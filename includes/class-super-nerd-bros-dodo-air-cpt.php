<?php

class Super_Nerd_Bros_Dodo_Air_CPT {

	public function register_post_types() {
		$post_types = array(
			'dodo_itinerary' => 'Itinerary',
			'dodo_request'  => 'Request',
			'dodo_trade'    => 'Trade Listing',
		);

		foreach ( $post_types as $post_type => $singular ) {
			$plural = $singular . 's';
			if ( $post_type === 'dodo_trade' ) {
				$plural = 'Trade Listings';
			}
			
			$labels = array(
				'name'                  => _x( $plural, 'Post type general name', 'super-nerd-bros-dodo-air' ),
				'singular_name'         => _x( $singular, 'Post type singular name', 'super-nerd-bros-dodo-air' ),
				'menu_name'             => _x( $plural, 'Admin Menu text', 'super-nerd-bros-dodo-air' ),
				'name_admin_bar'        => _x( $singular, 'Add New on Toolbar', 'super-nerd-bros-dodo-air' ),
				'add_new'               => __( 'Add New', 'super-nerd-bros-dodo-air' ),
				'add_new_item'          => __( 'Add New ' . $singular, 'super-nerd-bros-dodo-air' ),
				'new_item'              => __( 'New ' . $singular, 'super-nerd-bros-dodo-air' ),
				'edit_item'             => __( 'Edit ' . $singular, 'super-nerd-bros-dodo-air' ),
				'view_item'             => __( 'View ' . $singular, 'super-nerd-bros-dodo-air' ),
				'all_items'             => __( 'All ' . $plural, 'super-nerd-bros-dodo-air' ),
				'search_items'          => __( 'Search ' . $plural, 'super-nerd-bros-dodo-air' ),
				'not_found'             => __( 'No ' . strtolower($plural) . ' found.', 'super-nerd-bros-dodo-air' ),
				'not_found_in_trash'    => __( 'No ' . strtolower($plural) . ' found in Trash.', 'super-nerd-bros-dodo-air' ),
			);

			$args = array(
				'labels'             => $labels,
				'public'             => false,
				'publicly_queryable' => false,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'menu_icon'          => 'dashicons-airplane',
				'query_var'          => false,
				'rewrite'            => false,
				'capability_type'    => 'post',
				'has_archive'        => false,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'author', 'comments', 'custom-fields' ),
				'show_in_rest'       => true,
			);
			
			if ( $post_type === 'dodo_request' ) {
				$args['menu_icon'] = 'dashicons-testimonial';
			} elseif ( $post_type === 'dodo_trade' ) {
				$args['menu_icon'] = 'dashicons-cart';
			}
			
			register_post_type( $post_type, $args );
		}
	}
}
