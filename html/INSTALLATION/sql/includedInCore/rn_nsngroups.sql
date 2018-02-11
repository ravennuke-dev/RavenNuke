DROP TABLE IF EXISTS `nuke_nsngr_config`;
CREATE TABLE IF NOT EXISTS `nuke_nsngr_config` ( `config_name` varchar(255) NOT NULL default '', `config_value` text NOT NULL, PRIMARY KEY  (`config_name`) ) TYPE=MyISAM;

INSERT INTO `nuke_nsngr_config` VALUES ('perpage', '50');
INSERT INTO `nuke_nsngr_config` VALUES ('date_format', 'Y-m-d');
INSERT INTO `nuke_nsngr_config` VALUES ('send_notice', '1');
INSERT INTO `nuke_nsngr_config` VALUES ('version_number', '1.7.1');

DROP TABLE IF EXISTS `nuke_nsngr_groups`;
CREATE TABLE IF NOT EXISTS `nuke_nsngr_groups` ( `gid` int(11) NOT NULL auto_increment, `gname` varchar(32) NOT NULL default '', `gdesc` text NOT NULL, `gpublic` tinyint(1) NOT NULL default '0', `glimit` int(11) NOT NULL default '0', `phpBB` int(11) NOT NULL default '0', `muid` int(11) NOT NULL default '0', PRIMARY KEY  (`gid`) ) TYPE=MyISAM;

INSERT INTO `nuke_nsngr_groups` VALUES (1, 'Moderators', 'Moderators of this Forum', 0, 0, 3, 2);

DROP TABLE IF EXISTS `nuke_nsngr_users`;
CREATE TABLE IF NOT EXISTS `nuke_nsngr_users` ( `gid` int(11) NOT NULL default '0', `uid` int(11) NOT NULL default '0', `uname` varchar(25) NOT NULL default '', `trial` tinyint(1) NOT NULL default '0', `notice` tinyint(1) NOT NULL default '0', `sdate` int(14) NOT NULL default '0', `edate` int(14) NOT NULL default '0' ) TYPE=MyISAM;

INSERT INTO `nuke_nsngr_users` VALUES (1, 2, '', 0, 0, 2005, 0);

ALTER TABLE `nuke_blocks` ADD `groups` TEXT NOT NULL AFTER `view`;
ALTER TABLE `nuke_message` ADD `groups` TEXT NOT NULL AFTER `view`;
ALTER TABLE `nuke_modules` ADD `groups` TEXT NOT NULL AFTER `view`;
