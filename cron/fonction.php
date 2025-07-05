<?php

if (!defined('ABSPATH')) {
    exit; 
}

   function clear_wp_rocket_cache_for_recently_modified_pages() {
       error_log('Fonction clear_wp_rocket_cache_for_recently_modified_pages exécutée');
       
       if (get_option('clear_recent_cache', 0)) {
           error_log('Option clear_recent_cache activée');

           global $wpdb;
           $modified_interval = get_option('modified_interval', 5);

           // Récupérer les pages modifiées dans l'intervalle spécifié
           $recent_pages = $wpdb->get_results($wpdb->prepare("
               SELECT ID FROM $wpdb->posts 
               WHERE post_modified > NOW() - INTERVAL %d MINUTE 
               AND post_modified <= NOW()
               AND post_type = 'page'
               ", $modified_interval));

           error_log('Pages récemment modifiées récupérées : ' . print_r($recent_pages, true));

           if (!empty($recent_pages)) {
               foreach ($recent_pages as $page) {
                   // Vider le cache de la page spécifique
                   if (function_exists('rocket_clean_post')) {
                       rocket_clean_post($page->ID);
                       error_log('Cache vidé pour la page ID : ' . $page->ID);
                   } else {
                       error_log('Fonction rocket_clean_post non disponible');
                   }
               }
           }
       } else {
           error_log('Option clear_recent_cache non activée');
       }
   }