<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `cy_res`;");
E_C("CREATE TABLE `cy_res` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `aid` int(10) unsigned NOT NULL default '0',
  `qid` int(10) unsigned NOT NULL default '0',
  `uid` mediumint(8) unsigned NOT NULL,
  `username` varchar(18) NOT NULL,
  `uip` varchar(15) NOT NULL,
  `content` text NOT NULL,
  `time` int(10) unsigned NOT NULL default '0',
  `days` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>