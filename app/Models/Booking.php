<?php
// app\Models\Booking.php
// app/Models/Booking.php

// app/Booking.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Booking extends Model
{
    use Searchable;

    protected $table = 'booking'; // Adjust the table name if it's different
    protected $primaryKey = 'BookingID';

    protected $fillable = ['BookingID', 'RoomID', 'UserID', 'CheckInDate', 'Adult', 'Children', 'CheckOutDate', 'TotalPrice'];

    public $timestamps = false;
    public function toSearchableArray()
    {
        return[
            'BookingID' => $this->BookingID,
            
        ];
    }
}


