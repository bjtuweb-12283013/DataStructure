<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `cy_admin`;");
E_C("CREATE TABLE `cy_admin` (
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `adminid` tinyint(3) unsigned NOT NULL default '0',
  `sid` text NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");
E_D("replace into `cy_admin` values('0','1','all');");

require("../../inc/footer.php");
?>