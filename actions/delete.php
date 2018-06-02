<?php

$guid = (int) get_input('guid');

$badge = get_entity($guid);

if (!$badge instanceof BadgesBadge) {
	return elgg_error_response(elgg_echo('badges:delete_fail_no_badge'));
}

/* @var BadgesBadge $badge */

if (!$badge->canEdit()) {
	return elgg_error_response(elgg_echo('badges:delete_fail_no_permissions'));
}

if (!$badge->delete()) {
	return elgg_error_response(elgg_echo('badges:delete_fail', [$badge->title]));
}

return elgg_ok_response('', elgg_echo('badges:delete_success'), REFERER);
