<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_stat_click`;");
E_C("CREATE TABLE `ve123_stat_click` (
  `c_id` mediumint(9) NOT NULL auto_increment,
  `c_time` int(11) NOT NULL,
  `c_ip` varchar(100) NOT NULL,
  PRIMARY KEY  (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=402 DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>