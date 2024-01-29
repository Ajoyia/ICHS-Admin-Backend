<?php

namespace App\Notifications;

use App\classes\emailSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class DefaultNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $template;
    public $subject;
    public $from_name;
    public $from_email;
    public $attachment;
    public function __construct($template=null,$subject='General',$from_name=null,$from_email=null,$attachment=null) {
        $this->template = $template;
        $this->subject = $subject;
        $this->from_name= $from_name;
        $this->from_email= $from_email;
        $this->attachment=$attachment;
        Log::info($this->attachment);
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
        return (new MailMessage)
            ->subject($this->subject)
            ->markdown('emails.templates',['template'=>$this->template])
            ->from($address = $this->from_email, $name = $this->from_name);
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
