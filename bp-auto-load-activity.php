<?php
/*** Make sure BuddyPress is loaded ********************************/
if ( !function_exists( 'bp_core_install' ) ) {
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'buddypress/bp-loader.php' ) ) {
		require_once ( WP_PLUGIN_DIR . '/buddypress/bp-loader.php' );
	} else {
		add_action( 'admin_notices', 'bp_auto_load_activity_install_buddypress_notice' );
		return;
	}
}


function bp_auto_load_activity_install_buddypress_notice() {
	echo '<div id="message" class="error fade"><p style="line-height: 150%">';
	_e('<strong>BP Auto Load Activity</strong></a> requires the BuddyPress plugin to work. Please <a href="http://buddypress.org/download">install BuddyPress</a> first, or <a href="plugins.php">deactivate BP Auto Load Activity</a>.');
	echo '</p></div>';
}

/*Begin auto load activity*/
function juan_mag() {
?> 
	<div class="juan_js>
		<script type="text/javascript" style="display: none;">
			jq('.pixelMonitor').remove();
			jq(document).unbind('scroll');
		</script>
	</div>
<?php
}
add_action( 'bp_activity_has_more_items', 'juan_mag' );

function aut_loa_act() {
?>
<div id="pixelMonitor"  style="width: 1px; height: 1px; position: fixed; bottom: 0;">

	<div id="loadingActivityMessage" style="background: url('<?php bloginfo('url'); ?>/wp-content/plugins/bp-auto-load-activity/includes/preloader.gif') no-repeat scroll 8px 4px white; border-radius: 7px 7px 7px 7px; bottom: 4px; display: none; float: right; height: 16px; padding: 4px 2px 4px 39px; position: fixed; width: 100px;">Loading more...</div>

</div>

<div class="mag_js">
<script type="text/javascript">
/* Auto load more updates at the end of the page when reaching the bottom of the page */

jq(document).ready( function() {

	thereIsMoreActivityItems = 1;

	iterationAllowed = true;

	function loadActivityOnScroll(){

		jq("#loadingActivityMessage").show();

		if ( null == jq.cookie('bp-activity-oldestpage') )

			jq.cookie('bp-activity-oldestpage', 1, {path: '/'} );

		var oldest_page = ( jq.cookie('bp-activity-oldestpage') * 1 ) + 1;

		jq.post( ajaxurl, {

			action: 'activity_get_older_updates',

			'cookie': encodeURIComponent(document.cookie),

			'page': oldest_page

		},

		function(response){

			jq("#loadingActivityMessage").hide();

			jq.cookie( 'bp-activity-oldestpage', oldest_page, {path: '/'} );

			jq("#content ul.activity-list").append(response.contents);

		}, 'json' );

		return false;
	};

	jq(document).scroll(function(){		  

		if ( Math.round(jq('#pixelMonitor').offset().top) > ( jq(document).height() -500 ) && thereIsMoreActivityItems === 1 && iterationAllowed === true ) {

			loadActivityOnScroll();

			iterationAllowed = false;

			setTimeout('iterationAllowed = true', 3000);
		};
	});
}); /* Auto load more activity block ending here */
</script>
</div>
<?php	
}

add_action( 'bp_after_activity_loop', 'aut_loa_act' );
?>