<?php
/**
 * Plugin Name: Gigabit Testimonial Showcase
 * Plugin URI: https://omarfsumon.com/
 * Description: Simple testimonial CPT + rating meta + shortcode [testimonials].
 * Version: 1.7
 * Author: Omar F Sumon
 * Author URI: https://omarfsumon.com
 * Text Domain: gigabit-testimonials
 */



if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


//require_once plugin_dir_path( __FILE__ )
require_once plugin_dir_path( __FILE__ ) . 'inc/testimonial_metabox.php';

require_once plugin_dir_path( __FILE__ ) . 'inc/testimonial_cpt.php';

require_once plugin_dir_path( __FILE__ ) . 'inc/testimonial_shortcode.php';


// CSS Enqueue
function gigabit_style_enqueue() {
    wp_enqueue_style( 'gigabit-testimonial-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', array(), '1.0.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'gigabit_style_enqueue' );
