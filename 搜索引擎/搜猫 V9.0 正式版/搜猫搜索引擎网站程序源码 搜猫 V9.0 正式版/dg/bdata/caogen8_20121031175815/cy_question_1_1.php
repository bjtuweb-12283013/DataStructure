<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `cy_question_1`;");
E_C("CREATE TABLE `cy_question_1` (
  `qid` int(10) unsigned NOT NULL,
  `supplement` mediumtext NOT NULL,
  PRIMARY KEY  (`qid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>