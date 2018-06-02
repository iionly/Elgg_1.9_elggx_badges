<?php

/**
 * Main plugin file
 */

require_once(dirname(__FILE__) . '/lib/functions.php');
require_once(dirname(__FILE__) . '/lib/hooks.php');

// register default Elgg event
elgg_register_event_handler('init', 'system', 'elggx_badges_init');

/**
 * Called during system init
 *
 * @return void
 */
function elggx_badges_init() {

	// Extend CSS/js
	elgg_extend_view('elgg.css', 'elggx_badges/site.css');

	// Extend view
	elgg_extend_view('icon/user/default', 'elggx_badges/icon');

	// Plugin hooks
	elgg_register_plugin_hook_handler('userpoints:update', 'all', 'elggx_badges_userpoints');
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'elggx_badges_user_hover_menu');

	// Register actions
	elgg_register_action('elggx_badges/upload', dirname(__FILE__) . '/actions/upload.php', 'admin');
	elgg_register_action('elggx_badges/edit', dirname(__FILE__) . '/actions/edit.php', 'admin');
	elgg_register_action('elggx_badges/assign', dirname(__FILE__) . '/actions/assign.php', 'admin');
	elgg_register_action('elggx_badges/unassign', dirname(__FILE__) . '/actions/unassign.php', 'admin');
	elgg_register_action('elggx_badges/delete', dirname(__FILE__) . '/actions/delete.php', 'admin');
	elgg_register_action('elggx_badges/upgrade', dirname(__FILE__) . '/actions/upgrade.php', 'admin');
}
