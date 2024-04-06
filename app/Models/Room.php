<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Room extends Model
{
    use Searchable;

    protected $table = 'rooms';
    protected $primaryKey = 'RoomId';
    public $timestamps = false;

    protected $fillable = [
        'RoomId',
        'RoomNumber',
        'RoomType',
        'image_data',
        'PricePerNight',
        'Status',
        'NoofAdults',
        'Meals',
        'Amenities',
    ];

    public function toSearchableArray()
    {
        return[
            'RoomId' => $this->RoomID,
            'RoomNumber' => $this->RoomNumber,
            'RoomType' => $this->RoomType,
            'PricePerNight' => $this->PricePerNight,
            'Status'=>$this->Status,
        ];
    }
    }


?>