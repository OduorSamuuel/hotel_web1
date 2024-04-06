<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = 'profile_id'; // Specify the actual primary key column name
    protected $fillable = [
        'user_id', 'name', 'email', 'dob', 'phone_no', 'country', 'bio', 'photo_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}