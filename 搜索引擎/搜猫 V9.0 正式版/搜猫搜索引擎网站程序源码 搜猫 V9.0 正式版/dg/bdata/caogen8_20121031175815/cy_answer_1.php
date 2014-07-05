<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `cy_answer`;");
E_C("CREATE TABLE `cy_answer` (
  `aid` bigint(20) unsigned NOT NULL auto_increment,
  `qid` int(10) unsigned NOT NULL default '0',
  `uid` mediumint(8) unsigned NOT NULL,
  `joinvote` tinyint(1) unsigned NOT NULL default '0',
  `votevalue` smallint(5) unsigned NOT NULL default '0',
  `answertime` int(10) unsigned NOT NULL default '0',
  `adopttime` int(10) unsigned NOT NULL default '0',
  `response` smallint(5) unsigned NOT NULL default '0',
  `tableid` smallint(5) unsigned NOT NULL default '1',
  PRIMARY KEY  (`aid`),
  KEY `qid` (`qid`),
  KEY `uid` (`uid`),
  KEY `adopttime` (`adopttime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>