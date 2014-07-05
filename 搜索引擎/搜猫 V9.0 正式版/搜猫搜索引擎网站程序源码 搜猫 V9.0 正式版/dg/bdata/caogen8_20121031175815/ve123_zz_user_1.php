<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_zz_user`;");
E_C("CREATE TABLE `ve123_zz_user` (
  `user_id` mediumint(9) NOT NULL auto_increment,
  `question` varchar(225) NOT NULL,
  `answer` varchar(225) NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `real_name` varchar(225) NOT NULL,
  `user_group` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `reg_ip` varchar(225) NOT NULL,
  `reg_time` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_zz_user` values('95','novagin','novagin','novagin','张小亮','0','20','0.00','709b589dcd7dc2e32088c2e3b59e494f','novagin@qq.com','119.187.14.233','1346696327');");
E_D("replace into `ve123_zz_user` values('96','我在哪里','我在这里','jinbo','阮金波','0','20','0.00','e10adc3949ba59abbe56e057f20f883e','web@hyzhiji.com','112.112.229.122','1346843793');");

require("../../inc/footer.php");
?>