<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Voyager;
//use Illuminate\Http\Request;

class AcancleorderItem extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $datal;

    public function __construct($u)
    {
       $this->u = $u;
     
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
                   ->subject('Cancellation Request, orderItem No.#'.$this->u['item_id'])
                   ->view('emails.admincancleitem')
                   ->with('u', $this->u);
       
    }
                   
}
