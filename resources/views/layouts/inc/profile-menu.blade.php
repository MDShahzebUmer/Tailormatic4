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

<div class="card bg-common card-left bg-light border-0 ls-profile hidden visible-lg">
	<div class="card-body">
	  <ul class="nav d-md-block d-none">
		<li class="nav-item">	
		  <a class="nav-link <?php if($segment == '') { echo 'ls-active';}else { ''; } ?> " aria-current="page" href="{{ route('myaccount') }}"  >
			<i class="far fa-user-circle"></i> My Profile</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link <?php if($segment == 'edit') { echo 'ls-active';}else { ''; } ?>" href="{{ route('myaccount.edit') }}"  >
			<i class="fas fa-user-edit"></i>Edit Profile</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link <?php if($segment == 'orderlists') { echo 'ls-active';}else { ''; } ?>" href="{{ route('myaccount.orderlists') }}"  >
			<i class="fas fa-shopping-bag"></i>Order List</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link <?php if($segment == 'wishlists') { echo 'ls-active';}else { ''; } ?>" href="{{ route('myaccount.wishlists') }}"  ><i class="fas fa-list"></i>Wish List</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link <?php if($segment == 'passwordchange') { echo 'ls-active';}else { ''; } ?>" href="{{ route('myaccount.passwordchange') }}"  >
			<i class="fas fa-cog"></i>Change Password</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link <?php if($segment == 'refertofriend') { echo 'ls-active';}else { ''; } ?>" href="{{ route('myaccount.refertofriend') }}">
			<i class="fas fa-sync"></i>Refer To Friend</a>
		</li>
		{{-- <li class="nav-item">
		  <a class="nav-link" href="http://demo.duniyatailor.com/logout"  >
			<i class="fas fa-sign-out-alt"></i>&gt;Logout</a>
		</li> --}} 
		<li><a  href="{{ url('/logout') }}"
					 onclick="event.preventDefault();
					 document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
		<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
			{{ csrf_field() }}
		</form>
	  </ul>
	</div>
</div>