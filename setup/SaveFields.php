<?php

namespace BannerTime;

use WP_Post;

abstract class SaveFields {

    public static function Save( int $post_id ): void
    {
        if ( array_key_exists( 'wporg_field', $_POST ) ) {
            update_post_meta(
                $post_id,
                '_wporg_meta_key',
                $_POST['wporg_field']
            );
        }
    }


    public static function ReturnPermittedKeys( string $file ): array
    {

         
        $res = require_once plugin_dir_path(__FILE__) . $file;
        

        $permitted = array_map(function($field) {
            return [
                'name' => $field['name'],
                'type' => $field['type']
            ];
        }, $res);

       return $permitted;
       
    }

}