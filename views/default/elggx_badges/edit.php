<?php

$guid = (int) get_input('guid');

$vars['badge_guid'] = $guid;

echo '<div class="mtl">' . elgg_view("output/url", [
	'href' => 'admin/settings/elggx_badges',
	'text' => elgg_echo('back'),
	'is_trusted' => true,
	'class' => 'elgg-button elgg-button-action',
]) . '</div>';

echo elgg_view_form('elggx_badges/edit', ['enctype' => 'multipart/form-data'], $vars);
