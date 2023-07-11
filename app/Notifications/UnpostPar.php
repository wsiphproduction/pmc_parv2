<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UnpostPar extends Notification
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
                ->line('Requesting to Unpost Par #'.$this->r->upid)
                ->line('Reason : '.$this->r->message)
                ->line('= = = = = = = = = = = = = = = = = = = = = = = = = = = =')
                ->line('* Par #: '.$this->r->upid)
                ->line('* Accountable : '.$this->r->par_to)
                ->line('* Document Date : '.$this->r->doc_date)
                ->line('* Added By : '.$this->r->add_by)
                ->line('* Added Date : '.$this->r->add_on)
                ->line('* Status : '.$this->r->status)
                ->line('= = = = = = = = = = = = = = = = = = = = = = = = = = = =')
                ->line('Copy the link below . . .')
                ->action('Unposting Par', $url)
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
