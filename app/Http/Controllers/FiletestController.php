<?php

namespace App\Http\Controllers;
use DB;
use Session;
use App\Http\Requests\ConatctRequest;
use Illuminate\Support\Facades\Route;
use Request;
use Illuminate\Support\Collection;
use App\your;

class FiletestController extends Controller
{
   /*rename(base_path() . '/public/storage/filetest/1.png', base_path() .'/public/storage/test/1.png');
       return view('filetest');*/
   public function testfile()
   {
      $msg = "This is a simple message.";
      return response()->json(array('msg'=> $msg), 200);
   }

   public function postJquery(Request $r)
   {
       if($r->ajax())
       {
       	//return response($r->all());
       	   $u = new your();
       	   $u->name =  $r->name;
       	   $u->email = $r->email;
       	   $u->mobile = $r->mobile;
       	   if($u->save())
       	   {
       	   	return response(['mesg' => 'insert sucessfuly']);
       	   }
       }

   }
}
