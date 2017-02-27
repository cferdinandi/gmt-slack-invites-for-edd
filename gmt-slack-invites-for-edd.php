<?php

/**
 * Plugin Name: GMT Slack Invites for EDD
 * Plugin URI: https://github.com/cferdinandi/gmt-slack-invites-for-edd/
 * GitHub Plugin URI: https://github.com/cferdinandi/gmt-slack-invites-for-edd/
 * Description: Automatically invite members to your Slack team if they purchase a product.
 * Version: 1.0.0
 * Author: Chris Ferdinandi
 * Author URI: http://gomakethings.com
 * License: GPLv3
 */


// Load includes
if ( !class_exists( 'Slack_Invite' ) ) {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/slack-api.php' );
}
require_once( plugin_dir_path( __FILE__ ) . 'includes/settings.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/metabox.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/invites.php' );