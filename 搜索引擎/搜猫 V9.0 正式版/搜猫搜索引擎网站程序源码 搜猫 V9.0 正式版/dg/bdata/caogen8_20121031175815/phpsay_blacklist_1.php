<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `phpsay_blacklist`;");
E_C("CREATE TABLE `phpsay_blacklist` (
  `bid` int(10) unsigned NOT NULL auto_increment,
  `fid` smallint(6) unsigned NOT NULL default '0',
  `uid` mediumint(8) NOT NULL,
  `uname` char(15) NOT NULL,
  `dateline` int(10) unsigned NOT NULL default '0',
  `adminid` mediumint(8) NOT NULL,
  `adminname` char(15) NOT NULL,
  PRIMARY KEY  (`bid`),
  KEY `uid` (`uid`,`fid`,`bid`),
  KEY `uname` (`uname`,`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>