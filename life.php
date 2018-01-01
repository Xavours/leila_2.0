<?php /* Template Name: Life Template */ get_header(); ?>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article class="life">

		<?php the_content(); ?>

	</article>
	<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

<?php get_footer(); ?>