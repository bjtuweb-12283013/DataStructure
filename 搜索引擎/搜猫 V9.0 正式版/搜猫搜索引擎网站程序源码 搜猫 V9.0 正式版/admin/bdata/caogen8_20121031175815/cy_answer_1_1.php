<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `cy_answer_1`;");
E_C("CREATE TABLE `cy_answer_1` (
  `aid` int(10) unsigned NOT NULL,
  `username` varchar(18) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY  (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>