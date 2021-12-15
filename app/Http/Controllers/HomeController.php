<?php

namespace App\Http\Controllers;
use DB;
use Session;
use View;
//use Illuminate\Http\Request;
use App\Http\Requests\ConatctRequest;
use App\Http\Requests\ReferfRequest;
use Illuminate\Support\Facades\Route;
use Validator;
use Request;
use App\Contact;
use Mail;
use App\Mail\Reminder;
use App\Mail\RefReminder;
use Illuminate\Support\Collection;
use App\User;
use App\State;
use App\Etfabric;
use App\Contrast;
use App\Refertofriend;
use Auth;
use App\Http\Helper;
use Voyager;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $successfully;
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /*Welcome blade call*/
    public function index()
    {
        $data['slider']= DB::table('slides')->orderBy('order', 'ASC')->get();
        $data['client']= DB::table('testimonials')->orderBy('order', 'ASC')->get();
        $data['about'] = DB::table('pages')->where('id', '=', 3)->get();
        $data['soc']= DB::table('socialicons')->where('status', '=', 'ACTIVE')->orderBy('order', 'ASC')->get();
        return view::make('welcome')->with('data',$data);

    }
    /*Common Page Call*/
   public function pages($slug = 'test')
    {
         if($slug != '')
         {
            $data['data'] = DB::table('pages')->where('slug', '=', $slug)->get();
            if ($data['data']->isEmpty())
            {
              return view::make('errors/404');
            }
            else{
                 $data['faqs'] = DB::table('faqs')->orderBy('faq_order', 'ASC')->get();
                 $data['soc']  = DB::table('socialicons')->where('status', '=', 'ACTIVE')->orderBy('order', 'ASC')->get();
                 return view::make('page_template')->with('data',$data);
            }
         }
         else{
             return view::make('errors/404');

         }


    }
     /*Contac Us send Mail and Record Save*/
    public function inquirypost(ConatctRequest $request)
   {

       $cont = new Contact;
       $cont->con_subject = Request::input('con_subject');
       $cont->con_name    = Request::input('con_name');
       $cont->con_email   = Request::input('con_email');
       $cont->con_mobile  = Request::input('con_country_code').Request::input('con_mobile');
       $cont->con_message = Request::input('con_message');
       $data =  array(
        'con_subject' => $cont->con_subject,
        'con_name' => $cont->con_name,
        'con_email' => $cont->con_email,
        'con_mobile' => $cont->con_mobile,
        'con_message' => $cont->con_message
         );

        $cont->save();

        Mail::to(setting('site.web_email'))->send(new Reminder($data));
        Session::flash('message','E-mail has been sent Successfully');
        return redirect()->back();
   }

    public function check_email($ids)
    {
        $user = User::where('email', '=', $ids)->first();
        if($user == null)
        {
         return response()->json(array('em' => ''), 200);
        }
        else
        {
            return response()->json(array('em' => 'Already a Member?'), 200);
        }
    }

    public function refertofriend(ReferfRequest $request)
    {

       if(Auth::check())
       {
           $user_id = Auth::user()->id;
        }
       else
       {

           $user_id ='';
        }


          $ref = new  Refertofriend;
          $ref->user_id = $user_id;
          $ref->name = $request->name;
          $ref->email = $request->email;
          $ref->phone = $request->phone;
          $ref->message =$request->message;
          $ref->fname =$request->fname;
          $ref->femail =$request->femail;
          $ref->save();
          $data = [
                'name' => $request->name,
                'fname' => $request->fname,
                'message' => $request->message,
          ];


          Mail::to($request->email)->send(new RefReminder($data));
          Session::flash('reffriend','E-mail has been sent Successfully to friend');
          return redirect()->back();
    }

public function renderingprocess($id=null){
      if($id != ''){
        $ids = $id;
                    $ck = Etfabric::select('id')->where('id','=',$ids)->get();

                    if(count($ck) > 0){

                      $sta = 1;


                      $fabsta = Etfabric::findOrFail($ids);
                      $fabsta->active_fabric = 2;
                      $fabsta->save();
                       $soc = DB::table('socialicons')->where('status', '=', 'ACTIVE')->orderBy('order', 'ASC')->get();
                       return view('thank-youred')->with(compact('ids','soc','sta'));

                    }else{
                         $sta = 2;
                         $soc = DB::table('socialicons')->where('status', '=', 'ACTIVE')->orderBy('order', 'ASC')->get();
                        return view('thank-youred')->with(compact('ids','soc','sta'));

                    }



      }else{
        //$sta = 3;
       //$soc = DB::table('socialicons')->where('status', '=', 'ACTIVE')->orderBy('order', 'ASC')->get();
             return Redirect()->to('/');

      }


    }

 public function renderingprocesscont($id=null){
      if($id != ''){
        $ids = $id;
                    $ck = Contrast::select('id')->where('id','=',$ids)->get();

                    if(count($ck) > 0){

                      $sta = 1;


                      $fabsta = Contrast::findOrFail($ids);
                      $fabsta->cont_status = 2;
                      $fabsta->save();
                       $soc = DB::table('socialicons')->where('status', '=', 'ACTIVE')->orderBy('order', 'ASC')->get();
                       return view('thank-youred')->with(compact('ids','soc','sta'));

                    }else{
                         $sta = 2;
                         $soc = DB::table('socialicons')->where('status', '=', 'ACTIVE')->orderBy('order', 'ASC')->get();
                        return view('thank-youred')->with(compact('ids','soc','sta'));

                    }



      }else{
        //$sta = 3;
       //$soc = DB::table('socialicons')->where('status', '=', 'ACTIVE')->orderBy('order', 'ASC')->get();
             return Redirect()->to('/');

      }


    }

}
