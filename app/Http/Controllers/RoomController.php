<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Room; 


class RoomController extends Controller
{
    public static function showRooms()
    {
        $roomTypes = DB::table('rooms')->select('RoomType')->distinct()->pluck('RoomType');
        $rooms = DB::table('rooms')->get();

        return compact('roomTypes', 'rooms');
    }
    public function showRoomDetails($id)
    {
        $room = DB::table('rooms')->where('RoomId', $id)->first();

        return view('pages.room', compact('room'));
    }

    public function Room()
    {
       // $rooms = Room::all();
       // return view('all-rooms', ['rooms' => $rooms]);
       $rooms = DB::table('rooms')->get(); 
       return view('admin.all-rooms', compact('rooms'));


    }
    // Assuming this is your RoomsController method for displaying all rooms
public function allRooms()
{
    // Retrieve rooms from the database
   // $rooms = Room::all();

    // Check if $rooms is null and handle it appropriately
    $rooms = DB::table('rooms')->get(); 
    return view('admin.all-rooms', compact('rooms'));

    if ($rooms === null) {
        $rooms = [];
    }
}
    // Pass the $rooms data to the view
    public function showAddRoomForm()
    {
        return view('admin.add-rooms'); // Assuming you have a blade file named 'add-booking.blade.php'
    }
  /*  public function search(Request $request)
{
    $search = $request->input('search');

    $rooms = Room::where('RoomId', 'LIKE', "%$search%")
                ->orWhere('RoomType', 'LIKE', "%$search%")
                ->orWhere('Status', 'LIKE', "%$search%")
                ->get();

    return view('admin.all-rooms', compact('rooms'));
}*/
public function create()
{
    return view('admin.add-rooms'); 
}
public function search()
{
    $rooms = Room::search(request('search'))->paginate();
return view ('admin.all-rooms',compact('rooms'));
}



public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'RoomNumber' => 'required',
        'RoomType' => 'required',
        'image_data' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        'PricePerNight' => 'required|numeric',
        'Status' => 'required',
        'NoofAdults' => 'required|integer',
        'Meals' => 'required',
        'AmenitiesDetails' => '',
    ]);

    // Handle image upload

    if ($request->hasFile('image_data')) {
        $image = $request->file('image_data');
        
        $imageName = 'room_image_' . time() . '.' . $image->getClientOriginalExtension();
        
        $image->move(public_path('Rooms_images'), $imageName);
       
        $imagePath = 'Rooms_images/' . $imageName;
       
    
    } else {
        $imagePath = null;
    }
    


    Room::create([
        'RoomNumber' => $request->RoomNumber,
        'RoomType' => $request->RoomType,
        'image_data' => $imagePath,
        'PricePerNight' => $request->PricePerNight,
        'Status' => $request->Status,
        'NoofAdults' => $request->NoofAdults,
        'Meals' => $request->Meals,
        'AmenitiesDetails' => $request->AmenitiesDetails,
    ]);


    return redirect()->route('room.create')->with('success', 'Room added successfully');
}

   public function updates(Request $request, $RoomID)
{
    // Validate the request data
   $rooms = Room::find($RoomID);
   $rooms->fill($request->all());
 
    // Save the updated room
    $rooms->save();
 // Add a flash message to the session
 session()->flash('success', 'Booking updated successfully');
    // Redirect back with success message or to a different page
    return redirect()->route('rooms.edit-rooms', $RoomID)->with('success', 'Room details updated successfully.');
}
public function editRooms()
{
    $rooms = Room::all(); 

    return view('admin.edit-rooms', ['rooms' => $rooms]);
}

public function updateRoom(Request $request, $RoomID)
{
    // Validate the form data
    $request->validate([
        'RoomNumber' => 'required',
        'RoomType' => 'required',
        'image_data' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'PricePerNight' => 'required|numeric',
        'Status' => 'required',
        'NoofAdults' => 'required|integer',
        'Meals' => 'required',
        'AmenitiesDetails' => 'required',
    ]);

    // Find the room by RoomID
    $room = Room::find($RoomID);

    if (!$room) {
        abort(404);
    }

    // Update the room attributes
    $room->update([
        'RoomNumber' => $request->input('RoomNumber'),
        'RoomType' => $request->input('RoomType'),
        'image_data' => $request->input('image_data'),
        'PricePerNight' => $request->input('PricePerNight'),
        'Status' => $request->input('Status'),
        'NoofAdults' => $request->input('NoofAdults'),
        'Meals' => $request->input('Meals'),
        'AmenitiesDetails' => $request->input('AmenitiesDetails'),
    ]);

    // Redirect to a success page or wherever you want
    return redirect()->route('admin.edit-rooms')->with('success', 'Room updated successfully');
}
/*
public function update(Request $request, $BookingID)
{
 

    $rooms = Room::find($BookingID);
    $rooms->fill($request->all());
    $rooms->save();

        // Add a flash message to the session
        session()->flash('success', 'Booking updated successfully');

    return redirect()->back()->with('success', 'Booking updated successfully');
}
*/

    public function edit($RoomId)
    {
        $room = Room::find($RoomId);
        return view('edit-rooms', compact('room'));
    }

/*
    public function update1(Request $request, $id)
    {
        $room = Room::find($id);
    
        if (!$room) {
          
            abort(404);
        }
    
        $room->fill($request->all());
        $room->save();
    
        // Add a flash message to the session
        session()->flash('success', 'Booking updated successfully');
    
        return redirect()->back()->with('success', 'Booking updated successfully');
    }
    */
  

    public function update(Request $request, $RoomID)
    {
     
        $request->validate([
            'RoomNumber' => 'required|int', 
        ]);

       
        $room = Room::find($RoomID);

    
        $room->update($request->all());

        return redirect()->route('edit-rooms')->with('success', 'Room updated successfully');
    }

    public function searchRooms(Request $request)
    {
        $search = $request->input('search');
    
        $rooms = Room::where('RoomId', 'LIKE', "%$search%")
            ->orWhere('RoomType', 'LIKE', "%$search%")
            ->orWhere('Status', 'LIKE', "%$search%")
            ->get();
    
        return response()->json(['rooms' => $rooms]);
    }
    
    public function destroy($RoomID)
    {
        Room::find($RoomID)->delete();

        return redirect()->route('edit-rooms')->with('success', 'Room deleted successfully!');
    }
    public function edit1($id)
{
    $room = Room::find($id);

    return view('admin.edit-rooms', compact('room'));
}
public function editAll()
{
    $rooms = Room::all(); // Or use any logic to fetch the rooms
  
    return view('admin.edit-rooms', compact('rooms'));
}
}
    
   


