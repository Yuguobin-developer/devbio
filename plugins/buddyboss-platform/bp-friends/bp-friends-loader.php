<?php
/**
 * BuddyBoss Connections Feeds Loader.
 *
 * The friends component is for users to create relationships with each other.
 *
 * @package BuddyBoss\Connections
 * @since BuddyPress 1.5.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Set up the bp-friends component.
 *
 * @since BuddyPress 1.6.0
 */
function bp_setup_friends() {
	buddypress()->friends = new BP_Friends_Component();
}
add_action( 'bp_setup_components', 'bp_setup_friends', 6 );
