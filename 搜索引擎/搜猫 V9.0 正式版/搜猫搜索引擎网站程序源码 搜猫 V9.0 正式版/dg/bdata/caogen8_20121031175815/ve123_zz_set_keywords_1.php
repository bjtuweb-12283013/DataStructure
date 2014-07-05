<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_zz_set_keywords`;");
E_C("CREATE TABLE `ve123_zz_set_keywords` (
  `key_id` mediumint(9) NOT NULL auto_increment,
  `keywords` varchar(225) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY  (`key_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>