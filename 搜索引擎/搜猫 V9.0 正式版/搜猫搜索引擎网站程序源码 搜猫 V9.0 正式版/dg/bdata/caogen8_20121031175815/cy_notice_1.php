<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `cy_notice`;");
E_C("CREATE TABLE `cy_notice` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `author` char(18) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `time` int(10) unsigned NOT NULL default '0',
  `orderid` tinyint(3) unsigned NOT NULL default '0',
  `url` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>