<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

set_time_limit( 0 );
if ( $_GET['somao'] != "ok" )
{
		exit( );
}
require( "global.php" );
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" /><script language=\"javascript\" src=\"global.js\"></script>\r\n<link rel=\"stylesheet\" href=\"xp.css\" type=\"text/css\">\r\n<style>\r\n.iframe_style{border:1px solid #cccccc;width:98%;}\r\n</style>\r\n</head>\r\n\r\n<body>\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td width=\"200\" valign=\"top\"><table width=\"98%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n\t   <tr>\r\n        <td onClick=\"ShowMain(1)\" bgcolor=\"#999999\" height=\"25\" class='headtd1'>&nbsp;<img src=\"images/left_5.gif\" width=\"16\" height=\"16\"  align=\"absmiddle\"> 自动抓取</td>\r\n      </tr>\r\n    <tr>\r\n        <td onClick=\"ShowMain(4)\" bgcolor=\"#999999\" height=\"25\" class='headtd1'>&nbsp;<img src=\"images/left_5.gif\" width=\"16\" height=\"16\"  align=\"absmiddle\"> 自动更新</td>\r\n      </tr>\r\n\t       <tr>\r\n      <tr>\r\n        <td onClick=\"ShowMain(3)\" bgcolor=\"#999999\" height=\"25\" class='headtd1'>&nbsp;<img src=\"images/left_5.gif\" width=\"16\" height=\"16\"  align=\"absmiddle\"> <a href=\"sites.php\" target=\"sites\">站点管理</a></td>\r\n      </tr>\r\n      <tr>\r\n        <td onClick=\"ShowMain(3)\" bgcolor=\"#999999\" height=\"25\" class='headtd1'>&nbsp;<img src=\"images/left_5.gif\" width=\"16\" height=\"16\"  align=\"absmiddle\"> <a href=\"sites.php?action=addform\" target=\"sites\">添加新站</a></td>\r\n      </tr>\r\n     <tr>\r\n        <td onClick=\"ShowMain(2)\" bgcolor=\"#999999\" height=\"25\" class='headtd1'>&nbsp;<img src=\"images/left_5.gif\" width=\"16\" height=\"16\"  align=\"absmiddle\"> 寻找新站</td>\r\n      </tr>\r\n       <tr>\r\n        <td>&nbsp;</td>\r\n      </tr>\r\n    </table>\t</td>\r\n    <td valign=\"top\">\r\n\r\n\t<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n      <tr>\r\n        <td><div class=\"iframe_style\" style=\"padding:10px;\"><a href=\"javascript:window.history.go('-1');\">返回上一步</a> <input   type=\"button\"   value=\"停止加载\"   name=\"stop\"   onclick=\"window.location.stop()\"></div><br></td>\r\n      </tr>\r\n      <tr>\r\n        <td>\r\n<div id=\"main_1\" style=\"display:none;\"><iframe src=\"start.php?action=add_all_site_link\" class=\"iframe_style\" id=\"add_in_site_link\" name=\"add_in_site_link\" height=\"530\"></iframe></div>\r\n<div id=\"main_4\" style=\"display:none\">\r\n<iframe src=\"start.php?action=auto_update\" class=\"iframe_style\" id=\"auto_update\" name=\"auto_update\" height=\"530\"></iframe>\r\n</div>\r\n<div id=\"main_2\" style=\"display:none\"><iframe src=\"start.php?action=findsite\" class=\"iframe_style\" id=\"findsite\" name=\"findsite\" scrolling=\"no\" height=\"530\"></iframe></div>\r\n<div id=\"main_3\" style=\"display:none\"><iframe src=\"sites.php\" class=\"iframe_style\" id=\"sites\" name=\"sites\" height=\"530\"></iframe></div>\r\n\t\t</td>\r\n      </tr>\r\n    </table></td>\r\n  </tr>\r\n</table>\r\n";
foothtml( );
echo "</body>\r\n</html>\r\n<script language=javascript>\r\n///显示菜单\r\nfunction ShowMain(main_id)\r\n{\r\n\tdocument.all['main_2'].style.display=\"none\";\r\n\tdocument.all['main_1'].style.display=\"none\";\r\n\tdocument.all['main_3'].style.display=\"none\";\r\n\tdocument.all['main_4'].style.display=\"none\";\r\n\tdocument.all['main_'+main_id].style.display=\"\";\r\n\t\r\n}\r\nShowMain(1);\r\n</script>";
?>
