<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_zz_links`;");
E_C("CREATE TABLE `ve123_zz_links` (
  `link_id` mediumint(9) NOT NULL auto_increment,
  `user_id` mediumint(9) NOT NULL,
  `title` varchar(225) NOT NULL,
  `url` varchar(225) NOT NULL,
  `keywords` longtext NOT NULL,
  `description` varchar(225) NOT NULL,
  `price` int(11) NOT NULL,
  `jscode` mediumtext NOT NULL,
  `pic` varchar(225) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `stat_click` int(11) NOT NULL,
  `consumption` int(11) NOT NULL,
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>