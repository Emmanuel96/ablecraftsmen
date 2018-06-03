<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class artisanRegReceived extends Notification
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

    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
                    ->content("Artisan registration received" );
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
