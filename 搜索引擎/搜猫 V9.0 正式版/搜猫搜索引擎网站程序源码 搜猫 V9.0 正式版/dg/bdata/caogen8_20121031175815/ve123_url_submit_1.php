<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_url_submit`;");
E_C("CREATE TABLE `ve123_url_submit` (
  `submit_id` mediumint(9) NOT NULL auto_increment,
  `url` varchar(200) NOT NULL,
  `ip` text NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY  (`submit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=600 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_url_submit` values('598','http://www.diaoying.com','127.0.0.1','1351307780');");
E_D("replace into `ve123_url_submit` values('599','http://www.baidu.com','127.0.0.1','1351308721');");

require("../../inc/footer.php");
?>