<?php

$user_guid = (int) get_input('user_guid', false);

if ($user_guid) {
	$user = get_user($user_guid);
}

if ($user instanceof ElggUser) {
	$vars['username'] = $user->username;
} else {
	$vars['username'] = '';
}

echo elgg_view_form('elggx_badges/assign', ['enctype' => 'multipart/form-data'], $vars);
