<?php

$performed_by = $vars['item']->getSubjectEntity();
$performed_on = $vars['item']->getObjectEntity();
$object = $vars['item']->getObjectEntity();

if ($guid = $object->badges_badge) {
	$badge = get_entity($guid);
	$badge_url = $badge->badges_url;

	if ($badge_url) {
		$badge_view = '<a href="' . $badge_url . '"><img title="' . $badge->title . '" src="' . elgg_get_inline_url($badge) . '"></a>';
	} else {
		$badge_view = '<img title="' . $badge->title . '" src="' . elgg_get_inline_url($badge) . '">';
	}

	$url = '<a href="' . $performed_by->getURL() . '">' . $performed_by->name . '</a>';
	$string = elgg_echo('badges:river:assigned', [$url, $badge->title]);

	echo elgg_view('river/elements/layout', [
		'item' => $vars['item'],
		'attachments' => $badge_view,
		'message' => $string,
	]);
}
