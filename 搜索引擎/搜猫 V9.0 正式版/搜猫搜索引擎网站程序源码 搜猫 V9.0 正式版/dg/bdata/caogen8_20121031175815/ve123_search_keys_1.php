<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_search_keys`;");
E_C("CREATE TABLE `ve123_search_keys` (
  `kid` int(11) NOT NULL,
  `keyscn` varchar(50) NOT NULL,
  KEY `link_id` (`kid`,`keyscn`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");
E_D("replace into `ve123_search_keys` values('29166','软件');");
E_D("replace into `ve123_search_keys` values('29167','11');");
E_D("replace into `ve123_search_keys` values('29168','图片');");
E_D("replace into `ve123_search_keys` values('29169','图片');");
E_D("replace into `ve123_search_keys` values('29170','书籍');");
E_D("replace into `ve123_search_keys` values('29171','电影');");
E_D("replace into `ve123_search_keys` values('29172','111');");
E_D("replace into `ve123_search_keys` values('29174','1122');");
E_D("replace into `ve123_search_keys` values('29175','22');");
E_D("replace into `ve123_search_keys` values('29177','12');");
E_D("replace into `ve123_search_keys` values('29178','121');");
E_D("replace into `ve123_search_keys` values('29179','120');");
E_D("replace into `ve123_search_keys` values('29181','122');");

require("../../inc/footer.php");
?>