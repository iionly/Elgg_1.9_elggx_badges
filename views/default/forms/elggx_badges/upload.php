<?php

echo elgg_view_field([
	'#type' => 'file',
	'#label' => elgg_echo("badges:image"),
	'name' => 'badge_upload',
	'required' => true,
]);

echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo("badges:name"),
	'#help' => elgg_echo("badges:name:info"),
	'name' => 'params[name]',
	'required' => true,
]);

echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo("badges:description"),
	'#help' => elgg_echo("badges:description:info"),
	'name' => 'params[description]',
	'value' => $badge->description,
]);

echo elgg_view_field([
	'#type' => 'select',
	'#label' => elgg_echo("badges:access_id"),
	'#help' => elgg_echo("badges:description:access_id"),
	'name' => 'params[access_id]',
	'options_values' => [
		'0'  => elgg_echo('PRIVATE'),
		'1'  => elgg_echo('LOGGED_IN'),
		'2'  => elgg_echo('PUBLIC'),
		'-2' => elgg_echo('access:friends:label'),
	],
	'value' => 2,
]);

echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo("badges:description:url"),
	'#help' => elgg_echo("badges:description:url:info"),
	'name' => 'params[url]',
]);

echo elgg_view_field([
	'#type' => 'number',
	'#label' => elgg_echo("badges:points"),
	'#help' => elgg_echo("badges:points:info"),
	'name' => 'params[points]',
	'min' => 0,
	'step' => 1,
]);

$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo("save"),
]);

elgg_set_form_footer($footer);
