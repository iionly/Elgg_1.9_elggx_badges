<?php
/**
 * Activate Elggx Badges
 *
 */

// Register the BadgesBadge class for the object/userpoint subtype
if (get_subtype_id('object', BadgesBadge::SUBTYPE)) {
	update_subtype('object', BadgesBadge::SUBTYPE, 'BadgesBadge');
} else {
	add_subtype('object', BadgesBadge::SUBTYPE, 'BadgesBadge');
}
