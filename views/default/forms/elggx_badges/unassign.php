<?php

$username = elgg_extract('username', $vars);

echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo("badges:username"),
	'name' => 'params[username]',
	'value' => $username,
	'required' => true,
]);

$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo("badges:unassign_badge"),
]);

elgg_set_form_footer($footer);
