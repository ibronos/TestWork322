<?php
/**
 * Taxonomy: Country
 * CPT Parent: City
 * Registers the 'country' taxonomy.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Storefront_Tax_Country' ) ) :
    class Storefront_Tax_Country {

        public function __construct() {
			add_action( 'init', array( $this, 'register_tax_country' ) );
		}

        function register_tax_country() {

            $labels = [
                'name'                       => _x('Countries', 'Taxonomy General Name', 'textdomain'),
                'singular_name'              => _x('Country', 'Taxonomy Singular Name', 'textdomain'),
                'menu_name'                  => __('Countries', 'textdomain'),
                'all_items'                  => __('All Countries', 'textdomain'),
                'edit_item'                  => __('Edit Country', 'textdomain'),
                'view_item'                  => __('View Country', 'textdomain'),
                'update_item'                => __('Update Country', 'textdomain'),
                'add_new_item'               => __('Add New Country', 'textdomain'),
                'new_item_name'              => __('New Country Name', 'textdomain'),
                'parent_item'                => __('Parent Country', 'textdomain'),
                'parent_item_colon'          => __('Parent Country:', 'textdomain'),
                'search_items'               => __('Search Countries', 'textdomain'),
                'popular_items'              => __('Popular Countries', 'textdomain'),
                'separate_items_with_commas' => __('Separate countries with commas', 'textdomain'),
                'add_or_remove_items'        => __('Add or remove countries', 'textdomain'),
                'choose_from_most_used'      => __('Choose from the most used countries', 'textdomain'),
                'not_found'                  => __('No countries found.', 'textdomain'),
                'no_terms'                   => __('No countries', 'textdomain'),
                'items_list'                 => __('Countries list', 'textdomain'),
                'items_list_navigation'      => __('Countries list navigation', 'textdomain'),
            ];
        
            $args = [
                'labels'            => $labels,
                'public'            => true,
                'hierarchical'      => true,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => ['slug' => 'country'],
                'default_term' => [ 
                    'name' => 'Uncategorized', 
                    'slug' => 'ucategorized', 
                    'description' => '',
                ],
            ];

            register_taxonomy('country', ['city'], $args);
        }

    }
endif;

return new Storefront_Tax_Country();
