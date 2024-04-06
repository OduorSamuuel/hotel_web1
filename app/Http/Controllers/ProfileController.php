<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
 public function headerProfile()
    {
        // Retrieve the user's profile information
        $profile = Profile::where('user_id', session('user_id'))->first();

        return view('pages.home', compact('profile'));
    }
    public function showCreateProfileForm()
    {
      
        $userId = auth()->user()->id;

        
        $profile = Profile::where('user_id', $userId)->first();

        if ($profile) {
         
            return redirect()->route('update-profile');
        } else {
           
            return view('pages.create-profile');
        }
    }
    
    public function viewProfile()
    {
      
        $userId = auth()->user()->id;

    
        $profile = Profile::where('user_id', $userId)->first();

   
        return view('pages.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'dob' => 'date',
            'phone_no' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:50',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:800',
        ]);

  
     $userId = auth()->user()->id;
     $userRole = auth()->user()->role; 
       
        $profile = Profile::where('user_id', $userId)->first();
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); 
            $photoName = 'profile_photo_' . time() . '.' . $extension; 
        
          
            $photo->move(public_path('profile_photos'), $photoName);
        
          
            $photoPath = 'profile_photos/' . $photoName;
        } else {
            $photoPath = $profile->photo_path ?? null; 
        }
        
        if ($profile) {
            $profile->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'dob' => $request->input('dob'),
                'phone_no' => $request->input('phone_no'),
                'country' => $request->input('country'),
                'bio' => $request->input('bio'),
                'photo_path' => $photoPath,
            ]);
        } else {
            // Create a new profile record
            Profile::create([
                'user_id' => $userId,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'dob' => $request->input('dob'),
                'phone_no' => $request->input('phone_no'),
                'country' => $request->input('country'),
                'bio' => $request->input('bio'),
                'photo_path' => $photoPath,
            ]);
        }

      
        if ($userRole === '1') {
            return redirect()->route('admin-profile')->with('success', 'Admin profile updated successfully.');
        } else {
            return redirect()->route('user')->with('success', 'User profile updated successfully.');
        }
        
    }
    
    public function showadminProfile()
    {
        $userId = auth()->user()->id;
        $profile = Profile::where('user_id', $userId)->first();
        
            // If the profile exists, show the admin profile page with filled details
            return view('admin.profile', compact('profile'));
     
    }
    
}
