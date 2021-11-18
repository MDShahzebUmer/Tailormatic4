<?php
// Start the loop.
while ( have_posts() ) : the_post();
?>
<!-- BLOG AREA -->    
<section id="blogs-single">
<div class="container">
<div class="row bg-white">
        
    <div class="inner-cover text-center">
    <figure>
    <img src="<?php the_post_thumbnail_url('full'); ?>" class="img-responsive">
    </figure>
        <span class="date-author text-uppercase"><?php echo get_the_date('F j'); ?>  /  <a href="#" title="Posts by <?php the_author(); ?>" rel="author"><?php the_author(); ?></a></span>
    <h2 class="blog-title text-uppercase"> <?php the_title();?> </h2>
    </div><!--.title and thumbnail-->
    <div class="col-md-3 col-sm-3 col-xs-12 blog-sidebar">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </div><!--.col-md-3-->
    <div class="col-md-9 col-sm-9 col-xs-12 blog-right">
        <article id="blogs-article">
            <div class="inner-cover">
                <div class="blog-cover" style="margin:0 !important;">
                    <div class="entry-content">
                    <?php
                    the_content( sprintf(
                    __( 'Continue reading %s', 'twentyfifteen' ),
                    the_title( '<span class="screen-reader-text">', '</span>', false )
                    ) );
                    ?>
                    <?php //echo do_shortcode('[simple-social-share]'); ?>
                    <hr>
                    <?php
                    wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );
                    ?>
                    </div>
                    
                <footer class="entry-footer">
                <?php twentyfifteen_entry_meta(); ?>
                <?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
                </footer><!-- .entry-footer -->

                <div class="mailchimpform">
                <h3>SUBSCRIBE TO OUR NEWSLETTER FOR WEEKLY DEALS</h3>
                <?php echo do_shortcode('[mc4wp_form id="85"]'); ?>
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
    </div><!--.col-md-9-->
    
</div><!--.row-->
</div>
</section>
<!-- .BLOG AREA --> 
