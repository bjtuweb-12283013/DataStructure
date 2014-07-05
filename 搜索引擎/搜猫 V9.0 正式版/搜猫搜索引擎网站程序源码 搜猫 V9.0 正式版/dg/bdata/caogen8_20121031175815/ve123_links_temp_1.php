<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_links_temp`;");
E_C("CREATE TABLE `ve123_links_temp` (
  `temp_id` mediumint(9) NOT NULL auto_increment,
  `url` varchar(225) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `site_id` mediumint(9) NOT NULL,
  `no_id` int(11) NOT NULL,
  PRIMARY KEY  (`temp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=278797 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_links_temp` values('278547','http://www.fuxin.gov.cn','0','8983','0');");
E_D("replace into `ve123_links_temp` values('275187','http://bbs.my0557.cn','0','9005','0');");
E_D("replace into `ve123_links_temp` values('257642','http://www.onda.cn','0','9439','0');");
E_D("replace into `ve123_links_temp` values('268383','http://www.cndesign.com','0','9376','0');");
E_D("replace into `ve123_links_temp` values('271805','http://www.168hs.com','0','9045','0');");

require("../../inc/footer.php");
?>