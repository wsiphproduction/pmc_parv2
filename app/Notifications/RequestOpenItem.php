<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RequestOpenItem extends Notification
{
    use Queueable;
    
    public $r; 
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->r = $request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('http://172.16.20.28:8001/par/login');

            return (new MailMessage)
                ->subject($this->r->subject)
                ->level('info')    
                ->line(' '.$this->r->message)
                ->line('= = = = = = = = = = = = = = = = = = = = = = = = = = = =')
                ->line('* Tracking # : '.$this->r->tracking)
                ->line('* Item : '.$this->r->item)
                ->line('* Details : '.$this->r->details)
                ->action('Open Request', $url)
                ->line('= = = = = = = = = = = = = = = = = = = = = = = = = = = =')
                ->line('Regards,')
                ->line('MCD Department');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
