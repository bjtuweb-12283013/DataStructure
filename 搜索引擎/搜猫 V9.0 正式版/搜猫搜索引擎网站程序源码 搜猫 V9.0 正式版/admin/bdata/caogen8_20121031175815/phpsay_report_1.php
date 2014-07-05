<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `phpsay_report`;");
E_C("CREATE TABLE `phpsay_report` (
  `rid` int(10) unsigned NOT NULL auto_increment,
  `uname` char(15) NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `fid` smallint(6) unsigned NOT NULL default '0',
  `tid` mediumint(8) unsigned NOT NULL default '0',
  `pid` int(10) unsigned NOT NULL default '0',
  `author` char(15) NOT NULL,
  `authorid` mediumint(8) unsigned NOT NULL default '0',
  `message` char(90) NOT NULL,
  `dateline` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`rid`),
  KEY `fid` (`fid`,`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>