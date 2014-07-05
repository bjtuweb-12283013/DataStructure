<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_sites`;");
E_C("CREATE TABLE `ve123_sites` (
  `site_id` mediumint(9) NOT NULL auto_increment,
  `site_no` int(2) NOT NULL,
  `qp` int(2) NOT NULL,
  `fpr` int(2) NOT NULL,
  `url` varchar(250) NOT NULL,
  `pagestart` int(2) NOT NULL,
  `pagestop` int(2) NOT NULL,
  `pageadd` int(2) NOT NULL,
  `spider_depth` int(11) NOT NULL,
  `indexdate` int(10) NOT NULL,
  `addtime` int(10) NOT NULL,
  `com_count_ip` mediumint(9) NOT NULL,
  `com_time` int(11) NOT NULL,
  `include_word` mediumtext NOT NULL,
  `not_include_word` mediumtext NOT NULL,
  PRIMARY KEY  (`site_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24175 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_sites` values('24171','0','0','0','http://shiwww.com','1','2','1','0','0','0','0','0','','');");
E_D("replace into `ve123_sites` values('24172','0','0','0','http://www.1230530.com','1','2','1','0','0','0','0','0','','');");
E_D("replace into `ve123_sites` values('24173','0','0','0','http://www.caogen8.cc','0','0','0','1','1351307780','1351307780','0','0','','');");
E_D("replace into `ve123_sites` values('24174','0','0','0','http://www.baidu.com','0','0','0','1','1351308721','1351308721','0','0','','');");

require("../../inc/footer.php");
?>