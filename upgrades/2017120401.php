<?php

/**
 * Change owner of badge entities to site_entity
 * and move badge files to site_entity data folder
 *
 */

// prevent timeout when script is running
set_time_limit(0);

$badges = elgg_get_entities([
	'type' => 'object',
	'subtype' => BadgesBadge::SUBTYPE,
	'limit' => false,
	'batch' => true,
]);

$site_entity = elgg_get_site_entity();
$site_guid = $site_entity->guid;
$prefix = 'elggx_badges';

foreach($badges as $badge) {
	if (!$badge->exists()) {
		break;
	}

	$filestorename = $badge->getFilenameOnFilestore();

	$filename = $prefix . '/' . $badge->time_created . $badge->originalfilename;

	$badge->owner_guid = $site_guid;
	$badge->container_guid = $site_guid;
	$badge->filestore_prefix = $prefix;
	$badge->upload_time = $badge->time_created;
	$badge->icontime = $badge->time_created;
	$badge->simpletype = $badge->getSimpleType();
	$badge->setFilename($filename);
	$badge->open('write');
	$badge->close();

	$badge->save();
	
	rename($filestorename, $badge->getFilenameOnFilestore());
}
