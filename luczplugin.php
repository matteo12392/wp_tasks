<?php
/*
 * Plugin Name:       ToDo List - LuCz
 * Plugin URI:        https://lucz.altervista.org/
 * Description:       Handle the basics with this plugin.
 * Version:           2.0.0
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
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

function lucz_init() {
  global $wpdb;
  $tasksTable = "wp_tasks";
  $sql = `
  CREATE TABLE IF NOT EXISTS 'wp_tasks' (
  'id' int(11) NOT NULL AUTO_INCREMENT,
  'title' varchar(50) NOT NULL,
  'descr' varchar(200) DEFAULT NULL,
  'status' int(11) DEFAULT NULL,
  'i' int(11) DEFAULT NULL,
  PRIMARY KEY ('id')) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci`;
  if ($wpdb->get_var("show tables like '$tasksTable'") != $tasksTable) {
    require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }
}
register_activation_hook(__FILE__, "lucz_init");

function lucz_getScript() {
  wp_enqueue_style('lucz_style', plugins_url('assets/style.css', __FILE__));
  wp_enqueue_style('lucz_bs_style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
  wp_enqueue_style('lucz_bs_icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css');
  wp_enqueue_script('lucz_bs_script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), '1.0.0', true);
  wp_enqueue_script('lucz_jquery', 'https://code.jquery.com/jquery-3.6.0.js', array(), '1.0.0', true);
  wp_enqueue_script('lucz_jquery_ui', 'https://code.jquery.com/ui/1.13.2/jquery-ui.js', array(), '1.0.0', true);
  wp_enqueue_script('lucz_script', plugins_url('assets/main.js', __FILE__), array(), '1.0.0', true);
}
add_action('admin_head', 'lucz_getScript');

function lucz_settings() {
  add_menu_page(
    $page_title = 'LuCz ToDo List',
    $menu_title = 'LuCz ToDo List',
    $capability = 'administrator',
    $menu_slug  = 'lucz-todo',
    $function = 'lucz_sideBanner',
    $icon_url = "dashicons-editor-ul",
    $position = 6
  );
}
function lucz_sideBanner() {
  include("index.php");
}
add_action('admin_menu', 'lucz_settings');
