<?php

namespace App\Providers;
use App\Services\ReservationService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\reportsController;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
 public function boot()
{
    View::composer('pages.home', function ($view) {
        $data = RoomController::showRooms();

            $view->with($data);
        });
     
            View::composer('pages.home', function ($view) {
                $bookingController = app()->make(BookingController::class);
                $data = $bookingController->getTotalBookings();
    
                $view->with([
                    'totalBookings' => $data['totalBookings'],
                    'totalRooms' => $data['totalRooms'],
                    'roomData' => $data['roomData'],
                    'dailyBookings' => $data['dailyBookings'],
                ]);
            });
            
        }
    }
