<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `phpsay_apply`;");
E_C("CREATE TABLE `phpsay_apply` (
  `aid` int(10) unsigned NOT NULL auto_increment,
  `type` tinyint(1) NOT NULL,
  `uname` char(15) NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `fname` char(15) NOT NULL,
  `fid` smallint(6) unsigned NOT NULL default '0',
  `message` char(95) NOT NULL,
  `dateline` int(10) unsigned NOT NULL default '0',
  `dispose` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`aid`),
  KEY `check_dispose` (`type`,`uid`,`fid`),
  KEY `user_manage` (`type`,`uid`,`dispose`),
  KEY `type` (`type`,`dispose`,`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>