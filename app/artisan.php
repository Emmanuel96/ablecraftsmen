<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class artisan extends Model
{
    use Notifiable; 

    protected $table = "artisans"; 

    protected $fillable= 
    [
        "artisan_name", 
        "artisan_phone_no", 
        "artisan_confirmed", 
        "artisan_address",
    ];

    public function routeNotificationForTwilio()
    {
        $this->artisan_phone_no; 
    }
}
