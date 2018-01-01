<?php
/**
 * The template for displaying each project in the portfolio archive.
 * @package Leïla
 */

global $post; ?>

    <div id="<?php echo $post->post_name; ?>" class="project hand" data-url="<? echo get_the_post_thumbnail_url() ?>">
    
        <a href="<?php the_permalink(); ?>" class="leila-item-wrapper-link">
            <img>
            <div class="leila-item-content">
				<div class="leila-item-meta-wrapper">
				    <h2 class="leila-item-title"><?php the_title(); ?></h2>
				    <div class="leila-item-meta">
    					<?php
    					$categories = get_the_terms( get_the_ID(), 'portfolio_category' );
    					if ( ! is_wp_error( $categories ) && ! empty( $categories ) ):
    						echo '<ul class="meta">' . PHP_EOL;
    						foreach ( $categories as $category ) {
    							echo '<li class="meta-list__item">' . $category->name . '</li>' . PHP_EOL;
    						};
    						echo '</ul>' . PHP_EOL;
    					endif ?>
					</div><!-- .leila-item-meta -->
				</div><!-- .leila-item-meta-wrapper -->
			</div><!-- .leila-item-content -->
		</a>
    
    </div>