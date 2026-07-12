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
			$user_schedules = get_user_meta( $user_id, '_dodo_air_schedules', true ) ?: array();
			$user_passport = get_user_meta( $user_id, '_dodo_air_passport', true ) ?: null;
		}
		
		return new WP_REST_Response( array(
			'flights'  => $this->get_data( 'flights' ),
			'dreams'   => $this->get_data( 'dreams' ),
			'chatter'  => $this->get_data( 'chatter' ),
			'requests' => $this->get_data( 'requests' ),
			'profiles' => $this->get_data( 'profiles' ),
			'mySchedules' => $user_schedules,
			'myPassport' => $user_passport,
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

	public function save_profile( $request ) {
		$user_id = get_current_user_id();
		if ( ! $user_id ) return new WP_Error( 'unauthorized', 'Must be logged in.', array( 'status' => 401 ) );
		
		$params = $request->get_json_params();
		update_user_meta( $user_id, '_dodo_air_passport', $params );
		
		$profiles = $this->get_data( 'profiles' );
		$profiles[ $params['friendCode'] ] = $params;
		$this->update_data( 'profiles', $profiles );
		
		return new WP_REST_Response( array( 'success' => true ), 200 );
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
		
		$newFlight = array_merge( $params, array(
			'id' => 'DAL-' . rand( 1000, 9999 ),
			'status' => 'Scheduled',
			'passengers' => array(),
			'createdAt' => gmdate( 'Y-m-d\TH:i:s\Z' ),
		) );
		
		array_unshift( $flights, $newFlight );
		$this->update_data( 'flights', $flights );
		
		$this->internal_add_chatter( 'Orville [AI]', 'Attention! New flight ' . $newFlight['id'] . ' to ' . $newFlight['islandName'] . ' is now accepting passengers at Gate ' . $newFlight['gate'] . '.' );
		
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
		
		$flights = $this->get_data( 'flights' );
		foreach ( $flights as &$f ) {
			if ( $f['id'] === $id ) {
				if ( ! isset( $f['passengers'] ) ) {
					$f['passengers'] = array();
				}
				$f['passengers'][] = array_merge( $params, array(
					'id' => 'p-' . time(),
					'checkedInAt' => gmdate( 'Y-m-d\TH:i:s\Z' ),
				) );
				$this->internal_add_chatter( 'Orville [AI]', $params['name'] . ' just boarded Flight ' . $id . ' to ' . $f['islandName'] . '!' );
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

	public function ai_review( $request ) {
		return new WP_REST_Response( array( 'success' => true, 'message' => 'AI review completed (mock)' ), 200 );
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

		$user = get_user_by( 'email', $email );
		if ( ! $user ) {
			// Auto-create user
			$username = sanitize_user( current( explode( '@', $email ) ) );
			// Ensure unique username
			if ( username_exists( $username ) ) {
				$username .= '_' . rand( 1000, 9999 );
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
		), 200 );
	}
}
