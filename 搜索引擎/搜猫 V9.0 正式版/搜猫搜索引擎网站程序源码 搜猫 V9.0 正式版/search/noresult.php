<?php
require "../global.php";
?>
<html>
<head>
<meta content="text/html; charset=GB2312" http-equiv="content-type">
<title>网页搜索帮助-搜索无结果帮助</title>
<style type="text/css">
<!--
.p1 {FONT-SIZE: 14px; LINE-HEIGHT: 24px; FONT-FAMILY: "Arial"}
.p2 { FONT-SIZE: 14px; LINE-HEIGHT: 24px; color: #333333}
.p3 { FONT-SIZE: 14px; LINE-HEIGHT: 24px; color: #0033cc}
-->
</style>
<script language="javascript">
<!--
function h(obj,url){
obj.style.behavior='url(#default#homepage)';
obj.setHomePage(url);
}
-->
</script>
<link href="help.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor=#ffffff text=#000000 vlink=#0033CC alink=#800080  link=#0033cc topmargin="0">
<a name="n"></a>
<table width="95%" border=0 align="center">
  <tr> 
      
    <td width=139 valign="top" height="69"><a href="<?php echo $config["url"];?>"><img src="../images/logo.gif" border="0"></a></td>
      
    <td valign="bottom"> 
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr bgcolor="#e5ecf9"> 
          <td height="24">&nbsp;<b class="p1">网页搜索帮助-搜索无结果帮助</b></td>
          <td height="24" class="p2"> 
            <div align="right"><a  href="url_submit.php">帮助中心 </a> &nbsp;</div>
          </td>
        </tr>
        <tr> 
          <td height="20" class="p2" colspan="2"></td>
        </tr>
      </table>
    </td>
  </tr>

</table>
<b class="p1"><a name="n1"></a></b><br>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td bgcolor="#e5ecf9" width="750">&nbsp;<b class="p1">搜索无结果帮助</b></td>
        </tr>
        <tr> 
          <td class="padd10"><br>
            <span class="p2">造成搜索无结果的原因可能有多种，请查看下面提示的几种情况来调整您的查询词以获得您所要的信息。
              <ol>
			  <li>
			  <b>如果您使用了错误的字词，可能导致无结果。请检查您所使用的字词是否正确。</b></li>
              <br>例如：想查找宫崎骏的电影《千与千寻》，却错误地输入了“<a href="<?php echo $config["url"];?>/s?wd=%C7%A7%D3%EB%C7%AA%D1%B0+%B9%AC%C6%E9%BF%A1&cl=3" target="_blank">千与仟寻 宫崎俊</a>”，这样就无法达到目的。把查询词修改为正确的“<a href="<?php echo $config["url"];?>/s?ct=0&ie=gb2312&bs=%C7%A7%D3%EB%C7%AA%D1%B0+%B9%AC%C6%E9%BF%A1&sr=&z=&wd=%C7%A7%D3%EB%C7%A7%D1%B0+%B9%AC%C6%E9%BF%A5&cl=3&f=8" target="_blank">千与千寻 宫崎骏</a>”就可以准确地找到您所要的信息。 
			  <br>
			  此外，百度会对常见的错别字词出纠错提示。以上面的查询词为例，在页面上方就会有如下提示：<br>
              <strong>您要找的是不是 : <a href="<?php echo $config["url"];?>/s?wd=%C7%A7%D3%EB%C7%A7%D1%B0+%B9%AC%C6%E9%BF%A5&lm=0&si=&rn=10&ie=gb2312&ct=0&cl=3&f=12" target="_blank">千与千寻 宫崎骏 </a>&nbsp;</strong><br>
              <br>
			  <li>
			  <B>如果您输入的查询信息太多，可能导致无结果。您可以尝试简化输入的查询信息来获取更多的结果。</B></li>
              <br>例如：找北京市的海淀医院，有用户这样搜：“<a href="<?php echo $config["url"];?>/s?ie=gb2312&bs=%C7%A7%D3%EB%C7%A7%D1%B0+%B9%AC%C6%E9%BF%A5&sr=&z=&wd=%CE%D2%CF%EB%D5%D2%B1%B1%BE%A9%CA%D0%BA%A3%B5%ED%C7%F8%D6%D0%B9%D8%B4%E5%B8%BD%BD%FC%B5%C4%BA%A3%B5%ED%D2%BD%D4%BA&ct=0&cl=3&f=8" target="_blank">我想找北京市海淀区中关村附近的海淀医院</a>”，于是查询无结果。<br>
			  百度会严格按照您输入的字词进行检索。因此，您提交给百度的查询词，请尽量只包含最关键的信息。<br>
			  以上面的查询为例，可以简化成这样：
              <a href="<?php echo $config["url"];?>/s?ct=0&ie=gb2312&bs=%CE%D2%CF%EB%D5%D2%B1%B1%BE%A9%CA%D0%BA%A3%B5%ED%C7%F8%D6%D0%B9%D8%B4%E5%B8%BD%BD%FC%B5%C4%BA%A3%B5%ED%D2%BD%D4%BA&sr=&z=&wd=%B1%B1%BE%A9%CA%D0%BA%A3%B5%ED%D2%BD%D4%BA&cl=3&f=8" target="_blank">北京市海淀医院</a>              <br>
              由于“海淀医院”只在北京有，因此，单搜“<a href="<?php echo $config["url"];?>/s?ie=gb2312&bs=%B1%B1%BE%A9%CA%D0%BA%A3%B5%ED%D2%BD%D4%BA&sr=&z=&wd=%BA%A3%B5%ED%D2%BD%D4%BA&ct=0&cl=3&f=8" target="_blank">海淀医院</a>”，一样可以达到目的。
			<br><br>
            <li><B>如果您查询的是网址，而该网址并未被百度收录，也会导致无结果。</B></li>
              <br>如果您认为该网址比较重要，百度应该收录，可点击搜索框上方的“与百度对话”链接，向百度提出相应建议。<BR><BR>
            <li><b>您所查询的内容在互联网上不存在，或者相关的页面百度未收录，那么您的查询也会无结果。</B><br>
              您可以尝试去<a href="" target="_blank">百度贴吧</a>的相关主题讨论区向其他网友询问您的问题。
                <div align="right"><a href="#n" class="p3">返回页首</a> </div>
              </li>

			</ol>
			</span>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<hr size="1" color="#dddddd" width="95%">

<table width="95%" border=0 align="center">
  <tr> 
    <td align=center class=p1> <font color="#666666">&copy; 2010 <?php echo $config["name"];?></font></td>
  </tr>
</table>
</body></html>