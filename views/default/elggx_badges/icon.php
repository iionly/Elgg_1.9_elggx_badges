<?php

if (elgg_get_context() !== 'profile' || elgg_extract('size', $vars) !== 'large') {
	return;
}

$user = elgg_extract('entity', $vars);
if (!($guid = $user->badges_badge)) {
	return;
}

$badge = get_entity($guid);

if (!($badge instanceof BadgesBadge)) {
	return;
}

$html = '<div class="badges_profile mtm"><span>' . elgg_echo('badges:badge:upper');
if ($badge->badges_url) {
	$html .= '<a href="' . $badge->badges_url . '">';
}

$html .= '<img title="' . $badge->title . '" src="' . elgg_get_inline_url($badge) . '">';

if ($badge->badges_url) {
	$html .= '</a>';
}

if ((int) elgg_get_plugin_setting('show_description', 'elggx_badges')) {
	$html .= '<div class="elgg-subtext">' . $badge->description . '</div>';
}

$html .= '</span></div>';

echo $html;
