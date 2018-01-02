<?php
/*
*  Author: Xavier Orssaud
*  URL: xavierorssaud.com
*  Custom functions, support and more.
*/

/*------------------------------------*\
Theme Support
\*------------------------------------*/

if (function_exists('add_theme_support'))
{
// Add Menu Support
    add_theme_support('menus');

// Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
add_image_size('large', 700, '', true); // Large Thumbnail
add_image_size('medium', 250, '', true); // Medium Thumbnail
add_image_size('small', 120, '', true); // Small Thumbnail
add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

}

/*------------------------------------*\
Functions
\*------------------------------------*/

// HTML5 Blank navigation
// function html5blank_nav()
// {
//     wp_nav_menu(
//         array(
//             'theme_location'  => 'header-menu',
//             'menu'            => '',
//             'container'       => 'div',
//             'container_class' => 'menu-{menu slug}-container',
//             'container_id'    => '',
//             'menu_class'      => 'menu',
//             'menu_id'         => '',
//             'echo'            => true,
//             'fallback_cb'     => 'wp_page_menu',
//             'before'          => '',
//             'after'           => '',
//             'link_before'     => '',
//             'link_after'      => '',
//             'items_wrap'      => '<ul>%3$s</ul>',
//             'depth'           => 0,
//             'walker'          => ''
//             )
//         );
// }

// Load scripts

    // include custom jQuery
    function leila_include_custom_jquery() {
    
    	wp_deregister_script('jquery');
    	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
    
    }
    add_action('wp_enqueue_scripts', 'leila_include_custom_jquery');
    
    function leila_header_scripts()
    {
        if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    
            wp_enqueue_script('my-custom-script', get_template_directory_uri() .'/js/jquery.visible.min.js', array('jquery'), null, false);
            wp_enqueue_script('my-custom-script-2', get_template_directory_uri() .'/min/app.min.js', array('jquery'), null, false);
        }
    }
    add_action( 'wp_enqueue_scripts', 'leila_header_scripts' );

// Load JQuery in header instead of footer as Wordpress does by default
/*function insert_jquery_in_header(){
wp_enqueue_script('jquery', false, array(), false, false);
}
add_filter('wp_enqueue_scripts','insert_jquery_in_header',1);*/

/**
* Force scripts into Footer
* @link https://developer.wordpress.org/reference/since/4.2.0/
*/
/*function enqueue_scripts_in_footer() {
wp_deregister_script( 'jquery' ); // https://codex.wordpress.org/Function_Reference/wp_deregister_script
wp_deregister_script( 'jquery-migrate.min' );    
wp_register_script( 'jquery', '/wp-includes/js/jquery/jquery.js', array(), false, true );
wp_register_script( 'jquery-migrate.min', '/wp-includes/js/jquery/jquery-migrate.min.js', array(), false, true );    
wp_enqueue_script( 'jquery', '/wp-includes/js/jquery/jquery.js', array( 'jquery' ), false, true );
wp_enqueue_script( 'jquery-migrate.min', '/wp-includes/js/jquery/jquery-migrate.min.js', array( 'jquery-migrate.min' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts_in_footer' );*/

// Load styles
function add_theme_scripts() {
        wp_enqueue_style( 'reset', get_template_directory_uri() . '/min/app.min.css', array(), '1.1', 'all');
    // wp_enqueue_style( 'reset', get_template_directory_uri() . '/css/reset.css', array(), '1.1', 'all');
    // wp_enqueue_style( 'footer', get_template_directory_uri() . '/css/footer.css', array(), '1.1', 'all');
    // wp_enqueue_style( 'header', get_template_directory_uri() . '/css/header.css', array(), '1.1', 'all');
    // wp_enqueue_style( 'life', get_template_directory_uri() . '/css/life.css', array(), '1.1', 'all');
    // wp_enqueue_style( 'page', get_template_directory_uri() . '/css/homepage.css', array(), '1.1', 'all');
    // wp_enqueue_style( 'single', get_template_directory_uri() . '/css/single.css', array(), '1.1', 'all');
    // wp_enqueue_style( 'styles', get_template_directory_uri() . '/css/styles.css', array(), '1.1', 'all');
    // wp_enqueue_style( 'showcase-portfolio', get_template_directory_uri() . '/css/showcase-portfolio.css', array(), '1.1', 'all');

}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

// Register HTML5 Blank Navigation
// function register_html5_menu()
// {
// register_nav_menus(array( // Using array to specify more menus if needed
// 'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
// 'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
// 'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
// ));
// }

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

?>