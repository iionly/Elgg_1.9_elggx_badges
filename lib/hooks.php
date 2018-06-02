<?php

/**
 * Add to the user hover menu
 */
function elggx_badges_user_hover_menu($hook, $type, $returnvalue, $params) {
	$user = elgg_extract('entity', $params);
	if (!($user instanceof ElggUser)) {
		return;
	}

	$returnvalue[] = ElggMenuItem::factory([
		'name' => 'elggx_badges_assign',
		'text' => elgg_echo('badges:assign_badge'),
		'href' => elgg_http_add_url_query_elements('admin/settings/elggx_badges', [
			'tab' => 'assign',
			'user_guid' => $user->guid,
		]),
		'section' => 'admin',
	]);

	$returnvalue[] = ElggMenuItem::factory([
		'name' => 'elggx_badges_unassign',
		'text' => elgg_echo('badges:unassign_badge'),
		'href' => elgg_http_add_url_query_elements('admin/settings/elggx_badges', [
			'tab' => 'unassign',
			'user_guid' => $user->guid,
		]),
		'section' => 'admin',
	]);

	return $returnvalue;
}

/**
 * This method is called when a users points are updated.
 * We check to see what the users current balance is and
 * assign the appropriate badge.
 */
function elggx_badges_userpoints($hook, $type, $return, $params) {
	$user = elgg_extract('entity', $params);
	if (!($user instanceof ElggUser)) {
		return;
	}

	if ($user->badges_locked) {
		return;
	}

	$points = $user->userpoints_points;
	$badge = get_entity($user->badges_badge);

	$entities = elgg_get_entities_from_metadata([
		'type' => 'object',
		'subtype' => BadgesBadge::SUBTYPE,
		'limit' => false,
		'order_by_metadata' =>  [
			'name' => 'badges_userpoints',
			'direction' => DESC,
			'as' => 'integer',
		],
		'metadata_name_value_pairs' => [
			'name' => 'badges_userpoints',
			'value' => $points,
			'operand' => '<=',
		],
	
	]);

	if ((int) elgg_get_plugin_setting('lock_high', 'elggx_badges')) {
		if ($badge->badges_userpoints > $entities[0]->badges_userpoints) {
			return;
		}
	}

	if ($badge->guid != $entities[0]->guid) {
		$user->badges_badge = $entities[0]->guid;
		if (!elgg_trigger_plugin_hook('badges:update', 'object', ['entity' => $user], true)) {
			$user->badges_badge = $badge->guid;
			return false;
		}

		// Announce it on the river
		$user_guid = $user->guid;
		elgg_delete_river([
			'view' => 'river/object/badge/assign',
			'subject_guid' => $user_guid,
			'object_guid' => $user_guid,
		]);
		elgg_delete_river([
			'view' => 'river/object/badge/award',
			'subject_guid' => $user_guid,
			'object_guid' => $user_guid,
		]);
		elgg_create_river_item([
			'view' => 'river/object/badge/award',
			'action_type' => 'award',
			'subject_guid' => $user_guid,
			'object_guid' => $user_guid,
		]);
	}
}
