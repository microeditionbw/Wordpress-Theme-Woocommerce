<?php
if(is_checkout() or is_cart()) { $checkout = 1; }else { $checkout = 0;}	
get_header();
?>
<div class="row body__main no-gutters">
	<main id="primary" class="site-main <?php echo 'Число '.($checkout < 1 ? 'col-sm-9 col-md-9 col-lg-9 col-xs-9' : 'col-sm-12 col-md-12 col-lg-12 col-xs-12'); ?>">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
if(!$checkout){ get_sidebar(); }
?>
</div>
<?php
get_footer();
