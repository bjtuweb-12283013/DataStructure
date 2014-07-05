-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1:3306
-- 生成日期: 2010 年 06 月 03 日 13:26
-- 服务器版本: 5.1.30
-- PHP 版本: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `soso`
--

-- --------------------------------------------------------

--
-- 表的结构 `ve123_about`
--

CREATE TABLE IF NOT EXISTS `ve123_about` (
  `about_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `content` mediumtext NOT NULL,
  `is_show` int(1) NOT NULL,
  `url` varchar(225) NOT NULL,
  `sortid` int(11) NOT NULL,
  PRIMARY KEY (`about_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `ve123_about`
--

INSERT INTO `ve123_about` (`about_id`, `title`, `filename`, `content`, `is_show`, `url`, `sortid`) VALUES
(1, '关于程序', 'zeidu', '本地数据,带蜘蛛程序.完全后台管理,操作方便.<br>\r\n<p>价格面议,联系QQ:22568190</p>\r\n\r\n搜猫搜索引擎主要功能:<br><br>\r\n\r\n可以对某个网址站一键收录全部网址.<br><br>\r\n\r\n也可以对某个网站进行深度收录.<br><br>\r\n\r\n自动更新网页.去死链.<br><br>\r\n\r\n如果别人做上本站的链接,系统自动收录.来的IP越多,排名越靠前<br><br>\r\n\r\n还有更多的功能,不一一列出<br><br>\r\n\r\n<a href="http://www.zeidu.com/top/" target="_blank">仿百度搜索风云榜</a><br><br>\r\n<a href="http://www.zeidu.com/site/" target="_blank">仿hao123网址导航</a><br><br>\r\n\r\n<br>\r\n搜猫搜索引擎程序不需要服务器的,一般的空间就可以运行了.很方便.', 1, '', 0),
(2, 'About Somao', 'AboutSomao', '<p>About soumao</p>\r\n<p><a href="http://127.0.0.1">soumao</a></p>\r\n<p>&nbsp;</p>', 1, '', 2),
(3, '最新收录', 'down', '', 1, 's/newsite.php', 0),
(4, '搜猫推广', 'somao', '', 1, 'tg/', 0),
(5, '搜索风云榜', 'ss', '', 1, 'top/', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_ad`
--

CREATE TABLE IF NOT EXISTS `ve123_ad` (
  `ad_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `sortid` mediumint(9) NOT NULL,
  `type` int(10) NOT NULL,
  `title` varchar(225) NOT NULL,
  `siteurl` varchar(225) NOT NULL,
  `content` mediumtext NOT NULL,
  `is_show` int(1) NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 导出表中的数据 `ve123_ad`
--

INSERT INTO `ve123_ad` (`ad_id`, `sortid`, `type`, `title`, `siteurl`, `content`, `is_show`) VALUES
(14, 0, 2, '仿百度搜索程序', 'http://soumao.uueasy.com', '仿百度搜索程序带蜘蛛 运行PHP+MYSQL，不是小偷程序，有独立数据库，可抓首页和内页，带竞价排名和关键词推广系统，源码全开源，每套80元，联系QQ：22568190', 1),
(9, 4, 3, '搜猫集成搜索', 'soso/', '', 1),
(10, 5, 3, '网址导航', 'site/', '网址导航', 1),
(11, 0, 1, '在搜狗搜索 {zeidu:keyword}', 'http://www.sogou.com/web?query={zeidu:keyword}', '', 1),
(12, 0, 1, '在谷歌搜索 {zeidu:keyword}', 'http://www.google.cn/search?q={zeidu:keyword}', '', 1),
(13, 0, 1, '在百度搜索 {zeidu:keyword}', 'http://www.baidu.com/s?wd={zeidu:keyword}', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_admin`
--

CREATE TABLE IF NOT EXISTS `ve123_admin` (
  `admin_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `adminname` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `logintime` int(10) NOT NULL,
  `lastlogintime` int(10) NOT NULL,
  `loginip` varchar(20) NOT NULL,
  `lastloginip` varchar(20) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `ve123_admin`
--

INSERT INTO `ve123_admin` (`admin_id`, `adminname`, `password`, `logintime`, `lastlogintime`, `loginip`, `lastloginip`) VALUES
(1, 'admin', 'admin', 2010, 2010, '127.0.0.1', '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `ve123_categories`
--

CREATE TABLE IF NOT EXISTS `ve123_categories` (
  `cate_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `cate_title` varchar(200) NOT NULL,
  `cate_url` varchar(225) NOT NULL,
  `parent_id` mediumint(20) NOT NULL,
  `sort_id` mediumint(9) NOT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=365 ;

--
-- 导出表中的数据 `ve123_categories`
--

INSERT INTO `ve123_categories` (`cate_id`, `cate_title`, `cate_url`, `parent_id`, `sort_id`) VALUES
(2, '常见疾病', '', 1, 0),
(3, '医院', '', 1, 0),
(4, '整形美容', '', 1, 0),
(5, '女性疾病', '', 1, 0),
(6, '男性疾病', '', 1, 0),
(7, '老年疾病', '', 1, 0),
(8, '保健', '', 1, 0),
(9, '药品', '', 1, 0),
(10, '健身', '', 1, 0),
(11, '节育', '', 1, 0),
(12, '心理健康', '', 1, 0),
(13, '健康咨询', '', 1, 0),
(14, '医疗器械', '', 1, 0),
(15, '名站', '', 0, 0),
(16, '学校', '', 15, 0),
(17, '培训', '', 15, 0),
(18, '考试', '', 15, 0),
(19, '外语', '', 15, 0),
(20, '留学', '', 15, 0),
(21, '专业课程', '', 15, 0),
(22, '课件', '', 15, 0),
(23, 'mba', '', 15, 0),
(24, '教育资料', '', 15, 0),
(25, '书籍', '', 15, 0),
(26, '翻译', '', 15, 0),
(27, '驾校', '', 15, 0),
(28, '家教', '', 15, 0),
(29, '人物', '', 0, 0),
(30, '手机', '', 29, 0),
(31, '电脑', '', 29, 0),
(32, '服饰', '', 29, 0),
(33, '化妆品', '', 29, 0),
(34, '成人用品', '', 29, 0),
(35, '礼品', '', 29, 0),
(36, '数码产品', '', 29, 0),
(37, '玩具', '', 29, 0),
(38, '家居用品', '', 29, 0),
(39, '书籍', '', 29, 0),
(40, '珠宝首饰', '', 29, 0),
(41, '影音', '', 29, 0),
(42, '家具', '', 29, 0),
(43, '办公用品', '', 29, 0),
(44, '虚拟物品', '', 29, 0),
(45, '文化用品', '', 29, 0),
(46, '体育用品', '', 29, 0),
(47, '商务', '', 0, 3),
(48, '招聘', '', 47, 0),
(49, '商机', '', 47, 0),
(50, '招商', '', 47, 0),
(51, '创业', '', 47, 0),
(52, '加盟', '', 47, 0),
(53, '投资', '', 47, 0),
(54, '会展', '', 47, 0),
(55, '网络服务', '', 47, 0),
(56, '物流', '', 47, 0),
(57, '机械', '', 47, 0),
(58, '财经', '', 47, 0),
(59, '电子商务', '', 47, 0),
(60, '化工', '', 47, 0),
(61, '求职', '', 47, 0),
(62, '兼职', '', 47, 0),
(63, '诺基亚', '', 30, 0),
(64, '三星', '', 30, 0),
(65, '索尼爱立信', '', 30, 0),
(66, '摩托罗拉', '', 30, 0),
(67, '联想', '', 30, 0),
(68, 'lg', '', 30, 0),
(69, '夏新', '', 30, 0),
(70, 'cect', '', 30, 0),
(71, '多普达', '', 30, 0),
(72, '金立', '', 30, 0),
(73, 'tcl', '', 30, 0),
(74, '波导', '', 30, 0),
(75, '康佳', '', 30, 0),
(76, '海尔', '', 30, 0),
(77, '科健', '', 30, 0),
(78, '二手手机', '', 30, 0),
(79, '手机配件', '', 30, 0),
(80, '电池', '', 30, 0),
(81, '蓝牙耳机', '', 30, 0),
(82, '笔记本', '', 31, 0),
(83, '品牌电脑', '', 31, 0),
(84, '掌上电脑', '', 31, 0),
(85, '电脑硬件', '', 31, 0),
(86, '软件', '', 31, 0),
(87, '网络设备', '', 31, 0),
(88, '电脑周边', '', 31, 0),
(89, '存储设备', '', 31, 0),
(90, '办公设备', '', 31, 0),
(91, '电子词典', '', 31, 0),
(92, '女装', '', 32, 0),
(93, '男装', '', 32, 0),
(94, '童装', '', 32, 0),
(95, '内衣', '', 32, 0),
(96, '衬衫', '', 32, 0),
(97, 't恤', '', 32, 0),
(98, '保安服', '', 32, 0),
(99, '情侣装', '', 32, 0),
(100, '休闲服', '', 32, 0),
(101, '运动服饰', '', 32, 0),
(102, '外贸服装', '', 32, 0),
(103, '牛仔服装', '', 32, 0),
(104, '舞台服装', '', 32, 0),
(105, '制服', '', 32, 0),
(106, '婚纱', '', 32, 0),
(107, '领带', '', 32, 0),
(108, '首饰', '', 32, 0),
(109, '箱包', '', 32, 0),
(110, '鞋', '', 32, 0),
(111, '帽', '', 32, 0),
(112, '服装面料', '', 32, 0),
(113, '服装加工', '', 32, 0),
(114, '服装批发', '', 32, 0),
(115, '少数民族服装', '', 32, 0),
(116, '中老年服装', '', 32, 0),
(117, '隆胸', '', 4, 0),
(118, '吸脂', '', 4, 0),
(119, '隆鼻', '', 4, 0),
(120, '双眼皮', '', 4, 0),
(121, '祛皱', '', 4, 0),
(122, 'spa', '', 4, 0),
(123, '减肥', '', 4, 0),
(124, '除皱', '', 4, 0),
(125, '男士美容', '', 4, 0),
(126, '妇科整形', '', 4, 0),
(127, '美容', '', 4, 0),
(128, '美容仪器', '', 4, 0),
(129, '光子嫩肤', '', 4, 0),
(130, '包皮环切', '', 4, 0),
(131, '美容学校', '', 4, 0),
(132, '韩国整形', '', 4, 0),
(133, '牙齿整形', '', 4, 0),
(134, '烧伤整形', '', 4, 0),
(135, '生殖器整形', '', 4, 0),
(136, '阴道炎', '', 5, 0),
(137, '子宫肌瘤', '', 5, 0),
(138, '不孕症', '', 5, 0),
(139, '盆腔炎', '', 5, 0),
(140, '宫颈糜烂', '', 5, 0),
(141, '无痛人流', '', 5, 0),
(142, '妇科', '', 5, 0),
(143, '痛经', '', 5, 0),
(144, '卵巢囊肿', '', 5, 0),
(145, '妇科炎症', '', 5, 0),
(146, '白带异常', '', 5, 0),
(147, '乳腺增生', '', 5, 0),
(148, '更年期综合症', '', 5, 0),
(149, '月经不调', '', 5, 0),
(150, '宫颈炎', '', 5, 0),
(151, '阴道干涩', '', 5, 0),
(152, '阴道分泌物', '', 5, 0),
(153, '阴道异味', '', 5, 0),
(154, '阴道撕裂', '', 5, 0),
(155, '处女膜修补', '', 5, 0),
(156, '人工授精', '', 5, 0),
(157, '前列腺炎', '', 6, 0),
(158, '前列腺增生', '', 6, 0),
(159, '性功能障碍', '', 6, 0),
(160, '阳痿', '', 6, 0),
(161, '阴茎弯曲', '', 6, 0),
(162, '早泄', '', 6, 0),
(163, '阴茎短小', '', 6, 0),
(164, '包皮包茎', '', 6, 0),
(165, '前列腺疾病', '', 6, 0),
(166, '膀胱炎', '', 6, 0),
(167, '静脉曲张', '', 6, 0),
(168, '阴囊炎', '', 6, 0),
(169, '隐睾', '', 6, 0),
(170, '不育症', '', 6, 0),
(171, '附睾炎', '', 6, 0),
(172, '龟头炎', '', 6, 0),
(173, '尿频尿急', '', 6, 0),
(174, '不射精', '', 6, 0),
(175, '阴茎癌', '', 6, 0),
(176, '肾囊肿', '', 6, 0),
(177, '肾虚肾亏', '', 6, 0),
(178, '阴囊潮湿', '', 6, 0),
(179, '阴茎流脓', '', 6, 0),
(180, '糖尿病', '', 7, 0),
(181, '耳聋', '', 7, 0),
(182, '高血压', '', 7, 0),
(183, '风湿', '', 7, 0),
(184, '高血脂', '', 7, 0),
(185, '偏瘫', '', 7, 0),
(186, '关节炎', '', 7, 0),
(187, '神经衰弱', '', 7, 0),
(188, '脑梗塞', '', 7, 0),
(189, '冠心病', '', 7, 0),
(190, '白内障', '', 7, 0),
(191, '老年痴呆症', '', 7, 0),
(192, '脑血栓', '', 7, 0),
(193, '骨质疏松', '', 7, 0),
(194, '动脉硬化', '', 7, 0),
(195, '心血管', '', 7, 0),
(196, '心肌梗塞', '', 7, 0),
(197, '慢性支气管炎', '', 7, 0),
(198, '老花眼', '', 7, 0),
(199, '保健品', '', 8, 0),
(200, '保健器材', '', 8, 0),
(201, '足疗', '', 8, 0),
(202, '足浴', '', 8, 0),
(203, '推拿按摩', '', 8, 0),
(204, '康复中心', '', 8, 0),
(205, '夫妻保健', '', 8, 0),
(206, '性保健', '', 8, 0),
(207, '医疗保健', '', 8, 0),
(208, '女性保健', '', 8, 0),
(209, '男性保健', '', 8, 0),
(210, '儿童保健', '', 8, 0),
(211, '中药', '', 9, 0),
(212, '西药', '', 9, 0),
(213, '避孕药', '', 9, 0),
(214, '保健药', '', 9, 0),
(215, '性药', '', 9, 0),
(216, '感冒药', '', 9, 0),
(217, '胃病药', '', 9, 0),
(218, '头痛药', '', 9, 0),
(219, '消炎药', '', 9, 0),
(220, '抗癌药', '', 9, 0),
(221, '壮阳药', '', 9, 0),
(222, '麻醉药', '', 9, 0),
(223, '处方药', '', 9, 0),
(224, '止痛药', '', 9, 0),
(225, '咳嗽药', '', 9, 0),
(226, '妇科药', '', 9, 0),
(227, '催眠药', '', 9, 0),
(228, '中成药', '', 9, 0),
(229, '腹泻药', '', 9, 0),
(230, '药材', '', 9, 0),
(231, '健康会所', '', 10, 0),
(232, '健身中心', '', 10, 0),
(233, '体育设施', '', 10, 0),
(234, '网球场', '', 10, 0),
(235, '瑜伽馆', '', 10, 0),
(236, '运动场', '', 10, 0),
(237, '游泳馆', '', 10, 0),
(238, '游泳池', '', 10, 0),
(239, '游泳', '', 10, 0),
(240, '健身房', '', 10, 0),
(241, '攀岩', '', 10, 0),
(242, '乒乓球', '', 10, 0),
(243, '羽毛球', '', 10, 0),
(244, '健身培训', '', 10, 0),
(245, '街舞培训', '', 10, 0),
(246, '体育运动', '', 10, 0),
(247, '拉丁舞培训', '', 10, 0),
(248, '爬山', '', 10, 0),
(249, '太极拳', '', 10, 0),
(250, '高尔夫球场', '', 10, 0),
(251, '健美操', '', 10, 0),
(252, '药流', '', 11, 0),
(253, '人流', '', 11, 0),
(254, '刮宫', '', 11, 0),
(255, '引产', '', 11, 0),
(256, '节育环', '', 11, 0),
(257, '节育手术', '', 11, 0),
(258, '节育措施', '', 11, 0),
(259, '避孕节育', '', 11, 0),
(260, '宫内节育器', '', 11, 0),
(261, '生活', '', 0, 0),
(262, '生活服务', '', 261, 0),
(263, '娱乐休闲', '', 261, 0),
(264, '天气', '', 262, 0),
(265, '彩票', '', 262, 0),
(266, '查询', '', 262, 0),
(267, '手机', '', 262, 0),
(268, '股票', '', 262, 0),
(269, '基金', '', 262, 0),
(270, '银行', '', 262, 0),
(271, '移动', '', 262, 0),
(272, '房产', '', 262, 0),
(273, '菜谱', '', 262, 0),
(274, '汽车', '', 262, 0),
(275, '地图', '', 262, 0),
(276, '健康', '', 262, 0),
(277, '两性', '', 262, 0),
(278, '女性', '', 262, 0),
(279, '时尚', '', 262, 0),
(280, '儿童', '', 262, 0),
(281, '电视', '', 262, 0),
(282, '旅游', '', 262, 0),
(283, '音乐', '', 263, 0),
(284, '视频', '', 263, 0),
(285, '游戏', '', 263, 0),
(286, '电影', '', 263, 0),
(287, '新闻', '', 263, 0),
(288, '小说', '', 263, 0),
(289, '军事', '', 263, 0),
(290, '图片', '', 263, 0),
(291, '动漫', '', 263, 0),
(292, '体育', '', 263, 0),
(293, '足球', '', 263, 0),
(294, 'NBA', '', 263, 0),
(295, '交友', '', 263, 0),
(296, '明星', '', 263, 0),
(297, '社区', '', 263, 0),
(298, '搞笑', '', 263, 0),
(299, '星座', '', 263, 0),
(300, '网游', '', 263, 0),
(301, '非主流', '', 263, 0),
(302, '旅游', '', 261, 0),
(303, '汽车', '', 261, 0),
(304, '宾馆', '', 302, 0),
(305, '酒店', '', 302, 0),
(306, '度假村', '', 302, 0),
(307, '本地景区', '', 302, 0),
(308, '著名景区', '', 302, 0),
(309, '旅游名城', '', 302, 0),
(310, '海外旅游', '', 302, 0),
(311, '旅行社', '', 302, 0),
(312, '导游', '', 302, 0),
(313, '自驾游', '', 302, 0),
(314, '公交路线', '', 302, 0),
(315, '签证', '', 302, 0),
(316, '票务', '', 302, 0),
(317, '租车', '', 302, 0),
(318, '天气预报', '', 302, 0),
(319, '地图', '', 302, 0),
(320, '汽车租赁', '', 303, 0),
(321, '汽车配件', '', 303, 0),
(322, '汽车维修', '', 303, 0),
(323, '汽车养护', '', 303, 0),
(324, '二手车', '', 303, 0),
(325, '汽车美容', '', 303, 0),
(326, '汽车装饰', '', 303, 0),
(327, '汽车报价', '', 303, 0),
(328, '特种车', '', 303, 0),
(329, '汽车俱乐部', '', 303, 0),
(330, '汽车救援', '', 303, 0),
(331, '驾校', '', 303, 0),
(332, '陪练', '', 303, 0),
(333, '停车场', '', 303, 0),
(334, '汽车网', '', 303, 0),
(335, '购物', '', 0, 0),
(336, '站长站', '', 335, 0),
(337, '站长论坛', '', 335, 0),
(338, '站长工具', '', 335, 0),
(339, '站长交易', '', 335, 0),
(340, '站长名录', '', 335, 0),
(341, '站长帮手', '', 335, 0),
(342, '站长下载', '', 335, 0),
(343, '站长资源', '', 335, 0),
(344, '站长统计', '', 335, 0),
(345, '站长联盟', '', 335, 0),
(346, '站长赚钱', '', 335, 0),
(356, '企业', '', 0, 0),
(348, '化工', '', 347, 0),
(349, '机械', '', 347, 0),
(350, '食品', '', 347, 0),
(351, '服装', '', 347, 0),
(352, '汽车', '', 347, 0),
(353, '电子', '', 347, 0),
(354, '数码', '', 347, 0),
(355, '网络', '', 347, 0),
(357, '化工', '', 356, 0),
(358, '服装', '', 356, 0),
(359, '食品', '', 356, 0),
(360, '广告', '', 356, 0),
(361, '文具', '', 356, 0),
(362, '家具', '', 356, 0),
(363, '电子', '', 356, 0),
(364, '机械', '', 356, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_dh_class`
--

CREATE TABLE IF NOT EXISTS `ve123_dh_class` (
  `class_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `sort_id` mediumint(9) NOT NULL,
  `classname` varchar(225) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- 导出表中的数据 `ve123_dh_class`
--

INSERT INTO `ve123_dh_class` (`class_id`, `sort_id`, `classname`, `type_id`) VALUES
(1, 0, '小说', 1),
(2, 0, '游戏', 1),
(3, 0, '软件', 1),
(4, 0, '军事', 1),
(5, 0, '音乐', 1),
(6, 0, '邮箱', 1),
(7, 0, '视频', 1),
(8, 0, '闪游', 1),
(9, 0, '新闻', 1),
(10, 0, '社区', 1),
(11, 0, '财经', 1),
(12, 0, '交友', 1),
(13, 0, '硬件', 1),
(14, 0, '博客', 1),
(15, 0, '银行', 1),
(16, 0, '体育', 1),
(17, 0, '购物', 1),
(18, 0, '手机', 1),
(19, 0, '招聘', 1),
(20, 0, '汽车', 1),
(21, 0, '酷站', 1),
(22, 0, '生活', 1),
(23, 0, '实用查询', 2),
(24, 0, '常用软件', 2),
(25, 0, '游戏专区', 2);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_dh_goodlinks`
--

CREATE TABLE IF NOT EXISTS `ve123_dh_goodlinks` (
  `link_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `url` varchar(225) NOT NULL,
  `sort_id` mediumint(9) NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- 导出表中的数据 `ve123_dh_goodlinks`
--

INSERT INTO `ve123_dh_goodlinks` (`link_id`, `title`, `url`, `sort_id`) VALUES
(1, '新　浪', 'http://www.sina.com.cn', 0),
(2, '腾　讯', 'http://www.qq.com', 0),
(3, '搜　狐', 'http://www.sohu.com', 0),
(4, '网　易', 'http://www.163.com/', 0),
(5, '凤 凰 网', 'http://www.ifeng.com/', 0),
(6, '央 视 网', 'http://www.cctv.com/', 0),
(7, '新 华 网', 'http://www.xinhuanet.com/', 0),
(8, '人 民 网', 'http://www.people.com.cn/', 0),
(9, 'MSN中文网', 'http://cn.msn.com/', 0),
(10, '中国雅虎', 'http://cn.yahoo.com/', 0),
(11, '中国移动', 'http://www.chinamobile.com/', 0),
(12, '太平洋电脑网', 'http://www.pconline.com.cn/', 0),
(13, '中华英才网', 'http://www.chinahr.com/', 0),
(14, '中国政府网', 'http://www.gov.cn/', 0),
(15, '中 彩 网', 'http://www.zhcw.com', 0),
(16, '汽车之家', 'http://www.autohome.com.cn/', 0),
(17, '天天基金', 'http://fund.eastmoney.com/', 0),
(18, '东方财富', 'http://www.eastmoney.com/', 0),
(19, '校 内 网', 'http://www.xiaonei.com/', 0),
(20, '瑞星杀毒', 'http://www.rising.cn/', 0),
(21, '51个人空间', 'http://www.51.com/', 0),
(22, '百度有啊', 'http://youa.baidu.com/', 0),
(23, '百 姓 网', 'http://www.baixing.com/', 0),
(24, '360安全卫士', 'http://www.360.cn/', 0),
(25, '携程旅行网', 'http://www.ctrip.com/', 0),
(26, '爱卡汽车网', 'http://www.xcar.com.cn/', 0),
(27, '诺 基 亚', 'http://www.nokia.com.cn/', 0),
(28, '中关村在线', 'http://www.zol.com.cn/', 0),
(29, '淘 宝 网', 'http://www.taobao.com/', 0),
(30, '工商银行', 'http://www.icbc.com.cn/', 0),
(31, '迅　雷', 'http://www.xunlei.com/', 0),
(32, '飞　信', 'http://www.fetion.com.cn/', 0),
(33, '丁 丁 网', 'http://www.ddmap.com/', 0),
(34, '安居客房产网', 'http://www.anjuke.com/', 0),
(35, '<font color=red>搜猫搜索</font>', 'http://www.somao123.com/', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_dh_links`
--

CREATE TABLE IF NOT EXISTS `ve123_dh_links` (
  `link_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `url` varchar(225) NOT NULL,
  `class_id` mediumint(9) NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `ve123_dh_links`
--

INSERT INTO `ve123_dh_links` (`link_id`, `title`, `url`, `class_id`) VALUES
(1, '天气预报', 'http;//www.ip138.com', 23),
(2, '查IP', 'http;//www.ip138.com', 23);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_dh_siteconfig`
--

CREATE TABLE IF NOT EXISTS `ve123_dh_siteconfig` (
  `sid` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `user_agent` varchar(200) NOT NULL,
  `url` varchar(225) NOT NULL,
  `searchcode` mediumtext NOT NULL,
  `adtitle` varchar(225) NOT NULL,
  `icp` varchar(100) NOT NULL,
  `statcode` mediumtext NOT NULL,
  `copyright` mediumtext NOT NULL,
  `status_content` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `keywords` mediumtext NOT NULL,
  `telephone` varchar(225) NOT NULL,
  `qq` varchar(225) NOT NULL,
  `notice` mediumtext NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `ve123_dh_siteconfig`
--

INSERT INTO `ve123_dh_siteconfig` (`sid`, `name`, `user_agent`, `url`, `searchcode`, `adtitle`, `icp`, `statcode`, `copyright`, `status_content`, `description`, `keywords`, `telephone`, `qq`, `notice`) VALUES
(1, '搜猫网址之家', '', '', '', '--实用网址,搜索大全', '', '', 'Copyright 2002-2004 版权所有 soumao', '搜猫网址之家——最专业权威的上网导航', '搜猫网址之家——最专业权威的上网导航。及时收录包括音乐、视频、小说、游戏等热门分类的优秀网站，与搜索完美结合，提供最简单便捷的网上导航服务，是数千万网民的上网主页。精彩网络生活，从搜猫开始。', '最专业权威的上网导航', '13838250541', '22568190', '网站导航开通啦.(搜索引擎,搜索风云榜,网址导航..全部出售.联系QQ:22568190)');

-- --------------------------------------------------------

--
-- 表的结构 `ve123_guestbook`
--

CREATE TABLE IF NOT EXISTS `ve123_guestbook` (
  `gid` mediumint(9) NOT NULL AUTO_INCREMENT,
  `replyid` mediumint(9) NOT NULL,
  `title` varchar(225) NOT NULL,
  `content` mediumtext NOT NULL,
  `fileurl` varchar(225) NOT NULL,
  `addtime` int(10) NOT NULL,
  `reply_time` int(10) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `reply_count` mediumint(9) NOT NULL,
  `click_count` mediumint(9) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 导出表中的数据 `ve123_guestbook`
--

INSERT INTO `ve123_guestbook` (`gid`, `replyid`, `title`, `content`, `fileurl`, `addtime`, `reply_time`, `ip`, `reply_count`, `click_count`) VALUES
(2, 1, '支持..........', '支持..........', '', 1244539190, 0, '127.0.0.1', 0, 0),
(3, 1, '重要通知', '重要通知', '', 1244712744, 0, '123.190.71.129', 0, 0),
(4, 95, '申请收录', '网站\r\nhttp://www.001la.cn\r\n\r\n\r\n001啦学生联盟', '', 1244960235, 0, '218.22.44.50', 0, 0),
(5, 95, '申请收录', ' http://www.yshuo.cn 易说求职\r\n求职与面试经验分享', '', 1244960390, 0, '121.8.72.130', 0, 0),
(7, 95, '收录申请', '西部114\r\n\r\nhttp://www.xibu114.com', '', 1245127311, 0, '121.34.170.81', 0, 0),
(8, 6, '顶一下', '顶一下', '', 1245231097, 0, '58.248.169.15', 0, 0),
(11, 9, '请联系QQ:137738233', '请联系QQ:137738233', 'http://www.zeidu.com/images/logo.gif', 1246084014, 0, '58.248.169.15', 0, 0),
(10, 6, '晕到了', '晕到了', '', 1245924306, 0, '114.96.53.31', 0, 0),
(13, 12, '不用做太多花哨的东西啊.把网页这块做好,就OK了.', '不用做太多花哨的东西啊.\r\n把网页这块做好,就OK了.', '', 1246115859, 0, '58.248.169.15', 0, 0),
(15, 6, 'www.GoogleKe.com', 'http://www.googleke.com', '', 1246380589, 0, '118.119.65.173', 0, 0),
(20, 6, 'sdddddddd', 'ddsddddddddddddddd', '', 1248970202, 0, '124.192.39.197', 0, 0),
(19, 95, 'www.heidu.com 想合作了找我', '呵呵，垃圾也来做个合作\r\n这个域名不错\r\n想合作了找我\r\n\r\n黑度-www.Heidu.com\r\n就是【百度】的反义词\r\nhttp://www.heidu.com\r\n欢迎大家访问！\r\n如果您觉得实用，请设为主页！\r\n有任何想法及反馈请登录网站留言页面。\r\n谢谢！\r\nhttp://www.heidu.com', '', 1246963729, 0, '120.8.84.90', 0, 0),
(22, 14, '回复1：多少钱啊', '200元一份', '', 1252296137, 0, '192.168.1.2', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_links`
--

CREATE TABLE IF NOT EXISTS `ve123_links` (
  `link_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `tuiguang` int(11) NOT NULL,
  `site_id` mediumint(9) NOT NULL,
  `url` varchar(225) NOT NULL,
  `keywords` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `fulltxt` mediumtext NOT NULL,
  `pagesize` float NOT NULL,
  `level` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=523 ;

--
-- 导出表中的数据 `ve123_links`
--

INSERT INTO `ve123_links` (`link_id`, `title`, `tuiguang`, `site_id`, `url`, `keywords`, `description`, `fulltxt`, `pagesize`, `level`, `updatetime`) VALUES
(337, '', 0, 4, 'http://www.hotels-london.co.uk/the-goring.hotel', '', '', '', 0, 1, 0),
(338, '', 0, 4, 'http://www.hotels-london.co.uk/street-map.php', '', '', '', 0, 1, 0),
(339, '', 0, 4, 'http://www.hotels-london.co.uk/st-james-hotel-and-club.hotel', '', '', '', 0, 1, 0),
(340, '', 0, 4, 'http://www.hotels-london.co.uk/sofitel-st-james-london.hotel', '', '', '', 0, 1, 0),
(341, '', 0, 4, 'http://www.hotels-london.co.uk/shaftesbury-metropolis.hotel', '', '', '', 0, 1, 0),
(342, '', 0, 4, 'http://www.hotels-london.co.uk/rydges-kensington-plaza.hotel', '', '', '', 0, 1, 0),
(343, '', 0, 4, 'http://www.hotels-london.co.uk/park-plaza-sherlock-holmes.hotel', '', '', '', 0, 1, 0),
(344, '', 0, 4, 'http://www.hotels-london.co.uk/millennium-mayfair.hotel', '', '', '', 0, 1, 0),
(345, '', 0, 4, 'http://www.hotels-london.co.uk/mayflower.hotel', '', '', '', 0, 1, 0),
(346, '', 0, 4, 'http://www.hotels-london.co.uk/london_weather_forecast.php', '', '', '', 0, 1, 0),
(347, '', 0, 4, 'http://www.hotels-london.co.uk/linden-house.hotel', '', '', '', 0, 1, 0),
(348, '', 0, 4, 'http://www.hotels-london.co.uk/lb-resources.php', '', '', '', 0, 1, 0),
(349, '', 0, 4, 'http://www.hotels-london.co.uk/hyde-park-premier.hotel', '', '', '', 0, 1, 0),
(350, '', 0, 4, 'http://www.hotels-london.co.uk/hotel-lily-earls-court-a-budget.hotel', '', '', '', 0, 1, 0),
(351, '', 0, 4, 'http://www.hotels-london.co.uk/hotel-41.hotel', '', '', '', 0, 1, 0),
(352, '', 0, 4, 'http://www.hotels-london.co.uk/gresham.hotel', '', '', '', 0, 1, 0),
(353, '', 0, 4, 'http://www.hotels-london.co.uk/find.php', '', '', '', 0, 1, 0),
(354, '', 0, 4, 'http://www.hotels-london.co.uk/faq.php', '', '', '', 0, 1, 0),
(355, '', 0, 4, 'http://www.hotels-london.co.uk/dockland-apartments.hotel', '', '', '', 0, 1, 0),
(356, '', 0, 4, 'http://www.hotels-london.co.uk/crowne-plaza-london-kensington.hotel', '', '', '', 0, 1, 0),
(357, '', 0, 4, 'http://www.hotels-london.co.uk/corus-hotel-hyde-park.hotel', '', '', '', 0, 1, 0),
(358, '', 0, 4, 'http://www.hotels-london.co.uk/collingham-apartments.hotel', '', '', '', 0, 1, 0),
(359, '', 0, 4, 'http://www.hotels-london.co.uk/city-inn-westminster.hotel', '', '', '', 0, 1, 0),
(360, '', 0, 4, 'http://www.hotels-london.co.uk/church-street.hotel', '', '', '', 0, 1, 0),
(377, '', 0, 4, 'http://london_events.hotels-london.co.uk/news.php', '', '', '', 0, 1, 1252573245),
(387, '', 0, 4, 'http://hip.hotels-london.co.uk/sanderson.hotel', '', '', '', 0, 1, 0),
(388, '', 0, 4, 'http://hip.hotels-london.co.uk/one-aldwych.hotel', '', '', '', 0, 1, 0),
(389, '', 0, 4, 'http://hip.hotels-london.co.uk/haymarket.hotel', '', '', '', 0, 1, 0),
(390, '', 0, 4, 'http://hip.hotels-london.co.uk', '', '', '', 0, 1, 0),
(391, '', 0, 4, 'http://five-star.hotels-london.co.uk', '', '', '', 0, 1, 0),
(392, '', 0, 4, 'http://entertainment.hotels-london.co.uk/lb-entertainment.php', '', '', '', 0, 1, 0),
(393, '', 0, 4, 'http://discount.hotels-london.co.uk', '', '', '', 0, 1, 0),
(394, '', 0, 4, 'http://corporate.hotels-london.co.uk', '', '', '', 0, 1, 0),
(395, '', 0, 4, 'http://cheap.hotels-london.co.uk', '', '', '', 0, 1, 0),
(396, '', 0, 4, 'http://budget.hotels-london.co.uk', '', '', '', 0, 1, 0),
(397, '', 0, 4, 'http://boutique.hotels-london.co.uk', '', '', '', 0, 1, 0),
(398, '', 0, 4, 'http://apartments.hotels-london.co.uk', '', '', '', 0, 1, 0),
(399, '', 0, 4, 'http://airport.hotels-london.co.uk', '', '', '', 0, 1, 0),
(400, '', 0, 23, 'http://www.hotels-london.co.uk/thistle-london-heathrow.hotel', '', '', '', 0, 1, 0),
(401, '', 0, 23, 'http://www.hotels-london.co.uk/sofitel-london-gatwick.hotel', '', '', '', 0, 1, 0),
(402, '', 0, 23, 'http://www.hotels-london.co.uk/sofitel-heathrow.hotel', '', '', '', 0, 1, 0),
(403, '', 0, 23, 'http://www.hotels-london.co.uk/sheraton-skyline.hotel', '', '', '', 0, 1, 0),
(404, '', 0, 23, 'http://www.hotels-london.co.uk/sheraton-skyline-hotel-and-conference-centre.hotel', '', '', '', 0, 1, 0),
(405, '', 0, 23, 'http://www.hotels-london.co.uk/sheraton-heathrow.hotel', '', '', '', 0, 1, 0),
(406, '', 0, 23, 'http://www.hotels-london.co.uk/radisson-edwardian-heathrow.hotel', '', '', '', 0, 1, 0),
(407, '', 0, 23, 'http://www.hotels-london.co.uk/park-inn-heathrow-london.hotel', '', '', '', 0, 1, 0),
(408, '', 0, 23, 'http://www.hotels-london.co.uk/novotel-london-excel.hotel', '', '', '', 0, 1, 0),
(409, '', 0, 23, 'http://www.hotels-london.co.uk/hotels_map.php?hotel_ids=215,414,417,524,542,575,578,607,629,633,959', '', '', '', 0, 1, 0),
(410, '', 0, 23, 'http://www.hotels-london.co.uk/hazel-wood.hotel', '', '', '', 0, 1, 0),
(411, '', 0, 23, 'http://www.hotels-london.co.uk/custom-house.hotel', '', '', '', 0, 1, 0),
(412, '', 0, 23, 'http://www.hotels-london.co.uk/crowne-plaza-docklands.hotel', '', '', '', 0, 1, 0),
(413, '', 0, 23, 'http://last-minute.hotels-london.co.uk/browse.php', '', '', '', 0, 1, 0),
(414, '', 0, 23, 'http://entertainment.hotels-london.co.uk/show_browse.php', '', '', '', 0, 1, 0),
(415, '', 0, 23, 'http://entertainment.hotels-london.co.uk/restaurants.php', '', '', '', 0, 1, 0),
(416, '', 0, 23, 'http://entertainment.hotels-london.co.uk/news.php', '', '', '', 0, 1, 0),
(417, '', 0, 23, 'http://airport.hotels-london.co.uk/?range=Airport&sort=stars', '', '', '', 0, 1, 0),
(418, '', 0, 23, 'http://airport.hotels-london.co.uk/?range=Airport&sort=price', '', '', '', 0, 1, 0),
(419, '', 0, 23, 'http://airport.hotels-london.co.uk/?range=Airport&sort=location', '', '', '', 0, 1, 0),
(420, '', 0, 23, 'http://airport.hotels-london.co.uk/?range=Airport&full=1', '', '', '', 0, 1, 0),
(421, '', 0, 23, 'http://airport.hotels-london.co.uk/?range=Airport', '', '', '', 0, 1, 0),
(422, '', 0, 22, 'http://www.hotels-london.co.uk/zenith-apartments-by-bridgestreet-worldwide.hotel', '', '', '', 0, 1, 0),
(423, '', 0, 22, 'http://www.hotels-london.co.uk/vancouver-studios.hotel', '', '', '', 0, 1, 0),
(424, '', 0, 22, 'http://www.hotels-london.co.uk/think-bermondsey-street.hotel', '', '', '', 0, 1, 0),
(425, '', 0, 22, 'http://www.hotels-london.co.uk/the-milestone.hotel', '', '', '', 0, 1, 0),
(426, '', 0, 22, 'http://www.hotels-london.co.uk/the-london-carlton.hotel', '', '', '', 0, 1, 0),
(427, '', 0, 22, 'http://www.hotels-london.co.uk/the-kings-wardrobe-apartments.hotel', '', '', '', 0, 1, 0),
(428, '', 0, 22, 'http://www.hotels-london.co.uk/the-hyde-park.hotel', '', '', '', 0, 1, 0),
(429, '', 0, 22, 'http://www.hotels-london.co.uk/the-grainstore-apartments.hotel', '', '', '', 0, 1, 0),
(430, '', 0, 22, 'http://www.hotels-london.co.uk/the-collingham-apartments.hotel', '', '', '', 0, 1, 0),
(431, '', 0, 22, 'http://www.hotels-london.co.uk/the-cleveland-square.hotel', '', '', '', 0, 1, 0),
(432, '', 0, 22, 'http://www.hotels-london.co.uk/the-capital.hotel', '', '', '', 0, 1, 0),
(433, '', 0, 22, 'http://www.hotels-london.co.uk/the-athenaeum.hotel', '', '', '', 0, 1, 0),
(434, '', 0, 22, 'http://www.hotels-london.co.uk/space-apart.hotel', '', '', '', 0, 1, 0),
(435, '', 0, 22, 'http://www.hotels-london.co.uk/so-sienna.hotel', '', '', '', 0, 1, 0),
(436, '', 0, 22, 'http://www.hotels-london.co.uk/so-quartier.hotel', '', '', '', 0, 1, 0),
(437, '', 0, 22, 'http://www.hotels-london.co.uk/saco-london-holborn.hotel', '', '', '', 0, 1, 0),
(438, '', 0, 22, 'http://www.hotels-london.co.uk/saco-london-docklands.hotel', '', '', '', 0, 1, 0),
(439, '', 0, 22, 'http://www.hotels-london.co.uk/saco-london-covent-garden.hotel', '', '', '', 0, 1, 0),
(440, '', 0, 22, 'http://www.hotels-london.co.uk/royal-court-apartments.hotel', '', '', '', 0, 1, 0),
(441, '', 0, 22, 'http://www.hotels-london.co.uk/princes-square-by-bridgestreet-worldwide.hotel', '', '', '', 0, 1, 0),
(442, '', 0, 22, 'http://www.hotels-london.co.uk/plaza-on-the-river.hotel', '', '', '', 0, 1, 0),
(443, '', 0, 22, 'http://www.hotels-london.co.uk/mount-mansions.hotel', '', '', '', 0, 1, 0),
(444, '', 0, 22, 'http://www.hotels-london.co.uk/marlin-apartments-tower-bridge.hotel', '', '', '', 0, 1, 0),
(445, '', 0, 22, 'http://www.hotels-london.co.uk/marlin-apartments-stratford.hotel', '', '', '', 0, 1, 0),
(446, '', 0, 22, 'http://www.hotels-london.co.uk/marlin-apartments-queen-street.hotel', '', '', '', 0, 1, 0),
(447, '', 0, 22, 'http://www.hotels-london.co.uk/marlin-apartments-empire-square-london-bridge.hotel', '', '', '', 0, 1, 0),
(448, '', 0, 22, 'http://www.hotels-london.co.uk/marlin-apartments-city-docklands.hotel', '', '', '', 0, 1, 0),
(449, '', 0, 22, 'http://www.hotels-london.co.uk/marlin-apartments-canary-wharf.hotel', '', '', '', 0, 1, 0),
(450, '', 0, 22, 'http://www.hotels-london.co.uk/market-view-apartments-by-bridgestreet-worldwide.hotel', '', '', '', 0, 1, 0),
(451, '', 0, 22, 'http://www.hotels-london.co.uk/london-bridge.hotel', '', '', '', 0, 1, 0),
(452, '', 0, 22, 'http://www.hotels-london.co.uk/lanesra-apartments-canary-central.hotel', '', '', '', 0, 1, 0),
(453, '', 0, 22, 'http://www.hotels-london.co.uk/hyde-park-suites-lancaster-gate.hotel', '', '', '', 0, 1, 0),
(454, '', 0, 22, 'http://www.hotels-london.co.uk/hyde-park-suites-executive.hotel', '', '', '', 0, 1, 0),
(455, '', 0, 22, 'http://www.hotels-london.co.uk/hotels_map.php?hotel_ids=11,41,64,90,95,198,370,400,412,416,453,465,526,527,532,533,534,539,547,552,560,611,612,639,690,698,699,702,713,714,718,721,722,723,725,726,727,728,729,731,733,746,747,76', '', '', '', 0, 1, 0),
(456, '', 0, 22, 'http://www.hotels-london.co.uk/harrington-court.hotel', '', '', '', 0, 1, 0),
(457, '', 0, 22, 'http://www.hotels-london.co.uk/grand-plaza-apartments.hotel', '', '', '', 0, 1, 0),
(458, '', 0, 22, 'http://www.hotels-london.co.uk/fraser-place-canary-wharf.hotel', '', '', '', 0, 1, 0),
(459, '', 0, 22, 'http://www.hotels-london.co.uk/durley-house.hotel', '', '', '', 0, 1, 0),
(460, '', 0, 22, 'http://www.hotels-london.co.uk/dolphin-house.hotel', '', '', '', 0, 1, 0),
(461, '', 0, 22, 'http://www.hotels-london.co.uk/curzon-plaza-mayfair.hotel', '', '', '', 0, 1, 0),
(462, '', 0, 22, 'http://www.hotels-london.co.uk/corona-apartments-by-bridgestreet-worldwide.hotel', '', '', '', 0, 1, 0),
(463, '', 0, 22, 'http://www.hotels-london.co.uk/citadines-aparthotel-trafalgar-square.hotel', '', '', '', 0, 1, 0),
(464, '', 0, 22, 'http://www.hotels-london.co.uk/citadines-aparthotel-holborn.hotel', '', '', '', 0, 1, 0),
(518, '', 0, 0, 'http://www.rising.cn', '', '', '', 0, 0, 0),
(519, '', 0, 0, 'http://www.redbaby.com.cn', '', '', '', 0, 0, 0),
(483, '', 0, 0, 'http://zhidao.baidu.com', '', '', '', 0, 0, 0),
(484, '', 0, 0, 'http://youxi.baidu.com', '', '', '', 0, 0, 0),
(485, '', 0, 0, 'http://youa.baidu.com', '', '', '', 0, 0, 0),
(481, '', 0, 0, 'http://zt.ztgame.com', '', '', '', 0, 0, 0),
(482, '', 0, 0, 'http://zhuxian.wanmei.com', '', '', '', 0, 0, 0),
(486, '', 0, 0, 'http://xiazai.zol.com.cn', '', '', '', 0, 0, 0),
(487, '', 0, 0, 'http://xiaoyou.qq.com', '', '', '', 0, 0, 0),
(488, '', 0, 0, 'http://x5.qq.com', '', '', '', 0, 0, 0),
(489, '', 0, 0, 'http://www.zol.com.cn', '', '', '', 0, 0, 0),
(490, '', 0, 0, 'http://www.zhulang.com', '', '', '', 0, 0, 0),
(491, '', 0, 0, 'http://www.zhenai.com', '', '', '', 0, 0, 0),
(492, '', 0, 0, 'http://www.zhcw.com', '', '', '', 0, 0, 0),
(493, '', 0, 0, 'http://www.zhaopin.com', '', '', '', 0, 0, 0),
(494, '', 0, 0, 'http://www.zaobao.com', '', '', '', 0, 0, 0),
(495, '', 0, 0, 'http://www.youku.com', '', '', '', 0, 0, 0),
(496, '', 0, 0, 'http://www.yesky.com', '', '', '', 0, 0, 0),
(497, '', 0, 0, 'http://www.xxsy.net', '', '', '', 0, 0, 0),
(498, '', 0, 0, 'http://www.xunlei.com', '', '', '', 0, 0, 0),
(499, '', 0, 0, 'http://www.xs8.cn', '', '', '', 0, 0, 0),
(500, '', 0, 0, 'http://www.xinhuanet.com', '', '', '', 0, 0, 0),
(501, '', 0, 0, 'http://www.xiaonei.com', '', '', '', 0, 0, 0),
(502, '', 0, 0, 'http://www.xcar.com.cn', '', '', '', 0, 0, 0),
(503, '', 0, 0, 'http://www.weather.com.cn', '', '', '', 0, 0, 0),
(504, '', 0, 0, 'http://www.vancl.com', '', '', '', 0, 0, 0),
(505, '', 0, 0, 'http://www.uwan.com', '', '', '', 0, 0, 0),
(506, '', 0, 0, 'http://www.uusee.com', '', '', '', 0, 0, 0),
(507, '', 0, 0, 'http://www.tudou.com', '', '', '', 0, 0, 0),
(508, '', 0, 0, 'http://www.togj.com', '', '', '', 0, 0, 0),
(509, '', 0, 0, 'http://www.titan24.com', '', '', '', 0, 0, 0),
(510, '', 0, 0, 'http://www.tiexue.net', '', '', '', 0, 0, 0),
(511, '', 0, 0, 'http://www.tianya.cn', '', '', '', 0, 0, 0),
(512, '', 0, 0, 'http://www.taobao.com', '', '', '', 0, 0, 0),
(513, '', 0, 0, 'http://www.soufun.com', '', '', '', 0, 0, 0),
(514, '', 0, 0, 'http://www.sohu.com', '', '', '', 0, 0, 0),
(515, '', 0, 0, 'http://www.skycn.com', '', '', '', 0, 0, 0),
(516, '', 0, 0, 'http://www.sina.com.cn', '', '', '', 0, 0, 0),
(517, '', 0, 0, 'http://www.shumenol.com', '', '', '', 0, 0, 0),
(520, '', 0, 0, 'http://www.readnovel.com', '', '', '', 0, 0, 0),
(521, '', 0, 0, 'http://www.rayli.com.cn', '', '', '', 0, 0, 0),
(522, '搜猫搜索引擎 - 官方网站 |搜猫|搜猫搜索引擎|仿百度搜索引擎|搜猫搜索|搜猫5.0|搜猫5.1|搜猫5.5|搜猫6.0|搜猫7.0|', 0, 0, 'http://www.somao123.com', '搜猫 搜猫搜索引擎 仿百度搜索引擎 搜猫搜索 搜猫5.0 搜猫5.1 搜猫5.5 搜猫6.0 搜猫7.0 仿谷歌搜索引擎 仿搜狗搜索引擎 仿有道搜索引擎 仿google搜索引擎 仿115搜索引擎 仿谷姐搜索引擎 聚合搜索引擎', '搜猫搜索是一家专业制作搜索引擎的公司团队,有六年制作搜索引擎的经验,深受客户的青睐。请认准搜猫唯一销售QQ：22568190（谨防上当受骗）', ' 设为首页 加入收藏 站内搜索 今天是: 搜猫首页 新闻动态 产品发布 下载中心 成功案例 会员中心 留言中心 关于我们 公司简介 更多&gt;&gt; 搜猫是2004年8月3日推出的全国首家制作中文搜索引擎源码的团队。搜猫以制作搜索引擎为核心，致力于为客户提供搜索源动力，帮助中国上亿网民都可以拥有一个自己的搜索引擎，以辅助用户创造价值。 搜猫旗下产品线包括：仿百度搜索引擎,仿谷歌搜索引擎,仿搜狗搜索引擎,仿有道搜索引擎,仿google搜索引擎,仿115搜索引擎,仿谷姐搜索引擎,聚合搜索引擎。 搜猫网页搜索作为搜猫最核心的产品，经过两年半持续不断地优化改进...... 新闻中心 更多&gt;&gt; ·搜猫搜索引擎7.0最新版已经正式 (2010-4-3 13:55:34) ·搜猫搜索引擎制作团队成员 (2010-4-3 12:23:52) ·搜索引擎的使用方法以及其识别 (2010-4-3 12:23:17) ·【购买搜猫搜索程序流程详解】 (2010-4-3 12:22:22) ·百度停止收录的原因分析及解决 (2010-4-3 12:22:02) ·搜猫程序的一路', 26, 0, 1275570736);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_links_temp`
--

CREATE TABLE IF NOT EXISTS `ve123_links_temp` (
  `temp_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `url` varchar(225) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`temp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1048 ;

--
-- 导出表中的数据 `ve123_links_temp`
--

INSERT INTO `ve123_links_temp` (`temp_id`, `url`, `updatetime`) VALUES
(1047, 'http://www.hotels-london.co.uk/5-maddox-street.hotel', 0),
(1046, 'http://www.hotels-london.co.uk/amsterdam.hotel', 0),
(1045, 'http://www.hotels-london.co.uk/apart-hotel-73.hotel', 0),
(1044, 'http://www.hotels-london.co.uk/atelier-ec1-by-bridgestreet-worldwide.hotel', 0),
(1043, 'http://www.hotels-london.co.uk/avni-kensington.hotel', 0),
(1042, 'http://www.hotels-london.co.uk/base2stay.hotel', 0),
(1041, 'http://www.hotels-london.co.uk/beaufort-house-luxury-apartments.hotel', 0),
(1040, 'http://www.hotels-london.co.uk/best-western-john-howard.hotel', 0),
(1039, 'http://www.hotels-london.co.uk/canary-central-by-bridgestreet-worldwide.hotel', 0),
(1038, 'http://www.hotels-london.co.uk/canary-south-by-bridgestreet-worldwide.hotel', 0),
(1037, 'http://www.hotels-london.co.uk/canary-wharf-serviced-apartments-by-portland.hotel', 0),
(1036, 'http://www.hotels-london.co.uk/castletown-perham-house.hotel', 0),
(1035, 'http://www.hotels-london.co.uk/chelsea-cloisters.hotel', 0),
(1034, 'http://www.hotels-london.co.uk/circus-apartments-by-bridgestreet-worldwide.hotel', 0),
(1033, 'http://www.hotels-london.co.uk/citadines-apart-hotel-south-kensington.hotel', 0),
(1032, 'http://www.hotels-london.co.uk/citadines-aparthotel-holborn.hotel', 0),
(1031, 'http://www.hotels-london.co.uk/citadines-aparthotel-trafalgar-square.hotel', 0),
(1030, 'http://www.hotels-london.co.uk/corona-apartments-by-bridgestreet-worldwide.hotel', 0),
(1029, 'http://www.hotels-london.co.uk/curzon-plaza-mayfair.hotel', 0),
(1028, 'http://www.hotels-london.co.uk/dolphin-house.hotel', 0),
(1027, 'http://www.hotels-london.co.uk/durley-house.hotel', 0),
(1026, 'http://www.hotels-london.co.uk/fraser-place-canary-wharf.hotel', 0),
(1025, 'http://www.hotels-london.co.uk/grand-plaza-apartments.hotel', 0),
(1024, 'http://www.hotels-london.co.uk/harrington-court.hotel', 0),
(1023, 'http://www.hotels-london.co.uk/hotels_map.php?hotel_ids=11,41,64,90,95,198,370,400,412,416,453,465,526,527,532,533,534,539,547,552,560,611,612,639,690,698,699,702,713,714,718,721,722,723,725,726,727,728,729,731,733,746,747,76', 0),
(1022, 'http://www.hotels-london.co.uk/hyde-park-suites-executive.hotel', 0),
(1021, 'http://www.hotels-london.co.uk/hyde-park-suites-lancaster-gate.hotel', 0),
(1020, 'http://www.hotels-london.co.uk/lanesra-apartments-canary-central.hotel', 0),
(1019, 'http://www.hotels-london.co.uk/london-bridge.hotel', 0),
(1018, 'http://www.hotels-london.co.uk/market-view-apartments-by-bridgestreet-worldwide.hotel', 0),
(1017, 'http://www.hotels-london.co.uk/marlin-apartments-canary-wharf.hotel', 0),
(1016, 'http://www.hotels-london.co.uk/marlin-apartments-city-docklands.hotel', 0),
(1015, 'http://www.hotels-london.co.uk/marlin-apartments-empire-square-london-bridge.hotel', 0),
(1014, 'http://www.hotels-london.co.uk/marlin-apartments-queen-street.hotel', 0),
(1013, 'http://www.hotels-london.co.uk/marlin-apartments-stratford.hotel', 0),
(1012, 'http://www.hotels-london.co.uk/marlin-apartments-tower-bridge.hotel', 0),
(1011, 'http://www.hotels-london.co.uk/mount-mansions.hotel', 0),
(1010, 'http://www.hotels-london.co.uk/plaza-on-the-river.hotel', 0),
(1009, 'http://www.hotels-london.co.uk/princes-square-by-bridgestreet-worldwide.hotel', 0),
(1008, 'http://www.hotels-london.co.uk/royal-court-apartments.hotel', 0),
(1007, 'http://www.hotels-london.co.uk/saco-london-covent-garden.hotel', 0),
(1006, 'http://www.hotels-london.co.uk/saco-london-docklands.hotel', 0),
(1005, 'http://www.hotels-london.co.uk/saco-london-holborn.hotel', 0),
(1004, 'http://www.hotels-london.co.uk/so-quartier.hotel', 0),
(1003, 'http://www.hotels-london.co.uk/so-sienna.hotel', 0),
(1002, 'http://www.hotels-london.co.uk/space-apart.hotel', 0),
(1001, 'http://www.hotels-london.co.uk/the-athenaeum.hotel', 0),
(1000, 'http://www.hotels-london.co.uk/the-capital.hotel', 0),
(999, 'http://www.hotels-london.co.uk/the-cleveland-square.hotel', 0),
(998, 'http://www.hotels-london.co.uk/the-collingham-apartments.hotel', 0),
(997, 'http://www.hotels-london.co.uk/the-grainstore-apartments.hotel', 0),
(996, 'http://www.hotels-london.co.uk/the-hyde-park.hotel', 0),
(995, 'http://www.hotels-london.co.uk/the-kings-wardrobe-apartments.hotel', 0),
(994, 'http://www.hotels-london.co.uk/the-london-carlton.hotel', 0),
(993, 'http://www.hotels-london.co.uk/the-milestone.hotel', 0),
(992, 'http://www.hotels-london.co.uk/think-bermondsey-street.hotel', 0),
(991, 'http://www.hotels-london.co.uk/vancouver-studios.hotel', 0),
(990, 'http://www.hotels-london.co.uk/zenith-apartments-by-bridgestreet-worldwide.hotel', 0),
(989, 'http://airport.hotels-london.co.uk/?range=Airport', 0),
(988, 'http://airport.hotels-london.co.uk/?range=Airport&full=1', 0),
(987, 'http://airport.hotels-london.co.uk/?range=Airport&sort=location', 0),
(986, 'http://airport.hotels-london.co.uk/?range=Airport&sort=price', 0),
(985, 'http://airport.hotels-london.co.uk/?range=Airport&sort=stars', 0),
(984, 'http://entertainment.hotels-london.co.uk/news.php', 0),
(983, 'http://entertainment.hotels-london.co.uk/restaurants.php', 0),
(982, 'http://entertainment.hotels-london.co.uk/show_browse.php', 0),
(981, 'http://last-minute.hotels-london.co.uk/browse.php', 0),
(980, 'http://www.hotels-london.co.uk/crowne-plaza-docklands.hotel', 0),
(979, 'http://www.hotels-london.co.uk/custom-house.hotel', 0),
(978, 'http://www.hotels-london.co.uk/hazel-wood.hotel', 0),
(977, 'http://www.hotels-london.co.uk/hotels_map.php?hotel_ids=215,414,417,524,542,575,578,607,629,633,959', 0),
(976, 'http://www.hotels-london.co.uk/novotel-london-excel.hotel', 0),
(975, 'http://www.hotels-london.co.uk/park-inn-heathrow-london.hotel', 0),
(974, 'http://www.hotels-london.co.uk/radisson-edwardian-heathrow.hotel', 0),
(973, 'http://www.hotels-london.co.uk/sheraton-heathrow.hotel', 0),
(972, 'http://www.hotels-london.co.uk/sheraton-skyline-hotel-and-conference-centre.hotel', 0),
(971, 'http://www.hotels-london.co.uk/sheraton-skyline.hotel', 0),
(970, 'http://www.hotels-london.co.uk/sofitel-heathrow.hotel', 0),
(969, 'http://www.hotels-london.co.uk/sofitel-london-gatwick.hotel', 0),
(968, 'http://www.hotels-london.co.uk/thistle-london-heathrow.hotel', 0),
(967, 'http://airport.hotels-london.co.uk', 1252573203),
(966, 'http://apartments.hotels-london.co.uk', 1252573255),
(965, 'http://boutique.hotels-london.co.uk', 0),
(964, 'http://budget.hotels-london.co.uk', 0),
(963, 'http://cheap.hotels-london.co.uk', 0),
(961, 'http://discount.hotels-london.co.uk', 0),
(962, 'http://corporate.hotels-london.co.uk', 0),
(960, 'http://entertainment.hotels-london.co.uk/lb-entertainment.php', 0),
(959, 'http://five-star.hotels-london.co.uk', 0),
(958, 'http://hip.hotels-london.co.uk', 0),
(957, 'http://hip.hotels-london.co.uk/haymarket.hotel', 0),
(956, 'http://hip.hotels-london.co.uk/one-aldwych.hotel', 0),
(955, 'http://hip.hotels-london.co.uk/sanderson.hotel', 0),
(954, 'http://hip.hotels-london.co.uk/zetter.hotel', 0),
(953, 'http://last-minute.hotels-london.co.uk', 0),
(952, 'http://london-hotels.hotels-london.co.uk', 0),
(951, 'http://london-hotels.hotels-london.co.uk/5-maddox-street.hotel', 0),
(950, 'http://london-hotels.hotels-london.co.uk/baglioni-london.hotel', 0),
(949, 'http://london-hotels.hotels-london.co.uk/lb-select.php', 0),
(948, 'http://london-hotels.hotels-london.co.uk/lb-specials.php', 0),
(947, 'http://london-hotels.hotels-london.co.uk/locations.php', 0),
(946, 'http://london-meeting-rooms.hotels-london.co.uk', 0),
(945, 'http://london_events.hotels-london.co.uk/news.php', 0),
(944, 'http://luxury.hotels-london.co.uk', 0),
(943, 'http://luxury.hotels-london.co.uk/k-west.hotel', 0),
(942, 'http://midrange.hotels-london.co.uk', 0),
(941, 'http://news.bbc.co.uk/sport', 0),
(940, 'http://weekend-specials.hotels-london.co.uk', 0),
(939, 'http://www.hotels-london.co.uk', 0),
(938, 'http://www.hotels-london.co.uk/abc-hyde-park.hotel', 0),
(937, 'http://www.hotels-london.co.uk/ambassador-hotel-bloomsbury.hotel', 0),
(936, 'http://www.hotels-london.co.uk/andaz-london.hotel', 0),
(935, 'http://www.hotels-london.co.uk/ashley.hotel', 0),
(934, 'http://www.hotels-london.co.uk/athenaeum.hotel?tag=mpic', 0),
(933, 'http://www.hotels-london.co.uk/bermondsey-square.hotel', 0),
(932, 'http://www.hotels-london.co.uk/best-western-phoenix.hotel', 0),
(931, 'http://www.hotels-london.co.uk/best-western-shaftesbury-paddington-court.hotel', 0),
(930, 'http://www.hotels-london.co.uk/caesar.hotel', 0),
(929, 'http://www.hotels-london.co.uk/central-park.hotel', 0),
(928, 'http://www.hotels-london.co.uk/church-street.hotel', 0),
(927, 'http://www.hotels-london.co.uk/city-inn-westminster.hotel', 0),
(926, 'http://www.hotels-london.co.uk/collingham-apartments.hotel', 0),
(925, 'http://www.hotels-london.co.uk/corus-hotel-hyde-park.hotel', 0),
(924, 'http://www.hotels-london.co.uk/crowne-plaza-london-kensington.hotel', 0),
(923, 'http://www.hotels-london.co.uk/dockland-apartments.hotel', 0),
(922, 'http://www.hotels-london.co.uk/faq.php', 0),
(921, 'http://www.hotels-london.co.uk/find.php', 0),
(920, 'http://www.hotels-london.co.uk/gresham.hotel', 0),
(919, 'http://www.hotels-london.co.uk/hotel-41.hotel', 0),
(918, 'http://www.hotels-london.co.uk/hotel-lily-earls-court-a-budget.hotel', 0),
(917, 'http://www.hotels-london.co.uk/hyde-park-premier.hotel', 0),
(916, 'http://www.hotels-london.co.uk/lb-resources.php', 0),
(915, 'http://www.hotels-london.co.uk/linden-house.hotel', 0),
(914, 'http://www.hotels-london.co.uk/london_weather_forecast.php', 0),
(913, 'http://www.hotels-london.co.uk/mayflower.hotel', 0),
(912, 'http://www.hotels-london.co.uk/millennium-mayfair.hotel', 0),
(911, 'http://www.hotels-london.co.uk/park-plaza-sherlock-holmes.hotel', 0),
(910, 'http://www.hotels-london.co.uk/rydges-kensington-plaza.hotel', 0),
(909, 'http://www.hotels-london.co.uk/shaftesbury-metropolis.hotel', 0),
(908, 'http://www.hotels-london.co.uk/sofitel-st-james-london.hotel', 0),
(907, 'http://www.hotels-london.co.uk/st-james-hotel-and-club.hotel', 0),
(906, 'http://www.hotels-london.co.uk/street-map.php', 0),
(905, 'http://www.hotels-london.co.uk/the-goring.hotel', 0),
(904, 'http://bayswater.hotels-london.co.uk/', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_nav`
--

CREATE TABLE IF NOT EXISTS `ve123_nav` (
  `nav_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `content` mediumtext NOT NULL,
  `url` varchar(225) NOT NULL,
  `type` int(11) NOT NULL,
  `is_show` int(1) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`nav_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 导出表中的数据 `ve123_nav`
--

INSERT INTO `ve123_nav` (`nav_id`, `title`, `content`, `url`, `type`, `is_show`, `orderid`) VALUES
(1, '网页设计', '网页设计', '', 2, 0, 0),
(2, '美容', '美容', '', 2, 0, 0),
(3, '空间', '空间', '', 2, 0, 0),
(4, '网页制作', '网页制作', '', 2, 0, 0),
(5, '域名注册', '域名注册', '', 2, 0, 0),
(6, '虚拟主机', '虚拟主机', '', 2, 0, 0),
(7, '主机租用', '主机租用', '', 2, 0, 0),
(8, '新闻', '新闻', '', 1, 0, 0),
(9, '购物', '购物', '', 1, 0, 0),
(10, '商城', '商城', '', 1, 0, 0),
(11, 'MP3', 'MP3', '', 1, 0, 0),
(12, '网页', '网页', '', 0, 0, 0),
(13, '视频', '视频', '', 1, 0, 0),
(14, '游戏', '游戏', '', 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_search_keyword`
--

CREATE TABLE IF NOT EXISTS `ve123_search_keyword` (
  `kid` mediumint(9) NOT NULL AUTO_INCREMENT,
  `s` int(11) NOT NULL,
  `keyword` varchar(225) NOT NULL,
  `hits` mediumint(9) NOT NULL,
  `lasttime` int(10) NOT NULL,
  PRIMARY KEY (`kid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=116 ;

--
-- 导出表中的数据 `ve123_search_keyword`
--

INSERT INTO `ve123_search_keyword` (`kid`, `s`, `keyword`, `hits`, `lasttime`) VALUES
(1, 0, '搜索', 135, 1252409195),
(2, 261, '生活', 106, 1270646316),
(3, 0, '仿百度搜索引擎', 25, 1251769172),
(4, 335, '站长', 45, 1251947453),
(5, 261, '娱乐休闲', 6, 1251965268),
(6, 0, '搜猫', 8, 1275571433),
(7, 1, '美容', 1, 1251041729),
(8, 29, '购物', 72, 1270646311),
(9, 29, '服饰', 2, 1251809607),
(10, 335, '站长站', 2, 1251257109),
(11, 1, '健康', 19, 1251965281),
(12, 47, '商务', 17, 1270646314),
(13, 47, '商机', 1, 1251042417),
(14, 0, 'hao123', 4, 1252295425),
(15, 0, '', 21, 1270642204),
(16, 15, '培训', 3, 1251965837),
(17, 29, '电脑', 12, 1251794887),
(18, 347, '企业', 44, 1270646315),
(19, 15, '教育', 43, 1251965293),
(20, 47, '招商', 2, 1252079034),
(21, 29, '家具', 1, 1251192735),
(22, 335, '站长工具', 2, 1251253916),
(23, 335, '站长论坛', 3, 1251968492),
(24, 356, '文具', 2, 1251258057),
(25, 356, '服装', 4, 1252053470),
(26, 356, '化工', 2, 1252053551),
(27, 356, '电子', 1, 1251195023),
(28, 0, '仿百度', 22, 1252042086),
(29, 47, '创业', 1, 1251195131),
(30, 29, '家居用品', 1, 1251195145),
(31, 0, '太平洋', 1, 1251255047),
(32, 0, '华军', 2, 1251268204),
(33, 356, '汽车', 2, 1252053562),
(34, 0, '小游戏', 1, 1251255554),
(35, 0, '百度', 1, 1251255889),
(36, 0, '56', 2, 1251279052),
(37, 29, '淘宝', 2, 1251809534),
(38, 0, '1', 10, 1275570717),
(39, 0, 'zhanghanyun', 2, 1251257207),
(40, 356, '广告', 1, 1251257973),
(41, 261, '快眼', 1, 1251258021),
(42, 0, '5', 1, 1251258837),
(43, 356, '食品', 1, 1251278047),
(44, 15, '考试', 2, 1251286986),
(45, 0, '毫州电视台', 1, 1251289301),
(46, 47, '商务搜索', 1, 1251356612),
(47, 0, '艘', 1, 1251382216),
(48, 0, 'dssd', 1, 1251599097),
(49, 0, 'dsd', 1, 1251599244),
(50, 0, 'www', 1, 1251720362),
(51, 0, '地方', 5, 1251962197),
(52, 0, '服务', 6, 1251794877),
(53, 0, '娱乐', 4, 1251765975),
(54, 0, '其他', 4, 1251776607),
(55, 0, '搜索引擎', 4, 1251968438),
(56, 0, '呵呵网', 1, 1251764929),
(57, 0, '站长之家', 1, 1251765969),
(58, 0, '邮箱', 1, 1251766028),
(59, 0, 'a', 1, 1251766175),
(60, 0, 'aaaa', 6, 1251766586),
(61, 0, '我', 4, 1251768383),
(62, 0, 'sss', 2, 1251772386),
(63, 0, 'aaa', 4, 1251772443),
(64, 0, '0', 1, 1251772453),
(65, 0, '搜索网站', 5, 1251776935),
(66, 0, '百度一下', 1, 1251773710),
(67, 0, 'dd', 1, 1251776702),
(68, 0, 'dd地图', 1, 1251776709),
(69, 0, 'ffzw', 1, 1251776714),
(70, 0, 'g', 1, 1251776718),
(71, 0, '网站登陆', 5, 1252323124),
(72, 0, '方法', 1, 1251777017),
(73, 0, '法案故事', 2, 1251793791),
(74, 0, '视频', 1, 1251794935),
(75, 0, '仿百度搜索', 3, 1251809487),
(76, 0, '仿百度知道', 1, 1251945897),
(77, 0, '搜猫', 10, 1275571433),
(78, 0, '好123', 1, 1251964793),
(79, 15, 'gУ', 4, 1252322984),
(80, 1, '女性疾病', 1, 1251965718),
(81, 0, '不错啊', 1, 1251968410),
(82, 47, '人才', 1, 1251968805),
(83, 0, '柳州', 2, 1252042110),
(84, 0, '柳州新闻', 3, 1252322944),
(85, 261, '生活服务', 1, 1252041166),
(86, 29, '人物', 9, 1270646310),
(87, 0, 'hotels-london', 5, 1252049167),
(88, 0, 'hotels', 3, 1252045776),
(89, 0, 'Hundreds of carefully selected', 3, 1252045599),
(90, 0, 'www.hotels-london.co.uk', 1, 1252045651),
(91, 0, 'Reservations', 2, 1252045787),
(92, 0, 'ABC Hyde Park Hotel', 4, 1252045814),
(93, 0, 'ABC', 1, 1252045819),
(94, 0, 'Hotel Bloomsbury , Upper Woburn Place, Blooms...', 2, 1252046066),
(95, 0, 'Hotel', 10, 1252296000),
(96, 29, '手机', 1, 1252047091),
(97, 29, '新闻', 2, 1252322950),
(98, 15, '名站', 8, 1270646309),
(99, 0, '网页', 4, 1270642222),
(100, 0, '123', 1, 1252322742),
(101, 0, '123网址之家', 1, 1252322750),
(102, 29, '人物摄影', 1, 1252323532),
(103, 0, '飞', 4, 1252339460),
(104, 0, '好', 2, 1252339631),
(105, 29, '人物s', 2, 1270640513),
(106, 0, 's', 5, 1275571475),
(107, 0, 'df', 2, 1270642022),
(108, 15, 'x', 2, 1270642218),
(109, 0, 'ss', 1, 1270642232),
(110, 15, '教育资料', 1, 1270642688),
(111, 335, '站长赚钱', 1, 1270644500),
(112, 47, '网络服务', 1, 1270644504),
(113, 0, 'd', 1, 1270646304),
(114, 0, '13', 1, 1275570718),
(115, 0, 'somao', 1, 1275570746);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_services`
--

CREATE TABLE IF NOT EXISTS `ve123_services` (
  `s_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `http_host` varchar(225) NOT NULL,
  `addtime` int(11) NOT NULL,
  `is_die` int(1) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `ve123_services`
--

INSERT INTO `ve123_services` (`s_id`, `http_host`, `addtime`, `is_die`) VALUES
(1, '', 1251176533, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_siteconfig`
--

CREATE TABLE IF NOT EXISTS `ve123_siteconfig` (
  `config_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `user_agent` varchar(200) NOT NULL,
  `url` varchar(225) NOT NULL,
  `adtitle` varchar(225) NOT NULL,
  `icp` varchar(100) NOT NULL,
  `statcode` mediumtext NOT NULL,
  `copyright` mediumtext NOT NULL,
  `status_content` mediumtext NOT NULL,
  `Keywords` varchar(225) NOT NULL,
  `description` mediumtext NOT NULL,
  `telephone` varchar(225) NOT NULL,
  `qq` varchar(225) NOT NULL,
  `author` varchar(225) NOT NULL,
  `is_tijiao_shoulu` int(1) NOT NULL,
  `spider_depth` int(11) NOT NULL,
  `filter_word` mediumtext NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `ve123_siteconfig`
--

INSERT INTO `ve123_siteconfig` (`config_id`, `name`, `user_agent`, `url`, `adtitle`, `icp`, `statcode`, `copyright`, `status_content`, `Keywords`, `description`, `telephone`, `qq`, `author`, `is_tijiao_shoulu`, `spider_depth`, `filter_word`) VALUES
(1, '搜猫', 'somao', 'http://127.0.0.1', ' - 全球最大的中文搜索引擎', '豫ICP备5201314号', '', '&copy;2004 搜猫', '什么是搜猫?会搜网站的叫搜猫!!!^_^', '搜猫,搜索引擎,搜索引擎登录,搜索引擎源码,仿百度搜索引擎', '搜猫专找网站,为你找好网站!搜猫搜索引擎.本站仿百度.程序源码出售中,不需要服务器,一般空间就可以运行的了.联系QQ:22568190', '13838250541', '22568190', 'http://www.qiaso.com/', 1, 0, '你妈B，法轮功，操你妈，混蛋，去你妈，垃圾，杂种');

-- --------------------------------------------------------

--
-- 表的结构 `ve123_sites`
--

CREATE TABLE IF NOT EXISTS `ve123_sites` (
  `site_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `qp` int(2) NOT NULL,
  `url` varchar(250) NOT NULL,
  `spider_depth` int(11) NOT NULL,
  `indexdate` int(10) NOT NULL,
  `addtime` int(10) NOT NULL,
  `com_count_ip` mediumint(9) NOT NULL,
  `com_time` int(11) NOT NULL,
  `include_word` mediumtext NOT NULL,
  `not_include_word` mediumtext NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- 导出表中的数据 `ve123_sites`
--

INSERT INTO `ve123_sites` (`site_id`, `qp`, `url`, `spider_depth`, `indexdate`, `addtime`, `com_count_ip`, `com_time`, `include_word`, `not_include_word`) VALUES
(80, 0, 'http://127.0.0.1', 0, 1270646319, 1270646319, 1, 1270646319, '', ''),
(81, 0, 'http://localhost', 0, 1275570350, 1275570350, 1, 1275570350, '', ''),
(82, 0, 'http://www.somao123.com', 0, 1275570735, 1275570735, 0, 0, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `ve123_stat_click`
--

CREATE TABLE IF NOT EXISTS `ve123_stat_click` (
  `c_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `c_time` int(11) NOT NULL,
  `c_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `ve123_stat_click`
--

INSERT INTO `ve123_stat_click` (`c_id`, `c_time`, `c_ip`) VALUES
(1, 1251117514, '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `ve123_stat_visitor`
--

CREATE TABLE IF NOT EXISTS `ve123_stat_visitor` (
  `v_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `v_ip` varchar(225) NOT NULL,
  `v_time` int(11) NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `ve123_stat_visitor`
--

INSERT INTO `ve123_stat_visitor` (`v_id`, `v_ip`, `v_time`) VALUES
(1, '192.168.1.2', 1252197389),
(2, '127.0.0.1', 1252226852),
(3, '222.132.254.220', 1252323460),
(4, '127.0.0.1', 1270646319),
(5, '127.0.0.1', 1275570350);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_url_submit`
--

CREATE TABLE IF NOT EXISTS `ve123_url_submit` (
  `submit_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) NOT NULL,
  `ip` text NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`submit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `ve123_url_submit`
--

INSERT INTO `ve123_url_submit` (`submit_id`, `url`, `ip`, `addtime`) VALUES
(4, 'http://www.somao123.com', '127.0.0.1', 1275570735);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_user`
--

CREATE TABLE IF NOT EXISTS `ve123_user` (
  `user_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `username` varchar(225) NOT NULL,
  `sex` varchar(5) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `regtime` int(11) NOT NULL,
  `regip` varchar(225) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `ve123_user`
--

INSERT INTO `ve123_user` (`user_id`, `username`, `sex`, `email`, `password`, `regtime`, `regip`) VALUES
(1, 'zeidu', '1', 'zeidu@163.com', '', 1244692537, '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `ve123_zz_config`
--

CREATE TABLE IF NOT EXISTS `ve123_zz_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `default_point` int(11) NOT NULL,
  `zs_points` mediumint(9) NOT NULL,
  `getpoints` mediumtext NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `ve123_zz_config`
--

INSERT INTO `ve123_zz_config` (`config_id`, `default_point`, `zs_points`, `getpoints`) VALUES
(1, 1, 2, '<br>QQ:22568190<br>\r\n需要积分联系');

-- --------------------------------------------------------

--
-- 表的结构 `ve123_zz_links`
--

CREATE TABLE IF NOT EXISTS `ve123_zz_links` (
  `link_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(9) NOT NULL,
  `title` varchar(225) NOT NULL,
  `url` varchar(225) NOT NULL,
  `keywords` longtext NOT NULL,
  `description` varchar(225) NOT NULL,
  `price` int(11) NOT NULL,
  `jscode` mediumtext NOT NULL,
  `pic` varchar(225) NOT NULL,
  `updatetime` int(11) NOT NULL,
  `stat_click` int(11) NOT NULL,
  `consumption` int(11) NOT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 导出表中的数据 `ve123_zz_links`
--


-- --------------------------------------------------------

--
-- 表的结构 `ve123_zz_set_keywords`
--

CREATE TABLE IF NOT EXISTS `ve123_zz_set_keywords` (
  `key_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `keywords` varchar(225) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`key_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `ve123_zz_set_keywords`
--

INSERT INTO `ve123_zz_set_keywords` (`key_id`, `keywords`, `price`) VALUES
(1, '搜索', 4),
(2, '1', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ve123_zz_user`
--

CREATE TABLE IF NOT EXISTS `ve123_zz_user` (
  `user_id` mediumint(9) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 导出表中的数据 `ve123_zz_user`
--


-- --------------------------------------------------------

--
-- 表的结构 `ve123_zz_website`
--

CREATE TABLE IF NOT EXISTS `ve123_zz_website` (
  `site_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(9) NOT NULL,
  `site_name` varchar(225) NOT NULL,
  `site_url` varchar(225) NOT NULL,
  `description` mediumtext NOT NULL,
  `addtime` int(11) NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `ve123_zz_website`
--

INSERT INTO `ve123_zz_website` (`site_id`, `user_id`, `site_name`, `site_url`, `description`, `addtime`, `updatetime`) VALUES
(1, 1, '搜猫搜索', 'http://www.somao123.com', '搜猫搜索引擎', 1245988126, 1245991904),
(2, 1, '搜猫站长', ' http://www.somao123.com ', '搜猫站长', 1245988126, 1245991383),
(3, 1, '搜猫搜索', ' http://www.somao123.com', '搜猫搜索引擎', 1245988698, 1245991293),
(4, 0, '仿百度搜索', 'http://www.somao123.com/', '仿百度搜索带蜘蛛了，PHP+MYSQL', 1251808804, 1251808804);
