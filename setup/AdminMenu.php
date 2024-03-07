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
    }

}