DROP TABLE IF EXISTS `nuke_hnl_categories`;
CREATE TABLE IF NOT EXISTS `nuke_hnl_categories` ( `cid` int(11) NOT NULL auto_increment, `ctitle` varchar(50) NOT NULL default '', `cdescription` text NOT NULL, `cblocklimit` int(4) NOT NULL default '10', PRIMARY KEY  (`cid`) ) TYPE=MyISAM;

INSERT INTO `nuke_hnl_categories` VALUES (1, '*Unassigned*', 'This is a catch-all category where newsletters can default to or if all other categories are removed. Do NOT remove this category! This category of newsletters are only shown to the Admins.', 5);
INSERT INTO `nuke_hnl_categories` VALUES (2, 'Archived Newsletters', 'This category is for newsletter subscribers.', 5);
INSERT INTO `nuke_hnl_categories` VALUES (3, 'Archived Mass Mails', 'This category is used for mass mails.', 5);

DROP TABLE IF EXISTS `nuke_hnl_cfg`;
CREATE TABLE IF NOT EXISTS `nuke_hnl_cfg` ( `cfg_nm` varchar(255) NOT NULL default '', `cfg_val` longtext NOT NULL, PRIMARY KEY  (`cfg_nm`)) TYPE=MyISAM;

INSERT INTO `nuke_hnl_cfg` VALUES ('debug_mode', 'ERROR');
INSERT INTO `nuke_hnl_cfg` VALUES ('debug_output', 'DISPLAY');
INSERT INTO `nuke_hnl_cfg` VALUES ('show_blocks', '0');
INSERT INTO `nuke_hnl_cfg` VALUES ('dl_module', 'downloads');
INSERT INTO `nuke_hnl_cfg` VALUES ('blk_lmt', '10');
INSERT INTO `nuke_hnl_cfg` VALUES ('scroll', '0');
INSERT INTO `nuke_hnl_cfg` VALUES ('scroll_height', '180');
INSERT INTO `nuke_hnl_cfg` VALUES ('scroll_amt', '2');
INSERT INTO `nuke_hnl_cfg` VALUES ('scroll_delay', '100');
INSERT INTO `nuke_hnl_cfg` VALUES ('version', '01.03.02');
INSERT INTO `nuke_hnl_cfg` VALUES ('show_hits', '0');
INSERT INTO `nuke_hnl_cfg` VALUES ('show_dates', '0');
INSERT INTO `nuke_hnl_cfg` VALUES ('show_sender', '0');
INSERT INTO `nuke_hnl_cfg` VALUES ('show_categories', '1');
INSERT INTO `nuke_hnl_cfg` VALUES ('nsn_groups', '0');
INSERT INTO `nuke_hnl_cfg` VALUES ('latest_news', '0');
INSERT INTO `nuke_hnl_cfg` VALUES ('latest_downloads', '0');
INSERT INTO `nuke_hnl_cfg` VALUES ('latest_links', '0');
INSERT INTO `nuke_hnl_cfg` VALUES ('latest_forums', '0');
INSERT INTO `nuke_hnl_cfg` VALUES ('latest_reviews', '0');
INSERT INTO `nuke_hnl_cfg` VALUES ('wysiwyg_on', '1');
INSERT INTO `nuke_hnl_cfg` VALUES ('wysiwyg_rows', '30');

DROP TABLE IF EXISTS `nuke_hnl_newsletters`;
CREATE TABLE IF NOT EXISTS `nuke_hnl_newsletters` ( `nid` int(11) NOT NULL auto_increment, `cid` int(11) NOT NULL default '1', `topic` varchar(100) NOT NULL default '', `sender` varchar(20) NOT NULL default '', `filename` varchar(32) NOT NULL default '', `datesent` date default NULL, `view` int(1) NOT NULL default '0', `groups` text NOT NULL, `hits` int(11) NOT NULL default '0', PRIMARY KEY  (`nid`), KEY `cid` (`cid`)) TYPE=MyISAM;

INSERT INTO `nuke_hnl_newsletters` VALUES (NULL, 1, 'PREVIEW Newsletter File', 'Admin', 'tmp.php', '0000-00-00', 99, '', 0);
INSERT INTO `nuke_hnl_newsletters` VALUES (NULL, 1, 'Tested Email Temporary File', 'Admin', 'testemail.php', '0000-00-00', 99, '', 0);

INSERT INTO `nuke_modules` VALUES (NULL, 'HTML_Newsletter', 'HTML Newsletter', 0, 0, '', 1, 0, '');
