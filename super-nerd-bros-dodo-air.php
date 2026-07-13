<?php
/**
 * Plugin Name:       Dodo Airlines Flight Hub
 * Description:       Standalone WordPress backend and router for the Dodo Air SvelteKit app.
 * Version:           26.7.13.750
 * Author:            Hall of the Gods, Inc.
 * Text Domain:       super-nerd-bros-dodo-air
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'SUPER_NERD_BROS_DODO_AIR_VERSION', '26.7.13.750' );
define( 'SUPER_NERD_BROS_DODO_AIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'SUPER_NERD_BROS_DODO_AIR_URL', plugin_dir_url( __FILE__ ) );

require_once SUPER_NERD_BROS_DODO_AIR_PATH . 'admin/class-super-nerd-bros-dodo-air-admin.php';
require_once SUPER_NERD_BROS_DODO_AIR_PATH . 'public/class-super-nerd-bros-dodo-air-public.php';
require_once SUPER_NERD_BROS_DODO_AIR_PATH . 'includes/class-super-nerd-bros-dodo-air-rest.php';

function run_super_nerd_bros_dodo_air() {
    $admin = new Super_Nerd_Bros_Dodo_Air_Admin( 'super-nerd-bros-dodo-air', SUPER_NERD_BROS_DODO_AIR_VERSION );
    add_action( 'admin_menu', array( $admin, 'add_plugin_admin_menu' ) );
    add_action( 'admin_init', array( $admin, 'register_settings' ) );

    $public = new Super_Nerd_Bros_Dodo_Air_Public( 'super-nerd-bros-dodo-air', SUPER_NERD_BROS_DODO_AIR_VERSION );
    add_action( 'init', array( $public, 'register_endpoints' ) );
    add_filter( 'query_vars', array( $public, 'register_query_vars' ) );
    add_action( 'template_redirect', array( $public, 'template_redirect' ) );

    $rest = new Super_Nerd_Bros_Dodo_Air_REST();
    $rest->register_routes();
}

add_action( 'plugins_loaded', 'run_super_nerd_bros_dodo_air' );
