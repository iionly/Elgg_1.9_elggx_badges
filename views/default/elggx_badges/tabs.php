<?php

$selected_tab = elgg_extract('tab', $vars);

$base_url = 'admin/settings/elggx_badges';

$tabs = [
	'settings' => [
		'href' => 'admin/plugin_settings/elggx_badges',
	],
	'list' => [],
	'assign' => [],
	'unassign' => [],
	'upload' => [],
	'edit' => [],
];

$params = [
	'tabs' => [],
];

foreach ($tabs as $tab => $tab_settings) {

	$href = elgg_extract('href', $tab_settings);
	if (empty($href)) {
		$href = elgg_http_add_url_query_elements($base_url, [
			'tab' => $tab,
		]);
	}

	$params['tabs'][] = [
		'title' => elgg_echo("badges:{$tab}"),
		'url' => $href,
		'selected' => ($tab === $selected_tab),
	];
}

echo elgg_view('navigation/tabs', $params);
