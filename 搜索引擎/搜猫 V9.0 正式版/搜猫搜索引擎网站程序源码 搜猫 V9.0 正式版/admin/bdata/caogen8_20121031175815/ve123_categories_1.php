<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ve123_categories`;");
E_C("CREATE TABLE `ve123_categories` (
  `cate_id` mediumint(9) NOT NULL auto_increment,
  `cate_title` varchar(200) NOT NULL,
  `cate_url` varchar(225) NOT NULL,
  `parent_id` mediumint(20) NOT NULL,
  `sort_id` mediumint(9) NOT NULL,
  PRIMARY KEY  (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=432 DEFAULT CHARSET=gbk");
E_D("replace into `ve123_categories` values('399','中国民歌','','373','0');");
E_D("replace into `ve123_categories` values('398','流行歌曲','','373','0');");
E_D("replace into `ve123_categories` values('397','综艺节目','','374','0');");
E_D("replace into `ve123_categories` values('396','笑话片','','374','0');");
E_D("replace into `ve123_categories` values('395','外国片','','374','0');");
E_D("replace into `ve123_categories` values('394','港台片','','374','0');");
E_D("replace into `ve123_categories` values('393','警匪片','','374','0');");
E_D("replace into `ve123_categories` values('392','悬疑片','','374','0');");
E_D("replace into `ve123_categories` values('391','伦理片','','374','0');");
E_D("replace into `ve123_categories` values('390','动作片','','374','0');");
E_D("replace into `ve123_categories` values('389','桌面游戏','','375','0');");
E_D("replace into `ve123_categories` values('388','益智游戏','','375','0');");
E_D("replace into `ve123_categories` values('387','小游戏','','375','0');");
E_D("replace into `ve123_categories` values('386','体育运动','','375','0');");
E_D("replace into `ve123_categories` values('385','网络游戏','','375','0');");
E_D("replace into `ve123_categories` values('384','PC游戏','','375','0');");
E_D("replace into `ve123_categories` values('383','单机游戏','','375','0');");
E_D("replace into `ve123_categories` values('382','文档下载','','376','0');");
E_D("replace into `ve123_categories` values('381','源码下载','','376','0');");
E_D("replace into `ve123_categories` values('380','小说下载','','376','0');");
E_D("replace into `ve123_categories` values('379','图片下载','','376','0');");
E_D("replace into `ve123_categories` values('378','游戏下载','','376','0');");
E_D("replace into `ve123_categories` values('377','软件下载','','376','0');");
E_D("replace into `ve123_categories` values('376','下载','','0','0');");
E_D("replace into `ve123_categories` values('375','游戏','','0','0');");
E_D("replace into `ve123_categories` values('374','电影','','0','0');");
E_D("replace into `ve123_categories` values('373','音乐','','0','0');");
E_D("replace into `ve123_categories` values('372','书籍','','0','0');");
E_D("replace into `ve123_categories` values('371','图片','','0','0');");
E_D("replace into `ve123_categories` values('370','软件','','0','0');");
E_D("replace into `ve123_categories` values('428','网络软件','','370','0');");
E_D("replace into `ve123_categories` values('427','3D动画','','370','0');");
E_D("replace into `ve123_categories` values('426','制图软件','','370','0');");
E_D("replace into `ve123_categories` values('425','播放软件','','370','0');");
E_D("replace into `ve123_categories` values('424','财会软件','','370','0');");
E_D("replace into `ve123_categories` values('423','银行软件','','370','0');");
E_D("replace into `ve123_categories` values('422','电脑软件','','370','0');");
E_D("replace into `ve123_categories` values('421','花鸟虫鱼','','371','0');");
E_D("replace into `ve123_categories` values('420','明星图片','','371','0');");
E_D("replace into `ve123_categories` values('419','影视图片','','371','0');");
E_D("replace into `ve123_categories` values('418','旅游风景','','371','0');");
E_D("replace into `ve123_categories` values('417','手机图片','','371','0');");
E_D("replace into `ve123_categories` values('416','汽车图片','','371','0');");
E_D("replace into `ve123_categories` values('415','美女图片','','371','0');");
E_D("replace into `ve123_categories` values('414','电脑桌面','','371','0');");
E_D("replace into `ve123_categories` values('413','美食烹饪','','372','0');");
E_D("replace into `ve123_categories` values('412','医学资料','','372','0');");
E_D("replace into `ve123_categories` values('411','农业生产','','372','0');");
E_D("replace into `ve123_categories` values('410','电脑网络','','372','0');");
E_D("replace into `ve123_categories` values('409','技术文献','','372','0');");
E_D("replace into `ve123_categories` values('408','社会生活','','372','0');");
E_D("replace into `ve123_categories` values('407','校园生活','','372','0');");
E_D("replace into `ve123_categories` values('406','色情小说','','372','0');");
E_D("replace into `ve123_categories` values('405','武侠小说','','372','0');");
E_D("replace into `ve123_categories` values('404','影视歌曲','','373','0');");
E_D("replace into `ve123_categories` values('403','革命歌曲','','373','0');");
E_D("replace into `ve123_categories` values('402','经典老歌','','373','0');");
E_D("replace into `ve123_categories` values('401','轻音乐','','373','0');");
E_D("replace into `ve123_categories` values('400','校园歌曲','','373','0');");
E_D("replace into `ve123_categories` values('429','行业','','0','0');");
E_D("replace into `ve123_categories` values('430','品牌','','429','0');");
E_D("replace into `ve123_categories` values('431','产品','','430','0');");

require("../../inc/footer.php");
?>