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
			register_rest_route( 'dodo-air/v1', '/profiles/(?P<id>[a-zA-Z0-9_-]+)', array(
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
		} );

		// Bypass nonce checks for auth endpoints so stale cookies don't block login
		add_filter( 'rest_cookie_check_errors', function( $error ) {
			if ( ! empty( $error ) ) {
				$uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
				if ( strpos( $uri, '/wp-json/dodo-air/v1/auth/' ) !== false ) {
					return null;
				}
			}
			return $error;
		} );
	}

	private function get_data( $key ) {
		return get_option( 'dodo_air_' . $key, array() );
	}

	private function update_data( $key, $data ) {
		update_option( 'dodo_air_' . $key, $data );
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

			$user_schedules = get_user_meta( $user_id, '_dodo_air_schedules', true ) ?: array();
			$user_passport = get_user_meta( $user_id, '_dodo_air_passport', true );
			
			if ( ! is_array( $user_passport ) ) {
				$user_passport = array();
			}

			// Piggyback on the xophz-compass-xp system
			$user_passport['xp'] = (int) get_user_meta( $user_id, '_xp_total_xp', true );
			$user_passport['miles'] = (int) get_user_meta( $user_id, '_xp_total_gp', true );
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
		
		return new WP_REST_Response( array(
			'flights'  => $this->get_data( 'flights' ),
			'dreams'   => $this->get_data( 'dreams' ),
			'chatter'  => $this->get_data( 'chatter' ),
			'requests' => $this->get_data( 'requests' ),
			'profiles' => $this->get_data( 'profiles' ),
			'mySchedules' => $user_schedules,
			'myPassport' => $user_passport,
			'totalIslanders' => $total_users,
			'onlineIslanders' => $online_users,
			'analytics' => array(
				'views'    => $views,
				'visitors' => count( $visitors ),
				'alltimePilots' => $alltime_pilots,
				'alltimePassengers' => $alltime_passengers,
			),
		), 200 );
	}


	public function get_schedules( $request ) {
		$user_id = get_current_user_id();
		if ( ! $user_id ) return new WP_REST_Response( array(), 200 );
		$schedules = get_user_meta( $user_id, '_dodo_air_schedules', true );
		return new WP_REST_Response( empty( $schedules ) ? array() : $schedules, 200 );
	}

	public function add_schedule( $request ) {
		$user_id = get_current_user_id();
		if ( ! $user_id ) return new WP_Error( 'unauthorized', 'Must be logged in.', array( 'status' => 401 ) );
		
		$params = $request->get_json_params();
		$schedules = get_user_meta( $user_id, '_dodo_air_schedules', true );
		if ( empty( $schedules ) ) $schedules = array();
		
		$newSchedule = array_merge( $params, array(
			'id' => 'sch-' . time() . rand(100, 999),
		) );
		
		$schedules[] = $newSchedule;
		update_user_meta( $user_id, '_dodo_air_schedules', $schedules );
		return new WP_REST_Response( $newSchedule, 200 );
	}

	public function delete_schedule( $request ) {
		$user_id = get_current_user_id();
		if ( ! $user_id ) return new WP_Error( 'unauthorized', 'Must be logged in.', array( 'status' => 401 ) );
		
		$id = $request->get_param( 'id' );
		$schedules = get_user_meta( $user_id, '_dodo_air_schedules', true );
		if ( empty( $schedules ) ) $schedules = array();
		
		$schedules = array_values( array_filter( $schedules, function( $s ) use ( $id ) {
			return $s['id'] !== $id;
		} ) );
		
		update_user_meta( $user_id, '_dodo_air_schedules', $schedules );
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	private function generate_flight_number() {
		$counter = (int) get_option( 'dodo_air_flight_counter', 1 );
		update_option( 'dodo_air_flight_counter', $counter + 1 );
		$base36 = strtoupper( base_convert( $counter, 10, 36 ) );
		return str_pad( $base36, 4, '0', STR_PAD_LEFT );
	}

	public function save_profile( $request ) {
		$user_id = get_current_user_id();
		if ( ! $user_id ) return new WP_Error( 'unauthorized', 'Must be logged in.', array( 'status' => 401 ) );
		
		$params = $request->get_json_params();

		if ( empty( $params['flightNumber'] ) ) {
			$params['flightNumber'] = $this->generate_flight_number();
		}

		update_user_meta( $user_id, '_dodo_air_passport', $params );
		
		$profiles = $this->get_data( 'profiles' );
		$profiles[ $params['friendCode'] ] = $params;
		$this->update_data( 'profiles', $profiles );
		
		return new WP_REST_Response( array( 'success' => true, 'passport' => $params ), 200 );
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
		$requests = $this->get_data( 'requests' );
		
		$newReq = array_merge( $params, array(
			'id' => 'req-' . time(),
			'createdAt' => gmdate( 'Y-m-d\TH:i:s\Z' ),
		) );
		
		array_unshift( $requests, $newReq );
		$this->update_data( 'requests', $requests );
		
		return new WP_REST_Response( $newReq, 200 );
	}

	public function delete_request( $request ) {
		$id = $request->get_param( 'id' );
		$requests = $this->get_data( 'requests' );
		
		$requests = array_filter( $requests, function( $r ) use ( $id ) {
			return $r['id'] !== $id;
		} );
		
		$this->update_data( 'requests', array_values( $requests ) );
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function add_flight( $request ) {
		$params = $request->get_json_params();
		$flights = $this->get_data( 'flights' );
		
		$flightId = isset($params['flightNumber']) ? $params['flightNumber'] : ('DAL-' . rand(1000,9999));
		$milesCost = isset($params['milesCost']) ? (int) $params['milesCost'] : 0;

		$newFlight = array_merge( $params, array(
			'id' => $flightId,
			'status' => 'Scheduled',
			'passengers' => array(),
			'createdAt' => gmdate( 'Y-m-d\TH:i:s\Z' ),
			'milesCost' => $milesCost
		) );
		
		array_unshift( $flights, $newFlight );
		$this->update_data( 'flights', $flights );
		
		$alltime_pilots = (int) get_option( 'dodo_air_alltime_pilots', 0 );
		$alltime_pilots++;
		update_option( 'dodo_air_alltime_pilots', $alltime_pilots );
		
		$this->internal_add_chatter( 'Orville [AI]', 'Attention! New flight ' . $newFlight['id'] . ' to ' . $newFlight['islandName'] . ' is now accepting passengers at Gate ' . $newFlight['gate'] . '.' );
		
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
		
		$flights = $this->get_data( 'flights' );
		foreach ( $flights as &$f ) {
			if ( $f['id'] === $id ) {
				$f['status'] = $status;
				if ( isset( $params['dodoCode'] ) && !empty( $params['dodoCode'] ) ) {
					$f['dodoCode'] = $params['dodoCode'];
				}
				$this->internal_add_chatter( 'Orville [AI]', 'Update for Flight ' . $id . ': Status changed to ' . strtoupper( $status ) . '.' );
				break;
			}
		}
		
		$this->update_data( 'flights', $flights );
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function board_flight( $request ) {
		$id = $request->get_param( 'id' );
		$params = $request->get_json_params();
		$user_id = get_current_user_id();
		
		$flights = $this->get_data( 'flights' );
		foreach ( $flights as &$f ) {
			if ( $f['id'] === $id ) {
				$milesCost = isset($f['milesCost']) ? (int) $f['milesCost'] : 0;
				
				if ($milesCost > 0 && $user_id) {
					$passenger_miles = (int) get_user_meta( $user_id, '_xp_total_gp', true );
					if ( $passenger_miles < $milesCost ) {
						return new WP_Error( 'not_enough_miles', 'Not enough miles to board this flight.', array( 'status' => 400 ) );
					}
					update_user_meta( $user_id, '_xp_total_gp', $passenger_miles - $milesCost );
					
					$host_friendCode = isset($f['hostFriendCode']) ? $f['hostFriendCode'] : null;
					if ( $host_friendCode ) {
						$users = get_users(array(
							'meta_key' => '_dodo_air_passport',
							'meta_compare' => 'EXISTS'
						));
						foreach( $users as $u ) {
							$p = get_user_meta( $u->ID, '_dodo_air_passport', true );
							if ( isset($p['friendCode']) && $p['friendCode'] === $host_friendCode ) {
								$host_miles = (int) get_user_meta( $u->ID, '_xp_total_gp', true );
								update_user_meta( $u->ID, '_xp_total_gp', $host_miles + $milesCost );
								break;
							}
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
				
				$alltime_passengers = (int) get_option( 'dodo_air_alltime_passengers', 0 );
				$alltime_passengers++;
				update_option( 'dodo_air_alltime_passengers', $alltime_passengers );
				
				$this->internal_add_chatter( 'Orville [AI]', $params['name'] . ' just boarded Flight ' . $id . ' to ' . $f['islandName'] . '!' );
				
				if ( $user_id ) {
					do_action( 'xophz_compass_record_action', 'dal_boarded_flight', $user_id, array() );
				}
				break;
			}
		}
		
		$this->update_data( 'flights', $flights );
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function leave_flight( $request ) {
		$id = $request->get_param( 'id' );
		$params = $request->get_json_params();
		$passengerId = $params['passengerId'];
		
		$flights = $this->get_data( 'flights' );
		foreach ( $flights as &$f ) {
			if ( $f['id'] === $id && isset( $f['passengers'] ) ) {
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
					$this->internal_add_chatter( 'Orville [AI]', $p['name'] . ' left Flight ' . $id . '.' );
				}
				break;
			}
		}
		
		$this->update_data( 'flights', $flights );
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function add_dream( $request ) {
		$params = $request->get_json_params();
		$dreams = $this->get_data( 'dreams' );
		
		$newDream = array_merge( $params, array(
			'id' => 'LUNA-' . rand( 1000, 9999 ),
			'status' => 'Scheduled',
			'passengers' => array(),
			'createdAt' => gmdate( 'Y-m-d\TH:i:s\Z' ),
			'travelType' => 'LUNA'
		) );
		
		array_unshift( $dreams, $newDream );
		$this->update_data( 'dreams', $dreams );
		
		$alltime_pilots = (int) get_option( 'dodo_air_alltime_pilots', 0 );
		$alltime_pilots++;
		update_option( 'dodo_air_alltime_pilots', $alltime_pilots );
		
		$this->internal_add_chatter( 'Luna [AI]', 'Ah, a new dream has formed... ' . $newDream['islandName'] . ' is now accessible for dreamers.' );
		
		return new WP_REST_Response( $newDream, 200 );
	}

	public function update_dream_status( $request ) {
		$id = $request->get_param( 'id' );
		$params = $request->get_json_params();
		$status = $params['status'];
		
		$dreams = $this->get_data( 'dreams' );
		foreach ( $dreams as &$d ) {
			if ( $d['id'] === $id ) {
				$d['status'] = $status;
				if ( isset( $params['dodoCode'] ) && !empty( $params['dodoCode'] ) ) {
					$d['dodoCode'] = $params['dodoCode'];
				}
				$this->internal_add_chatter( 'Luna [AI]', 'Dream ' . $id . ' status is now ' . strtoupper( $status ) . '.' );
				break;
			}
		}
		
		$this->update_data( 'dreams', $dreams );
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function visit_dream( $request ) {
		$id = $request->get_param( 'id' );
		$params = $request->get_json_params();
		
		$dreams = $this->get_data( 'dreams' );
		foreach ( $dreams as &$d ) {
			if ( $d['id'] === $id ) {
				if ( ! isset( $d['passengers'] ) ) {
					$d['passengers'] = array();
				}
				$d['passengers'][] = array_merge( $params, array(
					'id' => 'd-' . time(),
					'checkedInAt' => gmdate( 'Y-m-d\TH:i:s\Z' ),
				) );
				
				$alltime_passengers = (int) get_option( 'dodo_air_alltime_passengers', 0 );
				$alltime_passengers++;
				update_option( 'dodo_air_alltime_passengers', $alltime_passengers );
				
				$this->internal_add_chatter( 'Luna [AI]', $params['name'] . ' has drifted into the dream of ' . $d['islandName'] . '...' );
				break;
			}
		}
		
		$this->update_data( 'dreams', $dreams );
		return new WP_REST_Response( array( 'success' => true ), 200 );
	}

	public function leave_dream( $request ) {
		$id = $request->get_param( 'id' );
		$params = $request->get_json_params();
		$passengerId = $params['passengerId'];
		
		$dreams = $this->get_data( 'dreams' );
		foreach ( $dreams as &$d ) {
			if ( $d['id'] === $id && isset( $d['passengers'] ) ) {
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
					$this->internal_add_chatter( 'Luna [AI]', $p['name'] . ' has awoken from the dream of ' . $id . '.' );
				}
				break;
			}
		}
		
		$this->update_data( 'dreams', $dreams );
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
		
		$passport = get_user_meta( $user_id, '_dodo_air_passport', true );
		$new_number = $this->generate_flight_number();
		$passport['flightNumber'] = $new_number;
		update_user_meta( $user_id, '_dodo_air_passport', $passport );
		
		$profiles = $this->get_data( 'profiles' );
		if ( isset( $passport['friendCode'] ) ) {
			$profiles[ $passport['friendCode'] ] = $passport;
			$this->update_data( 'profiles', $profiles );
		}
		
		return new WP_REST_Response( array( 'success' => true, 'flightNumber' => $new_number, 'miles' => $miles - 500 ), 200 );
	}

	public function rate_profile( $request ) {
		$target_friendCode = $request->get_param( 'id' );
		$params = $request->get_json_params();
		$ratingType = $params['ratingType']; // 'apple' or 'turnip'
		
		$user_id = get_current_user_id();
		
		$profiles = $this->get_data( 'profiles' );
		if ( isset( $profiles[$target_friendCode] ) ) {
			$p = $profiles[$target_friendCode];
			if ( $ratingType === 'apple' ) {
				$p['goodApples'] = isset($p['goodApples']) ? $p['goodApples'] + 1 : 1;
			} else {
				$p['rottenTurnips'] = isset($p['rottenTurnips']) ? $p['rottenTurnips'] + 1 : 1;
			}
			$profiles[$target_friendCode] = $p;
			$this->update_data('profiles', $profiles);
			
			$host_user_id = null;
			$users = get_users(array(
				'meta_key' => '_dodo_air_passport',
				'meta_compare' => 'EXISTS'
			));
			foreach( $users as $u ) {
				$pass = get_user_meta( $u->ID, '_dodo_air_passport', true );
				if ( isset( $pass['friendCode'] ) && $pass['friendCode'] === $target_friendCode ) {
					$host_user_id = $u->ID;
					
					// Base 100 miles. Apple = 2x, Turnip = 0.5x
					$reward = $ratingType === 'apple' ? 200 : 50;
					$host_miles = (int) get_user_meta( $host_user_id, '_xp_total_gp', true );
					update_user_meta( $host_user_id, '_xp_total_gp', $host_miles + $reward );
					
					do_action( 'xophz_compass_record_action', 'dal_flight_rated_' . $ratingType, $host_user_id, array() );
					break;
				}
			}
		}
		
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

	public function ai_review( $request ) {
		$params = $request->get_json_params();
		$flight_id = $params['flightId'] ?? '';
		if ( ! $flight_id ) {
			return new WP_Error( 'missing_id', 'Flight ID is required', array( 'status' => 400 ) );
		}

		$is_dream = strpos( $flight_id, 'LUNA-' ) === 0;
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
			
			$chatter_name = $is_dream ? 'Luna [AI]' : 'Orville [AI]';
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
		$subject = 'Your Dodo Airlines Access Code';
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
}
