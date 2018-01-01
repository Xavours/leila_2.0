<?php
/**
 * The template for displaying the main menu featured on the homepage and the about page.
 * @package Leïla
 */

global $post; ?>

<!-- header -->
		<header class="header" role="banner">

			<a class="name" href="<?php echo get_site_url(); ?>">xavier orssaud</a>     		
        	<div class="nav">
        	    
        	    <!-- main menu -->
        	    <?php wp_nav_menu( array( "menu" => 'main-menu-en' ) ) ;
        	    $translations = pll_the_languages(array('raw'=>1));
                $keys = array_keys($translations); ?>
                <!-- /main menu -->
                
                <!-- language switcher -->
                <!--<div class="langs-wrapper">
                	<div class="link langs">
                		<a href class="lang--selected">
                		    <?php echo(pll_current_language('slug')) ?>
                		    <span class="arrow">
                			       <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" width="6px" height="7px" viewBox="0 0 4.3 5" xml:space="preserve">
                       				<polygon points="0,5 0,0 4.3,2.5 "/>
                    			</svg>
                			</span>
                		</a>
                		<ul>
                			<?php for($i = 0; $i < count($translations); $i++) {
                                foreach($translations[$keys[$i]] as $key => $value) {
                                    if ( $key == "slug" && $value !==pll_current_language() ) {
                                        echo '<li class="lang"><a lang="' . $value . '" hreflang="' . $value . '" href="' . get_site_url() . '/' . $value . '/">' . $value . '</a></li>';
                                    }
                                }
                            } ?>
                		</ul>
                	</div>
                </div>-->
                <!-- /language switcher -->
                
        	</div><!-- /nav -->
        	
	    </header>
	    <!-- /header -->