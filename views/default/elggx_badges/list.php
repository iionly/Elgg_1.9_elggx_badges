<?php

$offset = (int) get_input('offset');
$limit = 10;
$sort = get_input('sort');

if ($sort == 'points') {
	$order = [
		'name' => 'badges_userpoints',
		'direction' => ASC,
		'as' => 'integer',
	];
} else {
	$sort = 'name';
	$order = [
		'name' => 'badges_name',
		'direction' => ASC,
	];
}

$options = [
	'type' => 'object',
	'subtype' => BadgesBadge::SUBTYPE,
	'count' => true,
	'limit' => $limit,
	'offset' => $offset,
	'order_by_metadata' => $order,
];

$count = elgg_get_entities_from_metadata($options);

if (!empty($count)) {

	echo elgg_view('navigation/pagination', [
		'base_url' => elgg_http_add_url_query_elements('admin/settings/elggx_userpoints', [
			'tab' => 'list',
			'sort' => $sort,
		]),
		'offset' => $offset,
		'count' => $count,
		'limit' => $limit,
	]);

	$rows = [];

	$options['count'] = false;
	$entities = elgg_get_entities_from_metadata($options);

	/* @var $entity BadgesBadge */
	foreach ($entities as $entity) {
		$row = [];

		// Bagde title
		$row[] = elgg_format_element('td', ['width' => '40%'], $entity->title);
		// Bagde points
		$row[] = elgg_format_element('td', ['width' => '10%'], $entity->badges_userpoints);
		// Bagde image
		$row[] = elgg_format_element('td', ['width' => '10%'], '<img src="' . elgg_get_inline_url($entity) . '">');
		// Bagde delete
		$row[] = elgg_format_element('td', ['width' => '10%'], elgg_view('output/url', [
			'text' => elgg_echo('badges:edit'),
			'href' => elgg_http_add_url_query_elements('admin/settings/elggx_badges', [
				'tab' =>  'edit',
				'guid' => $entity->guid,
			]),
		]) . ' | ' . elgg_view('output/url', [
			'text' => elgg_echo('badges:delete'),
			'href' => elgg_http_add_url_query_elements('action/elggx_badges/delete', [
				'guid' => $entity->guid,
			]),
			'is_action' => true,
			'is_trusted' => true,
			'confirm' => elgg_echo('badges:delete:confirm'),
		]));

		$rows[] = elgg_format_element('tr', [], implode('', $row));
	}

	$header_row = [
		elgg_format_element('th', ['width' => '40%'], elgg_view('output/url', [
			'text' => elgg_echo('badges:name'),
			'href' => elgg_http_add_url_query_elements('admin/settings/elggx_badges', [
				'tab' =>  'list',
				'sort' => 'name',
			]),
		])),
		elgg_format_element('th', ['width' => '10%'], elgg_view('output/url', [
			'text' => elgg_echo('badges:points'),
			'href' => elgg_http_add_url_query_elements('admin/settings/elggx_badges', [
				'tab' =>  'list',
				'sort' => 'points',
			])
		])),
		elgg_format_element('th', ['width' => '10%'], elgg_echo('badges:image')),
		elgg_format_element('th', ['width' => '10%'], elgg_echo('badges:action')),
	];
	$header = elgg_format_element('tr', [], implode('', $header_row));

	$table_content = elgg_format_element('thead', [], $header);
	$table_content .= elgg_format_element('tbody', [], implode('', $rows));
	
	echo elgg_format_element('table', ['class' => 'elgg-table'], $table_content);
}
