<?php

namespace App\Mail;

use Faker\Provider\ar_EG\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Log;

class GeneralEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $template;
    public $subject;
    private $attachment;
    public $from;
    public function __construct($template,$subject,$from,$attachment=null)
    {
        $this->template=$template;
        $this->subject=$subject;
        $this->attachment=$attachment;
        $this->from=['address'=>$from,'name'=>'Index Team'];
        // $this->from[0]['address']=$from;
        // $this->from[0]['name']='Bhola';

        // dd($this->from);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

     

        return $this->from($this->from)
            ->subject($this->subject)
            // ->view('emails.templates',['template'=>$this->template]);
            ->markdown('emails.templates',['template'=>$this->template]);
    }
    // public function attachments()
    // {
    //     return [
    //         Attachment::fromPath($this->attachment),
    //     ];
    // }
}
