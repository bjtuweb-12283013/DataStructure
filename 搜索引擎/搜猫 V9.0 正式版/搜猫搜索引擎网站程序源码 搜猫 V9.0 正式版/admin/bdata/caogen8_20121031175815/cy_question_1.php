<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `cy_question`;");
E_C("CREATE TABLE `cy_question` (
  `qid` int(10) unsigned NOT NULL auto_increment,
  `sid` smallint(5) unsigned NOT NULL default '0',
  `sid1` smallint(5) unsigned NOT NULL default '0',
  `sid2` smallint(5) unsigned NOT NULL default '0',
  `sid3` smallint(5) unsigned NOT NULL default '0',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `username` char(18) NOT NULL,
  `title` char(50) NOT NULL,
  `score` smallint(5) unsigned NOT NULL default '0',
  `asktime` int(10) unsigned NOT NULL default '0',
  `endtime` int(10) unsigned NOT NULL default '0',
  `introtime` int(10) unsigned NOT NULL default '0',
  `status` tinyint(1) unsigned NOT NULL default '1',
  `hidanswer` tinyint(1) unsigned NOT NULL default '0',
  `answercount` smallint(5) unsigned NOT NULL default '0',
  `clickcount` mediumint(8) unsigned NOT NULL default '0',
  `tableid` smallint(5) unsigned NOT NULL default '1',
  PRIMARY KEY  (`qid`),
  KEY `sid` (`sid`),
  KEY `sid1` (`sid1`),
  KEY `sid2` (`sid2`),
  KEY `sid3` (`sid3`),
  KEY `uid` (`uid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>