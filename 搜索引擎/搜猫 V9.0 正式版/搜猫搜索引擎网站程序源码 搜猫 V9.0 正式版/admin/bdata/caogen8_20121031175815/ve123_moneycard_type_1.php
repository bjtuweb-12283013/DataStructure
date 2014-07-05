<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_moneycard_type`;");
E_C("CREATE TABLE `ve123_moneycard_type` (
  `tid` int(11) NOT NULL auto_increment,
  `num` int(11) NOT NULL default '500',
  `money` int(11) NOT NULL default '50',
  `pname` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_moneycard_type` values('8','300','300','300µã¿¨');");
E_D("replace into `ve123_moneycard_type` values('6','100','100','100µã¿¨');");
E_D("replace into `ve123_moneycard_type` values('7','200','200','200µã¿¨');");

require("../../inc/footer.php");
?>