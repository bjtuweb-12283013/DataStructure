<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `cy_set`;");
E_C("CREATE TABLE `cy_set` (
  `K` varchar(32) NOT NULL,
  `V` text NOT NULL,
  `T` enum('str','num','arr') NOT NULL default 'str',
  PRIMARY KEY  (`K`),
  KEY `T` (`T`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");
E_D("replace into `cy_set` values('site_name','cyask','str');");
E_D("replace into `cy_set` values('admin_email','admin@cyask.com','str');");
E_D("replace into `cy_set` values('meta_description','cyask最强问答程序','str');");
E_D("replace into `cy_set` values('meta_keywords','php问答系统，百度知道程序','str');");
E_D("replace into `cy_set` values('count_show_sort1','10','num');");
E_D("replace into `cy_set` values('count_show_sort2','5','num');");
E_D("replace into `cy_set` values('count_show_intro','5','num');");
E_D("replace into `cy_set` values('count_show_nosolve','8','num');");
E_D("replace into `cy_set` values('count_show_solve','8','num');");
E_D("replace into `cy_set` values('count_show_note','5','num');");
E_D("replace into `cy_set` values('count_ques_exceed','5','num');");
E_D("replace into `cy_set` values('count_ip_register','5','num');");
E_D("replace into `cy_set` values('score_answer','2','num');");
E_D("replace into `cy_set` values('score_adopt','5','num');");
E_D("replace into `cy_set` values('score_register','10','num');");
E_D("replace into `cy_set` values('overdue_days','15','num');");
E_D("replace into `cy_set` values('credit_item','a:2:{i:0;a:3:{s:2:\"id\";s:1:\"1\";s:5:\"title\";s:4:\"积分\";s:3:\"img\";s:0:\"\";}i:1;a:3:{s:2:\"id\";s:1:\"2\";s:5:\"title\";s:4:\"金钱\";s:3:\"img\";s:0:\"\";}}','arr');");
E_D("replace into `cy_set` values('credit_out','','arr');");

require("../../inc/footer.php");
?>