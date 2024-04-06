<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required|date',
        ]);

        // Save the event to the database
        Event::create([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
        ]);

        return redirect()->back()->with('success', 'Event created successfully');
    }
    public function index()
    {
        $events = Event::all(); // Retrieve all events from the database
        return view('admin.calendar', ['events' => $events]);
    }
    public function edit($id)
    {
        $events = Event::find($id);
        return view('admin.calendar', ['events' => $events]);
    }

    public function updates(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required|date',
        ]);
    
        // Find the event by ID and update it in the database
        Event::find($id)->update([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
        ]);
    
        return redirect()->back()->with('success', 'Event updated successfully');
    }
    

    public function destroy($id)
    {
        // Delete the event from the database
        Event::destroy($id);

        return redirect()->back()->with('success', 'Event deleted successfully');
    }
 

}
