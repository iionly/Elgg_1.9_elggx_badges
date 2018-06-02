<?php

/**
 * Are there upgrade scripts to be run?
 *
 * @return bool
 */
function elggx_badges_is_upgrade_available() {
	// sets $version based on code
	require_once elgg_get_plugins_path() . "elggx_badges/version.php";

	$local_version = elgg_get_plugin_setting('version', 'elggx_badges');
	if ($local_version === null) {
		// check if installation already in use
		$badges_count = elgg_get_entities([
			'type' => 'object',
			'subtype' => BadgesBadge::SUBTYPE,
			'count' => true,
		]);
		
		if ($badges_count > 0) {
			// no version set yet but requires upgrade
			$local_version = 0;
		} else {
			// set initial version for new install
			elgg_set_plugin_setting('version', $version, 'elggx_badges');
			$local_version = $version;
		}
	}

	if ($local_version == $version) {
		return false;
	} else {
		return true;
	}
}
