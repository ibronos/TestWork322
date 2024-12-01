<?php

/**
 * Set environment variables
 */
define('OWM_KEY', 'cd5f684e82d30fb387aa0ff1a6282bc6');


/**
 * Autoload files in 'inc' sub directory
 */
function autoload_inc_files() {
    foreach (glob(get_theme_file_path() . '/inc/custom/*.php') as $file) {
        require_once $file;
    }

    foreach (glob(get_theme_file_path() . '/inc/admin/*.php') as $file) {
        require_once $file;
    }
}

autoload_inc_files();
