<?php
$soc =  $data['soc'];
$faq=$data['faqs'];
$data=$data['data'];
//print_r($data);
?>
@foreach ($data as $d)
 @endforeach
<?php  $seo = App\Http\Helpers::page_seo_details($d->id);?>
@include('layouts.inc.page_header')
@include('layouts.inc.page_menu')
<?php //echo '<pre>'.print_r($data,true).'</pre>' ?>
<?php //print_r($data); //echo $data['image'];?>
@if($d->slug == 'about-us')
<?php $other_page = App\OthersPage::select('*')->where('page_id','=','1')->limit(3)->get();?>

<section class="et-content">
	<div class="container">
    	<div class="row">
        	<div class="et-block">
            	<div class="col-md-5 col-xs-12">
                	<figure class="et-full-image">
                    	<img src="{{asset('/asset/img/about-us.png')}}" alt="etailor about">
                    </figure>
                </div>
                <div class="col-md-7 col-xs-12">
                	<h1 class="et-common-titile">{{ $d->title}} </h1>
                    {!! $d->body !!}
                </div>
            </div>
            <div class="et-block">
            	<div class="et-feature">
                	<ul class="featured-img-list">
                        @foreach ($other_page as $op)

                        <li>
                            <div class="inner">
                                <div class="img">
                                    <img src="{{url('storage/')}}/{{$op->image}}" alt="eTailor" />
                                </div>
                                <div class="content">
                                    <p>{!! $op->content !!}</p>
                                    <p class="small">{!! $op->subtitle !!}</p>
                                </div>
                            </div>
                        </li>

                        @endforeach
                    </ul>
                </div>
            </div>
            <?php $ot_page = App\OthersPage::select('*')->where('page_id','=','1')->whereIn('id',[4,5,6])->get();?>

            <div class="et-block">
                @foreach($ot_page as $ots)
            	<div class="col-md-4 col-sm-6 col-xs-12">
                	<div class="et-icon-box">
                    	<figure class="et-circle">
                        	<img src="{{url('storage')}}/{{$ots->image}}" alt="">
                        </figure>
                        <p>{!! $ots->content !!}</p>
                    </div>
                </div>
                @endforeach
            </div>
             <?php $oten_page = App\OthersPage::select('*')->where('id','=','13')->find(13);?>
            <div class="et-block">
            	<div class="col-md-10 col-xs-offset-1">
                	<div class="et-support" style="background-image:url({{url('storage/')}}/{{$oten_page->image}});">
                    	<div class="et-support-text">
                        	<p>{!! $oten_page->content !!}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@elseif($d->slug == 'contact-us')
<section class="et-content">
    <div class="container">
        <div class="row">
            <div class="et-sub-title et-fw">
                <h2>Contact Us</h2>
            </div>

           <div class="col-md-12 ">
              <p>  {!! $d->body !!} </p>
            </div>
            @if(Session::has('message'))

            <span class="alert alert-success">
              {{ Session::get('message') }}
          </span>
          @endif
               <form class="form-horizontal" role="form" method="POST" action="{{ url('/contact') }}">
                 {{ csrf_field() }}
            <div class="et-block">
                <div class="et-form">
                    <div class="col-md-6 col-xs-12 {{ $errors->has('con_subject') ? ' has-error' : '' }}">
                       <span class="input input--hoshi">

                            <input class="input__field input__field--hoshi" type="text" id="any" placeholder="Subject*" name="con_subject" required>
                            <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                                <span class="input__label-content input__label-content--hoshi"></span>
                            </label>
                        </span>
                        @if ($errors->has('con_subject'))
                        <span class="help-block">
                            <strong>{{ $errors->first('con_subject') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 col-xs-12 {{ $errors->has('con_name') ? ' has-error' : '' }}">

                        <span class="input input--hoshi">
                            <input class="input__field input__field--hoshi" type="text" id="any" placeholder="Full Name*" name="con_name" required>
                            <label class="input__label input__label--hoshi input__label--hoshi-color-2" for="input-5">
                                <span class="input__label-content input__label-content--hoshi"></span>
                            </label>
                        </span>
                        @if ($errors->has('con_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('con_name') }}</strong>
                        </span>
                        @endif

                    </div>
                    <div class="col-md-6 col-xs-12 {{ $errors->has('con_email') ? ' has-error' : '' }}">

                        <span class="input input--hoshi">
                            <input class="input__field input__field--hoshi" type="email" id="any" placeholder="Email*" name="con_email" required>
                            <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="input-6">
                                <span class="input__label-content input__label-content--hoshi"></span>
                            </label>
                        </span>
                        @if ($errors->has('con_email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('con_email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 col-xs-12 {{ $errors->has('con_mobile') ? ' has-error' : '' }}">

                        <span class="input input--hoshi">
                            <div class="" style="display: flex">
                                <?php $postids = App\Country::select('phonecode')->get();?>
                                {{-- <input class="" type="text" id="any" placeholder="Mobile Number*" name="con_mobile" required maxlength="12" minlength="10"> --}}
                                <select style="width: 103px;" name="con_country_code" id="" class="input__field input__field--hoshi" required>
                                    <option value="">select</option>
                                   @foreach ($postids as $code)
                                   <option value="{{ $code->phonecode }}">{{ $code->phonecode }}</option>
                                   @endforeach
                                </select>
                                <input class="input__field input__field--hoshi" type="text" id="any" placeholder="Mobile Number*" name="con_mobile" required maxlength="12" minlength="10">
                            </div>

                            <label class="input__label input__label--hoshi input__label--hoshi-color-2" for="input-5">
                                <span class="input__label-content input__label-content--hoshi"></span>
                            </label>
                        </span>
                        @if ($errors->has('con_mobile'))
                        <span class="help-block ">
                            <strong>{{ $errors->first('con_mobile') }}</strong>
                        </span>
                        @endif
                        @if ($errors->has('con_country_code'))
                        <span class="help-block ">
                            <strong>{{ $errors->first('con_country_code') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-12 col-xs-12 {{ $errors->has('con_message') ? ' has-error' : '' }}">
                        <span class="input input--hoshi">

                            <textarea class="input__field input__field--hoshi" type="message" id="any" placeholder="Write Your Message*" name="con_message" required></textarea>
                            <label class="input__label input__label--hoshi input__label--hoshi-color-2" for="input-5">
                                <span class="input__label-content input__label-content--hoshi"></span>
                            </label>
                        </span>
                         @if ($errors->has('con_message'))
                        <span class="help-block">
                            <strong>{{ $errors->first('con_message') }}</strong>
                        </span>
                        @endif

                    </div>
                    <div class="col-md-12 col-xs-12">
                        <input class="et-btn" type="submit" id="any" value="Submit"/>
                    </div>
                </div>
            </div>
          </form>

        </div>
    </div>
</section>
@elseif($d->slug == 'refer-to-friend')
<section class="et-content">
    <div class="container">
        <div class="row">
            <div class="et-sub-title et-fw">
                <h2>Refer To Friend</h2>
            </div>
            @if(Session::has('refermesg'))

<span class="alert alert-success">
  {{ Session::get('refermesg') }}
</span>
@endif
               <form class="form-horizontal" role="form" method="POST" action="{{ url('/referto') }}">
                 {{ csrf_field() }}
            <div class="et-block">
                <div class="et-form">
                    <div class="col-md-6 col-xs-12">
                        <?php echo ($errors->first('your name' ,"<li class='alert alert-danger'>:message </li>"));?>
                        <span class="input input--hoshi">
                            <input class="input__field input__field--hoshi" type="text" id="any" placeholder="Your Name*" name="fname" required>
                            <label class="input__label input__label--hoshi input__label--hoshi-color-2" for="input-5">
                                <span class="input__label-content input__label-content--hoshi"></span>
                            </label>
                        </span>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <?php echo ($errors->first('your email' ,"<li class='alert alert-danger fade in'>:message </li>"));?>
                        <span class="input input--hoshi">
                            <input class="input__field input__field--hoshi" type="text" id="any" placeholder="Your Email*" name="femail" required>
                            <label class="input__label input__label--hoshi input__label--hoshi-color-2" for="input-5">
                                <span class="input__label-content input__label-content--hoshi"></span>
                            </label>
                        </span>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <?php echo ($errors->first('name' ,"<li class='alert alert-danger fade in'>:message </li>"));?>
                        <span class="input input--hoshi">
                            <input class="input__field input__field--hoshi" type="text" id="any" placeholder="Full Name*" name="name" required>
                            <label class="input__label input__label--hoshi input__label--hoshi-color-2" for="input-5">
                                <span class="input__label-content input__label-content--hoshi"></span>
                            </label>
                        </span>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <?php echo  ($errors->first('email' ,"<li class='alert alert-danger fade in'>:message </li>"));?>
                        <span class="input input--hoshi">
                            <input class="input__field input__field--hoshi" type="email" id="any" placeholder="Email*" name="email" required>
                            <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="input-6">
                                <span class="input__label-content input__label-content--hoshi"></span>
                            </label>
                        </span>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <?php echo ($errors->first('phone' ,"<li class='alert alert-danger fade in'>:message </li>"));?>
                        <span class="input input--hoshi">
                            <input class="input__field input__field--hoshi" type="text" id="any" placeholder="Mobile Number*" name="phone" required>
                            <label class="input__label input__label--hoshi input__label--hoshi-color-2" for="input-5">
                                <span class="input__label-content input__label-content--hoshi"></span>
                            </label>
                        </span>
                    </div>
                    <div class="col-md-12 col-xs-12">
                        <span class="input input--hoshi">
                            <?php echo ($errors->first('message' ,"<li class='alert alert-danger fade in'>:message </li>"));?>
                            <textarea class="input__field input__field--hoshi" type="message" id="any" placeholder="Write Your Message*" name="message" required></textarea>
                            <label class="input__label input__label--hoshi input__label--hoshi-color-2" for="input-5">
                                <span class="input__label-content input__label-content--hoshi"></span>
                            </label>
                        </span>
                    </div>
                    <div class="col-md-12 col-xs-12">
                        <input class="et-btn" type="submit" id="any" value="Submit"/>
                    </div>
                </div>
            </div>
          </form>

        </div>
    </div>
</section>
@elseif($d->slug == 'how-we-work')
<section class="et-content">
	<div class="container">
    	<div class="row">
        	<div class="et-sub-title et-fw">
            	<h2>How We Work</h2>
            </div>
            <?php $hww_page = App\OthersPage::select('*')->where('page_id','=','2')->whereIn('id',[7,8,9])->get();?>
        	<div class="et-block">
            	<div class="col-md-3">
                    @foreach($hww_page as $hww)
                	<div class="et-fw {{$hww->step}} common-step">
                    	<h3>{{$hww->title}}</h3>
                        <ul class="et-work-list">
                        	<li>{!! $hww->content !!}</li>

                        </ul>
                        <div class="et-work-block mix-n-match">
                        	<figure class="et-work-icon">
                              <img src="{{url('storage/')}}/{{$hww->image}}" alt="">
                            </figure>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-md-6">
                	<div class="et-fw step-full">
                    	<div class="et-main-work">
                        	<img src="{{asset('/storage/')}}/{{ $d->image }}" alt="">
                        </div>
                    </div>
                </div>
                <?php $wwh_page = App\OthersPage::select('*')->where('page_id','=','2')->whereIn('id',[10,11,12])->get();?>
                <div class="col-md-3">
                	@foreach($wwh_page as $wwh)
                    <div class="et-fw {{$wwh->step}} common-step">
                        <h3>{{$wwh->title}}</h3>
                        <ul class="et-work-list">
                            <li>{!! $wwh->content !!}</li>

                        </ul>
                        <div class="et-work-block mix-n-match">
                            <figure class="et-work-icon">
                                <img src="{{url('storage/')}}/{{$wwh->image}}" alt="">
                            </figure>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</section>
@elseif($d->slug == 'faq')
<section class="et-content">
	<div class="container">
    	<div class="row">
        	<div class="et-sub-title et-fw">

            	<h2>Faq</h2>
            </div>
        	<div class="et-block">
            	<div class="fancy-collapse-panel">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

<?php
$ps=0;
?>
@foreach($faq as $f)
<?php
$ps++;
if($ps==1){
$contxt='class="panel-collapse collapse in"';
$contxtn='class=""';
}else{
$contxt='class="panel-collapse collapse"';
$contxtn='class="collapsed"';
}
?>

<div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo<?php echo $ps;?>">
                                <h4 class="panel-title">
                                    <a <?php echo $contxtn;?> data-toggle="collapse" data-parent="#accordion" href="#collapseTwo<?php echo $ps;?>" aria-expanded="false" aria-controls="collapseTwo<?php echo $ps;?>">{!! $f->faq_question !!}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo<?php echo $ps;?>" <?php echo $contxt;?> role="tabpanel" aria-labelledby="headingTwo<?php echo $ps;?>">
                                <div class="panel-body">
                                    {!! $f->faq_answer!!}
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@elseif($d->slug == 'terms-and-conditions')
<section class="et-content">
	<div class="container">
    	<div class="row">
        	<div class="et-sub-title et-fw">
            	<h2>{{ $d->title}}</h2>
            </div>
        	<div class="et-block">
            	{!! $d->body !!}
            </div>
        </div>
    </div>
</section>
@elseif($d->slug == 'privacy-policy')
<section class="et-content">
	<div class="container">
    	<div class="row">
        	<div class="et-sub-title et-fw">
            	<h2>{{ $d->title}}</h2>
            </div>
        	<div class="et-block">
            	{!! $d->body !!}
            </div>
        </div>
    </div>
</section>
@elseif($d->slug == 'return-and-refund-policy')
<section class="et-content">
	<div class="container">
    	<div class="row">
        	<div class="et-sub-title et-fw">
            	<h2>{{ $d->title}}</h2>
            </div>
        	<div class="et-block">
            	{!! $d->body !!}
            </div>
        </div>
    </div>
</section>
@elseif($d->slug == 'delivery')
<section class="et-content">
	<div class="container">
    	<div class="row">
        	<div class="et-sub-title et-fw">
            	<h2>{{ $d->title}}</h2>
            </div>
        	<div class="et-block">
            	{!! $d->body !!}
            </div>
        </div>
    </div>
</section>
@elseif($d->slug == 'garment-care')
<section class="et-content">
    <div class="container">
        <div class="row">
            <div class="et-sub-title et-fw">
                <h2>{{ $d->title}}</h2>
            </div>
            <div class="et-block">
                {!! $d->body !!}
            </div>
        </div>
    </div>
</section>
@else


  <section class="et-content">
	<div class="container">
    	<div class="row">
        	<div class="et-sub-title et-fw">
            	<h2>Not Found</h2>
            </div>
        	<div class="et-block">
            	404 Not Found
            </div>
        </div>
    </div>
</section>
@endif
@include('layouts.inc.footer')
