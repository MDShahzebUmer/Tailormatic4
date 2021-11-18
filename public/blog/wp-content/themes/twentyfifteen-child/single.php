<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
<?php
//error_reporting(0);
$categories = get_the_category($post->ID );
$blogscat = $categories[0]->term_id;
?>
<!--<h1><?php //echo $testicat?> </h1>-->
<?php
if($blogscat==2){
	include "single-blog.php";
}
else
{
?>

    <section id="blogs-single">
    <div class="container">
        <div class="row bg-white">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			 ?>
            <div class="inner-cover text-center">
            <figure>
            <img src="<?php the_post_thumbnail_url('full'); ?>" class="img-responsive">
            </figure>
            <span class="date-author text-uppercase"><?php echo get_the_date('F j'); ?>  /  <a href="#" title="Posts by iTailor Style Guru" rel="author"><?php the_author(); ?></a></span>
            <h2 class="blog-title text-uppercase"> <?php the_title();?> </h2>
            </div>
            <article id="blogs-article">
            <div class="inner-cover">
            <div class="blog-cover">
                    <div class="entry-content">
                    <?php
                    the_content( sprintf(
                    __( 'Continue reading %s', 'twentyfifteen' ),
                    the_title( '<span class="screen-reader-text">', '</span>', false )
                    ) );
                    ?>
                    </div>
                <hr>
                <div class="pagination-area">
                <?php
                the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
                '<span class="screen-reader-text">' . __( 'Next post', 'twentyfifteen' ) . '</span> ' .
                '<span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
                '<span class="screen-reader-text">' . __( 'Previous post', 'twentyfifteen' ) . '</span> ' .
                '<span class="post-title">%title</span>',
                ) );
                ?>
                </div>
                <div class="author-meta">
                <div class="author">
                <img alt="iTailor Style Guru" src="https://secure.gravatar.com/avatar/d4b016ae896a395210c7c795d9d5f5ba?s=72&amp;d=mm&amp;r=g" height="72" width="72"><span>
                Written by:<a href="<?php get_permalink(5)?>" title="Posts by <?php the_author(); ?>" rel="author"><?php the_author(); ?></a>        </span>
                </div>
                <div class="bio">
                <p></p>
                </div>
                </div>
                <div class="comment-area">
                <h3 class="text-uppercase">Be First to Comment </h3>
                <?php
                if ( comments_open() || get_comments_number() ) :
                comments_template();
                endif;?>
                </div>
                <?php
                endwhile;
                ?>
                </div>
			</div>
			</article>

    </div>
    </div>
    </section>
    <?php } ?>

<?php get_footer(); ?>
