<?php 

if (!defined('ABSPATH')) {
    exit; 
}


function clear_wp_rocket_cache_for_recently_modified_pages() {
    if (get_option('clear_recent_cache', 0)) {
        global $wpdb;

        // Obtenir les valeurs d'options personnalisées ou utiliser les valeurs par défaut
        $modified_interval = get_option('modified_interval', 5);

        // Récupérer les pages modifiées dans l'intervalle spécifié
        $recent_posts = $wpdb->get_results($wpdb->prepare("
            SELECT ID FROM $wpdb->posts 
            WHERE post_modified > NOW() - INTERVAL %d MINUTE 
            AND post_modified <= NOW()
            ", $modified_interval));

        if (!empty($recent_posts)) {
            foreach ($recent_posts as $post) {
                // Vider le cache de la page spécifique
                if (function_exists('rocket_clean_post')) {
                    rocket_clean_post($post->ID);
                }
            }
        }
    }
}