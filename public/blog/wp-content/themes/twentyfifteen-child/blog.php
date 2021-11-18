<?php 
/**
 * Template Name: Blog Template
**/
?>
<?php get_header();?>

    <!-- BLOG AREA -->    
    <section id="blogs">
    <div class="container">
        <div class="row">
		<?php
        $featuredPosts = new WP_Query();
        $featuredPosts->query('&cat=2&order=ASC');
        $i=1;
        while ($featuredPosts->have_posts()) : $featuredPosts->the_post();
        $blog_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );  ?>  

            <article id="blogs-article">
            	<div class="inner-cover">
                <figure>
                	<a href="<?php echo get_permalink();?>">
                    	<img src="<?php echo $blog_image; ?>" class="img-responsive">
                    </a>
                </figure>
                <div class="blog-content text-center bg-white">
                <div class="blog-cover">
                <span class="date-author text-uppercase"><?php echo get_the_date('F j'); ?>  /  <a href="#" title="Posts by iTailor Style Guru" rel="author"><?php the_author(); ?></a></span>	
                <h2 class="blog-title text-uppercase"><a href="<?php echo get_permalink();?>"><?php the_title();?></a></h2>
                <p><?php the_excerpt();?></p>
	<a class="more-link text-uppercase" href="<?php echo get_permalink();?>">Read the Post</a>
                </div>
                </div>
                </div>
            </article>
            <?php endwhile;  wp_reset_query();?>
        </div>
    </div>
    </section>
    <!-- .BLOG AREA --> 
    
  
<?php get_footer(); ?>