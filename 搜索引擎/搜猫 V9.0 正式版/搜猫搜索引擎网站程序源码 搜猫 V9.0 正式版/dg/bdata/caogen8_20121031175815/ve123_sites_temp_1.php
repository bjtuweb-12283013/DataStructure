<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_sites_temp`;");
E_C("CREATE TABLE `ve123_sites_temp` (
  `no_id` mediumint(9) NOT NULL,
  `temp_id` mediumint(9) NOT NULL auto_increment,
  `site_id` mediumint(9) NOT NULL,
  `url` varchar(225) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY  (`temp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=191226 DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>