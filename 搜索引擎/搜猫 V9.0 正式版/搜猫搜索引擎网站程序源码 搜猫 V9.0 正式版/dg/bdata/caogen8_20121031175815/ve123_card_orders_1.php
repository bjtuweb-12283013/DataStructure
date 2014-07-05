<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('latin1');
E_D("DROP TABLE IF EXISTS `ve123_card_orders`;");
E_C("CREATE TABLE `ve123_card_orders` (
  `id` int(15) NOT NULL auto_increment,
  `uid` int(15) NOT NULL,
  `card` varchar(255) character set utf8 NOT NULL,
  `price` int(10) NOT NULL,
  `time` int(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1");
E_D("replace into `ve123_card_orders` values('1','17','SN100009-JVJH-UBVV-PMQC','200','1317969521');");
E_D("replace into `ve123_card_orders` values('2','17','SN100006-CXEG-BEIK-HULI','200','1317969947');");
E_D("replace into `ve123_card_orders` values('3','18','SN100003-TMBC-HSMY-QWAB','200','1317970118');");
E_D("replace into `ve123_card_orders` values('4','94','SN100007-MFQC-BFCM-YKVZ','200','1318095165');");

require("../../inc/footer.php");
?>