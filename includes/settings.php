<?php


	/**
	 * Add settings section
	 * @param array $sections The current sections
	 */
	function gmt_edd_slack_settings_section( $sections ) {
		$sections['gmt_edd_slack'] = __( 'Slack', 'gmt_edd' );
		return $sections;
	}
	add_filter( 'edd_settings_sections_extensions', 'gmt_edd_slack_settings_section' );



	/**
	 * Add settings
	 * @param  array $settings The existing settings
	 */
	function gmt_edd_slack_settings( $settings ) {

		$slack_settings = array(
			array(
				'id'    => 'gmt_edd_slack_settings',
				'name'  => '<strong>' . __( 'Slack Settings', 'gmt_edd' ) . '</strong>',
				'desc'  => __( 'Slack Settings', 'gmt_edd' ),
				'type'  => 'header',
			),
			array(
				'id'      => 'gmt_slack_team_domain',
				'name'    => __( 'Team Name', 'gmt_edd' ),
				'desc'    => __( 'Your Slack team name', 'gmt_edd' ),
				'type'    => 'text',
				'std'     => __( '', 'gmt_edd' ),
			),
			array(
				'id'      => 'gmt_slack_auth_token',
				'name'    => __( 'Authorization Token', 'gmt_edd' ),
				'desc'    => __( 'Your Slack authorization token', 'gmt_edd' ),
				'type'    => 'text',
				'std'     => __( '', 'gmt_edd' ),
			),
		);
		if ( version_compare( EDD_VERSION, 2.5, '>=' ) ) {
			$slack_settings = array( 'gmt_edd_slack' => $slack_settings );
		}
		return array_merge( $settings, $slack_settings );
	}
	add_filter( 'edd_settings_extensions', 'gmt_edd_slack_settings', 999, 1 );