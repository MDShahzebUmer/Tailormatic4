<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Http\Request;
use Voyager;
class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $datal;

    public function __construct($orderdata,$invoicedata,$pdfurl)
    {
       $this->orderdata = $orderdata;
     $this->invoicedata = $invoicedata;
	   $this->pdfurl = $pdfurl;



    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return  $this->from(setting('site.server_web_email')
       ,'Duniyatailor.com')
                   ->attach($this->pdfurl)
                   ->view('emails.invoice')
                   ->with('orderdata', $this->orderdata)
				           ->with('invoicedata', $this->invoicedata);
    }

}
