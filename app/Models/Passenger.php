<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Passenger extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'last_name',
        'phone_number',
        'email',
        'emergency_contact',
        'address',
        'user_id'
    ];
}
