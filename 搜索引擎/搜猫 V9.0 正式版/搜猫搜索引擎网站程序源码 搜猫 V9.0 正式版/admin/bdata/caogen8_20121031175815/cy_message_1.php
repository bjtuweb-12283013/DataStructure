<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `cy_message`;");
E_C("CREATE TABLE `cy_message` (
  `mid` int(10) unsigned NOT NULL auto_increment,
  `mkey` varchar(17) NOT NULL,
  `touid` mediumint(8) unsigned NOT NULL default '0',
  `tousername` varchar(18) NOT NULL,
  `fromuid` mediumint(8) unsigned NOT NULL default '0',
  `fromusername` varchar(18) NOT NULL,
  `mbody` text NOT NULL,
  `mdate` int(10) unsigned NOT NULL default '0',
  `mstate` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`mid`),
  KEY `mkey` (`mkey`),
  KEY `touid` (`touid`),
  KEY `fromuid` (`fromuid`),
  KEY `mdate` (`mdate`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>