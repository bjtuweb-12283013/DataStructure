<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_links`;");
E_C("CREATE TABLE `ve123_links` (
  `link_id` mediumint(9) NOT NULL auto_increment,
  `title` varchar(225) NOT NULL,
  `tuiguang` int(11) NOT NULL,
  `site_id` mediumint(9) NOT NULL,
  `url` varchar(325) NOT NULL,
  `keywords` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `fulltxt` text NOT NULL,
  `pagesize` float NOT NULL,
  `level` int(11) NOT NULL,
  `addtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `lrymd5` varchar(32) NOT NULL,
  `key_status` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`link_id`),
  KEY `title` (`title`),
  KEY `tuiguang` (`tuiguang`),
  KEY `site_id` (`site_id`),
  KEY `url` (`url`)
) ENGINE=MyISAM AUTO_INCREMENT=18614 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_links` values('18511','','0','0','baidu.com','','','','0','0','0','1351308956','d41d8cd98f00b204e9800998ecf8427e','0');");
E_D("replace into `ve123_links` values('18515','','0','24173','http://www.caogen8.cc','','','','0','1','0','1351309147','d41d8cd98f00b204e9800998ecf8427e','0');");

require("../../inc/footer.php");
?>