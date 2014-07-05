<?php
set_time_limit(0);
//error_reporting(0);
if($_GET["zeidu"]!="ok"){die();}
require "global.php";
?>
<script language="javascript" src="global.js"></script>
<link rel="stylesheet" href="xp.css" type="text/css">
<style>
.iframe_style{border:1px solid #cccccc;width:98%;}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0">
	 <tr>
        <td onClick="ShowMain(1)" bgcolor="#999999" height="25" class='headtd1'>&nbsp;<img src="images/left_5.gif" width="16" height="16"  align="absmiddle"> 自动更新</td>
      </tr>
      <tr>
      <tr>
        <td onClick="ShowMain(2)" bgcolor="#999999" height="25" class='headtd1'>&nbsp;<img src="images/left_5.gif" width="16" height="16"  align="absmiddle"> 寻找新站</td>
      </tr>
      <tr>
        <td onClick="ShowMain(3)" bgcolor="#999999" height="25" class='headtd1'>&nbsp;<img src="images/left_5.gif" width="16" height="16"  align="absmiddle"> <a href="sites.php" target="sites">站点管理</a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>	</td>
    <td valign="top">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div class="iframe_style" style="padding:10px;"><a href="javascript:window.history.go('-1');">返回上一步</a></div><br></td>
      </tr>
      <tr>
        <td>
<div id="main_1" style="display:none">
<iframe src="start.php?action=auto_update" class="iframe_style" id="auto_update" name="auto_update" height="250"></iframe>
<iframe src="start.php?action=add_in_site_link" class="iframe_style" id="add_in_site_link" name="add_in_site_link" height="250"></iframe>
</div>
<div id="main_2" style="display:none"><iframe src="start.php?action=findsite" class="iframe_style" id="findsite" name="findsite" scrolling="no" height="450"></iframe></div>
<div id="main_3" style="display:none"><iframe src="sites.php" class="iframe_style" id="sites" name="sites" height="450"></iframe></div>
		</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php
 foothtml();
?>
</body>
</html>
<script language=javascript>
///显示菜单
function ShowMain(main_id)
{
	document.all['main_1'].style.display="none";
	document.all['main_2'].style.display="none";
	document.all['main_3'].style.display="none";
	document.all['main_'+main_id].style.display="";
	
}
ShowMain(1);
</script>