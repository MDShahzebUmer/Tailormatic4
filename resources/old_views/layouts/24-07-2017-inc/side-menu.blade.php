<?php  $cartcount = App\Http\Helpers::cartcount(); ?>
<ul class="nav navbar-nav">
    <li>
        <a href="#tab1">
            <img src="{{asset('/asset/img/Menu_01.jpg')}}" alt="">
            <a href="{{ url('/') }}"><span>Home</span></a>
        </a>
    </li>
    <li  class="dropdown">
        <a href="#tab2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="{{asset('/asset/img/Menu_02.jpg')}}" alt="">
            <span>MEN'S CLOTHING</span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="#">Option One</a></li>
            <li><a href="#">Option Two</a></li>
        </ul>
    </li>
    <li>
        <a href="#tab3">
            <img src="{{asset('/asset/img/Menu_03.jpg')}}" alt="">
            <span>Collection</span>
        </a>
    </li>
                        
                        <li>
                            <a href="#tab4">
                                <img src="{{asset('/asset/img/Menu_05.jpg')}}" alt="">
                                <a href="{{ url('/blog') }}"><span>Blog</span></a>
                            </a>
                        </li>
                         @if($cartcount > 0)
                        <li>
                            <a href="{{url('/cart')}}">
                                <img src="{{asset('/asset/img/Menu_05.jpg')}}" alt="">
                                <span>Cart Items (<?php echo $cartcount; ?>) </span>
                            </a>
                        </li>
                        @else
                        <li>
                            <a href="#" class="et-ck-cart-button">
                                <img src="{{asset('/asset/img/Menu_05.jpg')}}" alt="">
                                <span>Cart Items (0) </span>
                            </a>
                            <input type="hidden" id="crtcount" value="{{$cartcount}}">
                        </li>
                        @endif

                        @if (Auth::guest())
                        <li>
                            <a href="{{url('/login')}}">
                                <img src="{{asset('/asset/img/Menu_05.jpg')}}" alt="">
                                <span>Login</span>
                            </a>
                        </li>
                        @else

                        <li>
                            <a href="{{url('/myaccount')}}">
                                <img src="{{asset('/asset/img/Menu_05.jpg')}}" alt="">
                                <span>My Account</span>
                            </a>
                        </li>
                       
                        <li>
                            <a  href="{{ url('/logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <img src="{{asset('/asset/img/Menu_05.jpg')}}" alt="">
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @endif
                </ul>
                <div class="et-tab-content">
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                            <div id="et-replace" class="et-nav-content" style="background-image:url({{asset('/asset/img/et-dummy-bg-01.jpg')}})">
                                <ul>
                                    <li>
                                        
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div id="et-replace" class="et-nav-content" style="background-image:url({{asset('/asset/img/et-dummy-bg-02.jpg')}});">
                               <ul>
                                <li>
                                    <a href="{{URL('/designshirts')}}"><span>Custom Shirts</span></a>
                                </li>
                                <li>
                                    <a href="{{URL('/designjackets')}}"><span>CUSTOM JACKETS</span></a>
                                </li>
                                <li>
                                    <a href="{{URL('/designvests')}}"><span>Custom Vests</span></a>
                                </li>
                                <li>
                                    <a href="{{URL('/designpants')}}"><span>Custom Pants</span></a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <div id="et-replace" class="et-nav-content" style="background-image:url({{asset('/asset/img/et-dummy-bg-03.jpg')}});">
                            <ul>
                                <li>
                                    <a href="{{URL('/ecollection')}}/{{1}}"><span>Collection Shirts</span></a>
                                </li>
                                <li>
                                    <a href="{{URL('/ecollection')}}/{{2}}"><span>Collection JACKETS</span></a>
                                </li>
                                <li>
                                    <a href="{{URL('/ecollection')}}/{{3}}"><span>Collection Vests</span></a>
                                </li>
                                <li>
                                    <a href="{{URL('/ecollection')}}/{{4}}"><span>Collection Pants</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4">
                        <div id="et-replace" class="et-nav-content" style="background-image:url({{asset('/asset/img/et-dummy-bg-05.jpg')}});">
                            <ul>
                                <li>
                                   
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab5">
                        <div id="et-replace" class="et-nav-content" style="background-image:url({{asset('/asset/img/et-dummy-bg-06.jpg')}});">
                            <ul>
                                <li>
                                    <a href="#."></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
            