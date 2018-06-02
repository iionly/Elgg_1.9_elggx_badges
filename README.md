Elggx Bagdes plugin for Elgg 2.3 and newer 2.X
==============================================

Latest Version: 2.3.3  
Released: 2018-06-02  
Contact: iionly@gmx.de  
License: GNU General Public License version 2  
Copyright: (c) iionly (for Elgg 1.8 and newer), Billy Gunn


Description
-----------

This plugin allows users to be awarded a badge based on a configurable number of userpoints. Alternatively, the badges can also be assigned manually.

To use the automatic assign feature depending on userpoints your need the Elggx Userpoints plugin, too.

The badge will show below the profile picture on the user's profile pages. There's also the option to display the badges as overlay of the avatars. If you intend to use the overlay option, it requires the badge images to be of size 16x16 pixels or they won't get displayed completely! Larger images wouldn't work especially for the smaller versions of the avatars. The avatars would either be completely covered or the badge might even be larger than the avatar itself. The badge overlay is displayed in the upper-left corner of the avatar (lower-right seemed a bad idea due to the hover menu link and also because Elgg 1.8 (and later) doesn't increase the size of smaller profile images anymore like in previous versions).


Installation
------------

1. In case you have an earlier version of the Elggx Badges plugin installed it's best to remove the folder completely before copying the new version to the server,
2. Copy the elggx_badges folder into the mod directory of your Elgg installation,
3. Enable the plugin in the admin section of your site,
4. Configure then the plugin settings and upload at least some Badges and enter the Badges details.


Upgrading
---------

If you upload to version 2.3.3 or newer from a version older than 2.3.3 there's an upgrade script to execute that migrates badge images from the uploading user (or users) data directory subfolders to a single folder in the data directory subfolder of the site entity. To run it do as follows:

1. Backup your site database and data directory (for safety to be able to restore the former state in case the upgrade fails to complete without errors),
2. Run the upgrade from the Badges plugin settings page.

If the badges show up correctly afterwards, the migration has been finished successfully.
