<?php

$params = (array) get_input('params');

$username = elgg_extract('username', $params);
$user = get_user_by_username($username);

if (!($user instanceof ElggUser)) {
	return elgg_error_response(elgg_echo('badges:assign:nouser', [$username]));
}

$badge = (int) elgg_extract('badge', $params);
$locked = (int) elgg_extract('locked', $params);

$user->badges_badge = $badge;
$user->badges_locked = $locked;

// Anounce it on the river
if ($guid = $user->badges_badge) {
	elgg_delete_river([
		'view' => 'river/object/badge/award',
		'subject_guid' => $user->guid,
		'object_guid' => $user->guid,
	]);
	elgg_delete_river([
	'view' => 'river/object/badge/assign',
		'subject_guid' => $user->guid,
		'object_guid' => $user->guid,
	]);
	elgg_create_river_item([
		'view' => 'river/object/badge/assign',
		'action_type' => 'assign',
		'subject_guid' => $user->guid,
		'object_guid' => $user->guid,
	]);
}

return elgg_ok_response('', elgg_echo('badges:assign:success'), REFERER);
