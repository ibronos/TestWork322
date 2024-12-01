<?php
/**
 *  Get Data From  Openweathermap Api
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Owm_Api' ) ) :

    class Owm_Api {

        public function __construct(){
            add_action( 'wp_ajax_search_cities', array($this, 'search_cities_callback') );
        }

        // Fetch openweathermap api data
        public function fetch_weather_data($lon, $lat) {
            $lon = preg_replace('/\s+/', '', $lon);
            $lat = preg_replace('/\s+/', '', $lat);
            $owm_key = OWM_KEY;
            $api_url = "https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${owm_key}";
        
            $response = wp_remote_get($api_url);
        
            if (is_wp_error($response)) {
                return 'Error: ' . $response->get_error_message();
            }

            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);

            return $data;
        }

        // Search function on weather page
        function search_cities_callback() {
            global $wpdb;

            $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

            $query = $wpdb->prepare("
                SELECT 
                    p.ID AS post_id, 
                    p.post_title, 
                    t.name AS country, 
                    pm_long.meta_value AS longitude, 
                    pm_lat.meta_value AS latitude
                FROM 
                    {$wpdb->posts} AS p
                LEFT JOIN 
                    {$wpdb->term_relationships} AS tr ON p.ID = tr.object_id
                LEFT JOIN 
                    {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                LEFT JOIN 
                    {$wpdb->terms} AS t ON tt.term_id = t.term_id
                LEFT JOIN 
                    {$wpdb->postmeta} AS pm_long ON p.ID = pm_long.post_id AND pm_long.meta_key = 'longlat_longitude'
                LEFT JOIN 
                    {$wpdb->postmeta} AS pm_lat ON p.ID = pm_lat.post_id AND pm_lat.meta_key = 'longlat_latitude'
                WHERE 
                    p.post_type = 'city' 
                    AND p.post_status = 'publish'
                    AND tt.taxonomy = 'country'
                    AND p.post_title LIKE %s
            ", '%' . $wpdb->esc_like($search) . '%');

            $results = $wpdb->get_results($query);

            if (!empty($results)) {
                foreach ($results as $row) {
                    $owm = $this->fetch_weather_data($row->longitude, $row->latitude);
                    $temp = isset($owm['main']['temp']) ? $owm['main']['temp'] : '';
                    echo '<tr>';
                    echo '<td>' . esc_html($row->country) . '</td>';
                    echo '<td>' . esc_html( $row->post_title ) . '</td>';
                    echo '<td>' . esc_html( $temp ) . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="3">data not found.</td></tr>';
            }

            wp_die();
        }


    }

endif;

return new Owm_Api();
