CREATE TABLE IF NOT EXISTS `nuke_nsnpj_config` (
  `config_name` varchar(255) NOT NULL default '',
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `nuke_nsnpj_config` (
  `config_name` varchar(255) NOT NULL default '',
  `config_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `nuke_nsnpj_config` (`config_name`, `config_value`) VALUES
('admin_report_email', 'webmaster@mysite.com'),
('admin_request_email', 'webmaster@mysite.com'),
('new_project_position', '1'),
('new_project_priority', '3'),
('new_project_status', '1'),
('new_report_position', '2'),
('new_report_status', '5'),
('new_report_type', '-1'),
('new_request_position', '2'),
('new_request_status', '6'),
('new_request_type', '-1'),
('new_task_position', '2'),
('new_task_priority', '3'),
('new_task_status', '4'),
('notify_report_admin', '0'),
('notify_report_submitter', '0'),
('notify_request_admin', '0'),
('notify_request_submitter', '0'),
('project_date_format', 'Y-m-d H:i:s'),
('report_date_format', 'Y-m-d H:i:s'),
('request_date_format', 'Y-m-d H:i:s'),
('task_date_format', 'Y-m-d H:i:s');

CREATE TABLE IF NOT EXISTS `nuke_nsnpj_members` (
  `member_id` int(11) NOT NULL auto_increment,
  `member_name` varchar(255) NOT NULL default '',
  `member_email` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`member_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `nuke_nsnpj_members_positions` (
  `position_id` int(11) NOT NULL auto_increment,
  `position_name` varchar(255) NOT NULL default '',
  `position_weight` int(11) NOT NULL default '0',
  PRIMARY KEY  (`position_id`),
  KEY `position_id` (`position_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `nuke_nsnpj_members_positions` (`position_id`, `position_name`, `position_weight`) VALUES
(-1, 'N/A', 0),
(1, 'Manager', 1),
(2, 'Developer', 2),
(3, 'Tester', 3),
(4, 'Sponsor', 4);


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_projects` (
  `project_id` int(11) NOT NULL auto_increment,
  `project_name` varchar(255) NOT NULL default '',
  `project_description` text NOT NULL,
  `project_site` varchar(255) NOT NULL default '',
  `priority_id` int(11) NOT NULL default '0',
  `status_id` int(11) NOT NULL default '0',
  `project_percent` float NOT NULL default '0',
  `weight` int(11) NOT NULL default '0',
  `featured` tinyint(2) NOT NULL default '0',
  `allowreports` tinyint(2) NOT NULL default '0',
  `allowrequests` tinyint(2) NOT NULL default '0',
  `date_created` int(14) NOT NULL default '0',
  `date_started` int(14) NOT NULL default '0',
  `date_finished` int(14) NOT NULL default '0',
  PRIMARY KEY  (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `nuke_nsnpj_projects_members` (
  `project_id` int(11) NOT NULL default '0',
  `member_id` int(11) NOT NULL default '0',
  `position_id` int(11) NOT NULL default '0',
  KEY `project_id` (`project_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_projects_priorities` (
  `priority_id` int(11) NOT NULL auto_increment,
  `priority_name` varchar(30) NOT NULL default '',
  `priority_weight` int(11) NOT NULL default '1',
  PRIMARY KEY  (`priority_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `nuke_nsnpj_projects_priorities` (`priority_id`, `priority_name`, `priority_weight`) VALUES
(-1, 'N/A', 0),
(1, 'Low', 1),
(2, 'Low-Med', 2),
(3, 'Medium', 3),
(4, 'High-Med', 4),
(5, 'High', 5);


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_projects_status` (
  `status_id` int(11) NOT NULL auto_increment,
  `status_name` varchar(255) NOT NULL default '',
  `status_weight` int(11) NOT NULL default '0',
  PRIMARY KEY  (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `nuke_nsnpj_projects_status` (`status_id`, `status_name`, `status_weight`) VALUES
(-1, 'N/A', 0),
(1, 'Pending', 1),
(2, 'Completed', 2),
(3, 'Active', 3),
(4, 'Inactive', 4),
(5, 'Released', 5);


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_reports` (
  `report_id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL default '0',
  `type_id` int(11) NOT NULL default '0',
  `status_id` int(11) NOT NULL default '0',
  `report_name` varchar(255) NOT NULL default '',
  `report_description` text NOT NULL,
  `submitter_name` varchar(32) NOT NULL default '',
  `submitter_email` varchar(255) NOT NULL default '',
  `submitter_ip` varchar(20) NOT NULL default '0.0.0.0',
  `date_submitted` int(14) NOT NULL default '0',
  `date_commented` int(14) NOT NULL default '0',
  `date_modified` int(14) NOT NULL default '0',
  PRIMARY KEY  (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_reports_comments` (
  `comment_id` int(11) NOT NULL auto_increment,
  `report_id` int(11) NOT NULL default '0',
  `commenter_name` varchar(32) NOT NULL default '',
  `commenter_email` varchar(255) NOT NULL default '',
  `commenter_ip` varchar(20) NOT NULL default '0.0.0.0',
  `comment_description` text NOT NULL,
  `date_commented` int(14) NOT NULL default '0',
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_reports_members` (
  `report_id` int(11) NOT NULL default '0',
  `member_id` int(11) NOT NULL default '0',
  `position_id` int(11) NOT NULL default '0',
  KEY `report_id` (`report_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_reports_status` (
  `status_id` int(11) NOT NULL auto_increment,
  `status_name` varchar(255) NOT NULL default '',
  `status_weight` int(11) NOT NULL default '0',
  PRIMARY KEY  (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

INSERT INTO `nuke_nsnpj_reports_status` (`status_id`, `status_name`, `status_weight`) VALUES
(-1, 'N/A', 0),
(1, 'Open', 1),
(2, 'Closed', 2),
(3, 'Duplicate', 3),
(4, 'Feedback', 4),
(5, 'Submitted', 5),
(6, 'Suspended', 6),
(7, 'Assigned', 7),
(8, 'Info Needed', 8),
(9, 'Unverifiable', 9);


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_reports_types` (
  `type_id` int(11) NOT NULL auto_increment,
  `type_name` varchar(255) NOT NULL default '',
  `type_weight` int(11) NOT NULL default '0',
  PRIMARY KEY  (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `nuke_nsnpj_reports_types` (`type_id`, `type_name`, `type_weight`) VALUES
(-1, 'N/A', 0),
(1, 'General', 1);


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_requests` (
  `request_id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL default '0',
  `type_id` int(11) NOT NULL default '0',
  `status_id` int(11) NOT NULL default '0',
  `request_name` varchar(255) NOT NULL default '',
  `request_description` text NOT NULL,
  `submitter_name` varchar(32) NOT NULL default '',
  `submitter_email` varchar(255) NOT NULL default '',
  `submitter_ip` varchar(20) NOT NULL default '0.0.0.0',
  `date_submitted` int(14) NOT NULL default '0',
  `date_commented` int(14) NOT NULL default '0',
  `date_modified` int(14) NOT NULL default '0',
  PRIMARY KEY  (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_requests_comments` (
  `comment_id` int(11) NOT NULL auto_increment,
  `request_id` int(11) NOT NULL default '0',
  `commenter_name` varchar(32) NOT NULL default '',
  `commenter_email` varchar(255) NOT NULL default '',
  `commenter_ip` varchar(20) NOT NULL default '0.0.0.0',
  `comment_description` text NOT NULL,
  `date_commented` int(14) NOT NULL default '0',
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_requests_members` (
  `request_id` int(11) NOT NULL default '0',
  `member_id` int(11) NOT NULL default '0',
  `position_id` int(11) NOT NULL default '0',
  KEY `request_id` (`request_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_requests_status` (
  `status_id` int(11) NOT NULL auto_increment,
  `status_name` varchar(255) NOT NULL default '',
  `status_weight` int(11) NOT NULL default '0',
  PRIMARY KEY  (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

INSERT INTO `nuke_nsnpj_requests_status` (`status_id`, `status_name`, `status_weight`) VALUES
(-1, 'N/A', 0),
(1, 'Duplicate', 1),
(2, 'Closed', 2),
(3, 'Inclusion', 3),
(4, 'Open', 4),
(5, 'Feedback', 5),
(6, 'Submitted', 6),
(7, 'Discarded', 7),
(8, 'Assigned', 8);

CREATE TABLE IF NOT EXISTS `nuke_nsnpj_requests_types` (
  `type_id` int(11) NOT NULL auto_increment,
  `type_name` varchar(255) NOT NULL default '',
  `type_weight` int(11) NOT NULL default '0',
  PRIMARY KEY  (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `nuke_nsnpj_requests_types` (`type_id`, `type_name`, `type_weight`) VALUES
(-1, 'N/A', 0),
(1, 'General', 1);


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_tasks` (
  `task_id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL default '0',
  `task_name` varchar(255) NOT NULL default '',
  `task_description` text NOT NULL,
  `priority_id` int(11) NOT NULL default '1',
  `status_id` int(11) NOT NULL default '0',
  `task_percent` float NOT NULL default '0',
  `date_created` int(14) NOT NULL default '0',
  `date_started` int(14) NOT NULL default '0',
  `date_finished` int(14) NOT NULL default '0',
  PRIMARY KEY  (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_tasks_members` (
  `task_id` int(11) NOT NULL default '0',
  `member_id` int(11) NOT NULL default '0',
  `position_id` int(11) NOT NULL default '0',
  KEY `task_id` (`task_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_tasks_priorities` (
  `priority_id` int(11) NOT NULL auto_increment,
  `priority_name` varchar(30) NOT NULL default '',
  `priority_weight` int(11) NOT NULL default '1',
  PRIMARY KEY  (`priority_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `nuke_nsnpj_tasks_priorities` (`priority_id`, `priority_name`, `priority_weight`) VALUES
(-1, 'N/A', 0),
(1, 'Low', 1),
(2, 'Low-Med', 2),
(3, 'Medium', 3),
(4, 'High-Med', 4),
(5, 'High', 5);


CREATE TABLE IF NOT EXISTS `nuke_nsnpj_tasks_status` (
  `status_id` int(11) NOT NULL auto_increment,
  `status_name` varchar(255) NOT NULL default '',
  `status_weight` int(11) NOT NULL default '0',
  PRIMARY KEY  (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

INSERT INTO `nuke_nsnpj_tasks_status` (`status_id`, `status_name`, `status_weight`) VALUES
(-1, 'N/A', 0),
(1, 'Inactive', 1),
(2, 'On Going', 2),
(3, 'Holding', 3),
(4, 'Open', 4),
(5, 'Completed', 5),
(6, 'Discontinued', 6),
(7, 'Active', 7);