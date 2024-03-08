<?php

// Post new attempted sign-up - site_url()/wp-json/bannertime-api/create
add_action('rest_api_init', function () {
    register_rest_route( 'bannertime-api', '/create', array(
        'methods'  => 'POST',
        'callback' => 'add_new_banner_post',
        'permission_callback' => function() {
            return user_can( get_current_user_id(), 'manage_options' );
        }
    ));
  });
