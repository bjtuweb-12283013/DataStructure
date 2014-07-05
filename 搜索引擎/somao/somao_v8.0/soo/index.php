<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

require( "global.php" );
require( "include/global.sub.func.php" );
echo "<html>\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html;charset=gb2312\">\r\n<title>";
echo $ve123['name'];
echo "一下，你就找到好网站--Powered by qiaso v";
echo $qiaso_version;
echo "</title>\r\n<meta name=\"Keywords\" content=\"";
echo $ve123['Keywords'];
echo "\">\r\n<meta name=\"description\" content=\"";
echo $ve123['description'];
echo "\">\r\n<script language=\"javascript\" type=\"text/javascript\">\r\nfunction selectTag(showContent,wd,cate_id,selfObj){\r\n\tvar tag = document.getElementById(\"tags\").getElementsByTagName(\"a\");\r\n\tvar taglength = tag.length;\r\n\tfor(i=0; i<taglength; i++){\r\n\t\ttag[i].className = \"\";\r\n\t}\r\n\tselfObj.className = \"focu\";\r\n\t\r\n\tdocument.f.wd.focus();\r\n\tdocument.f.wd.value=wd;\r\n\tdocument.f.s.value=cate_id;\r\n\tf.attributes[83].value=showContent;\r\n\t//document.f.action=showContent;\r\n\r\n}\r\n</script>\r\n<script language=\"javascript\" src=\"js/zeidu_menu.php\"></script>\r\n<link rel=\"stylesheet\" href=\"images/css.css\">\r\n</head>\r\n<body onLoad=\"onLoadHandler()\" onMouseOut=\"window.status='";
echo $ve123['status_content'];
echo "';return true\">\r\n<div id=u>&nbsp;<a href=\"http://p2padmin.cn\" target=><font color=red>飞猫搜索程序出售</font></a>\r\n</div>\r\n<center><img src=\"images/zeidu_logo.gif\" width=270 height=129 usemap=\"#mp\" id=lg><br><br><br><br><table cellpadding=0 cellspacing=0 id=l><tr><td>\r\n<div id=m>\r\n<div id=\"tags\">\r\n<a href=\"javascript:void(0)\" class=focu onClick=\"selectTag('s','网页','',this)\">网页</a>";
foreach ( $nav as $key => $value )
{
		echo "<div id=\"Memu_Desc_".$key."\" class=\"popupMenu\" style=\"display:none\"></div>";
		echo "<a id=\"Memu_Desc_".$key."_link\" href=\"javascript:void(0)\" onClick=\"selectTag('s','".$value."','".$key."',this)\">".$value."</a>";
}
echo "</div>\r\n</div></td></tr></table>\r\n<table cellpadding=0 cellspacing=0 style=\"margin-left:15px\"><tr valign=top><td style=\"height:62px;padding-left:92px\" nowrap><form name=f action=s><input name=wd type=text id=kw size=42 maxlength=100> \r\n<input type=submit value=";
echo $ve123['name'];
echo "一下 id=sb><span id=hp></span></form></td></tr></table>\r\n<p id=km>&nbsp;</p>\r\n<br>\r\n<div id=\"hot_kw\">\r\n\r\n</div><br><br>\r\n<p style=height:30px><a onClick=\"this.style.behavior='url(#default#homepage)';this.setHomePage('";
echo $ve123['url'];
echo "')\" href=#>把";
echo $ve123['name'];
echo "设为主页</a>&nbsp;&nbsp;\r\n\r\n</p>\r\n";
index_foothtml( );
echo "<map name=mp><area shape=rect coords=\"43,22,227,91\" href=\"javascript:window.external.AddFavorite(window.location.href,document.title);\"  title=\"点此收藏 ";
echo $ve123['name'];
echo "\"></map></center>\r\n<a class=\"qiaso\" href=\"http://p2padmin.cn/\">飞猫搜索引擎</a>\r\n</body>\r\n</html>";
?>
