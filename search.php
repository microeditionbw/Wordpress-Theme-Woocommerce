<?php get_header(); ?>

	<main id="primary" class="site-main col-sm-12 col-md-12 col-lg-12 col-xs-12 m-auto">
<div class="row">
	<div class="col-auto m-auto p-3"><?php get_search_form(); ?></div>
</div>
		<?php if ( have_posts() ) : ?>

			<header class="page-header container">
				<h2 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Результаты поиска: %s', 'goldenskin' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h2>
			</header><!-- .page-header -->

<div class="search-items container">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;?>
</div>
			<?php

			the_posts_pagination( array(
'prev_text' => __( 'Previous page', 'twentyfifteen' ),
'next_text' => __( 'Next page', 'twentyfifteen' ),
'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php get_footer();
