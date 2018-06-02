<?php

// Get variables
$params = (array) get_input('params');

$name = htmlspecialchars(elgg_extract('name', $params), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$description = elgg_extract('description', $params);
$access_id = (int) elgg_extract('access_id', $params, 2);
$url = elgg_extract('url', $params, false);
$points = (int) elgg_extract('points', $params, 0);

// check if upload attempted and failed
$uploaded_files = elgg_get_uploaded_files('badge_upload');
$uploaded_file = array_shift($uploaded_files);
if ($uploaded_file && !$uploaded_file->isValid()) {
	$error = elgg_get_friendly_upload_error($uploaded_file->getError());
	return elgg_error_response($error);
}

$site_entity = elgg_get_site_entity();
$site_guid = $site_entity->guid;

$badge = new BadgesBadge();
$badge->owner_guid = $site_guid;
$badge->container_guid = $site_guid;
$badge->access_id = $access_id;
$badge->title = $name;
$badge->description = $description;
$badge->filestore_prefix = 'elggx_badges';

// Add the name as metadata. This is a hack to allow sorting the admin list view by name
$badge->badges_name = $name;

// Add the userpoints at which this badge will be awarded
$badge->badges_userpoints = $points;

// Add badge url if it has been provided
if ($url) {
	if (preg_match('/^https?/i', $url)) {
		$badge->badges_url = $url;
	} else {
		$badge->badges_url = elgg_get_config('wwwroot') . $url;
	}
}

// Now save the uploaded badge image file
$guid = 0;
if ($uploaded_file && $uploaded_file->isValid()) {
	if ($badge->acceptUploadedFile($uploaded_file)) {
		$badge->icontime = $badge->upload_time;
		$guid = $badge->save();
	}
}

if (!$guid) {
	return elgg_error_response(elgg_echo('badges:upload_failed'));
}

return elgg_ok_response('', elgg_echo('badges:uploaded'), REFERER);
