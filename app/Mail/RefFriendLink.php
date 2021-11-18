<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Http\Request;
use Voyager;
class RefFriendLink extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $datal;

    public function __construct($data)
    {
       $this->data = $data;
       //print_r($this->data);
       //exit();
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
                   ->subject('Refer to Friend')
                   ->view('emails.reffriendlink')
                   ->with('data', $this->data);
    }
                   
}
