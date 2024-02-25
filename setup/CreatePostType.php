<?php

namespace BannerTime;


abstract class CreatePostType
{

    public static function PostType(): void 
    {
        $post_type_vars = array(
            'labels' => array(
                'name' => __(BANNERTIME_POST_TYPE . 's'),
                'singular_name' => __(BANNERTIME_POST_TYPE),
            ),
            'public' => false,
            'has_archive' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'show_in_admin_bar' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-grid-view',
            'supports' => array('title', 'editor', 'thumbnail'),
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability_type' => 'post',
            'show_in_rest' => false,
        );

        register_post_type(BANNERTIME_POST_TYPE, $post_type_vars);
    
    }

}
