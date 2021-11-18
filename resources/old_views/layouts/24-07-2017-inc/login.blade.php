<ul>
    <li><a href="{{url('/')}}">HOME</a></li>
    <li>|</li>
    <li><a href="{{url('/ecollection')}}/{{1}}">SHIRTS</a></li> 
    <li>|</li>
    <li><a href="{{url('/ecollection')}}/{{2}}">JACKETS</a></li>
    <li>|</li>
    <li><a href="{{url('/ecollection')}}/{{3}}">VESTS</a></li>  
    <li>|</li>
    <li><a href="{{url('/ecollection')}}/{{4}}">PANTS</a></li>    
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