<?php
echo '<html><head><meta http-equiv=content-type content="text/html;charset=gb2312">
<title>';echo Html2Text($title).'--'.$config['name'];;echo '</title>
<style>
<!--
body{margin:0px;font-size:12px;font-family:Arial;line-height:180%}
td{font-size:12px;}
img{border:0}
.b{border:1px solid #A1C0DC;margin-bottom:8px;}
.b a{text-decoration:none;}
.b a:hover{text-decoration:underline;}
.b1{padding:4px 0 4px 10px;}
.b2{padding:6px 5px 4px 10px;font-size:14px;line-height:150%}
.b2 img{border:1px solid #D0E3F2;}
-->
</style>

<table width=910 border=0 align="center" cellpadding=0 cellspacing=0>
  <td height=3 bgcolor=005CCD></td>
</table>
<br>
<table width=910 border=0 align="center" cellpadding=0 cellspacing=0>
  <tr>
    <td width=117 rowspan=3><a href="';echo $config['url'];echo '"><img src="';echo $config['url'].'/images/log.gif';;echo '" width="117" height="50"></a></td>
    <td width=793 height=37 align=right valign=bottom style="font-size:14px;font-weight:bold;"><span class="b1">';echo $title;;echo '</span></td>
  </tr>
  <tr>
    <td height=1 bgcolor=D0E3F2></td>
  </tr>
  <tr>
    <td height=13></td>
  </tr>
</table>
<br>
<table width=910 align="center" cellpadding=0 cellspacing=1 bgcolor=D0E3F2 style="margin-bottom:8px;">
  <td bgcolor=E6F4FF class=b1><a href="';echo $config['url'];;echo '">';echo $config['name'];;echo '首页</a>&nbsp;&gt;&nbsp;';echo $title;;echo '</td>
</table>
<table width=910 align="center" cellpadding=0 cellspacing=0 class=b>
  
  <tr>
    <td valign=top class=b2>';echo $content;;echo '</td>
  </tr>
</table>


</div>

<div align=center class="center blue" style="padding:18px 0px 18px 0px;">Copyright ';echo $config['copyright'];;echo '&nbsp;&nbsp;</div>
</body></html>';
?>