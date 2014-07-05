<?php

set_time_limit( 0 );
if ( $_GET['somao'] != 'ok')
{
exit( );
}
require( 'global.php');
;echo '<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="Refresh" content="18000" > 
<script language="javascript" src="global.js"></script>
<link rel="stylesheet" href="xp.css" type="text/css">
<style> 
.iframe_style{border:1px solid #cccccc;width:100%;}
</style>
</head>
 
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" id="zuobian" name="zuobian" valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0">
	   <tr>
        <td onClick="ShowMain(1)" bgcolor="#999999" height="25" class=\'headtd1\'>&nbsp;<img src="images/left_5.gif" width="16" height="16"  align="absmiddle"> 自动抓取</td>
      </tr>
    <tr>
        <td onClick="ShowMain(4)" bgcolor="#999999" height="25" class=\'headtd1\'>&nbsp;<img src="images/left_5.gif" width="16" height="16"  align="absmiddle"> 自动更新</td>
      </tr>
	       <tr>
      <tr>
        <td onClick="ShowMain(3)" bgcolor="#999999" height="25" class=\'headtd1\'>&nbsp;<img src="images/left_5.gif" width="16" height="16"  align="absmiddle"> <a href="sites.php" target="sites">站点管理</a></td>
      </tr>
      <tr>
        <td onClick="ShowMain(3)" bgcolor="#999999" height="25" class=\'headtd1\'>&nbsp;<img src="images/left_5.gif" width="16" height="16"  align="absmiddle"> <a href="sites.php?action=addform" target="sites">手工添加</a></td>
      </tr>
     <tr>
        <td onClick="ShowMain(2)" bgcolor="#999999" height="25" class=\'headtd1\'>&nbsp;<img src="images/left_5.gif" width="16" height="16"  align="absmiddle">  <a href="find.php?action=addform" target="find">一键找站</a></td>
      </tr>
       <tr>
        <td height="50">　　默认刷新时间:<br>　　每隔5小时爬行一次</td>
      </tr>
       <tr>
        <td>　<input type="button" value="断点续爬" name="stop" onClick="javascript:document.execCommand(\'Refresh\');">　
        <input type="button" value="停止爬行" name="stop" onClick="javascript:document.execCommand(\'stop\');"></td>
      </tr>
    </table>	</td>
	
	    <td width="6" class="f"><img  style="cursor:hand" onClick="l();" src="images/l.jpg" alt="关闭/打开左栏" name="ls" width="6" height="60" id="ls"></td>
		
		
    <td valign="top">
 
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div class="iframe_style" style="padding:10px;"><a href="javascript:window.history.go(\'-1\');">返回上一步</a></div>
          <br></td>
      </tr>
      <tr>
        <td>
<div id="main_1" style="display:none"><iframe src="start.php?action=add_all_site_link" class="iframe_style" id="add_in_site_link" name="add_in_site_link" height="530"></iframe></div>
<div id="main_4" style="display:none"><iframe src="start.php?action=auto_update" class="iframe_style" id="auto_update" name="auto_update" height="530"></iframe></div>
<div id="main_2" style="display:none"><iframe src="find.php" class="iframe_style" id="find" name="find" height="530"></iframe></div>
<div id="main_3" style="display:none"><iframe src="sites.php" class="iframe_style" id="sites" name="sites" height="530"></iframe></div>
		</td>
      </tr>
    </table></td>
  </tr>
</table>
';
foothtml( );
;echo '</body>
</html>
<script language=javascript> 
///显示菜单
function ShowMain(main_id)
{
	document.all[\'main_2\'].style.display="none";
	document.all[\'main_1\'].style.display="none";
	document.all[\'main_3\'].style.display="none";
	document.all[\'main_4\'].style.display="none";
	document.all[\'main_\'+main_id].style.display="";
	
}
ShowMain(1);

function l(){
     if (document.getElementById("zuobian").style.display=="none"){
		 document.all.ls.src= \'images/l.jpg\';
          document.all("zuobian").style.display=""
     }
     else{
		    document.all.ls.src= \'images/r.jpg\';
          document.all("zuobian").style.display="none"
     }
}
</script>
'
?>