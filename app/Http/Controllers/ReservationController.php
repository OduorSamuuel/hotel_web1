<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking; 

class ReservationController extends Controller
{
    public function checkAvailability(Request $request)
    {
        // Validate the form data
        $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'adults' => 'required|integer',
            'child' => 'required|integer|min:0',
        ]);

        // Get the available rooms
        $availableRooms = $this->getAvailableRooms($request);

        // Store form data in the cache for 30 minutes
        $formData = [
            'check_in' => $request->input('check_in'),
            'check_out' => $request->input('check_out'),
            'adults' => $request->input('adults'),
            'child' => $request->input('child'),
        ];

        // Store the form data in the cache with a unique key
        Cache::put('form_data', $formData, now()->addMinutes(10));

        if (count($availableRooms) > 0) {
            return view('results', compact('availableRooms', 'formData'));
        } else {
            return view('results', compact('availableRooms'))->with('error', 'No available rooms for the selected dates and criteria.');
        }
    }

    public function index(Request $request)
    {
        // Add logic to retrieve and display available rooms based on form data
        $availableRooms = $this->getAvailableRooms($request);

        // dd the data for inspection
        dd($availableRooms);

        return view('results', ['availableRooms' => $availableRooms]);
    }

    private function getAvailableRooms(Request $request)
    { 
        // Get the booked room IDs for the given date range
        $bookedRoomIds = $this->getBookedRoomIds($request->input('check_in'), $request->input('check_out'));

        $notBookedRooms = Room::whereNotIn('RoomId', $bookedRoomIds)->get();

        return $notBookedRooms;
    }

    private function getBookedRoomIds($checkIn, $checkOut)
    {
        // Get booked room IDs based on the date range
        $bookedRoomIds = Booking::where(function($query) use ($checkIn, $checkOut) {
            $query->where('CheckInDate', '<', $checkOut)
                ->where('CheckOutDate', '>', $checkIn);
        })->pluck('RoomId')->toArray();

        return $bookedRoomIds;
    }
    
    public static function showRooms()
    {
        // Retrieve form data from cache
        $roomTypes = DB::table('rooms')->select('RoomType')->distinct()->pluck('RoomType');
        $rooms = DB::table('rooms')->get();

        return compact('roomTypes', 'rooms');
    }
    
    public function showRoomDetails($id)
    {
        $formData = Cache::get('form_data');
        $room = DB::table('rooms')->where('RoomId', $id)->first();
        
        if ($room) {
            $roomId = $id;
            $PricePerNight = $room->PricePerNight; 
    
            return view('pages.room', compact('room', 'formData', 'roomId', 'PricePerNight'));
        } else {
            // Handle the case where the room is not found
            // Redirect, show an error, etc.
            return redirect()->route('some.error.route');
        }
    }
}