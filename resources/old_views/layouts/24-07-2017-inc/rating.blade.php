<a href="#.">
    <ul class="et-rating-style">
        <li>{!! Voyager::setting('rating-text-one') !!}</li>
         <?php //$totavg = App\Http\Helpers::total_count_review();
              $totavg = Voyager::setting('rating-text-two');
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
      <li>{!! Voyager::setting('rating-text-three') !!}</li> 
    </ul>
</a>