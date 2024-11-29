<?php
/**
 * Add Metabox to Custom Post City
 * 
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Metabox_Longlat' ) ) :

    class Metabox_Longlat {

        public function __construct(){  
            add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
            add_action( 'save_post', array( $this, 'save_metabox' ), 10, 2 );
        }

        public function add_meta_box( $post_type ) {
            $post_types = array('city');
            
            if ( in_array( $post_type, $post_types ) ) {
                add_meta_box(
                    'longlat'
                    ,__( 'Longitude Latitude', 'textdomain' )
                    ,array( $this, 'render_metabox' )
                    ,$post_type
                    ,'advanced'
                    ,'low'
                );
            }
        }

        public function render_metabox( $post ) {
            require_once 'view/metabox-longlat-view.php';
        }

        public function save_metabox( $post_id, $post ) {

            // Check if nonce is valid.
            if( 
                isset(  $_POST['longlat_meta_box_nonce'] ) && 
                !wp_verify_nonce( $_POST['longlat_meta_box_nonce'], 'longlat_meta_box_action' ) 
            ) {
                return;
            }

            // Check if user has permissions to save data.
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }

            // Check if not an autosave.
            if ( wp_is_post_autosave( $post_id ) ) {
                return;
            }

            // Check if not a revision.
            if ( wp_is_post_revision( $post_id ) ) {
                return;
            }

            if (isset($_POST['longlat_longitude'])) {
                update_post_meta($post_id, 'longlat_longitude', sanitize_text_field($_POST['longlat_longitude']));
            }
            
            if (isset($_POST['longlat_latitude'])) {
                update_post_meta($post_id, 'longlat_latitude', sanitize_text_field($_POST['longlat_latitude']));
            }

        }


    }

endif;

return new Metabox_Longlat();
