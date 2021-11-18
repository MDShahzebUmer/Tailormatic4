<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<?php 
$headfoodetailid=67;
$post_id_67= get_post($headfoodetailid, ARRAY_A);
$facebook= get_field('facebook', $headfoodetailid);
$twitter= get_field('twitter', $headfoodetailid);
$youtube= get_field('youtube', $headfoodetailid);
$google_plus= get_field('google_plus', $headfoodetailid);
$pinterest= get_field('pinterest', $headfoodetailid);
$linkedin= get_field('linked_in', $headfoodetailid);
$instagram= get_field('instagram', $headfoodetailid);
$mail= get_field('mail', $headfoodetailid);
$rss= get_field('rss', $headfoodetailid);
$copyright= get_field('copyright', $headfoodetailid);
?>

<section id="itailer-blog">
<div class="container">
<div class="row text-center">
<h1 class="text-uppercase"><a href="<?php echo get_permalink(5);?>">iTailor Blog</a></h1>
    <ul class="sociel-icons">
    <li><a href="<?php echo $facebook; ?>"><i class="fa fa-twitter-square" aria-hidden="true"></i>
    </a></li>
    <li><a href="<?php echo $twitter; ?>"><i class="fa fa-facebook-square" aria-hidden="true"></i>
    </a></li>
    <li><a href="<?php echo $google_plus; ?>"><i class="fa fa-google-plus-square" aria-hidden="true"></i>
    </a></li>
    <li><a href="<?php echo $pinterest; ?>"><i class="fa fa-pinterest-square" aria-hidden="true"></i>
    </a></li>
    <li><a href="<?php echo $youtube; ?>"><i class="fa fa-youtube-square" aria-hidden="true"></i>
    </a></li>
    <li><a href="<?php echo $rss; ?>"><i class="fa fa-rss-square" aria-hidden="true"></i>
    </a></li>
    <li><a href="<?php echo $linkedin; ?>"><i class="fa fa-linkedin-square" aria-hidden="true"></i>
    </a></li>
    <li><a href="<?php echo $instagram; ?>"><i class="fa fa-instagram" aria-hidden="true"></i>
    </a></li>
    <li><a href="<?php echo $mail; ?>"><i class="fa fa-envelope" aria-hidden="true"></i>
    </a></li>
    </ul>
</div>
</div>
</section>


<footer id="site-footer" class="bg-darkgrey">
<div class="container">
<div class="row text-center text-uppercase">

	<div class="col-md-4 col-sm-4 col-xs-12 footerboxes">
    	<h4 class="widget-title">
        <img class="rss-widget-icon" style="border:0" src="<?php echo get_stylesheet_directory_uri();?>/images/rss.png" alt="RSS" height="14" width="14">
         What’s New</h4>
        <ul>
        <?php
        $featuredPosts = new WP_Query();
        $featuredPosts->query('&cat=2&order=ASC&showposts=10');
        $i=1;
        while ($featuredPosts->have_posts()) : $featuredPosts->the_post();
		?>
        <li><a  href="<?php echo get_permalink();?>"><?php the_title();?></a></li>
        <?php endwhile;  wp_reset_query();?>
 </ul>
    </div>
    
    <div class="col-md-4 col-sm-4 col-xs-12 footerboxes">
    	<h4 class="widget-title">
       SHOP ITAILOR</h4>
        <?php wp_nav_menu( array('menu' => 'SHOP ITAILOR')); ?>
    </div>
    
    <div class="col-md-4 col-sm-4 col-xs-12 footerboxes">
    	<h4 class="widget-title">
      WHAT INTERESTS YOU?</h4>
        <?php wp_nav_menu( array('menu' => 'WHAT INTERESTS YOU?')); ?>
    </div>
  
</div>
<div class="row text-center text-uppercase">    
    <div class="col-md-4 col-sm-4 col-xs-12 footerboxes">
    	<h4 class="widget-title">
     Sites We Like</h4>
        <?php wp_nav_menu( array('menu' => 'Sites We Like')); ?>
    </div>
    
    <div class="col-md-4 col-sm-4 col-xs-12 footerboxes">
    	<h4 class="widget-title">
     iTailor Blog Archives</h4>
         <?php dynamic_sidebar( 'sidebar-2' ); ?>
    </div>
    
    <div class="col-md-4 col-sm-4 col-xs-12 footerboxes">
    	<h4 class="widget-title">
     iTailor Blog Archives</h4>
        <div class="footer-search">
        <form class="search-form" action="" method="GET">
            <input class="search-field" placeholder="Search…" type="search" name="s">
            <input class="search-submit" value="Go" type="submit">
        </form>
        </div>
    </div>
</div>
</div>
</footer>

<section id="site-copy" class="bg-copy">
<div class="container">
<div class="row text-center text-uppercase copyright">
<?php echo $copyright; ?>
</div>
</div>
<a href="javascript:" id="return-to-top"><i class="fa fa-arrow-up"></i></a>
</footer>


</div><!-- .site-content -->
    
<script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri();?>/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
-->
<script type="text/javascript">
// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});
</script>
<script type="text/javascript">
  $(document).ready(function(){
            var submitIcon = $('.searchbox-icon');
            var inputBox = $('.searchbox-input');
            var searchBox = $('.searchbox');
            var isOpen = false;
            submitIcon.click(function(){
                if(isOpen == false){
                    searchBox.addClass('searchbox-open');
                    inputBox.focus();
                    isOpen = true;
                } else {
                    searchBox.removeClass('searchbox-open');
                    inputBox.focusout();
                    isOpen = false;
                }
            });  
             submitIcon.mouseup(function(){
                    return false;
                });
            searchBox.mouseup(function(){
                    return false;
                });
            $(document).mouseup(function(){
                    if(isOpen == true){
                        $('.searchbox-icon').css('display','block');
                        submitIcon.click();
                    }
                });
        });
            function buttonUp(){
                var inputVal = $('.searchbox-input').val();
                inputVal = $.trim(inputVal).length;
                if( inputVal !== 0){
                    $('.searchbox-icon').css('display','none');
                } else {
                    $('.searchbox-input').val('');
                    $('.searchbox-icon').css('display','block');
                }
            }
</script>

<?php wp_footer(); ?>

</body>
</html>
