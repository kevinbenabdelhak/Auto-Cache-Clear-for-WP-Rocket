<?php

/*

* Plugin Name: Auto Cache Clear for WP Rocket

* Plugin URI: https://kevin-benabdelhak.fr/plugins/auto-cache-clear-wp-rocket/

* Description: Auto Cache Clear for WP Rocket est un plugin WordPress qui permet de vider automatiquement le cache des pages modifiées récemment grâce à une option configurable dans le panneau d'administration de WP Rocket. Restez à jour avec vos modifications sans perdre de temps à vider manuellement le cache.

* Version: 1.1

* Author: Kevin BENABDELHAK

* Author URI: https://kevin-benabdelhak.fr

* Contributors: kevinbenabdelhak

*/





if (!defined('ABSPATH')) {

    exit; 

}




if ( !class_exists( 'YahnisElsts\\PluginUpdateChecker\\v5\\PucFactory' ) ) {
    require_once __DIR__ . '/plugin-update-checker/plugin-update-checker.php';
}
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$monUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/kevinbenabdelhak/Auto-Cache-Clear-for-WP-Rocket/', 
    __FILE__,
    'auto-cache-clear-for-wp-rocket' 
);

$monUpdateChecker->setBranch('main');

















define('auto_clear_for_wp', plugin_dir_path(__FILE__));



require_once(auto_clear_for_wp . 'options/wp-rocket-options.php');

require_once(auto_clear_for_wp . 'options/enregistrer.php');

require_once(auto_clear_for_wp . 'cron/planification.php');

require_once(auto_clear_for_wp . 'cron/fonction.php');





