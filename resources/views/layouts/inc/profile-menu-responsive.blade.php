<?php   $segment = Request::segment(2); ?>
{{-- <ul class="user-frofile-list">
	<li  class="<?php if($segment == '') { echo 'ls-active';}else { ''; } ?>"><a href="{{ route('myaccount') }}">My Profile</a></li>
	<li class="<?php if($segment == 'edit') { echo 'ls-active';}else { ''; } ?>"><a  href="{{ route('myaccount.edit') }}">Edit Profile</a></li>
	<li class="<?php if($segment == 'orderlists') { echo 'ls-active';}else { ''; } ?>"><a  href="{{ route('myaccount.orderlists') }}">Order List</a></li>
	<li class="<?php if($segment == 'wishlists') { echo 'ls-active';}else { ''; } ?>"><a  href="{{ route('myaccount.wishlists') }}">Wish List</a></li>
	
	<li class="<?php if($segment == 'passwordchange') { echo 'ls-active';}else { ''; } ?>"><a  href="{{ route('myaccount.passwordchange') }}">Change Password</a></li>
	<li class="<?php if($segment == 'refertofriend') { echo 'ls-active';}else { ''; } ?>"><a  href="{{ route('myaccount.refertofriend') }}">Refer to Friend</a></li>
	<li><a  href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></li>
                                                     <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                            </form>

</ul> --}}

<div class="border-bottom mb-3 d-md-none d-sm-block visible-md visible-sm visible-xs">
    <ul class="nav nav-tabs card-header-tabs nav-fill">
      <li class="nav-item"> 
        <a
          style="color: #ffff"
          class="nav-link <?php if($segment == '') { echo 'ls-active';}else { ''; } ?>"
          aria-current="page"
          href="{{ route('myaccount') }}"  
          ><i class="far fa-user-circle"></i
        ></a>
      </li>
      <li class="nav-item">
        <a style="color: #ffff" class="nav-link <?php if($segment == 'edit') { echo 'ls-active';}else { ''; } ?>" href="{{ route('myaccount.edit') }}"  
          ><i class="fas fa-user-edit"></i></i></a>
      </li>
      <li class="nav-item">
        <a style="color: #ffff" class="nav-link <?php if($segment == 'orderlists') { echo 'ls-active';}else { ''; } ?>" href="{{ route('myaccount.orderlists') }}"  
          ><i class="fas fa-shopping-bag"></i
        ></a>
      </li>
      <li class="nav-item">
        <a style="color: #ffff" class="nav-link <?php if($segment == 'wishlists') { echo 'ls-active';}else { ''; } ?>" href="{{ route('myaccount.wishlists') }}"  
          ><i class="fas fa-list"></i></a>
      </li>
      <li class="nav-item">
        <a style="color: #ffff" class="nav-link <?php if($segment == 'passwordchange') { echo 'ls-active';}else { ''; } ?>" href="{{ route('myaccount.passwordchange') }}"  
          ><i class="fas fa-cog"></i
        ></a>
      </li>
      <li class="nav-item">
        <a style="color: #ffff" class="nav-link <?php if($segment == 'refertofriend') { echo 'ls-active';}else { ''; } ?>" href="{{ route('myaccount.refertofriend') }}"  
          ><i class="fas fa-sync"></i></a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="http://demo.duniyatailor.com/myaccount/logout"  
          ><i class="fas fa-sign-out-alt"></i></a>
      </li> --}}
      <li><a style="color: #ffff"   href="{{ url('/logout') }}"
        onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i></a></li>
                 <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        </form>
    </ul>
  </div>