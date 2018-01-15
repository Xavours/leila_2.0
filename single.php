<?php

    /**
     * The project page template.
     * @package Leïla
     */

get_header();
get_template_part( 'template-parts/project-menu' ); 

global $post; ?>

<!-- article -->
<article style="background-color:<?php the_field('background_color') ?>">

    <!-- post cover -->
        <?php if(get_field('hero_bool')): 
        $image = get_field('hero_banner'); ?>

            <div class="cover" style="background-image: url('<?php echo ( $image['url'] ) ?>'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
                <div class="scroll-down">
                    <span class="arrow">
                        <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px" y="0px" width="8.6px" height="10px" viewBox="0 0 4.3 5" xml:space="preserve">
                        <polygon points="0,5 0,0 4.3,2.5 "/></svg>
                    </span>
                    <span class="text">scroll down</span>
                </div>
            </div>
        <?php endif; ?>
        <!-- /post cover -->

        <!-- post infos -->
        <div class="project-infos" style="color:<?php the_field('text_color') ?>">
            <h1 class="project-infos-title"><?php the_title(); ?></h1>
            <div class="project-infos-date"><?php the_field('date') ?></div>
            <div class="project-infos-description"><?php the_field('description') ?></div>
        </div>
        <!-- /post infos -->
    
     <!-- post content -->
    <div class="content">    
        <?php 
        if( have_rows('images') ){
            while( have_rows('images') ) {

                the_row(); 

                // vars
                $image = get_sub_field('image');
                $display = get_sub_field('display');

                if ( $display == 'marged' ) {
                    echo '<div class="' . $display . ' wrapper" data-url="' . $image['url'] . '" style="max-width:' . get_field('max-width') . 'px; ' . get_sub_field('style') . '"><img></div>';
                } else {
                    echo '<div class="' . $display . ' wrapper" data-url="' . $image['url'] . '" style="; ' . get_sub_field('style') . '"><img></div>';
                }
            }
        } ?>

            <!-- post meta -->
            <div class="project-meta" style="color:<?php the_field('text_color') ?>">

                <?php if( get_field('role') !== ""):
                $role = get_field('role'); ?>
                    <ul class="block">
                        <li class="label"><?php pll_e('Role'); ?></li>
                        <li class="value">
                            <ul>
                                <?php foreach ( $role as $value): ?>
                                    <li><?php echo $value; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
                <?php if( get_field('agence') !== ""): ?>
                    <ul class="block">
                        <li class="label"><?php pll_e('Agency'); ?></li>
                        <li class="value"><?php the_field('agence') ?></li>
                    </ul>
                <?php endif; ?>
                <?php if( get_field('client') !== ""): ?>
                    <ul class="block">
                        <li class="label"><?php pll_e('Client'); ?></li>
                        <li class="value"><?php the_field('client') ?></li>
                    </ul>
                <?php endif; ?>

            </div>
            <!-- /post meta -->
        </div>
        <!-- /post content -->

    </div><!-- class content -->

</article>
<!-- /article -->

<?php get_footer(); ?>
