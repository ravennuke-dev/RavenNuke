CREATE TABLE `nuke_mail_config` (
  `active` tinyint(1) NOT NULL default '0',
  `mailer` tinyint(1) NOT NULL default '1',
  `smtp_host` varchar(255) NOT NULL default '',
  `smtp_helo` varchar(255) NOT NULL default '',
  `smtp_port` int(10) NOT NULL default '25',
  `smtp_auth` tinyint(1) NOT NULL default '0',
  `smtp_uname` varchar(255) NOT NULL default '',
  `smtp_passw` varchar(255) NOT NULL default '',
  `sendmail_path` varchar(255) NOT NULL default '/usr/sbin/sendmail',
  `qmail_path` varchar(255) NOT NULL default '/var/qmail/bin/sendmail',
  PRIMARY KEY  (`mailer`),
  UNIQUE KEY `mailer` (`mailer`)
) TYPE=MyISAM;

INSERT INTO `nuke_mail_config` VALUES(0, 1, 'smtp.tusitio.com', 'smtp.tusitio.com', 25, 0, 'tu@tusitio.com', 'tupassword', '/usr/sbin/sendmail', '/var/qmail/bin/sendmail');