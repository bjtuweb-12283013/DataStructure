<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_site_find`;");
E_C("CREATE TABLE `ve123_site_find` (
  `site_id` mediumint(9) NOT NULL auto_increment,
  `url` varchar(225) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY  (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_site_find` values('20','http://www.hao123.com','0');");

require("../../inc/footer.php");
?>