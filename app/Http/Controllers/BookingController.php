<?php

namespace App\Http\Controllers;

use App\Models\Room; 
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use Laravel\Scout\Searchable;


class BookingController extends Controller
{
    
   public function allBooking()
    {
      

        $bookings = DB::table('booking')->get(); 
        return view('admin.all-booking', compact('bookings'));
    }
    public function editBooking()
    {
        // Assuming your model is named Booking

        $bookings = DB::table('booking')->get(); 
        return view('admin.edit-booking', compact('bookings'));
    }
  public function showAddBookingForm()
    {
        return view('add-booking'); // Assuming you have a blade file named 'add-booking.blade.php'
    }
    public function show()
    {
        $data = Booking::all();
        return view ('admin.all-booking', compact('data'));
    }




    public function search()
    {
        $bookings = Booking::search(request('search'))->paginate();
    return view ('all-booking',compact('bookings'));
    
    }


   // app/Http/Controllers/BookingController.php

public function create()
{
    return view('bookings.create');
}

public function store(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'room_id' => 'required|exists:rooms,id',
        'user_id' => 'required|exists:users,id',
        'check_in_date' => 'required|date',
        'adult' => 'required|integer|min:1',
        'children' => 'required|integer|min:0',
        'check_out_date' => 'required|date|after:check_in_date',
        'total_price' => 'required|numeric|min:0',
    ]);

    // Create a new booking
    $bookings = Booking::create($validatedData);

}


    public function addBooking(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'room_id' => 'required',
            'user_id' => 'required',
            'check_in_date' => 'required|date',
            'adult' => 'required|numeric',
            'children' => 'required|numeric',
            'check_out_date' => 'required|date',
            'total_price' => 'required',
        ]);

        // Create a new booking
        Booking::create($validatedData);

        // Redirect to a success page or wherever you want
        return redirect()->route('admin.add-booking')->with('success', 'Booking added successfully');
    }

    public function showEditBookingForm($bookingId)
    {
        $bookings = Booking::find($bookingId);

        if (!$bookings) {
            abort(404); // Handle the case when the booking is not found
        }

        return view('admin.edit-booking', compact('bookings')); // Assuming you have a blade file named 'edit-booking.blade.php'
    }

    public function updateBooking(Request $request)
    {
        // Validate the form data
        $request ->validate([
            'room_id' => 'required',
            'user_id' => 'required',
            'check_in_date' => 'required|date',
            'adult' => 'required|numeric',
            'children' => 'required|numeric',
            'check_out_date' => 'required|date',
            'total_price' => 'required',
        ]);

        $BookingId = auth()->user()->id;

        if (!$BookingId) {
            abort(404); 
        }

        $BookingId->update($request);

        // Redirect to a success page or wherever you want
        return redirect()->route('admin.add-booking')->with('success', 'Booking updated successfully');
    }

    // ----
  
    public function delete($id)
{
    $bookings = Booking::findOrFail($id);
    $bookings->delete();

    return redirect()->route('all.booking')->with('success', 'Booking deleted successfully.');
}
    // Existing methods...
   /* public function update(Request $request, $BookingID)
    {
        $bookings = Booking::findOrFail($BookingID);

        // Validate the request data as needed
        $validatedData = $request->validate([
            'BookingID'=>'required',
            'RoomID' => 'required',
            'UserID' => 'required',
            'CheckInDate' => 'required|date',
            'Adult' => 'required|integer',
            'Children' => 'required|integer',
            'CheckOutDate' => 'required|date',
            'TotalPrice' => 'required',
        ]);

        // Update the booking fields based on the form fields
        $bookings->RoomID = $request->input('RoomID');
        $bookings->UserID = $request->input('UserID');
        $bookings->CheckInDate = $request->input('CheckInDate');
        $bookings->Adult = $request->input('Adult');
        $bookings->Children = $request->input('Children');
        $bookings->CheckOutDate = $request->input('CheckOutDate');
        $bookings->TotalPrice = $request->input('TotalPrice');

        $bookings->save();
          // Find the booking by ID
          $booking = Booking::find($BookingID);

          // Update the booking with the validated data
          $booking->update($validatedData);
  
          // You can also add a response if needed
          return response()->json(['message' => 'Booking updated successfully']);

    }*/
    public function update(Request $request, $BookingID)
{
 

    $booking = Booking::find($BookingID);
    $booking->fill($request->all());
    $booking->save();

        // Add a flash message to the session
        session()->flash('success', 'Booking updated successfully');

    return redirect()->back()->with('success', 'Booking updated successfully');
}


    public function destroy($BookingID)
    {
        $bookings = Booking::findOrFail($BookingID);
        $bookings->delete();

        return redirect('/admin/all-booking')->with('success', 'Booking deleted successfully');
    }
    public function getTotalBookings()
    { $start_date = Carbon::now()->startOfMonth();
        $end_date = Carbon::now()->endOfMonth();
    
    
        $dailyBookings = Booking::whereBetween('CheckInDate', [$start_date, $end_date])
            ->groupBy('CheckInDate')
            ->selectRaw('date(CheckInDate) as date, count(*) as count')
            ->get();
        $totalBookings = Booking::count();
        $totalRooms = Room::where('Status', '!=', 'booked')->count();
        $roomData = Room::select('RoomType')
        ->whereIn('RoomType', ['Double', 'Suite', 'Executive'])
        ->groupBy('RoomType')
        ->selectRaw('count(*) as count')
        ->get();

        return view('admin.adminHome', [
            'roomData' => $roomData,
            'totalBookings' => $totalBookings,
            'totalRooms' => $totalRooms,
            'dailyBookings' => $dailyBookings,
        ]);
    }
    



}


