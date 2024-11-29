<?php
/**
 * Custom Post Type: City
 *
 * Registers the 'city' custom post type.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Storefront_Cpt_City' ) ) :
    class Storefront_Cpt_City {

        public function __construct() {
			add_action( 'init', array( $this, 'reg_cpt_city' ) );
		}

        function reg_cpt_city() {
            register_post_type('city',
                array(
                    'labels'      => array(
                        'name'          => __('Cities', 'textdomain'),
                        'singular_name' => __('City', 'textdomain'),
                        'add_new'            => __( 'Add New City' ),
                        'add_new_item'       => __( 'Add New City' ),
                        'edit_item'          => __( 'Edit City' ),
                        'new_item'           => __( 'New City' ),
                        'all_items'          => __( 'All Cities' ),
                        'view_item'          => __( 'View Cities' ),
                        'search_items'       => __( 'Search Cities' )
                    ),
                    'public'      => true,
                    'has_archive' => true,
                )
            );
        }

    }
endif;

return new Storefront_Cpt_City();
