<?php
include "F:/ShopEx/shop/docroot/tieba/class/phpSayTemplateExtensions/rewrite_topic.php";
include "F:/ShopEx/shop/docroot/tieba/class/phpSayTemplateExtensions/rewrite_category.php";
include "F:/ShopEx/shop/docroot/tieba/class/phpSayTemplateExtensions/rewrite_forum.php";
include "F:/ShopEx/shop/docroot/tieba/class/phpSayTemplateExtensions/rewrite_member.php";
include "F:/ShopEx/shop/docroot/tieba/class/phpSayTemplateExtensions/avatar.php";

?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title><?php
echo $_obj['siteName'];
?>
 亿时达 - 让您的产品与品牌服务两个小时内传遍互联网！</title><meta name="keywords" content="<?php
echo $_obj['siteName'];
?>
, 企业贴吧, 菏泽本地产品推广平台" /><meta name="description" content="亿时达 - 菏泽企业推广平台，让您的产品与品牌服务两个小时内传遍互联网！" /><link rel="stylesheet" type="text/css" href="./css/index.css?v3" /><link rel="stylesheet" type="text/css" href="./css/thickbox.css" /><script type="text/javascript" src="./js/jquery.js"></script><script type="text/javascript" src="./js/thickbox.js"></script><script type="text/javascript" src="./js/phpsay.js"></script><script type="text/javascript" src="./js/index.js"></script></head><body><div id="topw"><div id="top"><div id="header_left"><a href="./">亿时达企业推广平台</a></div><div id="header_links"></div></div></div><div id="search"><div id="search_l"></div><form id="search_c" method="get" action="./search.php" onsubmit="return SearchSubmit(this)"><div id="logo"></div><ul id="ipt"><li class="ipt_t" id="clueon">输入贴吧名称直接回车即可进入该吧，如果吧不存在即可创建。</li><li><input class="ipt_sr" type="text" name="wd" id="wd" /></li><li class="ipt_b"><em><input type="radio" name="tb" id="s1" value="1" onclick="clueOn(this.value);" checked />贴吧</em><em><input type="radio" name="tb" id="s2" value="2" onclick="clueOn(this.value);" />贴子</em><em><input type="radio" name="tb" id="s3" value="3" onclick="clueOn(this.value);" />作者</em></li></ul><input id="iptbt" type="submit" value=" " /></form><div id="search_r"></div></div><div id="wrap"><div class="listleft"><div class="tiezi"> <h1>最热帖</h1> <ul><?php
if (!empty($_obj['hotTopic'])){
if (!is_array($_obj['hotTopic']))
$_obj['hotTopic']=array(array('hotTopic'=>$_obj['hotTopic']));
$_tmp_arr_keys=array_keys($_obj['hotTopic']);
if ($_tmp_arr_keys[0]!='0')
$_obj['hotTopic']=array(0=>$_obj['hotTopic']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['hotTopic'] as $rowcnt=>$v) {
if (is_array($v)) $hotTopic=$v; else $hotTopic=array();
$hotTopic['ROWVAL']=$v;
$hotTopic['ROWCNT']=$rowcnt;
$hotTopic['ROWBIT']=$rowcnt%2;
$_obj=&$hotTopic;
?><li><a href="<?php
echo phpsay_rewrite_topic($_obj['tid']);
?>
" title="<?php
echo $_obj['subject'];
?>
" target="_blank"><?php
echo $_obj['subject'];
?>
</a></li><?php
}
$_obj=$_stack[--$_stack_cnt];}
?> </ul></div><div class="tiezi"> <h1>最新帖</h1> <ul><?php
if (!empty($_obj['newTopic'])){
if (!is_array($_obj['newTopic']))
$_obj['newTopic']=array(array('newTopic'=>$_obj['newTopic']));
$_tmp_arr_keys=array_keys($_obj['newTopic']);
if ($_tmp_arr_keys[0]!='0')
$_obj['newTopic']=array(0=>$_obj['newTopic']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['newTopic'] as $rowcnt=>$v) {
if (is_array($v)) $newTopic=$v; else $newTopic=array();
$newTopic['ROWVAL']=$v;
$newTopic['ROWCNT']=$rowcnt;
$newTopic['ROWBIT']=$rowcnt%2;
$_obj=&$newTopic;
?><li><a href="<?php
echo phpsay_rewrite_topic($_obj['tid']);
?>
" title="<?php
echo $_obj['subject'];
?>
" target="_blank"><?php
echo $_obj['subject'];
?>
</a></li><?php
}
$_obj=$_stack[--$_stack_cnt];}
?> </ul></div><div class="category"> <h1>贴吧目录</h1> <?php
if (!empty($_obj['category'])){
if (!is_array($_obj['category']))
$_obj['category']=array(array('category'=>$_obj['category']));
$_tmp_arr_keys=array_keys($_obj['category']);
if ($_tmp_arr_keys[0]!='0')
$_obj['category']=array(0=>$_obj['category']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['category'] as $rowcnt=>$v) {
if (is_array($v)) $category=$v; else $category=array();
$category['ROWVAL']=$v;
$category['ROWCNT']=$rowcnt;
$category['ROWBIT']=$rowcnt%2;
$_obj=&$category;
?> <dl><dt><a href="<?php
echo phpsay_rewrite_category($_obj['cid']);
?>
" target="_blank">[<?php
echo $_obj['name'];
?>
]</a></dt><dd><?php
if (!empty($_obj['subcategory'])){
if (!is_array($_obj['subcategory']))
$_obj['subcategory']=array(array('subcategory'=>$_obj['subcategory']));
$_tmp_arr_keys=array_keys($_obj['subcategory']);
if ($_tmp_arr_keys[0]!='0')
$_obj['subcategory']=array(0=>$_obj['subcategory']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['subcategory'] as $rowcnt=>$v) {
if (is_array($v)) $subcategory=$v; else $subcategory=array();
$subcategory['ROWVAL']=$v;
$subcategory['ROWCNT']=$rowcnt;
$subcategory['ROWBIT']=$rowcnt%2;
$_obj=&$subcategory;
?><a href="<?php
echo phpsay_rewrite_category($_obj['cid']);
?>
" target="_blank"><?php
echo $_obj['name'];
?>
</a><?php
}
$_obj=$_stack[--$_stack_cnt];}
?></dd> </dl> <?php
}
$_obj=$_stack[--$_stack_cnt];}
?></div><div class="friend"> <h1>友情链接</h1> <div><?php
if (!empty($_obj['friendLink'])){
if (!is_array($_obj['friendLink']))
$_obj['friendLink']=array(array('friendLink'=>$_obj['friendLink']));
$_tmp_arr_keys=array_keys($_obj['friendLink']);
if ($_tmp_arr_keys[0]!='0')
$_obj['friendLink']=array(0=>$_obj['friendLink']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['friendLink'] as $rowcnt=>$v) {
if (is_array($v)) $friendLink=$v; else $friendLink=array();
$friendLink['ROWVAL']=$v;
$friendLink['ROWCNT']=$rowcnt;
$friendLink['ROWBIT']=$rowcnt%2;
$_obj=&$friendLink;
?><a href="<?php
echo $_obj['url'];
?>
" target="_blank"><?php
echo $_obj['name'];
?>
</a><?php
}
$_obj=$_stack[--$_stack_cnt];}
?></div></div></div><div class="listright"><div class="tieba"> <h1>推荐贴吧</h1> <?php
if (!empty($_obj['topForum'])){
if (!is_array($_obj['topForum']))
$_obj['topForum']=array(array('topForum'=>$_obj['topForum']));
$_tmp_arr_keys=array_keys($_obj['topForum']);
if ($_tmp_arr_keys[0]!='0')
$_obj['topForum']=array(0=>$_obj['topForum']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['topForum'] as $rowcnt=>$v) {
if (is_array($v)) $topForum=$v; else $topForum=array();
$topForum['ROWVAL']=$v;
$topForum['ROWCNT']=$rowcnt;
$topForum['ROWBIT']=$rowcnt%2;
$_obj=&$topForum;
?> <dl><dt><a href="<?php
echo phpsay_rewrite_forum($_obj['fid']);
?>
" target="_blank"><?php
echo $_obj['name'];
?>
</a></dt><dd><?php
echo $_obj['synopsis'];
?>
</dd> </dl> <?php
}
$_obj=$_stack[--$_stack_cnt];}
?></div><div class="member"> <h1>活跃用户</h1> <ul><?php
if (!empty($_obj['topMember'])){
if (!is_array($_obj['topMember']))
$_obj['topMember']=array(array('topMember'=>$_obj['topMember']));
$_tmp_arr_keys=array_keys($_obj['topMember']);
if ($_tmp_arr_keys[0]!='0')
$_obj['topMember']=array(0=>$_obj['topMember']);
$_stack[$_stack_cnt++]=$_obj;
foreach ($_obj['topMember'] as $rowcnt=>$v) {
if (is_array($v)) $topMember=$v; else $topMember=array();
$topMember['ROWVAL']=$v;
$topMember['ROWCNT']=$rowcnt;
$topMember['ROWBIT']=$rowcnt%2;
$_obj=&$topMember;
?><li><a href="<?php
echo phpsay_rewrite_member($_obj['uid']);
?>
" title="<?php
echo $_obj['name'];
?>
" target="_blank"><img src="<?php
echo phpsay_avatar($_obj['uid']);
?>
" /><br><?php
echo $_obj['name'];
?>
</a></li><?php
}
$_obj=$_stack[--$_stack_cnt];}
?> </ul></div></div></div><div id="foot">﻿Powered by <a href="http://www.1230530.com" target="_blank"><?php
echo $_obj['codeName'];
?>
</a> <?php
echo $_obj['codeVersion'];
?>
, Copyright &copy; 2012～2016 <a href="http://www.1230530.com" target="_blank">Shiwww.com</a> 版权所有<?php
if (!empty($_obj['siteIcp'])){
?> <a href="http://www.miibeian.gov.cn/" target="_blank"><?php
echo $_obj['siteIcp'];
?>
</a><?php
}
?><script type="text/javascript"> var _gaq = _gaq || []; _gaq.push(['_setAccount', 'UA-6933823-13']); _gaq.push(['_trackPageview']); (function() { var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s); })();</script></div></body></html>