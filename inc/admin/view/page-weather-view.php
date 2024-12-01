<div class="wrap">
    <h1><?php esc_html_e('Weather', 'textdomain'); ?></h1>

    <div class="city-search">
        <input type="text" id="city-search" placeholder="<?php esc_attr_e('Search City', 'textdomain'); ?>" />
        <button id="city-search-button"><?php esc_html_e('Search', 'textdomain'); ?></button>
        <button id="city-clear-button"><?php esc_html_e('Clear', 'textdomain'); ?></button>
    </div>

    <?php do_action('before_city_table'); ?>

    <div id="city-results">
        <table>
            <thead>
                <tr>
                    <th><?php esc_html_e('Country', 'textdomain'); ?></th>
                    <th><?php esc_html_e('City', 'textdomain'); ?></th>
                    <th><?php esc_html_e('Temperature', 'textdomain'); ?></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
       
    <?php do_action('after_city_table'); ?>

</div>