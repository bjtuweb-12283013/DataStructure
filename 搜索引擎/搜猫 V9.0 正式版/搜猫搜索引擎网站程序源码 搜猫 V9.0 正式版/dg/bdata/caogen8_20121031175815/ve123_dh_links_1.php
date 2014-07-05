<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ve123_dh_links`;");
E_C("CREATE TABLE `ve123_dh_links` (
  `link_id` mediumint(9) NOT NULL auto_increment,
  `title` varchar(225) NOT NULL,
  `url` varchar(225) NOT NULL,
  `class_id` mediumint(9) NOT NULL,
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
E_D("replace into `ve123_dh_links` values('1','天气预报','http;//www.ip138.com','23');");
E_D("replace into `ve123_dh_links` values('2','查IP','http;//www.ip138.com','23');");

require("../../inc/footer.php");
?>