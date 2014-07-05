<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `cy_score`;");
E_C("CREATE TABLE `cy_score` (
  `uid` int(10) unsigned NOT NULL,
  `day` int(10) unsigned NOT NULL default '0',
  `week` smallint(5) unsigned NOT NULL default '0',
  `month` mediumint(8) unsigned NOT NULL default '0',
  `score` mediumint(9) NOT NULL default '0',
  UNIQUE KEY `uid` (`uid`,`day`),
  KEY `week` (`week`),
  KEY `month` (`month`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>