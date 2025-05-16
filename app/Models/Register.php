<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Register extends Model
{
    use HasFactory, HasApiTokens, Notifiable;


    protected $fillable = [
        'name', 'email', 'phonenumber', 'address', 'city', 'state', 'country', 'zipcode', 'role', 'gender', 'dob'
    ];

    protected $dispatchesEvents = [
        'created' => \App\Events\ReservationCreated::class,
    ];
}   
