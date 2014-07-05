<style type="text/css">
<!--
body,td,th {
	font-size: 15px;
	font-family: Arial;
}
a:link {
	color: #3366CC;
}
-->
</style><?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

require( "global.php" );
$link_id = intval( $_SERVER['QUERY_STRING'] );
if ( empty( $link_id ) )
{
    header( "location:.".$config['url'] );
}
$link = $db->get_one( "select * from ve123_links where link_id='".$link_id."'" );
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" />\r\n<title>";
echo $link['title'];
echo "</title>\r\n<style>\r\nbody{font-size:13px;line-height:25px;}\r\n.table{background:#D0DBFC;}\r\n.table td{background:#F4F6FC;}\r\n</style>\r\n<script language=\"javascript\" type=\"text/javascript\"> \r\nfunction codeCopy(){ \r\nvar obj=document.getElementById(\"url\"); \r\nobj.select(); \r\njs=obj.createTextRange(); \r\njs.execCommand(\"Copy\") ;\r\nalert(\"复制成功!\");\r\nreturn false;\r\n} \r\n</script>\r\n</head>\r\n\r\n<body>\r\n<table width=\"900\" height=\"54\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr valign=middle>\r\n<td width=\"100%\" valign=\"top\" style=\"padding-left:8px;width:137px;\" nowrap>\r\n<a href=\"./\"><img src=\"../images/logo-yy.gif\" border=\"0\" width=\"137\" height=\"48\" alt=\"到";
echo $config['name'];
echo "首页\"></a>\r\n</td>\r\n<td>&nbsp;&nbsp;&nbsp;</td>\r\n<td width=\"100%\" valign=\"top\">\r\n<div class=\"Tit\">\r\n";
foreach ( $nav as $key => $value )
{
    if ( empty( $value['url'] ) )
    {
        echo "<a href=\"../s?wd=".urlencode( $value['title'] )."\">".$value['title']."</a>";
    }
    else
    {
        echo "<a href=\"".$value['url']."\" target=\"_blank\">".$value['title']."</a>";
    }
    echo "&nbsp;&nbsp;&nbsp;";
}
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>\r\n<table cellspacing=\"0\" cellpadding=\"0\">\r\n<tr><td valign=\"top\" nowrap>\r\n<form name=f action=\"../s\">\r\n<input name=wd id=kw size=\"42\" class=\"i\" style=\"height:25px\" value=\"\" maxlength=\"100\"> \r\n<input type=submit style=\"height:25px\" value=";
echo $config['name'];
echo "一下>&nbsp;&nbsp;&nbsp;\r\n</form>\r\n</td>\r\n<td valign=\"middle\" nowrap>\r\n\r\n</td>\r\n</tr></table>\r\n<div style=\"line-height:25px;\"></div>\r\n</td>\r\n\r\n</tr></table>\r\n<table width=\"900\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\" class=\"table\">\r\n  <tr>\r\n    <td width=\"100\">网站标题:</td>\r\n    <td>";
echo $link['title'];
echo "</td>\r\n  </tr>\r\n  <tr>\r\n    <td>网站关键词:</td>\r\n    <td>";
echo $link['keywords'];
echo "</td>\r\n  </tr>\r\n  <tr>\r\n    <td>网站描述:</td>\r\n    <td>";
echo $link['description'];
echo "</td>\r\n  </tr>\r\n  <tr>\r\n    <td>内容预览:</td>\r\n    <td>";
echo $link['fulltxt']."...";
echo "</td>\r\n  </tr>\r\n  <tr>\r\n    <td>收录时间:</td>\r\n    <td>";
echo date( "Y-m-d H:i:s", $link['updatetime'] );
echo "</td>\r\n  </tr>\r\n  <tr>\r\n    <td>网站地址:</td>\r\n    <td><a href=\"";
echo $link['url'];
echo "\" target=\"_blank\">";
echo $link['url'];
echo "</a></td>\r\n  </tr>\r\n  <tr>\r\n    <td>网站快照:</td>\r\n    <td><a href=\"";
echo "../k/?".base64_encode( "url=".$link['url']."&wd=".$wd_split."" );
echo "\" target=\"_blank\">";
echo $config['name'];
echo "快照</a></td>\r\n  </tr>\r\n</table>\r\n\r\n<table width=\"900\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\" class=\"table\" style=\"margin-top:3px;\">\r\n  <tr>\r\n    <td><input name=\"url\" id=\"url\" type=\"text\" size=\"50\" value=\"";
echo $config['url'];
echo "\"/>\r\n    <input type=\"submit\" name=\"Submit\" value=\"复制\"  onClick=\"codeCopy()\"/>\r\n    (做上本站链接,系统自动收录你的网站,以后每次有新的点入,自动排在第一位!)</td>\r\n  </tr>\r\n</table>\r\n<div style=\"text-align:center;margin-top:5px;\">";
echo $config['url'];
echo "</div>\r\n</body>\r\n</html>\r\n";
?>
