<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `cy_member`;");
E_C("CREATE TABLE `cy_member` (
  `uid` mediumint(8) unsigned NOT NULL auto_increment,
  `username` char(18) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(40) NOT NULL,
  `adminid` tinyint(3) unsigned NOT NULL default '0',
  `allscore` int(10) unsigned NOT NULL default '0',
  `regip` char(15) NOT NULL,
  `lastlogin` int(10) unsigned NOT NULL default '0',
  `gender` tinyint(1) unsigned NOT NULL default '0',
  `bday` date NOT NULL,
  `qq` varchar(15) NOT NULL,
  `msn` varchar(40) NOT NULL,
  `attachopen` tinyint(1) unsigned NOT NULL default '0',
  `attachments` int(10) unsigned NOT NULL default '0',
  `authstr` varchar(30) NOT NULL,
  `signature` text NOT NULL,
  PRIMARY KEY  (`uid`),
  KEY `username` (`username`),
  KEY `regip` (`regip`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `cy_member` values('1','admin','e5c65234313eeaff07aa6f2266c26a68','admin@admin.com','1','0','','0','0','0000-00-00','','','1','0','','');");

require("../../inc/footer.php");
?>