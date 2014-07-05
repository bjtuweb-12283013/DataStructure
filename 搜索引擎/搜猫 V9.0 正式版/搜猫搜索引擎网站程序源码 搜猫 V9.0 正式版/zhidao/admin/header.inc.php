<?php
/*
	[CYASK] (C)2009 Cyask.com
	Revision: 3.2
	Date: 2009-1-19
	Author: zhaoshunyao
	QQ: 240508015
*/

@header('Content-Type: text/html; charset='.$charset);
?>
<html>
<head>
<style type="text/css">
<!--
a			{ text-decoration: none; color: #003366 }
a:hover			{ text-decoration: underline }
body			{ scrollbar-base-color: #F8F8F8; scrollbar-arrow-color: #698CC3; font-size: 12px; background-color: #9EB6D8 }
table			{ font: 12px Tahoma, Verdana; color: #000000 }
input,select,textarea	{ font: 11px Tahoma, Verdana; color: #000000; font-weight: normal; background-color: #F8F8F8 }
form			{ margin: 0; padding: 0}
select			{ font: 11px Arial, Tahoma; color: #000000; font-weight: normal; background-color: #F8F8F8 }
.nav			{ font: 12px Tahoma, Verdana; color: #000000; font-weight: bold }
.nav a			{ color: #000000 }
.header			{ font: 11px Tahoma, Verdana; color: #FFFFFF; font-weight: bold; background-color: #698CC3 }
.header a		{ color: #FFFFFF }
.category		{ font: 11px Arial, Tahoma; color: #000000; background-color: #EFEFEF }
.tableborder		{ background: #D6E0EF; border: 1px solid #698CC3 } 
.singleborder		{ font-size: 0px; line-height: 1px; padding: 0px; background-color: #F8F8F8 }
.smalltxt		{ font: 11px Arial, Tahoma }
.outertxt		{ font: 12px Tahoma, Verdana; color: #000000 }
.outertxt a		{ color: #000000 }
.bold			{ font-weight: bold }
.altbg1			{ background: #F8F8F8 }
.altbg2			{ background: #FFFFFF }
.maintable		{ width: 98%; background-color: #FFFFFF }
-->
</style>
</head>
<body leftmargin="0" topmargin="0">
<table cellspacing="0" cellpadding="2" border="0" width="100%" height="100%">
<tr valign="middle" class="smalltxt">
<td width="138" height="30" align="center"><a href="http://www.cyask.com" target="_blank"><?php echo $lang['header_offical'];?></a></TD>
<td width="60%" align="center" valign="middle"><font size="2" color="#ffffff"><b><?php echo $lang['header_csm'];?> v<?php echo $version;?></b></font></td>
<td width="20%" align="right"><a href="./" target="_blank"><?php echo $lang['header_home']?></a>&nbsp;&nbsp;&nbsp;&nbsp;</TD>
</tr>
</table>
</body>
</html>