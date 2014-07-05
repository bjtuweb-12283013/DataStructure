<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_stat_visitor`;");
E_C("CREATE TABLE `ve123_stat_visitor` (
  `visitor_id` mediumint(9) NOT NULL auto_increment,
  `v_time` int(10) NOT NULL,
  `referer` varchar(225) character set utf8 NOT NULL,
  `ip` varchar(30) character set utf8 NOT NULL,
  PRIMARY KEY  (`visitor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>