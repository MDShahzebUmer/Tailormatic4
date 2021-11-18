<a href="#.">
    <ul class="et-rating-style">
        <li>{!! setting('site.rating_text_one') !!}</li>
         <?php //$totavg = App\Http\Helpers::total_count_review();
              $totavg = setting('site.rating_text_two');
              $bl=5-$totavg;

               ?>
        <li>
           
            @for($av=0; $av < $totavg; $av++)
            <span class="fa fa-star" aria-hidden="true"></span>
            @endfor
            <!--<i class="fa fa-star-half-o" aria-hidden="true"></i>-->
            @for($avg=0; $avg< $bl; $avg++)
            <span class="fa fa-star-o" aria-hidden="true"></span>
            @endfor
        </li>
       <!--  <li>Based on  <?php // $totavg = App\Http\Helpers::total_based_review();  ?> reviews</li> -->
      <li>{!! setting('site.rating_text_three') !!}</li> 
    </ul>
</a>