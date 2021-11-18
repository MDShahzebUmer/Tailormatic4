<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
    <link href="<?php  echo get_stylesheet_directory_uri();?>/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="<?php  echo get_stylesheet_directory_uri();?>/css/style.css" type="text/css" rel="stylesheet">
    
    <link href="<?php echo get_stylesheet_directory_uri();?>/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<div id="content" class="site-content">
    
    
    <header>
    <!-- UPPER STRIP -->
        <section id="upper-strip">
            <div class="container">
            <div class="row">
                <form class="searchbox" action="" method="GET">
                    <input type="search" placeholder="Search......" name="s" class="searchbox-input" onkeyup="buttonUp();" required>
                    <input type="submit" class="searchbox-submit" value="GO">
                    <span class="searchbox-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
                    </form>
				<?php 
                $headfoodetailid=67;
                $post_id_67= get_post($headfoodetailid, ARRAY_A);
				$site_logo= get_field('site_logo', $headfoodetailid);
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
                    <ul class="sociel-icons pull-right">
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
    <!-- .UPPER STRIP -->
    <!-- MENU BAR -->
        <section id="menu-sc">
            <div class="container">
            <div class="row">
            <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
                </button>
                <!-- <a class="navbar-brand" href="#"><img src="<?php echo $site_logo;?>"></a> -->
                <a class="navbar-brand" href="#"><img src="http://demo.duniyatailor.com/public/blog/wp-content/uploads/2021/11/cropped-c1nbJOcjilqn3Ba8XtX6.png"></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <?php /*?><ul class="nav navbar-nav text-uppercase">
                <li><a href="#">Home</a></li>
                <li><a href="#">Men</a></li>
                <li><a href="#">Shoes</a></li>
                <li><a href="#">Collection</a></li>
                <li><a href="#">Sale</a></li>
                </ul><?php */?>
                <?php wp_nav_menu( array('menu' => 'Header Menu', 'theme_location' =>   'primary' , 'menu_class' => 'nav navbar-nav text-uppercase')); ?>
            </div>
            </nav>
            </div>
            </div>
        </section>
    <!-- .MENU BAR -->   
    </header>
 
    <!-- BREADCRUMB -->    
    <section id="breadcrumb">
    <div class="container">
        <div class="row">
			<?php if ( is_page(5) ) { ?>
            <div class="page-head">
                Home
            </div>
            <?php } else { ?>
            <div class="page-head">
                Home >> <?php the_title();?>
            </div>
            <?php } ?>
        </div>
    </div>
    </section>
    <!-- .BREADCRUMB --> 
    
    
    
    
