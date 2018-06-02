<?php

$params = (array) get_input('params');

$username = elgg_extract('username', $params);
$user = get_user_by_username($username);

if (!($user instanceof ElggUser)) {
	return elgg_error_response(elgg_echo('badges:unassign:nouser', [$username]));
}

unset($user->badges_badge);
unset($user->badges_locked);
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

return elgg_ok_response('', elgg_echo('badges:unassign:success'), REFERER);
