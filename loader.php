<?php 
/*
Plugin Name: BP Auto Load Activity
Plugin URI: https://github.com/bphelp/bp-auto-load-activity
Description: This plugin will auto load more in the activity stream
Version: 1.1
Requires at least: WordPress 3.2.1 / BuddyPress 1.5.1
Tested up to: WordPress 3.5.1 / BuddyPress 1.7.1
License: GNU/GPL 2
Author: @bphelp
Author URI: http://bphelpblog.wordpress.com/
*/

function bp_auto_load_activity_init() {
	require( dirname( __FILE__ ) . '/bp-auto-load-activity.php' );
}
add_action( 'bp_include', 'bp_auto_load_activity_init' );
?>