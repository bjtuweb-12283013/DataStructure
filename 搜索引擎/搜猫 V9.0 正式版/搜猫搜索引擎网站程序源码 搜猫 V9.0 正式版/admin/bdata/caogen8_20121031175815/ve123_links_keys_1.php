<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_links_keys`;");
E_C("CREATE TABLE `ve123_links_keys` (
  `link_id` int(11) NOT NULL,
  `keywords` varchar(50) NOT NULL,
  KEY `link_id` (`link_id`,`keywords`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>