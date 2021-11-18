<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Voyager;
//use Illuminate\Http\Request;

class RefundItems extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $datal;

    public function __construct($refu)
    {
       $this->refu = $refu;
     
       
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
                   ->subject($this->refu['subject'])
                   ->view('emails.userrefunditem')
                   ->with('refu', $this->refu);
    }
                   
}
