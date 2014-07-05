<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_zz_website`;");
E_C("CREATE TABLE `ve123_zz_website` (
  `site_id` mediumint(9) NOT NULL auto_increment,
  `user_id` mediumint(9) NOT NULL,
  `site_name` varchar(225) NOT NULL,
  `site_url` varchar(225) NOT NULL,
  `description` mediumtext NOT NULL,
  `addtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY  (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>