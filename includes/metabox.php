<?php

	/**
	 * Create the metabox
	 */
	function gmt_edd_slack_create_metabox() {
		add_meta_box( 'gmt_edd_slack_metabox', __( 'Invite to Slack', 'gmt_edd' ), 'gmt_edd_slack_render_metabox', 'download', 'side', 'default');
	}
	add_action( 'add_meta_boxes', 'gmt_edd_slack_create_metabox' );



	/**
	 * Render the metabox
	 */
	function gmt_edd_slack_render_metabox() {

		// Variables
		global $post;

		?>

			<fieldset>

				<label>
					<input type="checkbox" name="gmt_edd_invite_to_slack" value="on" <?php checked( get_post_meta( $post->ID, 'gmt_edd_invite_to_slack', true ), 'on' ); ?>>
					<?php _e( 'Invite purchaser to Slack', 'gmt_edd' ); ?>
				</label>

			</fieldset>

		<?php

		wp_nonce_field( 'gmt_edd_slack_metabox_nonce', 'gmt_edd_slack_metabox_process' );
	}



	/**
	 * Save the product page link metabox
	 * @param  Number $post_id The post ID
	 * @param  Array  $post    The post data
	 */
	function gmt_edd_slack_save_metabox( $post_id, $post ) {

		if ( !isset( $_POST['gmt_edd_slack_metabox_process'] ) ) return;

		// Verify data came from edit screen
		if ( !wp_verify_nonce( $_POST['gmt_edd_slack_metabox_process'], 'gmt_edd_slack_metabox_nonce' ) ) {
			return $post->ID;
		}

		// Verify user has permission to edit post
		if ( !current_user_can( 'edit_post', $post->ID )) {
			return $post->ID;
		}

		// Make sure data was provided
		if ( isset( $_POST['gmt_edd_invite_to_slack'] ) ) {
			update_post_meta( $post->ID, 'gmt_edd_invite_to_slack', 'on' );
		} else {
			update_post_meta( $post->ID, 'gmt_edd_invite_to_slack', 'off' );
		}


	}
	add_action( 'save_post', 'gmt_edd_slack_save_metabox', 1, 2 );