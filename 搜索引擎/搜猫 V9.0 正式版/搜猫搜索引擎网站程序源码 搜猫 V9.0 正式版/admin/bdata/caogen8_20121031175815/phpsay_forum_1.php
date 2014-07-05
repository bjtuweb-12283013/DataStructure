<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `phpsay_forum`;");
E_C("CREATE TABLE `phpsay_forum` (
  `fid` smallint(6) NOT NULL auto_increment,
  `cid` smallint(6) NOT NULL default '0',
  `name` char(15) NOT NULL,
  `synopsis` char(95) NOT NULL,
  `moderator` text NOT NULL,
  `friend` text NOT NULL,
  `commend` int(10) NOT NULL default '0',
  PRIMARY KEY  (`fid`),
  UNIQUE KEY `name` (`name`),
  KEY `cid` (`cid`),
  KEY `commend` (`commend`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>