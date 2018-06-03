<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;


class ArtisanBookingReceived extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $phone = " "; 
    private $name = " "; 
    private $description = " "; 

    public function __construct($vPhone, $vName, $vDescription)
    {
        $this->phone = $vPhone; 
        $this->name = $vName; 
        $this->description = $vDescription; 
    }
 /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
                    ->content("We received a new booking from $this->name for $this->description" );
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
