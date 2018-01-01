<?php
/**
 * The template for displaying the main menu featured on the project page.
 * @package Leïla
 */

global $post;
global $prevPostLink;
global $nextPostLink;


/**
 *  Infinite next and previous post looping in WordPress
 */
if( get_adjacent_post(false, '', false) ) { 
	$prevPostLink = get_permalink(get_adjacent_post(false,'',false));
} else { 
    $args2 = array( 'post_type' => 'portfolio', 'posts_per_page' =>1, 'orderby' => 'menu_order', 'order' => 'DESC' );
    $query2 = new WP_Query( $args2 );
    while ( $query2->have_posts() ) : $query2->the_post();
	$prevPostLink = get_permalink();
    endwhile;
    wp_reset_query();
}; 

$nextPostLink = get_permalink(get_adjacent_post(false,'',true));   
if( $nextPostLink === get_permalink() ) {
    $args3 = array( 'post_type' => 'portfolio', 'posts_per_page' =>1, 'orderby' => 'menu_order', 'order' => 'ASC' );
    $query3 = new WP_Query( $args3 );
    while ( $query3->have_posts() ) : $query3->the_post();
    $nextPostLink = get_permalink();
    endwhile;
    wp_reset_query();
};
?>

<!-- header -->
		<header class="header project-menu clear" role="banner">

			<div class="menu front">
        		<a class="name back" href="<?php echo get_site_url(); ?>">
        		    <div class="project-button-back">
           				<span class="icon-wrap">
           					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            	 width="8.6px" height="10px" viewBox="0 0 8.6 10" enable-background="new 0 0 8.6 10" xml:space="preserve">
                            <polygon points="8.6,0 8.6,10 0,5 "/>
                            </svg>
                        </span>
            			<span class="button-name"><?php pll_e('Back'); ?></span>
            		</div>
        		</a>     		
        		<!-- nav -->
        		<div class="nav-project">
        			<a class="previous" href="<?php echo $prevPostLink ?>">
        			    <div class="project-button-previous">
               				<span class="icon-wrap">
               					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                	 width="8.6px" height="10px" viewBox="0 0 8.6 10" enable-background="new 0 0 8.6 10" xml:space="preserve">
                                <polygon points="8.6,0 8.6,10 0,5 "/>
                                </svg>
                            </span>
                		</div>
        			</a>
        			<a class="previous" href="<?php echo $nextPostLink ?>">
        			    <div class="project-button-next">
               				<span class="icon-wrap">
               					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                	 width="8.6px" height="10px" viewBox="0 0 8.6 10" enable-background="new 0 0 8.6 10" xml:space="preserve">
                                <polygon points="0,10 0,0 8.6,5 "/>
                                </svg>
                            </span>
                		</div>
        			</a>
        		</div>
        		<!-- /nav -->      		
        	</div>

	    </header>
	<!-- /header -->