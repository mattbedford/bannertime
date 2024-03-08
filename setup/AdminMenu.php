<?php


namespace BannerTime;

class AdminMenu {

    public static function AddMenu(): void 
    {
        // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        add_menu_page(
            'Banner Time',
            'Banner Time',
            'manage_options',
            'bannertime',
            [ self::class, 'MenuHtml'],
            'dashicons-welcome-widgets-menus',
            90
        );
    }

    public static function MenuHtml(): void
    {
        echo "<h1>Banner Time</h1>";

        $args = array(
            'post_type' => BANNERTIME_POST_TYPE,
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $banners = new \WP_Query($args);

        if($banners->have_posts()) {
            echo "<h2>Banners</h2>";
            echo "<ul>";
            while($banners->have_posts()) {
                $banners->the_post();
                echo "<li><a href='" . get_edit_post_link() . "'>" . get_the_title() . "</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No banners found</p>";
        }
    }

}