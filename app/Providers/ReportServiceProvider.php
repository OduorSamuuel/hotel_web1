<?php

namespace App\Providers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\ServiceProvider;
use App\Models\Booking;
use App\Models\User;


class ReportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('reportService', function () {
            return new class {
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
                }

                public function generateUserReport()
                {
                    $usersWithProfiles = User::leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
                        ->select('users.*', 'profiles.name', 'profiles.email as profile_email', 'profiles.dob', 'profiles.phone_no', 'profiles.country', 'profiles.bio', 'profiles.photo_path')
                        ->get();

                    return view('admin.all_users-reports', compact('usersWithProfiles'));
                }

                public function downloadUserReportPdf()
                {
                    $usersWithProfiles = User::with('profile')->get();

                    $pdf = PDF::loadView('reports.allusersreports', compact('usersWithProfiles'));

                    return $pdf->download('all users_report.pdf');
                }
            };
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
