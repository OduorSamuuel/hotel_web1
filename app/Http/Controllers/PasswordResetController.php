<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\PasswordReset;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showResetForm(Request $request, $code)
    {
        $passwordReset = PasswordReset::where('verification_code', $code)->first();

        if (!$passwordReset || Carbon::parse($passwordReset->expires_at)->isPast()) {
            // If the code has expired, pass the error message to the view
            $errorMessage = 'The verification code has expired.';
            return view('passwords.setPassword', ['code' => $code, 'errorMessage' => $errorMessage]);
        }

        return view('passwords.setPassword', ['code' => $code]);
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate a unique reset code
        $code = Str::random(64); 

        PasswordReset::create([
            'user_id' => $user->id,
            'verification_code' => $code,
            'expires_at' => now()->addMinutes(30), // Set an expiration time (adjust as needed)
        ]);

       
        $resetLink = route('reset-password-form', ['code' => $code]);
        Mail::to($user->email)->send(new ResetPasswordEmail($resetLink, $code));

        return view('passwords.setPassword');
    }

    public function validateResetCode(Request $request)
    {
        $request->validate([
            'userCode' => 'required',
            'code' => 'required',
        ]);

        $passwordReset = PasswordReset::where('verification_code', $request->code)->first();

        if (!$passwordReset || $passwordReset->expires_at < now()) {
            // Code is invalid or expired
            return response()->json(['error' => 'Invalid or expired verification code.'], 422);
        }

        $user = User::find($passwordReset->user_id);

        if (!$user) {
            // User not found
            abort(404);
        }

        if ($passwordReset->verification_code !== $request->userCode) {
            // Code does not match
            return response()->json(['error' => 'Verification code does not match.'], 422);
        }

        // Code is valid, proceed to the next step (you can return any additional data if needed)
        return response()->json(['status' => 'valid', 'user_id' => $user->id]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $passwordReset = PasswordReset::where('verification_code', $request->code)->first();

        if (!$passwordReset || $passwordReset->expires_at < now()) {
            // Code is invalid or expired
            return response()->json(['error' => 'Invalid or expired verification code.'], 422);
        }

        $user = User::find($passwordReset->user_id);

        if (!$user) {
            // User not found
            return response()->json(['error' => 'User not found.'], 404);
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Remove the reset code from the database
        $passwordReset->delete();

        return response()->json(['status' => 'Password reset successfully.']);
    }
    
    // Other methods...
}
