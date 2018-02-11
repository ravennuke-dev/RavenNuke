DROP TABLE IF EXISTS `nuke_pages`;
CREATE TABLE `nuke_pages` (
  `pid` int(10) NOT NULL auto_increment,
  `cid` int(10) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `subtitle` varchar(255) NOT NULL default '',
  `tags` varchar(255) NOT NULL,
  `active` int(1) NOT NULL default '0',
  `page_header` text NOT NULL,
  `text` text NOT NULL,
  `page_footer` text NOT NULL,
  `signature` text NOT NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `counter` int(10) NOT NULL default '0',
  `clanguage` varchar(30) NOT NULL default '',
  `uname` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`pid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `nuke_pages_categories`;
CREATE TABLE `nuke_pages_categories` (
  `cid` int(10) NOT NULL auto_increment,
  `cimg` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `nuke_pages_feat`;
CREATE TABLE `nuke_pages_feat` (
  `cid` int(10) NOT NULL default '0',
  `pid` int(10) NOT NULL default '0'
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `nuke_newpages`;
CREATE TABLE `nuke_newpages` (
  `pid` int(10) NOT NULL auto_increment,
  `cid` int(10) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `subtitle` varchar(255) NOT NULL default '',
  `tags` varchar(255) NOT NULL default '',
  `page_header` text NOT NULL,
  `text` text NOT NULL,
  `page_footer` text NOT NULL,
  `signature` text NOT NULL,
  `uname` varchar(40) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `clanguage` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`pid`),
  KEY `pid` (`pid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM;