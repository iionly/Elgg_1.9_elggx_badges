<?php

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

$tab = get_input('tab', 'list');

echo elgg_view('elggx_badges/tabs', [
	'tab' => $tab,
]);

if (elgg_view_exists("elggx_badges/{$tab}")) {
	echo elgg_view("elggx_badges/{$tab}");
}
