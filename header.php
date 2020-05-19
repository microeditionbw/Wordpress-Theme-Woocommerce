<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GoldenSkin
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
   <meta charset="<?php bloginfo( 'charset' ); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="profile" href="https://gmpg.org/xfn/11">

   <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="mainbody">
<?php wp_body_open(); ?>
   <header id="masthead" class="site-header">
            <nav class="navbar navbar-expand-lg navbar-dark navbar-top">
               <div class="container">
                  <a class="navbar-brand" href="<?php echo get_home_url(); ?>">
                     <?php
                     if(get_header_image() or get_bloginfo( 'title' )) { 
                        echo '<img src="'.get_header_image().'" alt="'.get_bloginfo( 'title' )  .'"/>' . get_bloginfo( 'title' );
                     } ?>
                  </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarResponsive">
                  <?php
                     wp_nav_menu( array(
                        'menu' => 'Menu 1',
                        'menu_class'     => 'navbar-nav ml-auto',
                        'walker' => new IBenic_Walker()
                      ) );
                  ?>
                  </div>
               </div>
            </nav>
   </header><!-- #masthead -->