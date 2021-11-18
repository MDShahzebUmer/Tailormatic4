<?php  $seo = App\Http\Helpers::page_seo_details(24);?>
@include('../layouts.inc.page_header')
@include('../layouts.inc.page_menu')
@include('../layouts.inc.section_div')




  <div class="container">
      <div class="row">
          <div class="col-sm-12">
              <div class="et-sub-title et-fw">
                <h2>My Account</h2> 
              </div>
            </div>
          <div class="et-block">
              <div class="col-md-3">
                <div class="et-account-left-box">
                   @include('../layouts.inc.profile-menu')
                </div> 
              </div>
              <?php //print_r($data);?>
              <div class="col-md-9">
                  <div class="contact-box user-details full-witdh">
                      <ul>
                        <?php $cname = App\Country::get_country_name($data->country_id);
                              $sname = App\State::get_state_name($data->state);

                        ?>
                        <li><strong>Personal Information</strong></li>
                        <li class="et-setpos"><strong>Name </strong>:  {{$data->name}}&nbsp;{{$data->lname}}</li>
                        <li class="et-setpos"><strong>Email Id </strong>:  {{$data->email}}</li>
                        <li class="et-setpos"><strong>Mobile No.  </strong>:  <?php echo App\Country::get_country_ph($data->country_id)?> {{$data->phone}}</li>
                        <li class="et-setpos"><strong>Full Address  </strong>: {{$data->address}},<br>{{$data->landmark}},<br>{{$data->city}}, {{$data->zipcode}}. <br>{{$sname}}, {{$cname}}.
                        </li>
                      </ul>
                  </div>
              </div>
          </div>
        </div>
    </div>
</section>
<!-- Bootstrap Main JS File -->
  @include('../profile.profile-footer')
</body>
</html>