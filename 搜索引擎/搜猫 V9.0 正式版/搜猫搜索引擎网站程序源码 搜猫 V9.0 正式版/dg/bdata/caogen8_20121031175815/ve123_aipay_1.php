<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('latin1');
E_D("DROP TABLE IF EXISTS `ve123_aipay`;");
E_C("CREATE TABLE `ve123_aipay` (
  `id` int(4) NOT NULL auto_increment,
  `alipay_account` varchar(100) character set utf8 NOT NULL,
  `alipay_key` varchar(100) character set utf8 NOT NULL,
  `alipay_partner` varchar(100) character set utf8 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1");
E_D("replace into `ve123_aipay` values('1','','','');");

require("../../inc/footer.php");
?>