<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Http\Request;
use Voyager;
class StatusOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $datal;

    public function __construct($mess)
    {
       $this->message = $mess;
      //print_r($this->message['subject']);
      // exit();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return  $this->from(setting('site.server_web_email')
       ,'EtailorClothes.com')
                   ->subject($this->message['subject'])
                   ->view('emails.status-change-product')
                   ->with('mess',$this->message);
    }
                   
}
