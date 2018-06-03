<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\artisanBookedSMS; 
use App\Notifications\ArtisanBookingReceived; 
use App\Notifications\artisanRegistered; 
use App\Notifications\notifyRegisteredArtisan; 
use Illuminate\Notifications\Messages\NexmoMessage;
use Notification; 
use Mail; 
use App\booking; 
use App\artisan; 
use App\Mail\newBookingReceived; 
use App\Mail\newArtisanReg; 


class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function bookArtisans(Request $requests)
    {
        $phone_no = $requests->phone; 
        $name = $requests->name; 
        $description = $requests->message; 
        
        // //firstly send SMS notification to us about booking
        // Notification::route('twillio',"+2347037699184")
        //     ->notify(new ArtisanBookingReceived($phone_no, $name, $description));

        //secondly we send the sms to user who booked our service
        // Notification::route('TwilioChannel::class',$phone_no)
        //     ->notify(new artisanBookedSMS());
        
        Mail::to("emmanuel.audu1@aun.edu.ng")->send(new newBookingReceived());


        //lastly save in the DB
        $newBooking = booking::create([
            'booking_name' => $name, 
            'booking_phone_no' => $phone_no, 
            'booking_description' => $description,
        ]);         
    }

    public function regArtisans(Request $request)
    {
        //before saving the artisan to the DB
        //it shold notify me of the new artisan first 
        Notification::route('nexmo',"+2347037699184")
            ->notify(new artisanRegistered());

        // // //then send one to the artisan as well, so he knows we are considering him
        Notification::route('nexmo',$request->phone)
            ->notify(new notifyRegisteredArtisan());

        //after the whole notifications and all i need it to send an email to me... and daddy i guess 
        Mail::to("emmanuel.audu1@aun.edu.ng")->send(new newArtisanReg());

        $newArtisan = artisan::create(
            [
                'artisan_name' => $request->name, 
                'artisan_phone_no' => $request->phone,
                'artisan_confirmed' => 0, 
            ]); 

        
    }
}
