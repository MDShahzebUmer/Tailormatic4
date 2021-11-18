<?php   $segment = Request::segment(2); ?>
<ul class="user-frofile-list">
	<li  class="<?php if($segment == '') { echo 'active';}else { ''; } ?>"><a href="{{ route('myaccount') }}">My Profile</a></li>
	<li class="<?php if($segment == 'edit') { echo 'active';}else { ''; } ?>"><a  href="{{ route('myaccount.edit') }}">Edit Profile</a></li>
	<li class="<?php if($segment == 'orderlists') { echo 'active';}else { ''; } ?>"><a  href="{{ route('myaccount.orderlists') }}">Order List</a></li>
	<li class="<?php if($segment == 'wishlists') { echo 'active';}else { ''; } ?>"><a  href="{{ route('myaccount.wishlists') }}">Wish List</a></li>
	
	<li class="<?php if($segment == 'passwordchange') { echo 'active';}else { ''; } ?>"><a  href="{{ route('myaccount.passwordchange') }}">Change Password</a></li>
	<li class="<?php if($segment == 'refertofriend') { echo 'active';}else { ''; } ?>"><a  href="{{ route('myaccount.refertofriend') }}">Refer to Friend</a></li>
	<li><a  href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></li>
                                                     <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                            </form>

</ul>