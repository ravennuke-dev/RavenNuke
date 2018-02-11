DROP TABLE IF EXISTS `nuke_gcal_category`;
CREATE TABLE `nuke_gcal_category` (`id` int(11) NOT NULL auto_increment,`name` varchar(128) NOT NULL default '',PRIMARY KEY  (`id`)) TYPE=MyISAM;
INSERT INTO `nuke_gcal_category` VALUES (1, 'Unfiled');
INSERT INTO `nuke_gcal_category` VALUES (2, 'Show');
INSERT INTO `nuke_gcal_category` VALUES (3, 'Birthday');
INSERT INTO `nuke_gcal_category` VALUES (4, 'Release Date');
INSERT INTO `nuke_gcal_category` VALUES (5, 'Anniversary');
INSERT INTO `nuke_gcal_category` VALUES (6, 'Site Event');

DROP TABLE IF EXISTS `nuke_gcal_config`;
CREATE TABLE `nuke_gcal_config` (`id` int(11) NOT NULL auto_increment,`title` varchar(128) NOT NULL default 'Calendar of Events',`image` varchar(255) NOT NULL default '',`min_year` int(10) unsigned NOT NULL default '2006',`max_year` int(10) unsigned NOT NULL default '2037',`user_submit` enum('off','members','anyone','groups') NOT NULL default 'off',`req_approval` tinyint(1) NOT NULL default '1',`allowed_tags` text NOT NULL,`allowed_attrs` text NOT NULL,`version` varchar(16) NOT NULL default '',`time_in_24` tinyint(1) NOT NULL default '0',`short_date_format` varchar(16) NOT NULL default '',`reg_date_format` varchar(16) NOT NULL default '',`long_date_format` varchar(16) NOT NULL default '', `first_day_of_week` tinyint(1) NOT NULL default '0',`auto_link` tinyint(1) NOT NULL default '0',`location_required` tinyint(1) NOT NULL default '0',`details_required` tinyint(1) NOT NULL default '0',`email_notify` tinyint(1) NOT NULL default '0',`email_to` varchar(255) NOT NULL default '',`email_subject` varchar(255) NOT NULL default '',`email_msg` varchar(255) NOT NULL default '',`email_from` varchar(255) NOT NULL default '',`show_cat_legend` tinyint(1) NOT NULL default '1',`wysiwyg` tinyint(1) NOT NULL default '0',`user_update` tinyint(1) NOT NULL default '0',`weekends` SET( '0', '1', '2', '3', '4', '5', '6' ) NOT NULL DEFAULT '0,6',`rsvp` ENUM( 'off', 'on', 'email' ) NOT NULL DEFAULT 'off',`rsvp_email_subject` VARCHAR( 255 ) NOT NULL DEFAULT 'Event RSVP Notification', `groups_submit` TEXT NOT NULL , `groups_no_approval` TEXT NOT NULL, PRIMARY KEY  (`id`)) TYPE=MyISAM;
INSERT INTO `nuke_gcal_config` VALUES (1, 'Calendar of Events', 'images/admin/gcalendar.gif', 2006, 2037,'members', 1, 'a,b,i,img','href,src,border,alt,title', '1.7.0', 0, '%m/%d', '%B %d, %Y', '%A, %B %d, %Y', 0, 1, 0,0, 0, 'admin@yoursite.com', 'New GCalendar Event', 'A new GCalendar event was submitted.', 'admin@yoursite.com', 1, 1, 1, '0,6', 'off', 'Event RSVP Notification', '', '' );

DROP TABLE IF EXISTS `nuke_gcal_event`;
CREATE TABLE `nuke_gcal_event` (`id` int(11) NOT NULL auto_increment,`title` varchar(255) NOT NULL default '',`no_time` tinyint(1) NOT NULL default '1',`start_time` time NOT NULL default '00:00:00',`end_time` time NOT NULL default '00:00:00',`location` text NOT NULL,`category` int(11) NOT NULL default '0',`repeat_type` enum('none','daily','weekly','monthly','yearly') NOT NULL default 'none',`details` text NOT NULL,`interval_val` int(11) NOT NULL default '0',`no_end_date` tinyint(1) NOT NULL default '1',`start_date` date NOT NULL default '0000-00-00',`end_date` date NOT NULL default '0000-00-00',`weekly_days` set('0','1','2','3','4','5','6') NOT NULL default '',`monthly_by_day` tinyint(1) NOT NULL default '0',`submitted_by` varchar(25) NOT NULL default '',`approved` tinyint(1) NOT NULL default '0',`rsvp` ENUM( 'off', 'on', 'email' ) NOT NULL DEFAULT 'off',PRIMARY KEY  (`id`),KEY `approved` (`approved`),KEY `start_date` (`start_date`),KEY `repeat_type` (`repeat_type`)) TYPE=MyISAM;

DROP TABLE IF EXISTS `nuke_gcal_rsvp`;
CREATE TABLE `nuke_gcal_rsvp` (`id` int(11) NOT NULL auto_increment,`event_id` int(11) NOT NULL,`user_id` int(11) NOT NULL,PRIMARY KEY  (`id`), KEY `event_id` (`event_id`,`user_id`)) TYPE=MyISAM;

DROP TABLE IF EXISTS `nuke_gcal_exception`;
CREATE TABLE `nuke_gcal_exception` (`id` int(11) NOT NULL auto_increment, `event_id` int(11) NOT NULL, `date` date NOT NULL default '0000-00-00', PRIMARY KEY (`id`), KEY `event_id` (`event_id`), KEY `date` (`date`)) TYPE=MyISAM;

DROP TABLE IF EXISTS `nuke_gcal_cat_group`;
CREATE TABLE `nuke_gcal_cat_group` (`id` int(11) NOT NULL auto_increment, `cat_id` int(11) NOT NULL, `group_id` int(11) NOT NULL, PRIMARY KEY (`id`), KEY `cat_id` (`cat_id`), KEY `group_id` (`group_id`)) TYPE=MyISAM;

INSERT INTO `nuke_gcal_cat_group` VALUES (NULL, 1, -1);
INSERT INTO `nuke_gcal_cat_group` VALUES (NULL, 2, -1);
INSERT INTO `nuke_gcal_cat_group` VALUES (NULL, 3, -1);
INSERT INTO `nuke_gcal_cat_group` VALUES (NULL, 4, -1);
INSERT INTO `nuke_gcal_cat_group` VALUES (NULL, 5, -1);
INSERT INTO `nuke_gcal_cat_group` VALUES (NULL, 6, -1);
