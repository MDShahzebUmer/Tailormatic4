<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Config;
use Voyager;
use App\Subscriber;


class MailChimpController extends Controller
{
        
     public $mailchimp;
     public $listId = 'fea239c642';
     
    public function __construct(\Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    public function manageMailChimp()
    {
        return view('mailchimp');
    }

    public function subscribe(Request $request)
    {
    	$this->validate($request, [
	    	'email' => 'required|email',
        ]);
           $subs = new Subscriber;
           $subs->email = $request->input('email');
           $subs->save();
        try {

        	
            $this->mailchimp
            ->lists
            ->subscribe(
                $this->listId,
                ['email' => $request->input('email')]
            );

            return redirect()->back()->with('success',Voyager::setting('msm'));

        } catch (\Mailchimp_List_AlreadySubscribed $e) {
            return redirect()->back()->with('error','Email is Already Subscribed');
        } catch (\Mailchimp_Error $e) {
            return redirect()->back()->with('error','Error from MailChimp');
        }
    }
}
