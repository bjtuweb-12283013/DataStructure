<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_nav`;");
E_C("CREATE TABLE `ve123_nav` (
  `nav_id` mediumint(9) NOT NULL auto_increment,
  `title` varchar(225) NOT NULL,
  `content` mediumtext NOT NULL,
  `url` varchar(225) NOT NULL,
  `type` int(11) NOT NULL,
  `is_show` int(1) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY  (`nav_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>