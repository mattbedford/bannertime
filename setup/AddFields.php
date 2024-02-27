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
               $fields = self::ReturnFields("DisplayFieldDefs.php"),
             );


             add_meta_box( "bannertime_control",
             __( 'Banner control options' ),
                [ self::class, 'Html'],
                BANNERTIME_POST_TYPE,
                'normal',
                'low',
                 $fields = self::ReturnFields("ControlFieldDefs.php"),
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
    public static function ReturnFields(string $file): Array 
    {
        
        $res = require_once plugin_dir_path(__FILE__) . $file;
        return $res;

    }



    public static function Style(): void
    {
        global $typenow;

        echo "<script>console.log('adding style. typenow is " . ucfirst($typenow) . "');</script>";
        echo "<script>console.log('adding style. bannertime_post_type is " . BANNERTIME_POST_TYPE . "');</script>";

        if( BANNERTIME_POST_TYPE === ucfirst($typenow) ) {
            wp_register_style( 'bannertime-styles',  plugins_url( 'assets/styles.css' , dirname(__FILE__) ));
            wp_enqueue_style('bannertime-styles');
        }
    }


}

