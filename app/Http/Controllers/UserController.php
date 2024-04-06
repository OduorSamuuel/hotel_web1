<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class UserController extends Controller
{
    public function allCustomer()
    {
        // Assuming your model is named Booking

        $users = DB::table('users')->get(); // Change $booking to $bookings
        return view('admin.all-customer', compact('users'));
    }
    public function editCustomer()
    {
        // Assuming your model is named Booking

        $users = DB::table('users')->get(); // Change $booking to $bookings
        return view('admin.edit-customer', compact('users'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('all-customer', compact('user'));
    }

    public function editt($id)
    {
        $user = User::findOrFail($id);
        return view('edit-customer', compact('user'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'role' => 'required', // Add any other validation rules as needed
        ]);
    
        // Find the user by ID
        $user = User::find($id);
    
        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
    
        // Update the user's role
        $user->role = $request->input('role');
        $user->save();
    
        return redirect()->back()->with('success', 'User role updated successfully');
    }
    
    
   public function updateUser(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'role' => 'required', // Add any other validation rules as needed
        ]);
    
        // Find the user by ID
        $user = User::find($id);
    
        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
    
        // Update the user's role
        $user->role = $request->input('role');
        $user->save();
    
        return redirect()->back()->with('success', 'User role updated successfully');
    }
    public function allClient()
    {

        $client = DB::table('users')->where('role', 0)->get();
        return view('admin.all-client', compact('client'));

 
    }
    public function allStaff()
    {

        $staff = DB::table('users')->where('role', 1)->get();
        return view('admin.all-staff', compact('staff'));

 
    }
    public function delete($id)
{
    // Find the user by ID and delete it
    $user = User::find($id);

    if ($user) {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }

    return redirect()->back()->with('error', 'User not found');
}

}
