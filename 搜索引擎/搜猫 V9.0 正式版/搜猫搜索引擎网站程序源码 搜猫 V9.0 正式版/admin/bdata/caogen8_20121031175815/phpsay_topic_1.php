<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `phpsay_topic`;");
E_C("CREATE TABLE `phpsay_topic` (
  `tid` mediumint(8) unsigned NOT NULL auto_increment,
  `fid` smallint(6) unsigned NOT NULL default '0',
  `author` char(15) NOT NULL default '',
  `authorid` mediumint(8) unsigned NOT NULL default '0',
  `authorico` tinyint(1) NOT NULL,
  `subject` char(60) NOT NULL default '',
  `dateline` int(10) NOT NULL,
  `lasttime` int(10) unsigned NOT NULL default '0',
  `lastauthor` char(15) NOT NULL default '',
  `lastauthorid` mediumint(8) NOT NULL,
  `lastauthorico` tinyint(1) NOT NULL,
  `views` int(10) unsigned NOT NULL default '0',
  `replies` mediumint(8) unsigned NOT NULL default '0',
  `stick` tinyint(1) NOT NULL default '0',
  `digest` tinyint(1) NOT NULL default '0',
  `lockout` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`tid`),
  KEY `authorid` (`authorid`,`tid`),
  KEY `replies` (`dateline`,`replies`),
  KEY `dateline` (`dateline`,`tid`),
  KEY `stick` (`fid`,`stick`,`lasttime`),
  KEY `fid` (`fid`,`digest`,`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>