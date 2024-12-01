<?php
/**
 *  Register the 'weather' widget
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Widget_Weather' ) ) :
    class Widget_Weather extends WP_Widget {

        public function __construct() {
            parent::__construct(
                'Widget_Weather',
                __('Weather', 'textdomain'),
                ['description' => __('Weather Widget', 'textdomain')]
            );
        }

        //Display the Widget Form on the Frontend
        public function widget($args, $instance) {

            if ( isset($args['before_widget']) ) {
                echo $args['before_widget'];
            }
           
            
            if (!empty($instance['title'])) {
                echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
            }

            // Frontend view
            require_once 'view/widget-weather-view.php';

            if ( isset($args['after_widget']) ) {
                echo $args['after_widget'];
            }

        }

        // Display the Widget Options in the Admin Panel
        public function form($instance) {
          echo "<p>Openweathermap Widget</p>";
        }

    }
endif;


// Register the Widget
function register_weather_widget() {
    register_widget('Widget_Weather');
}

add_action('widgets_init', 'register_weather_widget');



