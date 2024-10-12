<?php 

if (!defined('ABSPATH')) {
    exit; 
}


// AJAX pour enregistrer l'option
add_action('wp_ajax_save_custom_rocket_option', 'save_custom_rocket_option');
function save_custom_rocket_option() {
    check_ajax_referer('save_custom_rocket_option_nonce', '_ajax_nonce');

    if (isset($_POST['clear_recent_cache'])) {
        update_option('clear_recent_cache', (int) $_POST['clear_recent_cache']);
    }

    if (isset($_POST['check_interval'])) {
        update_option('check_interval', (int) $_POST['check_interval']);
    }

    if (isset($_POST['modified_interval'])) {
        update_option('modified_interval', (int) $_POST['modified_interval']);
    }

    // Réinitialiser les événements Cron après enregistrement des paramètres
    wp_clear_scheduled_hook('custom_wprocket_clear_cache_event');

    $check_interval_seconds = get_option('check_interval', 3) * 60;
    $unique_schedule = "custom_interval_{$check_interval_seconds}";

    add_filter('cron_schedules', function($schedules) use ($check_interval_seconds, $unique_schedule) {
        $schedules[$unique_schedule] = array(
            'interval' => $check_interval_seconds,
            'display'  => __('Intervalle personnalisé')
        );
        return $schedules;
    });

    wp_schedule_event(time(), $unique_schedule, 'custom_wprocket_clear_cache_event');

    wp_send_json_success(__('Option enregistrée avec succès.', 'rocket'));
}