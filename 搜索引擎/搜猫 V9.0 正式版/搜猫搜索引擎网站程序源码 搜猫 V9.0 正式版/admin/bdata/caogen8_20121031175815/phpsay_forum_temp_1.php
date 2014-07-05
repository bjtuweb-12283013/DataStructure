<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `phpsay_forum_temp`;");
E_C("CREATE TABLE `phpsay_forum_temp` (
  `fid` mediumint(8) NOT NULL auto_increment,
  `name` char(15) NOT NULL,
  `synopsis` char(95) NOT NULL,
  `founder` char(15) NOT NULL,
  `dateline` int(10) NOT NULL,
  `ipaddress` char(15) NOT NULL,
  PRIMARY KEY  (`fid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>