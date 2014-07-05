<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_zz_config`;");
E_C("CREATE TABLE `ve123_zz_config` (
  `config_id` int(11) NOT NULL auto_increment,
  `default_point` int(11) NOT NULL,
  `zs_points` mediumint(9) NOT NULL,
  `getpoints` mediumtext NOT NULL,
  PRIMARY KEY  (`config_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_zz_config` values('1','1','20','需要积分请联系客服，推广信息设置客服和图片请联系站长');");

require("../../inc/footer.php");
?>