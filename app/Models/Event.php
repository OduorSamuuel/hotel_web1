<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event'; // Adjust the table name if it's different
    public $timestamps = false;

    // Event.php

protected $primaryKey = 'id';
   protected $fillable = ['name', 'date'];

}
