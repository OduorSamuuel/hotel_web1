<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Booking;

use App\Models\BookingModel;
use Illuminate\Http\Request;

class reportsController extends Controller
{
    public function viewUserReport()
    {
        $users = Booking::all();
        return view('admin.booking-reports', compact('users'));
    }

    public function downloadUserReport()
    { 
        $users = Booking::all();
        $pdf = PDF::loadView('reports.bookingreport', compact('users'));
       
        return $pdf->download('user_report.pdf');
      
        //return $pdf->stream('user_report.pdf');
        dd('After download');
    }
}
