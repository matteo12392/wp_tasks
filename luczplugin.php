<?php 
/*
 * Plugin Name:       ToDo List - LuCz
 * Plugin URI:        https://lucz.altervista.org/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Matteo Lucrezio
 * Author URI:        https://lucz.altervista.org/
 * License:           GPL v2 or later
 * License URI:       https://lucz.altervista.org/
 * Update URI:        https://lucz.altervista.org/
 * Text Domain:       lucz
 * Domain Path:       /languages
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function lucz_getScript() {
	wp_enqueue_style( 'lucz_style', plugins_url( 'assets/style.css', __FILE__ ));
	wp_enqueue_style( 'lucz_bs_style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
	wp_enqueue_style( 'lucz_bs_icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');
	wp_enqueue_script( 'lucz_script', plugins_url( 'assets/main.js', __FILE__ ), array(), '1.0.0', true );
	wp_enqueue_script( 'lucz_bs_script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'lucz_jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'lucz_getScript' );

function lucz_sideBanner() {
    include("todolist.php");
}
add_action('wp_body_open', "lucz_sideBanner");
?>