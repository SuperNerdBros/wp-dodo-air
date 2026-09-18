<?php
/**
 * Plugin Name:       Dodo Airlines Flight Hub
 * Description:       Real-time air traffic control, flight tracker, and passenger manifest gateway bridge for Dodo Airlines operations.
 * Version:           26.9.18-1180
 * Author:            Hall of the Gods, Inc.
 * Text Domain:       super-nerd-bros-dodo-air
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'SUPER_NERD_BROS_DODO_AIR_VERSION', '26.9.18-1180' );
define( 'SUPER_NERD_BROS_DODO_AIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'SUPER_NERD_BROS_DODO_AIR_URL', plugin_dir_url( __FILE__ ) );

$required_files = array(
    'admin/class-super-nerd-bros-dodo-air-admin.php',
    'public/class-super-nerd-bros-dodo-air-public.php',
    'includes/class-super-nerd-bros-dodo-air-rest.php',
    'includes/class-super-nerd-bros-dodo-air-cpt.php',
);

foreach ( $required_files as $file ) {
    $full_path = SUPER_NERD_BROS_DODO_AIR_PATH . $file;
    if ( file_exists( $full_path ) ) {
        require_once $full_path;
    }
}

function run_super_nerd_bros_dodo_air() {
    $has_nook_os = function_exists( 'run_xophz_nook_phone' );
    if ( ! $has_nook_os ) {
        add_action( 'admin_notices', 'admin_notice_super_nerd_bros_dodo_air' );
    }

    if ( class_exists( 'Super_Nerd_Bros_Dodo_Air_CPT' ) ) {
        $cpt = new Super_Nerd_Bros_Dodo_Air_CPT();
        add_action( 'init', array( $cpt, 'register_post_types' ) );
    }

    if ( class_exists( 'Super_Nerd_Bros_Dodo_Air_Admin' ) ) {
        $admin = new Super_Nerd_Bros_Dodo_Air_Admin( 'super-nerd-bros-dodo-air', SUPER_NERD_BROS_DODO_AIR_VERSION );
        add_action( 'admin_menu', array( $admin, 'add_plugin_admin_menu' ) );
        add_action( 'admin_init', array( $admin, 'register_settings' ) );
    }

    if ( class_exists( 'Super_Nerd_Bros_Dodo_Air_Public' ) ) {
        $public = new Super_Nerd_Bros_Dodo_Air_Public( 'super-nerd-bros-dodo-air', SUPER_NERD_BROS_DODO_AIR_VERSION );
        add_action( 'init', array( $public, 'register_endpoints' ) );
        add_filter( 'query_vars', array( $public, 'register_query_vars' ) );
        add_action( 'template_redirect', array( $public, 'template_redirect' ) );
    }

    if ( class_exists( 'Super_Nerd_Bros_Dodo_Air_REST' ) ) {
        $rest = new Super_Nerd_Bros_Dodo_Air_REST();
        $rest->register_routes();
    }

    if ( $has_nook_os ) {
        add_action( 'admin_init', 'dodo_air_migrate_passports_to_nook_os' );
    }
}

function admin_notice_super_nerd_bros_dodo_air() {
    echo '<div class="notice notice-warning is-dismissible"><p><strong>Dodo Airlines Flight Hub:</strong> Nook OS (xophz-nook-phone) is not currently active. Passport integration may be limited until Nook OS is running.</p></div>';
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
