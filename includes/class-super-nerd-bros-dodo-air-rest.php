<?php

class Super_Nerd_Bros_Dodo_Air_REST {

	public function register_routes() {
		add_action( 'rest_api_init', function () {
			register_rest_route( 'dodo-air/v1', '/state', array(
				'methods'  => 'GET',
				'callback' => array( $this, 'get_state' ),
				'permission_callback' => '__return_true', // adjust permissions if needed
			) );

			register_rest_route( 'dodo-air/v1', '/visit', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'record_visit' ),
				'permission_callback' => '__return_true',
			) );

			// Nookipedia proxy endpoint
			register_rest_route( 'dodo-air/v1', '/nookipedia/search', array(
				'methods'  => 'GET',
				'callback' => array( $this, 'nookipedia_search' ),
				'permission_callback' => '__return_true',
			) );



			// Auth endpoints
			register_rest_route( 'dodo-air/v1', '/auth/request-code', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'auth_request_code' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/auth/verify', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'auth_verify' ),
				'permission_callback' => '__return_true',
			) );

			// Schedules endpoints
			register_rest_route( 'dodo-air/v1', '/schedules', array(
				array(
					'methods'  => 'GET',
					'callback' => array( $this, 'get_schedules' ),
					'permission_callback' => '__return_true',
				),
				array(
					'methods'  => 'POST',
					'callback' => array( $this, 'add_schedule' ),
					'permission_callback' => '__return_true',
				),
			) );

			register_rest_route( 'dodo-air/v1', '/schedules/(?P<id>[a-zA-Z0-9_-]+)', array(
				'methods'  => 'DELETE',
				'callback' => array( $this, 'delete_schedule' ),
				'permission_callback' => '__return_true',
			) );

			// Profiles endpoints
			register_rest_route( 'dodo-air/v1', '/profiles/me', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'save_profile' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/profiles', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'save_profile' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/stamps/claim', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'claim_stamp' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/requests', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'add_request' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/requests/(?P<id>[a-zA-Z0-9_-]+)', array(
				'methods'  => 'DELETE',
				'callback' => array( $this, 'delete_request' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/flights', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'add_flight' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/flights/reroll-number', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'reroll_flight_number' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/profiles/(?P<id>[a-zA-Z0-9_-]+)/rate', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'rate_profile' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/profiles/(?P<id>[a-zA-Z0-9_-]+)/rate-dream', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'rate_dream' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/flights/(?P<id>[a-zA-Z0-9_-]+)/status', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'update_flight_status' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/flights/(?P<id>[a-zA-Z0-9_-]+)/board', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'board_flight' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/flights/(?P<id>[a-zA-Z0-9_-]+)/leave', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'leave_flight' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/chatter', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'add_chatter' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/ai/review', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'ai_review' ),
				'permission_callback' => '__return_true',
			) );

			// Luna Dreams Endpoints
			register_rest_route( 'dodo-air/v1', '/dreams', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'add_dream' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/dreams/(?P<id>[a-zA-Z0-9_-]+)/status', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'update_dream_status' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/dreams/(?P<id>[a-zA-Z0-9_-]+)/visit', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'visit_dream' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/dreams/(?P<id>[a-zA-Z0-9_-]+)/leave', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'leave_dream' ),
				'permission_callback' => '__return_true',
			) );

			// Auth Endpoints
			register_rest_route( 'dodo-air/v1', '/auth/status', array(
				'methods'  => 'GET',
				'callback' => array( $this, 'auth_status' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/auth/request-code', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'auth_request_code' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/auth/verify', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'auth_verify' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/auth/logout', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'auth_logout' ),
				'permission_callback' => '__return_true',
			) );

			register_rest_route( 'dodo-air/v1', '/badges/(?P<type>[a-zA-Z0-9_-]+)', array(
				'methods'  => 'GET',
				'callback' => array( $this, 'get_badge' ),
				'permission_callback' => '__return_true',
			) );

			// Trades Endpoints
			register_rest_route( 'dodo-air/v1', '/trades', array(
				array(
					'methods'  => 'GET',
					'callback' => array( $this, 'get_trades' ),
					'permission_callback' => '__return_true',
				),
				array(
					'methods'  => 'POST',
					'callback' => array( $this, 'add_trade' ),
					'permission_callback' => '__return_true',
				),
			) );

			register_rest_route( 'dodo-air/v1', '/trades/(?P<id>\d+)', array(
				'methods'  => 'DELETE',
				'callback' => array( $this, 'delete_trade' ),
				'permission_callback' => '__return_true',
			) );
		} );

		// Bypass nonce checks for all dodo-air endpoints so stale nonces (from open tabs) don't block API calls
		add_filter( 'rest_authentication_errors', function( $error ) {
			if ( is_wp_error( $error ) && $error->get_error_code() === 'rest_cookie_invalid_nonce' ) {
				$uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
				if ( strpos( $uri, '/wp-json/dodo-air/v1/' ) !== false ) {
					return true;
				}
			}
			return $error;
		}, 101 );
	}

	private function get_data( $key ) {
		return get_option( 'dodo_air_' . $key, array() );
	}

	private function update_data( $key, $data ) {
		update_option( 'dodo_air_' . $key, $data );
	}

	private function fetch_cpt_json( $post_type ) {
		$args = array(
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'posts_per_page' => 150,
			'orderby'        => 'date',
			'order'          => 'DESC'
		);
		$query = new WP_Query( $args );
		$results = array();
		if ( $query->have_posts() ) {
			foreach ( $query->posts as $post ) {
				$meta = get_post_meta( $post->ID );
				$item = array( 'id' => (string) $post->ID );
				foreach ( $meta as $k => $v ) {
					if ( strpos( $k, '_' ) !== 0 ) {
						$item[ $k ] = maybe_unserialize( $v[0] );
					}
				}
				if ( ! isset( $item['createdAt'] ) ) {
					$item['createdAt'] = gmdate( 'Y-m-d\TH:i:s\Z', strtotime( $post->post_date_gmt ) );
				}
				if ( in_array($post_type, ['dodo_flight', 'dodo_dream']) && !isset($item['passengers']) ) {
					$item['passengers'] = array();
				}
				$results[] = $item;
			}
		}
		return $results;
	}

	private function insert_cpt_json( $post_type, $title, $data, $content = '' ) {
		$post_id = wp_insert_post( array(
			'post_title'   => sanitize_text_field( $title ),
			'post_content' => wp_kses_post( $content ),
			'post_type'    => $post_type,
			'post_status'  => 'publish'
		) );
		
		if ( is_wp_error( $post_id ) ) {
			return $post_id;
		}

		$data['id'] = (string) $post_id;
		if ( ! isset( $data['createdAt'] ) ) {
			$data['createdAt'] = gmdate( 'Y-m-d\TH:i:s\Z' );
		}

		foreach ( $data as $k => $v ) {
			if ( $k !== 'id' ) {
				update_post_meta( $post_id, $k, $v );
			}
		}

		return $data;
	}
	
	private function update_cpt_json( $post_id, $data ) {
		foreach ( $data as $k => $v ) {
			if ( $k !== 'id' ) {
				update_post_meta( $post_id, $k, $v );
			}
		}
	}

	private function get_cpt_item_json( $post_id ) {
		$post = get_post( $post_id );
		if ( ! $post || $post->post_status === 'trash' ) return null;
		
		$meta = get_post_meta( $post->ID );
		$item = array( 'id' => (string) $post->ID );
		foreach ( $meta as $k => $v ) {
			if ( strpos( $k, '_' ) !== 0 ) {
				$item[ $k ] = maybe_unserialize( $v[0] );
			}
		}
		if ( ! isset( $item['createdAt'] ) ) {
			$item['createdAt'] = gmdate( 'Y-m-d\TH:i:s\Z', strtotime( $post->post_date_gmt ) );
		}
		if ( $post->post_type === 'dodo_itinerary' && !isset( $item['passengers'] ) ) {
			$item['passengers'] = array();
		}
		if ( $post->post_type === 'dodo_request' ) {
			$item['message'] = $post->post_content;
		}
		if ( $post->post_type === 'dodo_trade' ) {
			$item['description'] = $post->post_content;
		}
		return $item;
	}

	private function get_dynamic_profiles() {
		$profiles = get_transient( 'dodo_air_dynamic_profiles_v3' );
		if ( false !== $profiles ) {
			return $profiles;
		}

		$args = array(
			'post_type'      => 'nook_passport',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		);
		$query = new WP_Query( $args );
		$profiles = array();

		if ( $query->have_posts() ) {
			foreach ( $query->posts as $post ) {
				$u_id = $post->post_author;
				$meta = get_post_meta( $post->ID );
				$passport = array();
				foreach ( $meta as $k => $v ) {
					if ( strpos( $k, '_nook_passport_' ) === 0 ) {
						$passport[ str_replace( '_nook_passport_', '', $k ) ] = maybe_unserialize( $v[0] );
					}
				}
				
				$index = isset($passport['passportIndex']) ? $passport['passportIndex'] : 0;
				if ( ! isset( $passport['friendCode'] ) ) {
					$passport['friendCode'] = '';
				}

				$passport['userId'] = (string) $u_id;
				$passport['passportIndex'] = $index;
				$passport['xp'] = (int) get_user_meta( $u_id, '_xp_total_xp', true );
				$passport['miles'] = (int) get_user_meta( $u_id, '_xp_total_gp', true );
				
				$passport['goodApples'] = (int) get_user_meta( $u_id, 'dodo_air_good_apples', true );
				$passport['rottenTurnips'] = (int) get_user_meta( $u_id, 'dodo_air_rotten_turnips', true );

				$dream_ratings_raw = get_user_meta( $u_id, 'dodo_air_dream_ratings_' . $index, true );
				$dream_ratings = is_array( $dream_ratings_raw ) ? $dream_ratings_raw : array();
				$passport['dreamRatingCount'] = count( $dream_ratings );
				if ( $passport['dreamRatingCount'] > 0 ) {
					$sum = array_sum( array_column( $dream_ratings, 'rating' ) );
					$passport['dreamRatingAvg'] = round( $sum / $passport['dreamRatingCount'], 1 );
				} else {
					$passport['dreamRatingAvg'] = 0;
				}
				
				$profiles[ $u_id . '_' . $index ] = $passport;
			}
		}

		set_transient( 'dodo_air_dynamic_profiles_v3', $profiles, 300 );
		return $profiles;
	}

	public function get_state( $request ) {
		$user_id = get_current_user_id();
		$user_schedules = array();
		$user_passport = null;
		
		if ( $user_id ) {
			// Update last active timestamp for online tracking (throttled to 60s)
			$last_active = get_user_meta( $user_id, 'dodo_air_last_active', true );
			if ( ! $last_active || ( time() - (int) $last_active > 60 ) ) {
				update_user_meta( $user_id, 'dodo_air_last_active', time() );
			}

			$args = array(
				'post_type' => 'dodo_itinerary',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'userId',
						'value' => $user_id
					),
					array(
						'key' => 'travelType',
						'value' => 'SCHEDULE'
					)
				),
				'posts_per_page' => 100
			);
			$query = new WP_Query($args);
			if ($query->have_posts()) {
				foreach ($query->posts as $post) {
					$user_schedules[] = $this->get_cpt_item_json($post->ID);
				}
			}
			
			$user_passports = array();
			$args = array(
				'post_type'      => 'nook_passport',
				'author'         => $user_id,
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'ASC'
			);
			$query = new WP_Query($args);
			if ( $query->have_posts() ) {
				foreach ( $query->posts as $post ) {
					$meta = get_post_meta( $post->ID );
					$p = array();
					foreach ( $meta as $k => $v ) {
						if ( strpos( $k, '_nook_passport_' ) === 0 ) {
							$p[ str_replace( '_nook_passport_', '', $k ) ] = maybe_unserialize( $v[0] );
						}
					}
					$p['id'] = $post->ID;
					$p['xp'] = (int) get_user_meta( $user_id, '_xp_total_xp', true );
					$p['miles'] = (int) get_user_meta( $user_id, '_xp_total_gp', true );
					$user_passports[] = $p;
				}
			}
			$user_passport = empty( $user_passports ) ? array() : $user_passports[0];
		}
		
		$user_counts = count_users();
		$total_users = $user_counts['total_users'];
		
		global $wpdb;
		// Cache the online users count using a transient (60 seconds)
		$online_users = get_transient( 'dodo_air_online_users_count' );
		
		if ( false === $online_users ) {
			// Count users active in the last 120 seconds (since writes are throttled to 60s)
			$active_window = time() - 120;
			$online_users = (int) $wpdb->get_var( $wpdb->prepare(
				"SELECT COUNT(DISTINCT user_id) FROM {$wpdb->usermeta} WHERE meta_key = 'dodo_air_last_active' AND CAST(meta_value AS UNSIGNED) > %d",
				$active_window
			) );
			set_transient( 'dodo_air_online_users_count', $online_users, 60 );
		}
		
		$views = (int) get_option( 'dodo_air_views', 0 );
		$visitors = get_option( 'dodo_air_visitor_ids', array() );
		if ( ! is_array( $visitors ) ) {
			$visitors = array();
		}
		
		$alltime_pilots = (int) get_option( 'dodo_air_alltime_pilots', 0 );
		if ( $alltime_pilots === 0 ) {
			$flights = get_option( 'dodo_air_flights', array() );
			$dreams = get_option( 'dodo_air_dreams', array() );
			$alltime_pilots = count( $flights ) + count( $dreams );
			update_option( 'dodo_air_alltime_pilots', $alltime_pilots );
		}
		
		$alltime_passengers = (int) get_option( 'dodo_air_alltime_passengers', 0 );
		if ( $alltime_passengers === 0 ) {
			$flights = get_option( 'dodo_air_flights', array() );
			$dreams = get_option( 'dodo_air_dreams', array() );
			$cnt = 0;
			foreach ( $flights as $f ) {
				$cnt += count( $f['passengers'] ?? array() );
			}
			foreach ( $dreams as $d ) {
				$cnt += count( $d['passengers'] ?? array() );
			}
			$alltime_passengers = $cnt;
			update_option( 'dodo_air_alltime_passengers', $alltime_passengers );
		}
		
		$all_itineraries = $this->fetch_cpt_json( 'dodo_itinerary' );
		$flights = array();
		$dreams = array();
		foreach ($all_itineraries as $it) {
			if (isset($it['travelType']) && $it['travelType'] === 'LUNA') {
				$dreams[] = $it;
			} elseif (isset($it['travelType']) && $it['travelType'] === 'DAL') {
				$flights[] = $it;
			}
		}

		return new WP_REST_Response( array(
			'flights'  => $flights,
			'dreams'   => $dreams,
			'chatter'  => $this->get_data( 'chatter' ),
			'requests' => $this->fetch_cpt_json( 'dodo_request' ),
			'profiles' => $this->get_dynamic_profiles(),
			'mySchedules' => $user_schedules,
			'myPassports' => isset($user_passports) ? $user_passports : array(),
			'myPassport' => $user_passport,
			'totalIslanders' => $total_users,
			'onlineIslanders' => $online_users,
			'analytics' => array(
				'views'    => $views,
				'visitors' => count( $visitors ),
				'alltimePilots' => $alltime_pilots,
				'alltimePassengers' => $alltime_passengers,
			),
			'version' => defined( 'SUPER_NERD_BROS_DODO_AIR_VERSION' ) ? SUPER_NERD_BROS_DODO_AIR_VERSION : 'unknown',
		), 200 );
	}


	public function get_schedules( $request ) {
		$user_id = get_current_user_id();
		if ( ! $user_id ) return new WP_REST_Response( array(), 200 );
		$args = array(
			'post_type' => 'dodo_itinerary',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key' => 'userId',
					'value' => $user_id
				),
				array(
					'key' => 'travelType',
					'value' => 'SCHEDULE'
				)
			),
			'posts_per_page' => 100
		);
		$query = new WP_Query($args);
		$schedules = array();
		if ($query->have_posts()) {
			foreach ($query->posts as $post) {
				$schedules[] = $this->get_cpt_item_json($post->ID);
			}
		}
		return new WP_REST_Response( $schedules, 200 );
	}

	public function add_schedule( $request ) {
		$user_id = get_current_user_id();
		if ( ! $user_id ) return new WP_Error( 'unauthorized', 'Must be logged in.', array( 'status' => 401 ) );
		
		$params = $request->get_json_params();
		$params['userId'] = $user_id;
		$params['travelType'] = 'SCHEDULE';
		$islandName = isset($params['islandName']) ? $params['islandName'] : 'Unknown Island';
		$time = isset($params['time']) ? $params['time'] : 'Future';
		
		$title = sprintf('SCHEDULE to %s - %s', $islandName, $time);
		$newSchedule = $this->insert_cpt_json( 'dodo_itinerary', $title, $params );
		return new WP_REST_Response( $newSchedule, 200 );
	}

	public function delete_schedule( $request ) {
		$user_id = get_current_user_id();
		if ( ! $user_id ) return new WP_Error( 'unauthorized', 'Must be logged in.', array( 'status' => 401 ) );
		
		$id = $request->get_param( 'id' );
		$sched = $this->get_cpt_item_json($id);
		if ($sched && isset($sched['userId']) && $sched['userId'] == $user_id) {
			wp_trash_post( $id );
		}
		
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	private function generate_flight_number() {
		$counter = (int) get_option( 'dodo_air_flight_counter', 1 );
		update_option( 'dodo_air_flight_counter', $counter + 1 );
		$base36 = strtoupper( base_convert( $counter, 10, 36 ) );
		return 'DAL-' . str_pad( $base36, 4, '0', STR_PAD_LEFT );
	}

	public function save_profile( $request ) {
		$user_id = get_current_user_id();
		if ( ! $user_id ) return new WP_Error( 'unauthorized', 'Must be logged in.', array( 'status' => 401 ) );
		
		$params = $request->get_json_params();

		// Handle array of passports format
		if ( isset( $params['passports'] ) && is_array( $params['passports'] ) ) {
			$passports = $params['passports'];
			
			$args = array(
				'post_type'      => 'nook_passport',
				'author'         => $user_id,
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'date',
				'order'          => 'ASC'
			);
			$query = new WP_Query($args);
			$existing_posts = $query->posts;

			foreach ( $passports as $index => &$p ) {
				if ( empty( $p['flightNumber'] ) ) {
					$p['flightNumber'] = $this->generate_flight_number();
				}
				$p['passportIndex'] = $index;

				$post_id = 0;
				if ( isset($existing_posts[$index]) ) {
					$post_id = $existing_posts[$index]->ID;
				} else {
					$post_id = wp_insert_post( array(
						'post_title'  => (isset($p['villagerName']) ? $p['villagerName'] : 'Unknown') . "'s Passport",
						'post_type'   => 'nook_passport',
						'post_status' => 'publish',
						'post_author' => $user_id
					) );
				}

				if ( ! is_wp_error( $post_id ) ) {
					$p['id'] = $post_id;
					foreach ( $p as $k => $v ) {
						update_post_meta( $post_id, '_nook_passport_' . sanitize_key( $k ), $v );
					}
				}
			}
			unset($p);
			
			$active_index = isset($params['activePassportIndex']) ? (int)$params['activePassportIndex'] : 0;
			$params = isset($passports[$active_index]) ? $passports[$active_index] : (isset($passports[0]) ? $passports[0] : array());

			delete_transient( 'dodo_air_dynamic_profiles_v3' );
			return new WP_REST_Response( array( 'success' => true, 'passports' => $passports, 'passport' => $params ), 200 );
		}

		// Fallback for single passport save
		if ( empty( $params['flightNumber'] ) ) {
			$params['flightNumber'] = $this->generate_flight_number();
		}

		$args = array(
			'post_type'      => 'nook_passport',
			'author'         => $user_id,
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'ASC'
		);
		$query = new WP_Query($args);
		$post_id = 0;
		if ( $query->have_posts() ) {
			$post_id = $query->posts[0]->ID;
			$meta = get_post_meta( $post_id );
			foreach ( $meta as $k => $v ) {
				if ( strpos( $k, '_nook_passport_' ) === 0 ) {
					$clean_k = str_replace( '_nook_passport_', '', $k );
					if (!isset($params[$clean_k])) {
						$params[$clean_k] = maybe_unserialize( $v[0] );
					}
				}
			}
		} else {
			$post_id = wp_insert_post( array(
				'post_title'  => (isset($params['villagerName']) ? $params['villagerName'] : 'Unknown') . "'s Passport",
				'post_type'   => 'nook_passport',
				'post_status' => 'publish',
				'post_author' => $user_id
			) );
		}

		if ( ! is_wp_error( $post_id ) ) {
			$params['id'] = $post_id;
			$params['passportIndex'] = 0;
			foreach ( $params as $k => $v ) {
				update_post_meta( $post_id, '_nook_passport_' . sanitize_key( $k ), $v );
			}
		}

		delete_transient( 'dodo_air_dynamic_profiles_v3' );
		
		return new WP_REST_Response( array( 'success' => true, 'passport' => $params, 'passports' => array($params) ), 200 );
	}

	public function claim_stamp( $request ) {
		$user_id = get_current_user_id();
		if ( ! $user_id ) return new WP_Error( 'unauthorized', 'Must be logged in.', array( 'status' => 401 ) );
		
		$params = $request->get_json_params();
		$stamp_id = isset( $params['stampId'] ) ? sanitize_text_field( $params['stampId'] ) : '';
		$miles = isset( $params['miles'] ) ? (int) $params['miles'] : 0;

		if ( $miles > 0 ) {
			$current_miles = (int) get_user_meta( $user_id, '_xp_total_gp', true );
			update_user_meta( $user_id, '_xp_total_gp', $current_miles + $miles );
		}

		if ( $stamp_id ) {
			do_action( 'xophz_compass_record_action', 'dal_claimed_stamp', $user_id, array( 'stamp_id' => $stamp_id ) );
		}

		return new WP_REST_Response( array( 'success' => true, 'milesAwarded' => $miles ), 200 );
	}

	public function add_request( $request ) {
		$params = $request->get_json_params();
		$title = isset($params['authorName']) ? $params['authorName'] . ' Request' : 'New Request';
		$content = isset($params['message']) ? $params['message'] : '';
		unset($params['message']);
		$newReq = $this->insert_cpt_json( 'dodo_request', $title, $params, $content );
		return new WP_REST_Response( $newReq, 200 );
	}

	public function delete_request( $request ) {
		$id = $request->get_param( 'id' );
		wp_trash_post( $id );
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function add_flight( $request ) {
		$params = $request->get_json_params();
		$flightNumber = isset($params['flightNumber']) && !empty($params['flightNumber']) ? $params['flightNumber'] : ('DAL-' . rand(1000,9999));
		$milesCost = isset($params['milesCost']) ? (int) $params['milesCost'] : 0;
		$islandName = isset($params['islandName']) ? $params['islandName'] : 'Unknown Island';
		$gate = isset($params['gate']) ? $params['gate'] : 'X';
		
		$title = sprintf('DAL to %s (Gate: %s) - %s', $islandName, $gate, $flightNumber);

		$args = array(
			'post_type' => 'dodo_itinerary',
			'meta_key' => 'flightNumber',
			'meta_value' => $flightNumber,
			'posts_per_page' => 1
		);
		$query = new WP_Query($args);

		$data = array_merge($params, array(
			'flightNumber' => $flightNumber,
			'status' => 'Scheduled',
			'passengers' => array(),
			'milesCost' => $milesCost,
			'travelType' => 'DAL'
		));

		if ( $query->have_posts() ) {
			$post_id = $query->posts[0]->ID;
			$data['id'] = (string) $post_id;
			$data['createdAt'] = gmdate( 'Y-m-d\TH:i:s\Z' );
			$this->update_cpt_json( $post_id, $data );
			wp_update_post(array('ID' => $post_id, 'post_title' => $title));
			$this->internal_add_chatter( 'Orville', 'Attention! Flight ' . $flightNumber . ' to ' . $params['islandName'] . ' is back online and accepting passengers at Gate ' . $params['gate'] . '.' );
			$newFlight = $this->get_cpt_item_json( $post_id );
		} else {
			$newFlight = $this->insert_cpt_json( 'dodo_itinerary', $title, $data );
			$alltime_pilots = (int) get_option( 'dodo_air_alltime_pilots', 0 );
			update_option( 'dodo_air_alltime_pilots', ++$alltime_pilots );
			$this->internal_add_chatter( 'Orville', 'Attention! New flight ' . $flightNumber . ' to ' . $params['islandName'] . ' is now accepting passengers at Gate ' . $params['gate'] . '.' );
		}

		$user_id = get_current_user_id();
		if ( $user_id ) {
			do_action( 'xophz_compass_record_action', 'dal_hosted_flight', $user_id, array() );
		}

		return new WP_REST_Response( $newFlight, 200 );
	}

	public function update_flight_status( $request ) {
		$id = $request->get_param( 'id' );
		$params = $request->get_json_params();
		$status = $params['status'];
		
		$f = $this->get_cpt_item_json( $id );
		if ( $f ) {
			$f['status'] = $status;
			if ( isset( $params['dodoCode'] ) && !empty( $params['dodoCode'] ) ) {
				$f['dodoCode'] = $params['dodoCode'];
			}
			$this->update_cpt_json( $id, array('status' => $f['status'], 'dodoCode' => $f['dodoCode'] ?? '') );
			$flightNumber = isset($f['flightNumber']) ? $f['flightNumber'] : $id;
			$this->internal_add_chatter( 'Orville', 'Update for Flight ' . $flightNumber . ': Status changed to ' . strtoupper( $status ) . '.' );
		}
		
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function board_flight( $request ) {
		$id = $request->get_param( 'id' );
		$params = $request->get_json_params();
		$user_id = get_current_user_id();
		
		$f = $this->get_cpt_item_json( $id );
		if ( $f ) {
			$milesCost = isset($f['milesCost']) ? (int) $f['milesCost'] : 0;
			
			if ($milesCost > 0 && $user_id) {
				$passenger_miles = (int) get_user_meta( $user_id, '_xp_total_gp', true );
				if ( $passenger_miles < $milesCost ) {
					return new WP_Error( 'not_enough_miles', 'Not enough miles to board this flight.', array( 'status' => 400 ) );
				}
				update_user_meta( $user_id, '_xp_total_gp', $passenger_miles - $milesCost );
				
				$host_friendCode = isset($f['hostFriendCode']) ? $f['hostFriendCode'] : null;
				$host_userId = isset($f['hostUserId']) ? $f['hostUserId'] : null;
				
				if ( $host_userId ) {
					$host_miles = (int) get_user_meta( $host_userId, '_xp_total_gp', true );
					update_user_meta( $host_userId, '_xp_total_gp', $host_miles + $milesCost );
				} elseif ( $host_friendCode ) {
					$args = array(
						'post_type'      => 'nook_passport',
						'meta_key'       => '_nook_passport_friendCode',
						'meta_value'     => $host_friendCode,
						'posts_per_page' => 1
					);
					$query = new WP_Query($args);
					if ( $query->have_posts() ) {
						$host_userId = $query->posts[0]->post_author;
						$host_miles = (int) get_user_meta( $host_userId, '_xp_total_gp', true );
						update_user_meta( $host_userId, '_xp_total_gp', $host_miles + $milesCost );
					}
				}
			}

			if ( ! isset( $f['passengers'] ) ) {
				$f['passengers'] = array();
			}
			$f['passengers'][] = array_merge( $params, array(
				'id' => 'p-' . time(),
				'checkedInAt' => gmdate( 'Y-m-d\TH:i:s\Z' ),
			) );
			
			$this->update_cpt_json( $id, array( 'passengers' => $f['passengers'] ) );
			
			$alltime_passengers = (int) get_option( 'dodo_air_alltime_passengers', 0 );
			update_option( 'dodo_air_alltime_passengers', ++$alltime_passengers );
			
			$flightNumber = isset($f['flightNumber']) ? $f['flightNumber'] : $id;
			$this->internal_add_chatter( 'Orville', $params['name'] . ' just boarded Flight ' . $flightNumber . ' to ' . $f['islandName'] . '!' );
			
			if ( $user_id ) {
				do_action( 'xophz_compass_record_action', 'dal_boarded_flight', $user_id, array() );
			}
		}
		
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function leave_flight( $request ) {
		$id = $request->get_param( 'id' );
		$params = $request->get_json_params();
		$passengerId = $params['passengerId'];
		
		$f = $this->get_cpt_item_json( $id );
		if ( $f && isset( $f['passengers'] ) ) {
			$p = null;
			foreach ( $f['passengers'] as $key => $pass ) {
				if ( $pass['id'] === $passengerId ) {
					$p = $pass;
					unset( $f['passengers'][$key] );
					break;
				}
			}
			if ( $p ) {
				$f['passengers'] = array_values( $f['passengers'] );
				$this->update_cpt_json( $id, array( 'passengers' => $f['passengers'] ) );
				$flightNumber = isset($f['flightNumber']) ? $f['flightNumber'] : $id;
				$this->internal_add_chatter( 'Orville', $p['name'] . ' left Flight ' . $flightNumber . '.' );
			}
		}
		
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function add_dream( $request ) {
		$params = $request->get_json_params();
		$baseNumber = isset($params['flightNumber']) && !empty($params['flightNumber']) ? $params['flightNumber'] : ('DAL-' . rand(1000,9999));
		$dreamNumber = str_replace('DAL-', 'LUL-', $baseNumber);
		$islandName = isset($params['islandName']) ? $params['islandName'] : 'Unknown Island';
		$gate = isset($params['gate']) ? $params['gate'] : 'X';
		
		$title = sprintf('LUNA to %s (Gate: %s) - %s', $islandName, $gate, $dreamNumber);

		$args = array(
			'post_type' => 'dodo_itinerary',
			'meta_key' => 'flightNumber',
			'meta_value' => $dreamNumber,
			'posts_per_page' => 1
		);
		$query = new WP_Query($args);

		$data = array_merge($params, array(
			'flightNumber' => $dreamNumber,
			'status' => 'Scheduled',
			'passengers' => array(),
			'travelType' => 'LUNA'
		));

		if ( $query->have_posts() ) {
			$post_id = $query->posts[0]->ID;
			$data['id'] = (string) $post_id;
			$data['createdAt'] = gmdate( 'Y-m-d\TH:i:s\Z' );
			$this->update_cpt_json( $post_id, $data );
			wp_update_post(array('ID' => $post_id, 'post_title' => $title));
			$this->internal_add_chatter( 'Luna', 'Ah, the dream returns... Dream ' . $dreamNumber . ' at ' . $params['islandName'] . ' is once again accessible for dreamers.' );
			$newDream = $this->get_cpt_item_json( $post_id );
		} else {
			$newDream = $this->insert_cpt_json( 'dodo_itinerary', $title, $data );
			$alltime_pilots = (int) get_option( 'dodo_air_alltime_pilots', 0 );
			update_option( 'dodo_air_alltime_pilots', ++$alltime_pilots );
			$this->internal_add_chatter( 'Luna', 'Ah, a new dream has formed... Dream ' . $dreamNumber . ' at ' . $params['islandName'] . ' is now accessible for dreamers.' );
		}

		return new WP_REST_Response( $newDream, 200 );
	}

	public function update_dream_status( $request ) {
		$id = $request->get_param( 'id' );
		$params = $request->get_json_params();
		$status = $params['status'];
		
		$d = $this->get_cpt_item_json( $id );
		if ( $d ) {
			$d['status'] = $status;
			if ( isset( $params['dodoCode'] ) && !empty( $params['dodoCode'] ) ) {
				$d['dodoCode'] = $params['dodoCode'];
			}
			$this->update_cpt_json( $id, array('status' => $d['status'], 'dodoCode' => $d['dodoCode'] ?? '') );
			$dreamNumber = isset($d['flightNumber']) ? $d['flightNumber'] : $id;
			$this->internal_add_chatter( 'Luna', 'Dream ' . $dreamNumber . ' status is now ' . strtoupper( $status ) . '.' );
		}
		
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function visit_dream( $request ) {
		$id = $request->get_param( 'id' );
		$params = $request->get_json_params();
		
		$d = $this->get_cpt_item_json( $id );
		if ( $d ) {
			if ( ! isset( $d['passengers'] ) ) {
				$d['passengers'] = array();
			}
			$d['passengers'][] = array_merge( $params, array(
				'id' => 'd-' . time(),
				'checkedInAt' => gmdate( 'Y-m-d\TH:i:s\Z' ),
			) );
			
			$this->update_cpt_json( $id, array('passengers' => $d['passengers']) );
			
			$alltime_passengers = (int) get_option( 'dodo_air_alltime_passengers', 0 );
			update_option( 'dodo_air_alltime_passengers', ++$alltime_passengers );
			
			$this->internal_add_chatter( 'Luna', $params['name'] . ' has drifted into the dream of ' . $d['islandName'] . '...' );
		}
		
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function leave_dream( $request ) {
		$id = $request->get_param( 'id' );
		$params = $request->get_json_params();
		$passengerId = $params['passengerId'];
		
		$d = $this->get_cpt_item_json( $id );
		if ( $d && isset( $d['passengers'] ) ) {
			$p = null;
			foreach ( $d['passengers'] as $key => $pass ) {
				if ( $pass['id'] === $passengerId ) {
					$p = $pass;
					unset( $d['passengers'][$key] );
					break;
				}
			}
			if ( $p ) {
				$d['passengers'] = array_values( $d['passengers'] );
				$this->update_cpt_json( $id, array('passengers' => $d['passengers']) );
				$dreamNumber = isset($d['flightNumber']) ? $d['flightNumber'] : $id;
				$this->internal_add_chatter( 'Luna', $p['name'] . ' has awoken from the dream of ' . $dreamNumber . '.' );
			}
		}
		
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function add_chatter( $request ) {
		$params = $request->get_json_params();
		$this->internal_add_chatter( $params['sender'], $params['text'], strpos( $params['sender'], 'AI' ) !== false ? 'orville' : 'user' );
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function reroll_flight_number( $request ) {
		$user_id = get_current_user_id();
		if ( ! $user_id ) return new WP_Error( 'unauthorized', 'Must be logged in.', array( 'status' => 401 ) );
		
		$miles = (int) get_user_meta( $user_id, '_xp_total_gp', true );
		if ( $miles < 500 ) {
			return new WP_Error( 'not_enough_miles', 'Need 500 miles to re-roll flight number.', array( 'status' => 400 ) );
		}

		update_user_meta( $user_id, '_xp_total_gp', $miles - 500 );
		
		$params = $request->get_json_params();
		$active_index = isset($params['activePassportIndex']) ? (int)$params['activePassportIndex'] : 0;
		
		$new_number = $this->generate_flight_number();
		
		$passports = get_user_meta( $user_id, '_dodo_air_passports', true );
		if ( ! is_array( $passports ) ) {
			$single = get_user_meta( $user_id, '_dodo_air_passport', true );
			$passports = is_array( $single ) ? array( $single ) : array();
		}
		
		if ( isset( $passports[$active_index] ) ) {
			$passports[$active_index]['flightNumber'] = $new_number;
			update_user_meta( $user_id, '_dodo_air_passports', $passports );
			
			if ( $active_index === 0 ) {
				update_user_meta( $user_id, '_dodo_air_passport', $passports[$active_index] );
			}
		}
		
		delete_transient( 'dodo_air_dynamic_profiles_v2' );
		
		return new WP_REST_Response( array( 'success' => true, 'flightNumber' => $new_number, 'miles' => $miles - 500 ), 200 );
	}

	public function rate_profile( $request ) {
		$target_user_id = (int) $request->get_param( 'id' );
		$params = $request->get_json_params();
		$ratingType = $params['ratingType']; // 'apple' or 'turnip'
		
		$user_id = get_current_user_id();
		if ( ! $user_id ) return new WP_Error( 'unauthorized', 'Must be logged in.', array( 'status' => 401 ) );
		
		if ( $ratingType === 'apple' ) {
			$apples = (int) get_user_meta( $target_user_id, 'dodo_air_good_apples', true );
			update_user_meta( $target_user_id, 'dodo_air_good_apples', $apples + 1 );
		} else {
			$turnips = (int) get_user_meta( $target_user_id, 'dodo_air_rotten_turnips', true );
			update_user_meta( $target_user_id, 'dodo_air_rotten_turnips', $turnips + 1 );
		}
		
		delete_transient( 'dodo_air_dynamic_profiles' );
		
		// Base 100 miles. Apple = 2x, Turnip = 0.5x
		$reward = $ratingType === 'apple' ? 200 : 50;
		$host_miles = (int) get_user_meta( $target_user_id, '_xp_total_gp', true );
		update_user_meta( $target_user_id, '_xp_total_gp', $host_miles + $reward );
					
		do_action( 'xophz_compass_record_action', 'dal_flight_rated_' . $ratingType, $target_user_id, array() );
		
		// Give miles to rater
		if ( $user_id ) {
			$comment_len = strlen( trim( $params['comment'] ?? '' ) );
			$extra = min( 25, $comment_len );
			$rater_reward = 50 + $extra;
			
			$rater_miles = (int) get_user_meta( $user_id, '_xp_total_gp', true );
			update_user_meta( $user_id, '_xp_total_gp', $rater_miles + $rater_reward );
			
			do_action( 'xophz_compass_record_action', 'dal_gave_rating', $user_id, array() );
		}

		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	/**
	 * Rate a dream address (1-5 Z scale). Per-passport, per-rater upsert.
	 */
	public function rate_dream( $request ) {
		$target_user_id = (int) $request->get_param( 'id' );
		$params = $request->get_json_params();
		$passport_index = isset( $params['passportIndex'] ) ? (int) $params['passportIndex'] : 0;
		$rating = isset( $params['rating'] ) ? (int) $params['rating'] : 0;

		if ( $rating < 1 || $rating > 5 ) {
			return new WP_Error( 'invalid_rating', 'Rating must be 1-5.', array( 'status' => 400 ) );
		}

		$user_id = get_current_user_id();
		if ( ! $user_id ) {
			return new WP_Error( 'unauthorized', 'Must be logged in.', array( 'status' => 401 ) );
		}

		$meta_key = 'dodo_air_dream_ratings_' . $passport_index;
		$ratings = get_user_meta( $target_user_id, $meta_key, true );
		if ( ! is_array( $ratings ) ) {
			$ratings = array();
		}

		// Upsert: update existing rating or add new one
		$found = false;
		foreach ( $ratings as &$entry ) {
			if ( (int) $entry['userId'] === $user_id ) {
				$entry['rating'] = $rating;
				$found = true;
				break;
			}
		}
		unset( $entry );

		if ( ! $found ) {
			$ratings[] = array( 'userId' => $user_id, 'rating' => $rating );
		}

		update_user_meta( $target_user_id, $meta_key, $ratings );
		delete_transient( 'dodo_air_dynamic_profiles_v2' );

		// Reward rater with miles
		$rater_miles = (int) get_user_meta( $user_id, '_xp_total_gp', true );
		update_user_meta( $user_id, '_xp_total_gp', $rater_miles + 50 );
		do_action( 'xophz_compass_record_action', 'dal_dream_rated', $user_id, array() );

		// Compute updated average
		$count = count( $ratings );
		$sum = array_sum( array_column( $ratings, 'rating' ) );
		$avg = round( $sum / $count, 1 );

		return new WP_REST_Response( array(
			'success'       => true,
			'averageRating' => $avg,
			'totalRatings'  => $count,
		), 200 );
	}

	public function ai_review( $request ) {
		$params = $request->get_json_params();
		$flight_id = $params['flightId'] ?? '';
		if ( ! $flight_id ) {
			return new WP_Error( 'missing_id', 'Flight ID is required', array( 'status' => 400 ) );
		}

		$is_dream = strpos( $flight_id, 'LUL-' ) === 0 || strpos( $flight_id, 'LUNA-' ) === 0 || strpos( $flight_id, 'dr-' ) === 0;
		$collection_key = $is_dream ? 'dreams' : 'flights';
		$items = $this->get_data( $collection_key );
		
		$target_item = null;
		$target_index = -1;
		foreach ( $items as $index => $item ) {
			if ( $item['id'] === $flight_id ) {
				$target_item = $item;
				$target_index = $index;
				break;
			}
		}
		
		if ( ! $target_item ) {
			return new WP_Error( 'not_found', 'Flight or dream not found.', array( 'status' => 404 ) );
		}

		$api_key = '';
		if ( function_exists( 'wp_get_connectors' ) ) {
			$connectors = wp_get_connectors();
			if ( ! empty( $connectors['google']['authentication']['setting_name'] ) ) {
				$api_key = get_option( $connectors['google']['authentication']['setting_name'], '' );
			}
		}
		
		if ( empty( $api_key ) && defined( 'GEMINI_API_KEY' ) ) {
			$api_key = GEMINI_API_KEY;
		}

		if ( empty( $api_key ) ) {
			return new WP_Error( 'no_api_key', 'AI API key not configured via Connectors or Constants.', array( 'status' => 500 ) );
		}

		$hostName = $target_item['hostName'] ?? 'Unknown';
		$islandName = $target_item['islandName'] ?? 'Unknown';
		$passengers = $target_item['passengers'] ?? array();
		$passenger_names = implode( ', ', array_column( $passengers, 'name' ) );
		if ( empty( $passenger_names ) ) {
			$passenger_names = 'no passengers yet';
		}

		if ( $is_dream ) {
			$prompt = "You are Luna from Animal Crossing. Write a short, mystical, and peaceful 2-sentence dream review brochure about the dream of island '{$islandName}' hosted by '{$hostName}'. The dream was visited by: {$passenger_names}. Do not use markdown formatting.";
		} else {
			$prompt = "You are Orville from Animal Crossing. Write a short, enthusiastic, and cheerful 2-sentence travel review brochure about the flight to island '{$islandName}' hosted by '{$hostName}'. The passengers were: {$passenger_names}. Do not use markdown formatting.";
		}

		$url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $api_key;
		$body = array(
			'contents' => array(
				array(
					'parts' => array(
						array( 'text' => $prompt )
					)
				)
			)
		);

		$response = wp_remote_post( $url, array(
			'headers'     => array( 'Content-Type' => 'application/json' ),
			'body'        => wp_json_encode( $body ),
			'timeout'     => 15,
		) );

		if ( is_wp_error( $response ) ) {
			return new WP_Error( 'ai_error', 'Failed to connect to AI service.', array( 'status' => 500 ) );
		}

		$response_body = wp_remote_retrieve_body( $response );
		$data = json_decode( $response_body, true );

		if ( isset( $data['candidates'][0]['content']['parts'][0]['text'] ) ) {
			$review_text = trim( $data['candidates'][0]['content']['parts'][0]['text'] );
			$review_text = str_replace( array("\r", "\n"), ' ', $review_text );
			
			$items[$target_index]['review'] = $review_text;
			$this->update_data( $collection_key, $items );
			
			$chatter_name = $is_dream ? 'Luna' : 'Orville';
			$this->internal_add_chatter( $chatter_name, "I've compiled a review for {$islandName}! " . $review_text );

			return new WP_REST_Response( array( 'success' => true, 'review' => $review_text ), 200 );
		}

		return new WP_Error( 'ai_failed', 'AI did not return a valid response.', array( 'status' => 500 ) );
	}

	private function internal_add_chatter( $sender, $text, $type = 'orville' ) {
		$chatter = $this->get_data( 'chatter' );
		$newMessage = array(
			'id' => 'c-' . time() . rand(100, 999),
			'sender' => $sender,
			'text' => $text,
			'type' => $type,
			'timestamp' => gmdate( 'Y-m-d\TH:i:s\Z' ),
		);
		array_unshift( $chatter, $newMessage );
		if ( count( $chatter ) > 50 ) {
			$chatter = array_slice( $chatter, 0, 50 );
		}
		$this->update_data( 'chatter', $chatter );

		// Fire webhook to WebSocket server
		wp_remote_post( 'https://chatter.ai.studio/webhook/chatter', array(
			'body' => wp_json_encode( $newMessage ),
			'headers' => array( 'Content-Type' => 'application/json' ),
			'timeout' => 2,
			'blocking' => false,
		) );
	}

	public function auth_status( $request ) {
		$user_id = get_current_user_id();
		if ( $user_id ) {
			$user = get_userdata( $user_id );
			return new WP_REST_Response( array( 'loggedIn' => true, 'email' => $user->user_email ), 200 );
		}
		return new WP_REST_Response( array( 'loggedIn' => false ), 200 );
	}

	public function auth_request_code( $request ) {
		$params = $request->get_json_params();
		$email = sanitize_email( $params['email'] ?? '' );
		if ( ! is_email( $email ) ) {
			return new WP_Error( 'invalid_email', 'Invalid email address', array( 'status' => 400 ) );
		}

		$villager_name = sanitize_text_field( $params['villagerName'] ?? '' );
		$island_name = sanitize_text_field( $params['islandName'] ?? '' );

		$user = get_user_by( 'email', $email );
		if ( ! $user ) {
			if ( empty( $villager_name ) || empty( $island_name ) ) {
				return new WP_Error( 'needs_names', 'Please provide your villager and island names to create an account.', array( 'status' => 400 ) );
			}

			// Auto-create user
			$username = sanitize_user( current( explode( '@', $email ) ) );
			
			if ( ! empty( $villager_name ) && ! empty( $island_name ) ) {
				// Create username from name@island
				$username = sanitize_user( strtolower( $villager_name . '@' . $island_name ) );
			}
			
			// Ensure unique username
			$base_username = $username;
			while ( username_exists( $username ) ) {
				$username = $base_username . '_' . rand( 1000, 9999 );
			}
			
			$password = wp_generate_password( 24, true, true );
			$user_id = wp_create_user( $username, $password, $email );
			if ( is_wp_error( $user_id ) ) {
				return $user_id;
			}
			$user = get_userdata( $user_id );
		}

		$code = str_pad( rand( 0, 999999 ), 6, '0', STR_PAD_LEFT );
		update_user_meta( $user->ID, '_dodo_air_temp_code', wp_hash_password( $code ) );
		update_user_meta( $user->ID, '_dodo_air_temp_code_expiry', time() + ( 15 * MINUTE_IN_SECONDS ) );

		// Send email
		$subject = '🦤 Your Dodo Airlines Access Code 🛩️';
		$message = "Welcome to Dodo Airlines!\n\nYour temporary access code is: $code\n\nThis code will expire in 15 minutes.";
		wp_mail( $email, $subject, $message );

		$response_data = array( 'success' => true );
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$response_data['dev_code'] = $code;
		}

		return new WP_REST_Response( $response_data, 200 );
	}

	public function auth_verify( $request ) {
		$params = $request->get_json_params();
		$email = sanitize_email( $params['email'] ?? '' );
		$code = sanitize_text_field( $params['code'] ?? '' );

		if ( ! $email || ! $code ) {
			return new WP_Error( 'missing_fields', 'Email and code are required', array( 'status' => 400 ) );
		}

		$user = get_user_by( 'email', $email );
		if ( ! $user ) {
			return new WP_Error( 'invalid_user', 'User not found', array( 'status' => 404 ) );
		}

		$expiry = get_user_meta( $user->ID, '_dodo_air_temp_code_expiry', true );
		if ( ! $expiry || time() > $expiry ) {
			return new WP_Error( 'expired_code', 'Code has expired', array( 'status' => 400 ) );
		}

		$hashed_code = get_user_meta( $user->ID, '_dodo_air_temp_code', true );
		if ( ! wp_check_password( $code, $hashed_code, $user->ID ) ) {
			return new WP_Error( 'invalid_code', 'Invalid code', array( 'status' => 400 ) );
		}

		// Clear code
		delete_user_meta( $user->ID, '_dodo_air_temp_code' );
		delete_user_meta( $user->ID, '_dodo_air_temp_code_expiry' );

		// Log in
		wp_set_current_user( $user->ID );
		wp_set_auth_cookie( $user->ID, true );
		do_action( 'wp_login', $user->user_login, $user );

		return new WP_REST_Response( array( 
			'success' => true,
			'nonce'   => wp_create_nonce( 'wp_rest' )
		), 200 );
	}

	public function nookipedia_search( $request ) {
		$query = $request->get_param( 'q' );

		if ( empty( $query ) || strlen( $query ) < 2 ) {
			return new WP_REST_Response( array(), 200 );
		}

		$mw_api_url = 'https://nookipedia.com/w/api.php';
		$capitalized_query = ucfirst( strtolower( $query ) );
		$lower_query = strtolower( $query );

		// 1. Fetch Villagers
		$villager_params = array(
			'action' => 'cargoquery',
			'format' => 'json',
			'tables' => 'villager',
			'fields' => 'name, image_url',
			'where'  => 'name LIKE "%' . $capitalized_query . '%" OR name LIKE "%' . $lower_query . '%"',
			'limit'  => '20',
		);
		
		$villager_url = add_query_arg( $villager_params, $mw_api_url );
		$villager_res = wp_remote_get( $villager_url, array( 'timeout' => 15 ) );

		// 2. Fetch Items
		$item_params = array(
			'action' => 'cargoquery',
			'format' => 'json',
			'tables' => 'nh_item',
			'fields' => 'en_name=name, image_url',
			'where'  => 'en_name LIKE "%' . $capitalized_query . '%" OR en_name LIKE "%' . $lower_query . '%"',
			'limit'  => '20',
		);

		$item_url = add_query_arg( $item_params, $mw_api_url );
		$item_res = wp_remote_get( $item_url, array( 'timeout' => 15 ) );

		$results = array();

		if ( ! is_wp_error( $villager_res ) && wp_remote_retrieve_response_code( $villager_res ) === 200 ) {
			$body = wp_remote_retrieve_body( $villager_res );
			$data = json_decode( $body, true );
			if ( ! empty( $data['cargoquery'] ) ) {
				foreach ( $data['cargoquery'] as $row ) {
					$title = $row['title'];
					$results[] = array(
						'name'     => $title['name'],
						'imageUrl' => isset( $title['image_url'] ) ? $title['image_url'] : '',
						'category' => 'villager',
					);
				}
			}
		}

		if ( ! is_wp_error( $item_res ) && wp_remote_retrieve_response_code( $item_res ) === 200 ) {
			$body = wp_remote_retrieve_body( $item_res );
			$data = json_decode( $body, true );
			if ( ! empty( $data['cargoquery'] ) ) {
				foreach ( $data['cargoquery'] as $row ) {
					$title = $row['title'];
					$results[] = array(
						'name'     => $title['name'],
						'imageUrl' => isset( $title['image_url'] ) ? $title['image_url'] : '',
						'category' => 'item',
					);
				}
			}
		}

		// Return top 20 results combined
		$results = array_slice( $results, 0, 20 );

		return new WP_REST_Response( $results, 200 );
	}

	public function auth_logout( $request ) {
		wp_logout();
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function record_visit( $request ) {
		$params = $request->get_json_params();
		$visitor_id = sanitize_text_field( $params['visitorId'] ?? '' );
		
		$views = (int) get_option( 'dodo_air_views', 0 );
		$views++;
		update_option( 'dodo_air_views', $views );
		
		$visitors = get_option( 'dodo_air_visitor_ids', array() );
		if ( ! is_array( $visitors ) ) {
			$visitors = array();
		}
		
		if ( $visitor_id && ! in_array( $visitor_id, $visitors, true ) ) {
			$visitors[] = $visitor_id;
			update_option( 'dodo_air_visitor_ids', $visitors );
		}
		
		return new WP_REST_Response( array(
			'views'    => $views,
			'visitors' => count( $visitors ),
			'alltimePilots' => (int) get_option( 'dodo_air_alltime_pilots', 0 ),
			'alltimePassengers' => (int) get_option( 'dodo_air_alltime_passengers', 0 ),
		), 200 );
	}

	public function get_badge( $request ) {
		$type = $request->get_param( 'type' );
		
		$label = 'dodo air';
		$message = 'unknown';
		$color = 'lightgrey';
		
		if ( $type === 'online' ) {
			global $wpdb;
			$active_window = time() - 120;
			$online = (int) $wpdb->get_var( $wpdb->prepare(
				"SELECT COUNT(DISTINCT user_id) FROM {$wpdb->usermeta} WHERE meta_key = 'dodo_air_last_active' AND CAST(meta_value AS UNSIGNED) > %d",
				$active_window
			) );
			$label = 'islanders online';
			$message = (string) $online;
			$color = 'success';
		} elseif ( $type === 'pilots' ) {
			$pilots = (int) get_option( 'dodo_air_alltime_pilots', 0 );
			$label = 'all-time pilots';
			$message = (string) $pilots;
			$color = 'blue';
		} elseif ( $type === 'passengers' ) {
			$passengers = (int) get_option( 'dodo_air_alltime_passengers', 0 );
			$label = 'all-time passengers';
			$message = (string) $passengers;
			$color = 'blue';
		} elseif ( $type === 'total' ) {
			$user_counts = count_users();
			$label = 'total islanders';
			$message = (string) $user_counts['total_users'];
			$color = 'blue';
		} elseif ( $type === 'views' ) {
			$views = (int) get_option( 'dodo_air_views', 0 );
			$label = 'total views';
			$message = (string) $views;
			$color = 'orange';
		}
		
		return new WP_REST_Response( array(
			'schemaVersion' => 1,
			'label' => $label,
			'message' => $message,
			'color' => $color,
		), 200 );
	}

	public function get_trades( $request ) {
		$args = array(
			'post_type' => 'dodo_trade',
			'post_status' => 'publish',
			'posts_per_page' => 100,
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'status',
					'compare' => '!=',
					'value' => 'canceled'
				),
				array(
					'key' => 'status',
					'compare' => 'NOT EXISTS'
				)
			)
		);
		$query = new WP_Query( $args );
		$trades = array();

		if ( $query->have_posts() ) {
			foreach ( $query->posts as $post ) {
				$lf = get_post_meta( $post->ID, 'lfItems', true );
				$ft = get_post_meta( $post->ID, 'ftItems', true );
				$trades[] = array(
					'id' => (string) $post->ID,
					'authorId' => get_post_meta( $post->ID, 'authorId', true ),
					'authorName' => get_post_meta( $post->ID, 'authorName', true ),
					'authorIsland' => get_post_meta( $post->ID, 'authorIsland', true ),
					'authorAvatar' => get_post_meta( $post->ID, 'authorAvatar', true ),
					'travelPreference' => get_post_meta( $post->ID, 'travelPreference', true ),
					'status' => get_post_meta( $post->ID, 'status', true ) ?: 'open',
					'description' => $post->post_content,
					'createdAt' => get_post_meta( $post->ID, 'createdAt', true ) ?: $post->post_date,
					'lfItems' => is_array( $lf ) ? $lf : array(),
					'ftItems' => is_array( $ft ) ? $ft : array(),
				);
			}
		}

		return new WP_REST_Response( $trades, 200 );
	}

	public function add_trade( $request ) {
		$params = $request->get_json_params();

		$post_id = wp_insert_post( array(
			'post_title' => sanitize_text_field( $params['authorName'] ?? 'Unknown' ) . ' Trading Post',
			'post_content' => wp_kses_post( $params['description'] ?? '' ),
			'post_type' => 'dodo_trade',
			'post_status' => 'publish'
		) );

		if ( is_wp_error( $post_id ) ) {
			return new WP_Error( 'create_failed', 'Failed to create trade listing', array( 'status' => 500 ) );
		}

		$created_at = gmdate( 'Y-m-d\TH:i:s\Z' );

		update_post_meta( $post_id, 'authorId', sanitize_text_field( $params['authorId'] ?? '' ) );
		update_post_meta( $post_id, 'authorName', sanitize_text_field( $params['authorName'] ?? '' ) );
		update_post_meta( $post_id, 'authorIsland', sanitize_text_field( $params['authorIsland'] ?? '' ) );
		update_post_meta( $post_id, 'authorAvatar', sanitize_text_field( $params['authorAvatar'] ?? '' ) );
		update_post_meta( $post_id, 'travelPreference', sanitize_text_field( $params['travelPreference'] ?? 'flexible' ) );
		update_post_meta( $post_id, 'status', 'open' );
		update_post_meta( $post_id, 'createdAt', $created_at );
		update_post_meta( $post_id, 'lfItems', $params['lfItems'] ?? array() );
		update_post_meta( $post_id, 'ftItems', $params['ftItems'] ?? array() );

		$new_trade = array(
			'id' => (string) $post_id,
			'authorId' => $params['authorId'] ?? '',
			'authorName' => $params['authorName'] ?? '',
			'authorIsland' => $params['authorIsland'] ?? '',
			'authorAvatar' => $params['authorAvatar'] ?? '',
			'travelPreference' => $params['travelPreference'] ?? 'flexible',
			'status' => 'open',
			'description' => $params['description'] ?? '',
			'createdAt' => $created_at,
			'lfItems' => $params['lfItems'] ?? array(),
			'ftItems' => $params['ftItems'] ?? array(),
		);

		return new WP_REST_Response( $new_trade, 200 );
	}

	public function delete_trade( $request ) {
		$id = (int) $request->get_param( 'id' );
		if ( ! $id ) {
			return new WP_Error( 'invalid_id', 'Invalid listing ID', array( 'status' => 400 ) );
		}

		// Soft delete by updating status
		update_post_meta( $id, 'status', 'canceled' );
		// Or move to trash:
		wp_trash_post( $id );

		return new WP_REST_Response( array( 'success' => true ), 200 );
	}
}
