<?php /* Template Name: Homepage Template */

    /**
     * The main template a.k.k.a. the homepage template.
     * @package Leïla
     */
    
    get_header();
    get_template_part( 'template-parts/main-menu' ); ?>

    <!-- scrolled down -->
    <div class="wrapper-scrolled-down">
        <div class="scroll-down">
	        <span class="arrow">
			       <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
x="0px" y="0px" width="8.6px" height="10px" viewBox="0 0 4.3 5" xml:space="preserve">
       				<polygon points="0,5 0,0 4.3,2.5 "/>
    			</svg>
			</span>
    		<span class="text">scroll down</span>
    	</div>
    </div>
    
    <!-- main content -->
	<main class="content">
	
	<!-- Query the post -->
    <?php $args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1 );
        $query = new WP_Query( $args ); ?>

    <!-- mobile -->
    <section class="mobile-only">
        <?php while ( $query->have_posts() ) : $query->the_post();
        
            global $post;   
            get_template_part( 'template-parts/showcase-portfolio' );
        
        endwhile ?>
    </section>
    <!-- /mobile -->

    <!-- desktop -->
    <section class="desktop-only">
        <!-- even -->
        <section class="left">
            <?php while ( $query->have_posts() ) : $query->the_post();
        	
            	global $post;	
                if ($query->current_post % 2 == 0):
                    get_template_part( 'template-parts/showcase-portfolio' );
                endif;
            
            endwhile ?>
        </section>

        <!-- odd -->
        <section class="right">
            <?php while ( $query->have_posts() ) : $query->the_post();
        	
            	global $post;	
                if ($query->current_post % 2 == 1):
                    get_template_part( 'template-parts/showcase-portfolio' );
                endif;
            
            endwhile ?>
        </section>
    </section>
    <!-- /desktop -->
    	    

    </main>
    <!-- /main content -->

<?php get_footer(); ?>
