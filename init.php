<?php

/*
Plugin Name: BannerTime
Description: A tool to create infinite, dismissable custom banners on your website
Plugin URI:  https://app.mattbedford.work
Author:      Matt Bedford & Ulisse Snc
Version:     1.0
License:     GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.txt

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 
2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
with this program. If not, visit: https://www.gnu.org/licenses/

*/

namespace BannerTime;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Don't require activation hook
// register_activation_hook( __FILE__, 'callback' );


// Declare case-sensitive constant to hold post type name
if ( !defined( 'BANNERTIME_POST_TYPE' ) ) {
    define( 'BANNERTIME_POST_TYPE', 'Banner' );
}

// Set up custom post and field types via static methods in abstract classes
require_once plugin_dir_path( __FILE__ ) . 'setup/CreatePostType.php';
require_once plugin_dir_path( __FILE__ ) . 'setup/AddFields.php';
require_once plugin_dir_path( __FILE__ ) . 'setup/SaveFields.php';
require_once plugin_dir_path( __FILE__ ) . 'setup/FieldType.php'; // Hook into WP routines to fire static methods

// Hook into WP routines to fire static methods
add_action( 'wp_loaded', [ 'BannerTime\CreatePostType', 'PostType' ] );
add_action( 'add_meta_boxes', [ 'BannerTime\AddFields', 'Add' ] );

if(is_admin()) {
	add_action( 'admin_print_styles-post-new.php', [ 'BannerTime\AddFields', 'Style' ] );
	add_action( 'admin_print_styles-post.php', [ 'BannerTime\AddFields', 'Style' ] );
}

//add_action( 'save_post', [ 'SaveFields', 'save' ] );



/*
//Check to see if cookie set and if plugin is set up
function check_bfb_requisite_status() {
    $plugin_status = get_option('bigfoot_banner_active');
	if(!is_admin() && !isset($_COOKIE['bfb-dismiss']) && isset($plugin_status) && $plugin_status === '1' ) {
		return true;	
	}
	return false;
}

//If all requisites are in place, set up scripts
function set_up_bfb_scripts() {
	if(!check_bfb_requisite_status()) return;
	wp_register_style( 'bfb-styles',  plugins_url( '' , __FILE__ ) . '/assets/styles.css' );
	wp_register_script( 'bfb-scripts', plugins_url( '' , __FILE__ ) . '/assets/scripts.js', array(), true );
	wp_enqueue_style('bfb-styles');
	wp_enqueue_script('bfb-scripts');
}
add_action('wp_enqueue_scripts', 'set_up_bfb_scripts');


//If all requisites are in place, add the cookie expiry option in the header
function add_bfb_cookie_expiry() {
	if(!check_bfb_requisite_status()) return;
	$time_out_days = get_option('bigfoot_cookies_timeout');
	if(empty($time_out_days)) {
		$time_out_days = 3;
	}
	echo "<script>let bfbTimeout = " . $time_out_days . ";</script>";
}
add_action('wp_head', 'add_bfb_cookie_expiry');


//If all requisites are in place; run main script
function bfb_gotime() {
	if(!check_bfb_requisite_status()) return;
	require_once plugin_dir_path( __FILE__ ) . 'bfb-main.php'; 
    set_up_bfb_cookie_banner();
}
add_action('wp_footer', 'bfb_gotime');


//Clear out upon uninstall
function bfb_uninstall_me(){
	
	$option_names = array(
        'bigfoot_banner_header',
        'bigfoot_banner_text',
        'bigfoot_cookies_timeout',
        'bigfoot_banner_active'
    );
    foreach($option_names as $single_option) {
	    delete_option($single_option);
    }
}
register_uninstall_hook(__FILE__, 'bfb_uninstall_me');	

*/