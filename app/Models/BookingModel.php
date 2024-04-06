<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingModel extends Model
{
    use HasFactory;
    protected $table = 'booking'; // Adjust the table name if it's different
    protected $fillable = ['BookingID', 'RoomID', 'UserID', 'CheckInDate', 'Adult', 'Children', 'CheckoutDate', 'TotalPrice'];
}
