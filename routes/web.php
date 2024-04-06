<?php
namespace App\Http\Controllers;

use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\reportsController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;



use App\Models\Booking;
use App\Models\Room;
//home
Route::get('/', function () {
    return view('pages.home');
})->name('home');

//forms
Route::get('/log', function () {
    return view('pages.log');
})->name('log');

//room details
Route::post('/results', function () {
    return view('results');
})->name('results');

//forms operations
Route::post('/check-email', [LogController::class, 'checkEmail'])->name('check-email');
Route::post('/register', [LogController::class, 'register'])->name('register');
Route::get('/verify/{token}', [VerificationController::class, 'verify'])->name('verify');
Route::post('/signin', [LogController::class, 'signIn'])->name('signin');
Route::get('/pages/success', function () {
    return view('pages.success');
})->name('pages.success');

//admin
Route::get('/admin/home', [LogController::class, 'adminHome'])
    ->name('admin.home')->middleware('role');
//Password reset
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('reset-password');
Route::get('/reset', function () {
    return view('passwords.reset');
})->name('reset');

Route::get('/send-reset-link', [PasswordResetController::class, 'showEmailForm'])->name('send-reset-link-form');
Route::post('/validate-reset-code', [PasswordResetController::class, 'validateResetCode'])->name('validate-reset-code');
Route::post('/send-reset-link', [PasswordResetController::class, 'sendResetLink'])->name('send-reset-link');
Route::get('/reset-password/{code}', [PasswordResetController::class, 'showResetForm'])->name('reset-password-form');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('reset-password');


//Rooms
Route::get('/room/{roomId}', [RoomController::class, 'showRoomDetails'])->name('room.details');
Route::get('/room',function(){
    return view('pages.room');
})->name('room');





/*
// Admin routes
Route::group(['prefix' => 'admin'], function () {
    // ... (your existing admin routes)
});
*/

//Payment
Route::get('/success', function () {
    return view('payment.success');
})->name('success');



//Protected routes


    Route::get('/user', [ProfileController::class, 'viewProfile'])->name('user');

    Route::post('/payment',[MpesaController::class,'show'])->name('payment');
    Route::post('/perform-stk-push', [MpesaController::class, 'performStkPush'])->name('perform-stk-push');
   
    Route::get('/querystk-push', [MpesaController::class, 'queryStkPush'])->name('query.stk.push');

    

Route::get('/admin-profile', [ProfileController::class,'showadminProfile'])->name('admin-profile');

 


    //Route::get('/query-stk-push', 'MpesaController@queryStkPush')->name('query.stk.push');

    Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile')->middleware('auth');
    Route::post('/create-profile', [ProfileController::class, 'create'])->name('create-profile');



Route::get('/home', [ProfileController::class, 'headerProfile'])->name('home');


Route::get('/admin/all-bookings', [BookingController::class, 'show'])->name('all-booking');
route::get('/admin/edit-booking/{id}', [BookingController::class, 'editBooking'])->name('edit.booking');
// web.php
Route::get('/allCustomer', 'UserController@allCustomer')->name('allCustomer');
Route::get('/editCustomer', 'UserController@editCustomer')->name('editCustomer');

//route::get('/admin/edit-booking/{id}', [BookingController::class, 'editBooking'])->name('edit.booking');

route::get('/admin/edit-booking', [BookingController::class, 'editBooking'])->name('edit-booking');
route::get('/admin/edit-customer', [UserController::class, 'updateUser'])->name('edit-customer');


route::get('/admin/add-booking', function() {
    return view('admin.add-booking');
})->name('add-booking');

route::get('/admin/all-customer', function() {
    return view('admin.all-customer');
})->name('all-customer');

route::get('/admin/edit-customer', function() {
    return view('admin.edit-customer');
})->name('edit-customer');

route::get('/admin/add-customer', function() {
    return view('admin.add-customer');
})->name('add-customer');

Route::get('/admin/all-rooms', [RoomController::class, 'show'])->name('all-rooms');

route::get('/admin/edit-room', function() {
    return view('admin.edit-room');
})->name('edit-room');


route::get('/admin/add-room', function() {
    return view('admin.add-rooms');
})->name('room.create');

Route::get('/admin/all-rooms', [RoomController::class, 'allRooms'])->name('all-rooms');

//route::get('/admin/edit-rooms', function() {return view('admin.edit-rooms');})->name('edit-rooms');


route::get('/admin/all-staff', function() {
    return view('admin.all-staff');
})->name('all-staff');

route::get('/admin/edit-staff', function() {
    return view('admin.edit-staff');
})->name('edit-staff');

route::get('/admin/add-staff', function() {
    return view('admin.add-staff');
})->name('add-staff');

route::get('/admin/pricing', function() {
    return view('admin.pricing');
})->name('pricing');

route::get('/admin/email/compose', function() {
    return view('admin.email.compose');
})->name('compose');

route::get('/admin/email/inbox', function() {
    return view('admin.email.inbox');
})->name('inbox');

route::get('/admin/email/mail-veiw', function() {
    return view('admin.email.mail-veiw');
})->name('mail-veiw');

route::get('/admin/employees', function() {
    return view('admin.employees');
})->name('employees');

route::get('/admin/invoicess', function() {
    return view('admin.invoices');
})->name('invoices');

route::get('/admin/payments', function() {
    return view('admin.payments');
})->name('payments');

route::get('/admin/expenses', function() {
    return view('admin.expenses');
})->name('expenses');

route::get('/admin/blog', function() {
    return view('admin.blog');
})->name('blog');

route::get('/admin/blog-details', function() {
    return view('admin.blog-details');
})->name('blog-details');

route::get('/admin/add-blog', function() {
    return view('admin.add-blog');
})->name('add-blog');

route::get('/admin/edit-blog', function() {
    return view('admin.edit-blog');
})->name('edit-blog');

route::get('/admin/assets', function() {
    return view('admin.assets');
})->name('assets');

route::get('/admin/activities', function() {
    return view('admin.activities');
})->name('activities');

route::get('/admin/booking-reports', function() {
    return view('admin.booking-reports');
})->name('booking-reports');

Route::get('admin/booking-reports', [reportsController::class, 'viewUserReport'])->name('booking-reports');



route::get('/admin/invoice-reports', function() {
    return view('admin.invoice-reports');
})->name('invoice-reports');

route::get('/admin/settings', function() {
    return view('admin.settings');
})->name('settings');

route::get('/admin/uikit', function() {
    return view('admin.uikit');
})->name('uikit');

route::get('/admin/typography', function() {
    return view('admin.typography');
})->name('typography');

route::get('/admin/tabs', function() {
    return view('admin.tabs');
})->name('tabs');

route::get('/admin/form-basic-inputs', function() {
    return view('admin.form-basic-inputs');
})->name('form-basic-inputs');

route::get('/admin/form-input-groups', function() {
    return view('admin.form-input-groups');
})->name('form-input-groups');

route::get('/admin/form-horizontal', function() {
    return view('admin.form-horizontal');
})->name('form-horizontal');

route::get('/admin/tables-basic', function() {
    return view('admin.tables-basic');
})->name('tables-basic');

route::get('/admin/form-vertical', function() {
    return view('admin.form-vertical');
})->name('form-vertical');

route::get('/admin/tables-datatables', function() {
    return view('admin.tables-datatables');
})->name('tables-datatables');

route::get('/admin/forgot-password', function() {
    return view('admin.forgot-password');
})->name('forgot-password');

route::get('/admin/change-password', function() {
    return view('admin.change-password');
})->name('change-password');

route::get('/admin/lock-screen', function() {
    return view('admin.lock-screen');
})->name('lock-screen');

route::get('/admin/profile', function() {
    return view('admin.profile');
})->name('profile');

route::get('/admin/gallery', function() {
    return view('admin.gallery');
})->name('gallery');

//route::get('/admin/calendar', function() {return view('admin.calendar');})->name('admin.calendar');
Route::get('admin/add-rooms', [RoomController::class, 'create'])->name('room.create');
Route::get('/rooms/edit',[RoomController::class, 'editAll'])->name('rooms.editAll');
Route::get('/logout', [LogController::class, 'signOut'])->name('logout');
Route::get('/all-client', [UserController::class, 'allClient'])->name('all-client');
//Route::put('/rooms/{id}', [RoomController::class,'update'])->name('rooms.update');
Route::put('/rooms/update/{id}', 'App\Http\Controllers\RoomController@update')->name('update.room');
Route::put('/rooms/destroy/{id}', 'App\Http\Controllers\RoomController@destroy')->name('rooms.destroy');
Route::get('/reports' ,[reportsController::class,'viewUserReport']);
Route::get('/reports/download' ,[reportsController::class,'downloadUserReport'])->name('bookings');
Route::get('/reports/bookings',function(){
return view('reports.bookingreport');
});

// routes/web.php



Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/all-booking', [BookingController::class, 'allBooking'])->name('all-booking');
Route::get('/admin/add-booking', [BookingController::class, 'addBooking'])->name('add-booking');

Route::resource('bookings', BookingController::class);


Route::get('/admin/all-rooms', [RoomController::class, 'allRooms'])->name('all-rooms');


//route::get('/admin/all-booking', function() {
 //   return view('admin.all-booking');
//})->name('all-booking');

// routes/web.php

Route::get('/add-booking', 'BookingController@showAddBookingForm')->name('add.booking');

// routes/web.php

//Route::get('/all-booking', 'BookingController@search')->name('all-booking.search');
Route::get('/search', [BookingController::class,'search']);

//Route::get('/search', 'RoomController@search')->name('search');
Route::get('search', [RoomController::class,'search']);


//Route::get('/all-rooms', [RoomController::class, 'allRooms']);

Route::get('/AdminHome', [AdminController::class, 'AdminHome'])->name('AdminHome');Route::get('/room/{roomId}', [ReservationController::class, 'showRoomDetails'])->name('room.details');

Route::post('/check_availability', [ReservationController::class, 'checkAvailability'])->name('check_availability');
Route::get('/logout', [LogController::class, 'signOut'])->name('logout');


// routes/web.php
Route::get('/admin/all-customer', [UserController::class, 'allCustomer'])->name('all-customer');
Route::get('/admin/edit-customer', [UserController::class, 'editCustomer'])->name('edit-customer');

// routes/web.php
//Route::patch('/admin/all-customer/{id}', 'UserController@updateUser')->name('updateUser');


// Add this line to create a route for updating the user

Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('editUser');
Route::patch('/user/{id}', [UserController::class, 'update'])->name('updateUser');

Route::get('/all-client', [UserController::class, 'allClient'])->name('all-client');

Route::get('/all-staff', [UserController::class, 'allStaff'])->name('all-staff');

Route::get('/admin/edit-booking/{id}', 'BookingController@edit')->name('edit.booking');

Route::get('/booking/{id}/edit', 'BookingController@edit');

Route::get('/admin/delete-booking/{id}', 'BookingController@delete')->name('delete.booking');

Route::get('/deleteUser/{id}', 'App\Http\Controllers\UserController@delete')->name('deleteUser');
Route::get('/editUser/{id}', 'App\Http\Controllers\UserController@edit')->name('editUser');
Route::get('/updateUser/{id}', 'App\Http\Controllers\UserController@updateUser')->name('updateUser');
Route::patch('/updateUser/{id}', 'App\Http\Controllers\UserController@update')->name('updateUser');

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
// routes/web.php
//Route::put('/admin/edit-rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');
Route::put('/bookings/update/{id}', 'App\Http\Controllers\BookingController@update')->name('update.booking');
Route::put('/rooms/update/{id}', 'App\Http\Controllers\RoomController@update')->name('update.room');
//Route::put('/rooms/update/{id}', 'App\Http\Controllers\RoomController@updates')->name('update.rooms');
Route::put('/rooms/delete/{id}', 'App\Http\Controllers\RoomController@delete')->name('rooms.delete');





Route::delete('/bookings/delete/{id}', 'App\Http\Controllers\BookingController@destroy')->name('delete.booking');

Route::resource('bookings', BookingController::class);



// Add a route for handling the form submission
Route::post('admin/add-rooms', [RoomController::class, 'store'])->name('room.store');

Route::get('/rooms/edit-rooms', [RoomController::class, 'editRooms'])->name('rooms.edit');

// Route to handle the form submission and update the room details
Route::put('/rooms/{RoomID}', [RoomController::class, 'update'])->name('rooms.update');
//Route::put('/rooms/{$RoomId}', [RoomController::class, 'updateRoom'])->name('rooms.update');


Route::resource('RoomID', 'RoomController');


Route::post('/events/store', [EventController::class, 'store'])->name('events.store');


Route::delete('admin/calendar/{id}', [EventController::class, 'destroy'])->name('events.destroy');


Route::get('/admin/home', [BookingController::class, 'getTotalBookings'])
    ->name('admin.home')->middleware('role');

    Route::delete('/admin/edit-rooms/{RoomID}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    Route::get('/search-rooms', [RoomController::class, 'searchRooms'])->name('search.rooms');

  

   

    Route::get('/admin/calendar', [EventController::class, 'index'])->name('admin.calendar');
   
 
   Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
    Route::post('/check_availability', [ReservationController::class, 'checkAvailability'])->name('check_availability');

  