<?php
/**
 * Plugin Name:       Dodo Airlines Flight Hub
 * Description:       Standalone WordPress backend and router for the Dodo Air SvelteKit app.
 * Version:           26.7.20.300
 * Author:            Hall of the Gods, Inc.
 * Text Domain:       super-nerd-bros-dodo-air
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'SUPER_NERD_BROS_DODO_AIR_VERSION', '26.7.20.300' );
define( 'SUPER_NERD_BROS_DODO_AIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'SUPER_NERD_BROS_DODO_AIR_URL', plugin_dir_url( __FILE__ ) );

require_once SUPER_NERD_BROS_DODO_AIR_PATH . 'admin/class-super-nerd-bros-dodo-air-admin.php';
require_once SUPER_NERD_BROS_DODO_AIR_PATH . 'public/class-super-nerd-bros-dodo-air-public.php';
require_once SUPER_NERD_BROS_DODO_AIR_PATH . 'includes/class-super-nerd-bros-dodo-air-rest.php';
require_once SUPER_NERD_BROS_DODO_AIR_PATH . 'includes/class-super-nerd-bros-dodo-air-cpt.php';

function run_super_nerd_bros_dodo_air() {
    if ( ! function_exists( 'run_xophz_nook_phone' ) ) {
        add_action( 'admin_init', 'shutoff_super_nerd_bros_dodo_air' );
        add_action( 'admin_notices', 'admin_notice_super_nerd_bros_dodo_air' );
        return;
    }

    $cpt = new Super_Nerd_Bros_Dodo_Air_CPT();
    add_action( 'init', array( $cpt, 'register_post_types' ) );

    $admin = new Super_Nerd_Bros_Dodo_Air_Admin( 'super-nerd-bros-dodo-air', SUPER_NERD_BROS_DODO_AIR_VERSION );
    add_action( 'admin_menu', array( $admin, 'add_plugin_admin_menu' ) );
    add_action( 'admin_init', array( $admin, 'register_settings' ) );

    $public = new Super_Nerd_Bros_Dodo_Air_Public( 'super-nerd-bros-dodo-air', SUPER_NERD_BROS_DODO_AIR_VERSION );
    add_action( 'init', array( $public, 'register_endpoints' ) );
    add_filter( 'query_vars', array( $public, 'register_query_vars' ) );
    add_action( 'template_redirect', array( $public, 'template_redirect' ) );

    $rest = new Super_Nerd_Bros_Dodo_Air_REST();
    $rest->register_routes();

    add_action( 'admin_init', 'dodo_air_migrate_passports_to_nook_os' );
}

function shutoff_super_nerd_bros_dodo_air() {
    if ( ! function_exists( 'deactivate_plugins' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    deactivate_plugins( plugin_basename( __FILE__ ) );
}

function admin_notice_super_nerd_bros_dodo_air() {
    echo '<div class="error"><h2><strong>Dodo Airlines Flight Hub</strong> requires Nook OS (xophz-nook-phone) to run. It has self <strong>deactivated</strong>.</h2></div>';
    if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
}

function dodo_air_migrate_passports_to_nook_os() {
    if ( get_option( 'dodo_air_passports_migrated' ) ) {
        return;
    }

    $users = get_users( array(
        'meta_key'     => '_dodo_air_passports',
        'meta_compare' => 'EXISTS'
    ) );

    foreach ( $users as $u ) {
        $passports = get_user_meta( $u->ID, '_dodo_air_passports', true );
        if ( is_array( $passports ) ) {
            foreach ( $passports as $index => $p ) {
                $post_id = wp_insert_post( array(
                    'post_title'  => (isset($p['villagerName']) ? $p['villagerName'] : 'Unknown') . "'s Passport",
                    'post_type'   => 'nook_passport',
                    'post_status' => 'publish',
                    'post_author' => $u->ID
                ) );

                if ( ! is_wp_error( $post_id ) ) {
                    $p['passportIndex'] = $index;
                    foreach ( $p as $k => $v ) {
                        update_post_meta( $post_id, '_nook_passport_' . sanitize_key( $k ), $v );
                    }
                }
            }
        }
    }

    // Process those who only had _dodo_air_passport (fallback)
    $single_users = get_users( array(
        'meta_key'     => '_dodo_air_passport',
        'meta_compare' => 'EXISTS'
    ) );

    foreach ( $single_users as $u ) {
        // If they already got migrated from the array check above, skip to avoid dupes
        $existing = get_posts( array( 'post_type' => 'nook_passport', 'author' => $u->ID, 'fields' => 'ids' ) );
        if ( ! empty( $existing ) ) continue;

        $p = get_user_meta( $u->ID, '_dodo_air_passport', true );
        if ( is_array( $p ) ) {
            $post_id = wp_insert_post( array(
                'post_title'  => (isset($p['villagerName']) ? $p['villagerName'] : 'Unknown') . "'s Passport",
                'post_type'   => 'nook_passport',
                'post_status' => 'publish',
                'post_author' => $u->ID
            ) );

            if ( ! is_wp_error( $post_id ) ) {
                $p['passportIndex'] = 0;
                foreach ( $p as $k => $v ) {
                    update_post_meta( $post_id, '_nook_passport_' . sanitize_key( $k ), $v );
                }
            }
        }
    }

    update_option( 'dodo_air_passports_migrated', true );
}

add_action( 'plugins_loaded', 'run_super_nerd_bros_dodo_air' );
