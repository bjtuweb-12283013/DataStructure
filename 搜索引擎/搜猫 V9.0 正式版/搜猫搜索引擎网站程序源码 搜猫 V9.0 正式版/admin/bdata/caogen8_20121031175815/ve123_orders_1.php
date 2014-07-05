<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_orders`;");
E_C("CREATE TABLE `ve123_orders` (
  `id` int(80) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `oid` varchar(50) NOT NULL default '0',
  `price` int(10) NOT NULL,
  `state` tinyint(1) NOT NULL default '0',
  `time` int(15) NOT NULL,
  `utime` int(15) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `userid` (`uid`),
  KEY `oid` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_orders` values('45','96','20120905071657','100','0','1346843817','0');");
E_D("replace into `ve123_orders` values('46','0','20120905074659','0','0','1346845619','0');");

require("../../inc/footer.php");
?>