<?php
require_once("global.php");
is_login();
$pagetitle="账户信息";
$action=$_REQUEST["action"];
switch($action)
{
     case "saveinfo":
	       $email=HtmlReplace($_POST["email"]);
		   $question=HtmlReplace($_POST["question"]);
		   $answer=HtmlReplace(trim($_POST["answer"]));
		   if(empty($answer))
		   {
		        $array=array('email'=>$email,'question'=>$question);
		   }
		   else
		   {
		        $array=array('email'=>$email,'question'=>$question,'answer'=>md5($answer));
		   }
		   $db->update("ve123_zz_user",$array,"user_name='".$user["user_name"]."'");
		   header("location:account.php?msg=".urlencode("修改信息成功"));
	 break;
	 case "saveepw":
	       $oldpassword=trim(HtmlReplace($_POST["oldpassword"]));
		   $newpassword=trim(HtmlReplace($_POST["newpassword"]));
		   $array=array('email'=>$email);
		   if(md5($oldpassword)!=$user["password"])
		   {
		        header("location:account.php?action=epw&msg=".urlencode("旧密码不正确，请确认再输入!"));
		   }
		   else
		   {
		      $array=array('password'=>md5($newpassword));
		      $db->update("ve123_zz_user",$array,"user_name='".$user["user_name"]."'");
			   header("location:account.php?action=epw&msg=".urlencode("更新密码成功!"));
		   }
	 break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>首页--<?php echo $pagetitle;?></title>
        <link type="text/css" rel="stylesheet" media="all" href="images/global.css" />     
	</head>
	<body>
<?php
headhtml();
?>        	    
<div class="wrapper">
<?php
if($action=="")
{
?>
	<table width="100%" border="1" cellspacing="0" cellpadding="0" class="">
	<form name="form1" method="post" action="account.php">
	<input type="hidden" name="action" value="saveinfo">
    <tr>
      <td>&nbsp;</td>
      <td style='color:#f00;'><?php
			$msg=HtmlReplace($_GET["msg"]);
			if(empty($msg))
			{
			   echo "修改个人信息";
			}
			else
			{
			    echo $msg;
			}
			?></td>
    </tr>
    <tr>
    <td width="100">用户名：</td>
    <td><?php echo $user["user_name"];?></td>
  </tr>
  <tr>
    <td>联系人姓名：</td>
    <td><?php echo $user["real_name"];?></td>
  </tr>
  <tr>
    <td>电子邮件 ： </td>
    <td><input type="text" name="email" value="<?php echo $user["email"];?>"></td>
  </tr>
    <tr>
    <td>找回密码问题：</td>
    <td><input name="question" type="text" size="60"  value="<?php echo $user["question"];?>"/></td>
  </tr>
  <tr>
    <td>找回密码答案：</td>
    <td><input name="answer" type="text" size="60" />
      (如不修改试表留空)</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="提交"></td>
  </tr></form>
</table>
<?php
}
elseif($action=="epw")
{
?>
<table width="100%" border="1" cellspacing="0" cellpadding="0" class="">
<form id="form2" name="form2" method="post" action="account.php">
<input type="hidden" name="action" value="saveepw" />
  <tr>
    <td width="100">&nbsp;</td>
    <td style='color:#f00;'>
	<?php
			$msg=HtmlReplace($_GET["msg"]);
			if(empty($msg))
			{
			   echo "修改你的密码";
			}
			else
			{
			    echo $msg;
			}
			?>	</td>
  </tr>
  <tr>
    <td>原密码：</td>
    <td><input type="text" name="oldpassword" /></td>
  </tr>
  <tr>
    <td>新密码：</td>
    <td><input type="text" name="newpassword" /></td>
  </tr>
  <tr>
    <td>确定新密码：</td>
    <td><input type="text" name="newpassword2" /></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit2" value="提交" /></td>
  </tr>
  </form>
</table>

<?php
}
?>
<?php
foothtml();
?>