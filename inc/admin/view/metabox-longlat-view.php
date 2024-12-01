<?php 

$field_longitude = 'longlat_longitude';
$field_latitude = 'longlat_latitude';
$value_longitude = isset( $post->ID ) && !is_null( $post->ID ) ? get_post_meta( $post->ID, $field_longitude, true ) : "";
$value_latitude = isset( $post->ID ) && !is_null( $post->ID ) ? get_post_meta( $post->ID, $field_latitude, true ) : "";
wp_nonce_field( 'longlat_meta_box_action', 'longlat_meta_box_nonce' );

?>

<table>
    <tr>
        <td>
            <label for="<?= $field_longitude; ?>">
                <?php _e( 'Longitude', 'textdomain' ); ?>
            </label>
        </td>
        <td>
            <input type="text" id="<?= $field_longitude; ?>" name="<?= $field_longitude; ?>" value="<?php echo esc_attr( $value_longitude ); ?>" size="90" />
        </td>
    </tr>

    <tr>
        <td>
            <label for="<?= $field_latitude; ?>">
                <?php _e( 'Latitude', 'textdomain' ); ?>
            </label>
        </td>
        <td>
            <input type="text" id="<?= $field_latitude; ?>" name="<?= $field_latitude; ?>" value="<?php echo esc_attr( $value_latitude ); ?>" size="90" />
        </td>
    </tr>

</table>