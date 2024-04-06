<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use Illuminate\Support\Str;
use View;

class LogController extends Controller
{
    public function checkEmail(Request $request)
    {
        $emailToCheck = $request->input('email');

        $user = User::where('email', $emailToCheck)->first();

        if ($user) {
            return response()->json(['status' => 'found']);
        } else {
            return response()->json(['status' => 'not found']);
        }
    }

    public function setPassword(Request $request)
    {
        // Set the password for the user (you can implement this part)
    }
    public function signIn(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
    
        $user = User::where('email', $email)->first();
    
        if (!$user) {
            return response()->json(['error' => 'Invalid email or password']);
        }
    
        if (!$user->is_verified) {
            return response()->json(['error' => 'Account not verified. Check your email for the account activation link.']);
        }
    
        if (auth()->attempt(['email' => $email, 'password' => $password])) {
            Session::put('isLoggedIn', true);
    
            if (auth()->user()->role == 1) {
                session(['user_id' => $user->id]);
                return response()->json(['status' => 'success', 'message' => 'Admin logged in', 'role' => 'admin']);
            } else {
                session(['user_id' => $user->id]);
                return response()->json(['status' => 'success', 'message' => 'User logged in', 'role' => 'user']);
            }
        }
    
        return response()->json(['error' => 'Invalid password. Please try again.']);
    }
    
    
    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already in use.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.confirmed' => 'The passwords do not match.',
        ]);
    
    
    
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()->first()]);
    }
        $verificationToken = $this->generateUniqueVerificationToken();

        $user = new User();
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->verification_token = $verificationToken;
        $user->token_expiration_time = now()->addHours(24);
        $user->is_verified = false;
        $user->role = false;

        $user->save();

        $tokenLink = route('verify', ['token' => $verificationToken]);

        try {
            Mail::to($user->email)
                ->send(new VerificationEmail($tokenLink));

            // Redirect to a success page or provide feedback to the user
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            // Handle email sending failure
            return response()->json(['error' => 'Registration successful, but the verification email could not be sent.']);
        }
    }

    private function generateUniqueVerificationToken()
    {
        $token = Str::random(40);

        while (User::where('verification_token', $token)->exists()) {
            $token = Str::random(40);
        }

        return $token;
    }
    public function adminHome(){
        return view('admin\AdminHome');
    }

    
    public function signOut()
{
    Session::forget('isLoggedIn');
    Session::forget('user_id');

  return View('pages.home');
}


}


