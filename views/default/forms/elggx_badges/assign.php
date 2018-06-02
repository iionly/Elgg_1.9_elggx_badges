<?php

$username = elgg_extract('username', $vars);

$entities = elgg_get_entities_from_metadata([
	'type' => 'object',
	'subtype' => BadgesBadge::SUBTYPE,
	'limit' => false,
	'order_by_metadata' => [
		'name' => 'badges_name',
		'direction' => ASC,
	],
]);

foreach ($entities as $entity) {
	$label = '<img src="' . elgg_get_inline_url($entity) . '">' . $entity->title . ' - ' . $entity->badges_userpoints . ' ' . elgg_echo('badges:points');
	$options[$label] = $entity->guid;
}

echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo("badges:username"),
	'name' => 'params[username]',
	'value' => $username,
	'required' => true,
]);

echo elgg_view_field([
	'#type' => 'checkbox',
	'#label' => elgg_echo("badges:lock:info"),
	'name' => 'params[locked]',
	'value' => 0,
]);

echo elgg_view_field([
	'#type' => 'radio',
	'#label' => elgg_echo("badges:assign_list"),
	'name' => 'params[badge]',
	'value' => $user->badges_badge,
	'options' => $options,
]);

$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo("badges:assign_badge"),
]);

elgg_set_form_footer($footer);
