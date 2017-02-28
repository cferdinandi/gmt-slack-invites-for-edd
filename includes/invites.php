<?php


	/**
	 * Create a new user when a product is purchased
	 * @param  integer $payment_id The payment ID
	 */
	function gmt_edd_invite_to_slack_on_complete_purchase( $payment_id ) {

		// Variables
		$downloads = edd_get_payment_meta_downloads( $payment_id );
		$email = edd_get_payment_user_email( $payment_id );

		// See if user account should be created
		$invite = 'off';
		foreach( $downloads as $download ) {
			if ( get_post_meta( $download['id'], 'gmt_edd_invite_to_slack', true ) === 'on' ) {
				$invite = 'on';
				break;
			}
		}

		// Get Slack Credentials
		$team_domain = edd_get_option( 'gmt_slack_team_domain', false );
		$auth_token = edd_get_option( 'gmt_slack_auth_token', false );
		if ( empty( $team_domain ) || empty( $auth_token ) ) return;

		// Setup new Slack API instance
		$slack = new Slack_Invite( $auth_token, $team_domain );

		// Invite purchaser to Slack
		$invitation = $slack->send_invite( $email );

		// Emit action hook
		do_action( 'gmt_edd_invite_to_slack_after', $email );

	}
	add_action( 'edd_complete_purchase', 'gmt_edd_invite_to_slack_on_complete_purchase' );
