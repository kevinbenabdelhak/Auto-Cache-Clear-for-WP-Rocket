<?php
/*
* Plugin Name: Auto Cache Clear for WP Rocket
* Plugin URI: https://kevin-benabdelhak.fr/plugins/auto-cache-clear-wp-rocket/
* Description: Auto Cache Clear for WP Rocket est un plugin WordPress qui permet de vider automatiquement le cache des pages modifiées récemment grâce à une option configurable dans le panneau d'administration de WP Rocket. Restez à jour avec vos modifications sans perdre de temps à vider manuellement le cache.
* Version: 1.0
* Author: Kevin BENABDELHAK
* Author URI: https://kevin-benabdelhak.fr
* Contributors: kevinbenabdelhak
*/


if (!defined('ABSPATH')) {
    exit; 
}

define('auto_clear_for_wp', plugin_dir_path(__FILE__));

require_once(auto_clear_for_wp . 'options/wp-rocket-options.php');
require_once(auto_clear_for_wp . 'options/enregistrer.php');
require_once(auto_clear_for_wp . 'cron/planification.php');
require_once(auto_clear_for_wp . 'cron/fonction.php');


