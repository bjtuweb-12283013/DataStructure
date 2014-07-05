<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_admin`;");
E_C("CREATE TABLE `ve123_admin` (
  `admin_id` mediumint(9) NOT NULL auto_increment,
  `adminname` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `logintime` int(10) NOT NULL,
  `lastlogintime` int(10) NOT NULL,
  `loginip` varchar(20) NOT NULL,
  `lastloginip` varchar(20) NOT NULL,
  PRIMARY KEY  (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_admin` values('1','admin','123456789xxx','2012','2012','127.0.0.1','127.0.0.1');");

require("../../inc/footer.php");
?>