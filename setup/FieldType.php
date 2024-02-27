<?php

namespace BannerTime;

use WP_Post;


abstract class FieldType {


    public static function Text(WP_Post $post, Array $args): void{

        $value = self::GetMetaValue($post->ID, $args['name']);

        echo '<label for="bannertime_' . $args['name'] . '">' . $args['desc'] . '</label>';
        echo '<input type="' . $args['type'] . '" name="bannertime_' . $args['name'] . '"';
        echo 'id="bannertime_' . $args['name'] . '" class="postbox" value="' . $value . '">';

    }

    public static function Checkbox(WP_Post $post, Array $args): void {
       
        $value = self::GetMetaValue($post->ID, $args['name']);
        
        if($value !== "") $value = 'checked';

        echo '<div class="bannertime-wrap">';
        echo '<input type="checkbox" name="bannertime_' . $args['name'] . '"';
        echo 'id="bannertime_' . $args['name'] . '" class="postbox" ' . $value . '>';
        echo '<label for="bannertime_' . $args['name'] . '">' . $args['desc'] . '</label></div>';

    }

    public static function Textarea(WP_Post $post, Array $args): void {
        
        $value = self::GetMetaValue($post->ID, $args['name']);

        echo '<label for="bannertime_' . $args['name'] . '">' . $args['desc'] . '</label>';
        echo '<textarea name="bannertime_' . $args['name'] . '"';
        echo 'id="bannertime_' . $args['name'] . '" class="postbox">' . $value . '</textarea>';

    }

    public static function Select(WP_Post $post, Array $args): void {
        
        $value = self::GetMetaValue($post->ID, $args['name']);

        echo '<label for="bannertime_' . $args['name'] . '">' . $args['desc'] . '</label>';
        echo '<select name="bannertime_' . $args['name'] . '"';
        echo 'id="bannertime_' . $args['name'] . '" class="postbox">';
        echo '<option value="' . $value . '">' . $value . '</option>'; // TBD
        echo '</select>';


    }

    public static function Color(WP_Post $post, Array $args): void {
        
        $value = self::GetMetaValue($post->ID, $args['name']);

        echo '<label for="bannertime_' . $args['name'] . '">' . $args['desc'] . '</label>';
        echo '<input type="color" name="bannertime_' . $args['name'] . '"';
        echo 'id="bannertime_' . $args['name'] . '" class="postbox" value="' . $value . '">';

    }

    public static function Url(WP_Post $post, Array $args): void {

        $value = self::GetMetaValue($post->ID, $args['name']);

        echo '<label for="bannertime_' . $args['name'] . '">' . $args['desc'] . '</label>';
        echo '<input type="url" name="bannertime_' . $args['name'] . '"';
        echo 'id="bannertime_' . $args['name'] . '" class="postbox" value="' . $value . '">';


    }


    public static function GetMetaValue(Int $id, String $fieldname) {

        $value = get_post_meta( $id, $fieldname, true );
        
        if($value && $value !== '') {
            $value = esc_html($value);
        } else {
            $value = '';
        }

    }

}