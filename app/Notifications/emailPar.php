<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class emailPar extends Notification
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
        $url = url('http://mlappsvr.philsaga.com:8007/par/print/'.$this->r->eid);

            return (new MailMessage)
                ->subject($this->r->subject)
                ->level('info')
                ->action('PAR #'.$this->r->par_no, $url) 
                ->line(' '.$this->r->message)
                ->line('= = = = = = = = = = = = = = = = = = = = = = = = = = = =')
                ->line('* Par #: '.$this->r->par_no)
                ->line('* Accountable : '.$this->r->par_to)
                ->line('* Document Date : '.$this->r->doc_date)
                ->line('* Added By : '.$this->r->add_by)
                ->line('* Added Date : '.$this->r->add_on)
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
