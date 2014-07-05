<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `cy_sort`;");
E_C("CREATE TABLE `cy_sort` (
  `sid` smallint(5) unsigned NOT NULL auto_increment,
  `sid1` smallint(5) unsigned NOT NULL default '0',
  `sid2` smallint(5) unsigned NOT NULL default '0',
  `sort1` char(30) NOT NULL,
  `sort2` char(30) NOT NULL,
  `sort3` char(30) NOT NULL,
  `grade` tinyint(1) unsigned NOT NULL default '0',
  `orderid` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`sid`),
  KEY `grade` (`grade`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `cy_sort` values('1','0','0','Ä¬ÈÏ·ÖÀà','','','1','0');");

require("../../inc/footer.php");
?>