<?php  

if (!defined('ABSPATH')) {
    exit; 
}

add_filter('cron_schedules', function($schedules) {
    $check_interval_seconds = get_option('check_interval', 3) * 60;
    $unique_schedule = "custom_interval_{$check_interval_seconds}";

    $schedules[$unique_schedule] = array(
        'interval' => $check_interval_seconds,
        'display'  => __('Intervalle personnalisé')
    );

    return $schedules;
});




// planifier l'événement WP Cron au chargement WP
add_action('wp', function() {
    $check_interval_seconds = get_option('check_interval', 3) * 60;
    $unique_schedule = "custom_interval_{$check_interval_seconds}";

    if (!wp_next_scheduled('custom_wprocket_clear_cache_event')) {
        wp_schedule_event(time(), $unique_schedule, 'custom_wprocket_clear_cache_event');
    }
});

// Action pour le cron job personnalisé
add_action('custom_wprocket_clear_cache_event', 'clear_wp_rocket_cache_for_recently_modified_pages');
