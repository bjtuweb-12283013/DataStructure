<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `phpsay_member`;");
E_C("CREATE TABLE `phpsay_member` (
  `uid` mediumint(8) NOT NULL auto_increment,
  `name` char(15) NOT NULL,
  `email` char(45) NOT NULL,
  `password` char(32) NOT NULL,
  `securekey` char(10) NOT NULL,
  `regdate` int(10) NOT NULL,
  `regip` char(15) NOT NULL,
  `lastdate` int(10) NOT NULL,
  `lastip` char(15) NOT NULL,
  `integral` int(10) NOT NULL default '0',
  `groupid` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `name` (`name`),
  KEY `integral` (`integral`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
E_D("replace into `phpsay_member` values('1','admin','admin@shiwww.com','e5c65234313eeaff07aa6f2266c26a68','2eRf2sCRbj','1346681979','119.187.14.233','1346682136','119.187.14.233','0','6');");

require("../../inc/footer.php");
?>