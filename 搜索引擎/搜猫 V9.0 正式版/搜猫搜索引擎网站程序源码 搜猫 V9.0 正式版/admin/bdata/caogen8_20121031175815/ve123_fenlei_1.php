<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_fenlei`;");
E_C("CREATE TABLE `ve123_fenlei` (
  `about_id` mediumint(9) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `content` mediumtext NOT NULL,
  `is_show` int(1) NOT NULL,
  `url` varchar(225) NOT NULL,
  `sortid` int(11) NOT NULL,
  `urlid` varchar(225) NOT NULL,
  PRIMARY KEY  (`about_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_fenlei` values('28','лЛ©ухМ╪Чобть','','','0','','0','4521');");

require("../../inc/footer.php");
?>