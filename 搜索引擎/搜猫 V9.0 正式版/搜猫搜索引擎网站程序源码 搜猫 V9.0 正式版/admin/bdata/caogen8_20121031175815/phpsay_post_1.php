<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `phpsay_post`;");
E_C("CREATE TABLE `phpsay_post` (
  `pid` int(10) unsigned NOT NULL auto_increment,
  `fid` smallint(6) unsigned NOT NULL default '0',
  `tid` mediumint(8) unsigned NOT NULL default '0',
  `replyfloor` smallint(6) NOT NULL default '1',
  `author` char(15) NOT NULL,
  `authorid` mediumint(8) unsigned NOT NULL default '0',
  `authorico` tinyint(1) NOT NULL,
  `guestname` tinyint(1) NOT NULL,
  `subject` char(60) NOT NULL,
  `dateline` int(10) unsigned NOT NULL default '0',
  `postip` char(15) NOT NULL default '',
  `up` mediumint(8) NOT NULL default '0',
  `down` mediumint(8) unsigned NOT NULL default '0',
  `wave` mediumint(8) NOT NULL default '0',
  PRIMARY KEY  (`pid`),
  KEY `fid` (`fid`,`replyfloor`,`pid`),
  KEY `tid` (`tid`,`pid`,`replyfloor`),
  KEY `authorid` (`authorid`,`replyfloor`,`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>