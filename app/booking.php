<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    //  use Notifiable;

    protected $table = "booking";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'booking_name', 'booking_phone_no', 'booking_description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function routeNotificationForNexmo()
    {
        return $this->user_phone_number;
    }
}
