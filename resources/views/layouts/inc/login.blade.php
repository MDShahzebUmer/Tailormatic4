<ul>
    <li><a href="{{url('/')}}">HOME</a></li>
    <li>|</li>
    <li><a href="{{url('/designshirts')}}">SHIRTS</a></li>
    <li>|</li>
    <li><a href="{{url('/designjackets')}}">JACKETS</a></li>
    <li>|</li>
    <li><a href="{{url('/designvests')}}">VESTS</a></li>
    <li>|</li>
    <li><a href="{{url('/designpants')}}">PANTS</a></li>
    <li>|</li>
    <li><a href="{{url('/design3pcsuits')}}">3 PIECE SUIT</a></li>
    <li>|</li>
    <li><a href="{{url('/design2pcsuits')}}">2 PIECE SUIT</a></li>
    <!-- <li>|</li>
    <li><a href="{{url('/designsuits')}}">WOMEN SUIT</a></li>  -->
</ul>
</div>
<div class="pt-right-p">
    <ul>
     @if (Auth::guest())

     <li><a href="{{ url('/login') }}">MY ACCOUNT</a></li>
     <li>|</li>
     <li><a href="{{ url('/login') }}">LOGIN </a></li>

     @else

     <li><a href="{{ url('/myaccount') }}">MY ACCOUNT</a></li>
     <li>|</li>
     <li>
         <a href="{{ url('/logout') }}"
         onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">

         <span>LOGOUT</span>
     </a>
     <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
         {{ csrf_field() }}
     </form>
 </li>
 @endif
</ul>
