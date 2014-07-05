<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

require( "../global.php" );
require( "global.func.php" );
require( "../include/search.class.php" );
$wd = filtersearch( $_GET['wd'] );
if ( empty( $wd ) )
{
		header( "location:../" );
}
$wd_en = urlencode( $wd );
$search = new search( );
$data = $search->q( $wd );
$total = $search->total;
$wd_split = $search->wd_split;
$wd_array = $search->wd_array;
$wd_count = $search->wd_count;
$totalpage = $search->totalpage;
echo "<!--STATUS OK--><html><head>\r\n<meta http-equiv=\"content-type\" content=\"text/html;charset=gb2312\">\r\n<title>";
echo $ve123['name'];
echo "搜索_";
echo $wd.$ve123['adtitle'];
echo "--Powered by Feimao v";
echo $qiaso_version;
echo "</title>\r\n<link rel=\"stylesheet\" href=\"images/css.css\" type=\"text/css\">\r\n<script language=\"javascript\" src=\"global.js\"></script>\r\n<script language=\"javascript\" src=\"http://www.ve123.com/product/qiaso/js/?http_host=";
echo $_SERVER['HTTP_HOST'];
echo "\"></script>\r\n</head>\r\n<body link=\"#261CDC\">\r\n<table width=\"100%\" height=\"54\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr valign=middle>\r\n<td width=\"100%\" valign=\"top\" style=\"padding-left:8px;width:137px;\" nowrap>\r\n<a href=\"../\"><img src=\"../images/logo-yy.gif\" border=\"0\" width=\"137\" height=\"46\" alt=\"到";
echo $ve123['name'];
echo "首页\"></a>\r\n</td>\r\n<td>&nbsp;&nbsp;&nbsp;</td>\r\n<td width=\"100%\" valign=\"top\">\r\n<div class=\"Tit\">\r\n";
foreach ( $nav as $key => $value )
{
		if ( !empty( $wd ) || ( $wd == $value || in_array( $wd, $nav_keywords[$key] ) ) )
		{
				$nav_selected = " class=\"popupMenu\"";
				$nav_id = $key;
		}
		else
		{
				$nav_selected = "";
		}
		echo "<a href=\"?wd=".urlencode( $value )."\"".$nav_selected.">".$value."</a>";
		echo "&nbsp;&nbsp;&nbsp;";
}
echo "</div>\r\n<table cellspacing=\"0\" cellpadding=\"0\">\r\n<tr><td valign=\"top\" nowrap><form name=f action=\"./\">\r\n<input name=wd id=kw size=\"42\" class=\"i\" value=\"";
echo $wd;
echo "\" maxlength=\"100\"> \r\n<input type=submit value=";
echo $ve123['name'];
echo "一下>\r\n</form></td>\r\n<td valign=\"middle\" nowrap>&nbsp;\r\n<a href=\"http://p2padmin.cn/\" target=\"_blank\">飞猫演示</a>&nbsp;&nbsp;\r\n<script language=\"javascript\">notice();</script>\r\n</td></tr></table>\r\n</td>\r\n<td></td>\r\n</tr></form></table>\r\n\r\n<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"bi\">\r\n<tr>\r\n<td nowrap>&nbsp;&nbsp;&nbsp;<a onClick=\"h(this,'";
echo $ve123['url'];
echo "')\" href=\"#\" style=\"color:#000000 \">把";
echo $ve123['name'];
echo "设为主页</a></td>\r\n<td align=\"right\" nowrap>";
echo $ve123['name']."一下，找到相关网页约 ".$total." 篇，用时0.001秒";
echo "</td>\r\n</tr>\r\n</table>\r\n";
rightad( );
if ( 0 < $total )
{
		foreach ( $data as $link )
		{
				echo "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"1\"><tr><td class=f>\r\n<a onMouseDown=\"return ss('";
				echo $link['url'];
				echo "')\" onMouseOver=\"return ss('";
				echo $link['url'];
				echo "')\" onMouseOut=\"cs()\" href=\"";
				echo $link['url'];
				echo "\" target=\"_blank\"><font size=\"3\">";
				echo $link['title'];
				echo "</font></a><br><font size=-1>\r\n";
				echo $link['fulltxt'];
				echo "<br></font>\r\n</td></tr></table><br>\r\n";
		}
		echo "<br clear=all>\r\n<div class=\"p\">\r\n";
		require_once( "../include/inc_page.php" );
		$page = new page( $totalpage, "?wd=".$wd_en."&p=" );
		echo $page->show( );
		echo "</div><br>\r\n";
}
else
{
		echo "<div style=\"margin:0 0 0 15px;font-size:14px;line-height:20px;\">\r\n";
		if ( substr( $wd, 0, 7 ) == "http://" )
		{
				echo "您可以直接访问：";
				echo "<a target=\"_blank\" href=\"".$wd."\">".$wd."</a>";
				echo "<br>\r\n";
		}
		else
		{
				echo "\r\n抱歉，没有找到与“<font color=\"#C60A00\">";
				echo $wd;
				echo "</font>” 相关的网页。\r\n\r\n";
		}
		echo "<br><br>\r\n<font class=\"fB\">";
		echo $ve123['name'];
		echo "建议您：</font>\r\n<div style=\"margin-top:0px;margin-left:15px;\">\r\n<li>看看输入的文字是否有误</li>\r\n<li>去掉可能不必要的字词，如“的”、“什么”等</li>\r\n</div>\r\n<div style=\"margin-top:0px;margin-left:15px;\" id=\"DivPost\"></div>\r\n</div>\r\n";
}
if ( !empty( $wd ) || $is_site != true )
{
		echo "<div style=\"background-color:#EFF2FA;height:60px;width:100%;clear:both;border-top:1px solid #B6CAE3;border-bottom:1px solid #B6CAE3;\">\r\n<table width=\"96%\" height=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n<tr><td style=\"font-size:14px;font-weight:bold;height:40px;width:70px;\">相关搜索</td>\r\n<td rowspan=\"2\" valign=\"middle\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr>\r\n";
		$sql = "select * from ve123_search_keyword where";
		$i = 0;
		for ( ;	$i < $wd_count;	++$i	)
		{
				if ( $i == $wd_count - 1 )
				{
						$sql = $sql." keyword like '%".$wd_array[$i]."%'";
				}
				else
				{
						$sql = $sql." keyword like '%".$wd_array[$i]."%' or ";
				}
		}
		$query = $db->query( $sql." order by hits desc limit 10" );
		$j = 0;
		while ( $row_kw = $db->fetch_array( $query ) )
		{
				++$j;
				echo "<td nowrap class=\"f14\"><a href=\"?wd=";
				echo urlencode( $row_kw['keyword'] );
				echo "\">";
				echo str_cut( $row_kw['keyword'], 10, "" );
				echo "</a></td>\r\n<td nowrap class=\"s\">&nbsp;</td>\r\n";
				if ( $j % 5 == 0 )
				{
						echo "</tr>";
				}
		}
		echo "</tr></table>\r\n</td></tr>\r\n<tr><td>&nbsp;</td></tr></table>\r\n</div><br>\r\n";
}
echo "<table cellpadding=\"0\" cellspacing=\"0\" style=\"margin-left:18px;height:60px;\">\r\n<form name=f2 action=\"./\">\r\n<tr valign=\"middle\">\r\n<td nowrap>\r\n<input name=wd size=\"35\" class=i value=\"";
echo $wd;
echo "\" maxlength=100>\r\n<input type=submit value=";
echo $ve123['name'];
echo "一下>&nbsp;&nbsp;&nbsp;</td>\r\n<td nowrap>&nbsp;</td>\r\n</tr>\r\n</form>\r\n</table>\r\n";
foothtml( );
echo "\r\n";
?>
