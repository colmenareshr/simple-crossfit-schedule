<?php
/*
Plugin Name: Simple CrossFit Schedule
Description: A plugin to manage CrossFit class schedules
Version: 1.0
Author: ColmenaDev
*/

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

// Función de activación del plugin
function scs_activate() {
    // Código de activación
}
register_activation_hook(__FILE__, 'scs_activate');

// Función de desactivación del plugin
function scs_deactivate() {
    // Código de desactivación
}
register_deactivation_hook(__FILE__, 'scs_deactivate');

// Incluir archivos necesarios
require_once plugin_dir_path(__FILE__) . 'includes/post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-boxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';
require_once plugin_dir_path(__FILE__) . 'includes/frontend.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin.php';

// Inicializar el plugin
function scs_init() {
    // Código de inicialización
}
add_action('init', 'scs_init');