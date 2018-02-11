DROP TABLE IF EXISTS `nuke_bbattachments_config`;
CREATE TABLE `nuke_bbattachments_config` (
  config_name varchar(255) NOT NULL,
  config_value varchar(255) NOT NULL,
  PRIMARY KEY (config_name)
) TYPE=MyISAM;
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('upload_dir','modules/Forums/files');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('upload_img','modules/Forums/images/icon_clip.gif');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('topic_icon','modules/Forums/images/icon_clip.gif');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('display_order','0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('max_filesize','262144');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('attachment_quota','52428800');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('max_filesize_pm','262144');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('max_attachments','3');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('max_attachments_pm','1');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('disable_mod','0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('allow_pm_attach','1');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('attachment_topic_review','0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('allow_ftp_upload','0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('show_apcp','0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('attach_version','2.4.5');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('default_upload_quota', '0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('default_pm_quota', '0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('ftp_server','');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('ftp_path','');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('download_path','');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('ftp_user','');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('ftp_pass','');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('ftp_pasv_mode','1');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('img_display_inlined','1');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('img_max_width','0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('img_max_height','0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('img_link_width','0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('img_link_height','0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('img_create_thumbnail','0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('img_min_thumb_filesize','12000');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('img_imagick', '');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('use_gd2','0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('wma_autoplay','0');
INSERT INTO `nuke_bbattachments_config` (`config_name`, `config_value`) VALUES ('flash_autoplay','0');

DROP TABLE IF EXISTS `nuke_bbforbidden_extensions`;
CREATE TABLE `nuke_bbforbidden_extensions` (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  extension varchar(100) NOT NULL,
  PRIMARY KEY (ext_id)
) TYPE=MyISAM;
INSERT INTO `nuke_bbforbidden_extensions` (`ext_id`, `extension`) VALUES (1,'php');
INSERT INTO `nuke_bbforbidden_extensions` (`ext_id`, `extension`) VALUES (2,'php3');
INSERT INTO `nuke_bbforbidden_extensions` (`ext_id`, `extension`) VALUES (3,'php4');
INSERT INTO `nuke_bbforbidden_extensions` (`ext_id`, `extension`) VALUES (4,'phtml');
INSERT INTO `nuke_bbforbidden_extensions` (`ext_id`, `extension`) VALUES (5,'pl');
INSERT INTO `nuke_bbforbidden_extensions` (`ext_id`, `extension`) VALUES (6,'asp');
INSERT INTO `nuke_bbforbidden_extensions` (`ext_id`, `extension`) VALUES (7,'cgi');
INSERT INTO `nuke_bbforbidden_extensions` (`ext_id`, `extension`) VALUES (8,'php5');
INSERT INTO `nuke_bbforbidden_extensions` (`ext_id`, `extension`) VALUES (9,'php6');

DROP TABLE IF EXISTS `nuke_bbextension_groups`;
CREATE TABLE `nuke_bbextension_groups` (
  group_id mediumint(8) NOT NULL auto_increment,
  group_name char(20) NOT NULL,
  cat_id tinyint(2) DEFAULT '0' NOT NULL,
  allow_group tinyint(1) DEFAULT '0' NOT NULL,
  download_mode tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  upload_icon varchar(100) DEFAULT '',
  max_filesize int(20) DEFAULT '0' NOT NULL,
  forum_permissions varchar(255) default '' NOT NULL,
  PRIMARY KEY group_id (group_id)
) TYPE=MyISAM;
INSERT INTO `nuke_bbextension_groups` (`group_id`, `group_name`, `cat_id`, `allow_group`, `download_mode`, `upload_icon`, `max_filesize`, `forum_permissions`) VALUES (1,'Images',1,1,1,'',0,'');
INSERT INTO `nuke_bbextension_groups` (`group_id`, `group_name`, `cat_id`, `allow_group`, `download_mode`, `upload_icon`, `max_filesize`, `forum_permissions`) VALUES (2,'Archives',0,1,1,'',0,'');
INSERT INTO `nuke_bbextension_groups` (`group_id`, `group_name`, `cat_id`, `allow_group`, `download_mode`, `upload_icon`, `max_filesize`, `forum_permissions`) VALUES (3,'Plain Text',0,0,1,'',0,'');
INSERT INTO `nuke_bbextension_groups` (`group_id`, `group_name`, `cat_id`, `allow_group`, `download_mode`, `upload_icon`, `max_filesize`, `forum_permissions`) VALUES (4,'Documents',0,0,1,'',0,'');
INSERT INTO `nuke_bbextension_groups` (`group_id`, `group_name`, `cat_id`, `allow_group`, `download_mode`, `upload_icon`, `max_filesize`, `forum_permissions`) VALUES (5,'Real Media',0,0,2,'',0,'');
INSERT INTO `nuke_bbextension_groups` (`group_id`, `group_name`, `cat_id`, `allow_group`, `download_mode`, `upload_icon`, `max_filesize`, `forum_permissions`) VALUES (6,'Streams',2,0,1,'',0,'');
INSERT INTO `nuke_bbextension_groups` (`group_id`, `group_name`, `cat_id`, `allow_group`, `download_mode`, `upload_icon`, `max_filesize`, `forum_permissions`) VALUES (7,'Flash Files',3,0,1,'',0,'');

DROP TABLE IF EXISTS `nuke_bbextensions`;
CREATE TABLE `nuke_bbextensions` (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  group_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  extension varchar(100) NOT NULL,
  comment varchar(100),
  PRIMARY KEY ext_id (ext_id)
) TYPE=MyISAM;
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (1, 1,'gif', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (2, 1,'png', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (3, 1,'jpeg', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (4, 1,'jpg', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (5, 1,'tif', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (6, 1,'tga', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (7, 2,'gtar', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (8, 2,'gz', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (9, 2,'tar', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (10, 2,'zip', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (11, 2,'rar', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (12, 2,'ace', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (13, 3,'txt', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (14, 3,'c', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (15, 3,'h', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (16, 3,'cpp', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (17, 3,'hpp', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (18, 3,'diz', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (19, 4,'xls', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (20, 4,'doc', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (21, 4,'dot', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (22, 4,'pdf', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (23, 4,'ai', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (24, 4,'ps', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (25, 4,'ppt', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (26, 5,'rm', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (27, 6,'wma', '');
INSERT INTO `nuke_bbextensions` (`ext_id`, `group_id`, `extension`, `comment`) VALUES (28, 7,'swf', '');

DROP TABLE IF EXISTS `nuke_bbattachments_desc`;
CREATE TABLE `nuke_bbattachments_desc` (
  `attach_id` mediumint(8) UNSIGNED NOT NULL auto_increment,
  `physical_filename` varchar(255) NOT NULL,
  `real_filename` varchar(255) NOT NULL,
  `download_count` mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  `comment` varchar(255),
  `extension` varchar(100),
  `mimetype` varchar(100),
  `filesize` int(20) NOT NULL,
  `filetime` int(11) DEFAULT '0' NOT NULL,
  `thumbnail` tinyint(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY (`attach_id`),
  KEY `filetime` (`filetime`),
  KEY `physical_filename` (`physical_filename`(10)),
  KEY `filesize` (`filesize`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `nuke_bbattachments`;
CREATE TABLE `nuke_bbattachments` (
  `attach_id` mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  `post_id` mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  `privmsgs_id` mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  `user_id_1` mediumint(8) NOT NULL,
  `user_id_2` mediumint(8) NOT NULL,
  KEY `attach_id_post_id` (`attach_id`, `post_id`),
  KEY `attach_id_privmsgs_id` (`attach_id`, `privmsgs_id`),
  KEY `post_id` (`post_id`),
  KEY `privmsgs_id` (`privmsgs_id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `nuke_bbquota_limits`;
CREATE TABLE `nuke_bbquota_limits` (
  `quota_limit_id` mediumint(8) unsigned NOT NULL auto_increment,
  `quota_desc` varchar(20) NOT NULL default '',
  `quota_limit` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`quota_limit_id`)
) TYPE=MyISAM;
INSERT INTO `nuke_bbquota_limits` (`quota_limit_id`, `quota_desc`, `quota_limit`) VALUES (1, 'Low', 262144);
INSERT INTO `nuke_bbquota_limits` (`quota_limit_id`, `quota_desc`, `quota_limit`) VALUES (2, 'Medium', 2097152);
INSERT INTO `nuke_bbquota_limits` (`quota_limit_id`, `quota_desc`, `quota_limit`) VALUES (3, 'High', 5242880);

DROP TABLE IF EXISTS `nuke_bbattach_quota`;
CREATE TABLE `nuke_bbattach_quota` (
  `user_id` mediumint(8) unsigned NOT NULL default '0',
  `group_id` mediumint(8) unsigned NOT NULL default '0',
  `quota_type` smallint(2) NOT NULL default '0',
  `quota_limit_id` mediumint(8) unsigned NOT NULL default '0',
  KEY `quota_type` (`quota_type`)
) TYPE=MyISAM;

ALTER TABLE `nuke_bbforums` ADD `auth_download` TINYINT(2) DEFAULT '0' NOT NULL;
ALTER TABLE `nuke_bbauth_access` ADD `auth_download` TINYINT(1) DEFAULT '0' NOT NULL;
ALTER TABLE `nuke_bbposts` ADD `post_attachment` TINYINT(1) DEFAULT '0' NOT NULL;
ALTER TABLE `nuke_bbtopics` ADD `topic_attachment` TINYINT(1) DEFAULT '0' NOT NULL;
ALTER TABLE `nuke_bbprivmsgs` ADD `privmsgs_attachment` TINYINT(1) DEFAULT '0' NOT NULL;