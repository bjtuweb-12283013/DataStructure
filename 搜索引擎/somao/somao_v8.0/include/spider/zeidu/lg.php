<?php
require "../../../global.php";
require_once("global_func.php");
  $action=$_GET["action"];
 switch($action)
 {
    case "checklogin":
	checklogin();
    break;
	
	case "logou":
	logou();
	break;
 }
   function checklogin()
  {
     global $db;
     $adminname=htmlspecialchars($_POST["adminname"]);
	 $password=htmlspecialchars($_POST["password"]);
	 $result=$db->query("select * from ve123_admin where adminname='$adminname' and password='$password'");
	 $num=$db->num_rows($result);
	 if ($num>0)
	    {
		    $rs=$db->fetch_array($result);
			$array=array('lastloginip'=>$rs["loginip"],'loginip'=>ip(),'lastlogintime'=>$rs["logintime"],'logintime'=>date("Y-y-d H:i:s"));
			$db->update("ve123_admin",$array,"admin_id=$rs[admin_id]");
			setcookie("adminname",$adminname);
			header("location:index.php?zeidu=ok");
		}
	 else
	   {
	       jsalert("用户名或密码错误!","login.php");
	   }
	   
  }
  
  function logou()
  {
     setcookie("adminname","",time()-3600);
	 header("location:login.php");
  }
?>
<link rel="stylesheet" href="xp.css" type="text/css">
</style>
</head>

<body>
<table width="300" border="1" align="center" cellpadding="5" cellspacing="0" bordercolordark="#FFFFFF" bordercolor="888888" style="margin-top:100px;">
<form id="adminloginform" name="adminloginform" method="post" action="?action=checklogin">
  <tr>
    <th colspan="2" class="tbtitle">后台管理系统</th>
  </tr>
  <tr>
    <td width="100">登录名称:</td>
    <td><input name="adminname" type="text" style="width:150px;"/></td>
  </tr>
  <tr>
    <td>登录密码:</td>
    <td><input name="password" type="password" style="width:150px;"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
      <input type="submit" name="Submit" value="提交" />    </td>
  </tr></form>
</table>
<script language="javascript">
if (top.location != location) top.location.href = location.href;
self.moveTo(0,0);
self.resizeTo(screen.availWidth,screen.availHeight);
adminloginform.adminname.focus();
</script>
<?php
 foothtml();
?>
</body>
</html>
