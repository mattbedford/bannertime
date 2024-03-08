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
require_once plugin_dir_path( __FILE__ ) . 'setup/AdminMenu.php';
require_once plugin_dir_path( __FILE__ ) . 'api/callbacks.php';
require_once plugin_dir_path( __FILE__ ) . 'api/routes.php';



// Create new post type and admin screen
add_action( 'wp_loaded', [ 'BannerTime\CreatePostType', 'PostType' ] );

if(is_admin()) {
	add_action( 'admin_menu', [ 'BannerTime\AdminMenu', 'AddMenu' ] );
}



// Enqueue script to pass REST API nonce to front-end
add_action('wp_enqueue_scripts', 'load_api_nonce');
function load_api_nonce() {

    wp_register_script( 'rest_api_vars', false );
	$rest_args = array(
		'rest_base' => site_url() . "/wp-json/bannertime-api/",
		'rest_nonce' => wp_create_nonce('wp_rest'),
	);
	wp_localize_script( 'rest_api_vars', 'nonce_object', $rest_args );

    wp_enqueue_script('rest_api_vars');

}

// TO DO: Build new class to handle saving fields
//add_action( 'save_post', [ 'SaveFields', 'save' ] );

