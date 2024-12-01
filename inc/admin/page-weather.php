<?php
/**
 *  Add 'weather' admin menu and page
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Page_Weather' ) ) :

    class Page_Weather {

        public function __construct(){  
            add_action('admin_enqueue_scripts', array( $this,'enqueue_city_search_scripts' ) );
            add_action( 'admin_menu', array( $this, 'weather_page' ) );
        
            add_action('before_city_table', function () {
                echo '<p>List of cities</p>';
            });
            
            add_action('after_city_table', function () {
                echo '<p>After table content..</p>';
            });
        }

        public function weather_page() {
            add_menu_page(
                'Weather',
                'Weather', 
                'manage_options', 
                'weather-page', 
                [$this, 'weather_page_content'], 
                'dashicons-cloud', 
                25
            );
        }

        public function weather_page_content() {
            require_once 'view/page-weather-view.php';
        }

        function enqueue_city_search_scripts() {

            // include custom js and css on weather admin page
            if ( is_admin() && isset($_GET['page']) && $_GET['page'] === 'weather-page') {

                wp_enqueue_style( 'style-city', get_stylesheet_directory_uri()  . '/inc/admin/assets/page-weather.css' );

                wp_enqueue_script(
                    'city-search-script',
                    get_stylesheet_directory_uri() . '/inc/admin/assets/city-search.js',
                    ['jquery'],
                    '1.0',
                    true
                );
            
                wp_localize_script('city-search-script', 'citySearchAjax', [
                    'ajax_url' => admin_url('admin-ajax.php'),
                ]);
                
            }
        }

    }

endif;

return new Page_Weather();