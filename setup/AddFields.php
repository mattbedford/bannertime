<?php


namespace BannerTime;

use WP_Post;
use Bannertime\FieldType;


abstract class AddFields {


    public static function Add(): void 
    {

            add_meta_box( "bannertime_display",
           __( 'Banner display options' ),
              [ self::class, 'Html'],
              BANNERTIME_POST_TYPE,
              'normal',
              'low',
               $fields = self::ReturnDisplayFields(),
             );


             add_meta_box( "bannertime_control",
             __( 'Banner control options' ),
                [ self::class, 'Html'],
                BANNERTIME_POST_TYPE,
                'normal',
                'low',
                 $fields = self::ReturnControlFields(),
               );

    }


    /**
     * Save the meta box selections.
     *
     * @param int $post_id  The post ID.
     */
    public static function save( int $post_id ): void
    {
        if ( array_key_exists( 'wporg_field', $_POST ) ) {
            update_post_meta(
                $post_id,
                '_wporg_meta_key',
                $_POST['wporg_field']
            );
        }
    }






    /**
     * Display the meta box HTML to the user.
     *
     * @param WP_Post $post   Post object. 
     */
    public static function Html(WP_Post $post, Array $args): void
    {
        $fields = $args['args'];

        foreach ($fields as $field) {

            switch ($field['type']) {
                case 'checkbox':
                    FieldType::Checkbox($post, $field);
                    break;
                case 'url':
                    FieldType::Url($post, $field);
                    break;
                case 'text':
                    FieldType::Text($post, $field);
                    break;
                case 'textarea':
                    FieldType::Textarea($post, $field);
                    break;
                case 'select':
                    FieldType::Select($post, $field);
                    break;
                case 'color':
                    FieldType::Color($post, $field);
                    break;
            }

        }
       
    }


    /**
     * Return the fields for the different meta boxes.
     *
     * @return array
     */
    public static function ReturnDisplayFields(): Array 
    {
        return [
            ['name' =>'simple_mode', 'type' => 'checkbox', 'desc' => 'Simple mode will only show the banner message and a close button.'],
            ['name' =>'title', 'type' => 'text', 'desc' => 'The title of the banner.'],
            ['name' =>'subtitle', 'type' => 'text', 'desc' => 'The subtitle of the banner.'],
            ['name' =>'banner_message', 'type' => 'text', 'desc' => 'The message of the banner.'],
            ['name' =>'link', 'type' => 'text', 'desc' => 'The link of the banner.'],
            ['name' =>'link_text', 'type' => 'text', 'desc' => 'The link text of the banner.'],
        ];
    }

    public static function ReturnControlFields(): Array 
    {
        return [
            ['name' =>'display_pages', 'type' => 'text', 'desc' => 'List here the post IDs or slugs of where this banner should show'],
            ['name' =>'exclude_pages', 'type' => 'text', 'desc' => 'List any post IDs or slugs of where banner should not be displayed'],
        ];
    }

}

