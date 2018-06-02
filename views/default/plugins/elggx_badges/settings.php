<?php
/**
 * Elggx Badges settings form
 */

/* @var $plugin ElggPlugin */
$plugin = elgg_extract('entity', $vars);

if (elggx_badges_is_upgrade_available()) {
	echo '<div class="elgg-admin-notices">';
	echo '<p>';
	echo elgg_view('output/url', [
		'text' => elgg_echo('badges:upgrade'),
		'href' => 'action/elggx_badges/upgrade',
		'is_action' => true,
	]);
	echo '</p>';
	echo '</div>';
}

// show navigation tabs
echo elgg_view('elggx_badges/tabs', [
	'tab' => 'settings',
]);

echo elgg_view_field([
	'#type' => 'select',
	'#label' => elgg_echo('badges:lock_high'),
	'#help' => elgg_echo('badges:lock_high:info'),
	'name' => 'params[lock_high]',
	'options_values' => [
		'1' => elgg_echo('option:yes'),
		'0' => elgg_echo('option:no')
	],
	'value' => $plugin->lock_high,
]);

echo elgg_view_field([
	'#type' => 'select',
	'#label' => elgg_echo('badges:show_description'),
	'#help' => elgg_echo('badges:show_description:info'),
	'name' => 'params[show_description]',
	'options_values' => [
		'1' => elgg_echo('option:yes'),
		'0' => elgg_echo('option:no')
	],
	'value' => $plugin->show_description,
]);

echo elgg_view_field([
	'#type' => 'select',
	'#label' => elgg_echo('badges:avatar_overlay'),
	'#help' => elgg_echo('badges:avatar_overlay:info'),
	'name' => 'params[avatar_overlay]',
	'options_values' => [
		'1' => elgg_echo('option:yes'),
		'0' => elgg_echo('option:no')
	],
	'value' => $plugin->avatar_overlay,
]);
