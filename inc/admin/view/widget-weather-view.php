<?php 

$owm_api = new Owm_Api();
$args = array(
    'post_type' => 'city',
    'posts_per_page' => 10
);

$city_query = new WP_Query($args);

if ( $city_query->have_posts() ) {

    echo '<table> <tr> <th>City</th> <th>Temperature</th> </tr>';
    
    while ($city_query->have_posts()){
        $city_query->the_post();
        $data = $owm_api->fetch_weather_data( 
            get_post_meta(get_the_ID(), 'longlat_longitude', true),
            get_post_meta(get_the_ID(), 'longlat_latitude', true)
        );
        ?>

        <tr>
            <td><?= get_the_title(); ?></td>
            <td><?= isset($data['main']['temp']) ? $data['main']['temp'] : ''; ?></td>
        </tr>

        <?php
    }

    echo '</table>';

    wp_reset_postdata();

}

