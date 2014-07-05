<?php
require("../global.php");
$user_name=HtmlReplace($_POST["user_name"]);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $config["name"];?>开放平台--找回密码</title>
<link href="images/reg.css" rel="stylesheet" type="text/css"></head>
<body>
<center>
  <div  id="main" align="left">
    <table width="100%"  border="0" cellspacing="0" cellpadding="0" id="hd">
      <tr>
        <td width="46" valign="top"><a href="./"><img src="../images/log.gif" width="117" height="50" border="0" align="absmiddle" class="lg"></a></td>
        <td width="938" valign="top"><div class="tt">
            <div class="r">&nbsp;</div>
        <strong>找回密码</strong></div></td>
      </tr>
    </table>
    <br>
	<div class="pad_1">
		  <p><strong>找回密码:</strong> <img src="images/ico6_1.gif" align="absmiddle">&nbsp;&nbsp;输入用户名&nbsp;&nbsp;&nbsp;&nbsp;2 回答密码答案&nbsp;&nbsp;&nbsp;&nbsp;3 输入新的密码<br>
		    <br>
	      <img src="images/ico6_7.gif" align="absmiddle">&nbsp;&nbsp;<span class="col_1">请输入下面的信息，以帮助您快速找回密码。</span></p>
          <form name="form1" method="post" action="">
		  <?php
		  if(empty($user_name))
		  {
		  ?>
            1．用户名： 
            <input type="text" name="user_name">
            <input type="submit" name="Submit" value="下一步">
		<?php
		}
		else
		{
		   $user=$db->get_one("select * from ve123_zz_user where user_name='".$user_name."'");
		   if(empty($user))
		   {
		       echo "<font class=\"error\">".$user_name."&nbsp;&nbsp;用户不存在.</font><br><br><a href=\"?\">返回第一步</a>";
		   }
		   else
		   {
		       $answer=HtmlReplace(trim($_POST["answer"]));
		       ?>
			   <input type="hidden" name="user_name" value="<?php echo $user_name;?>">
			   2．找回密码问题：<?php echo $user["question"];?><br>
			   2．找回密码答案：
			   <input type="text" name="answer" value="<?php echo $answer;?>">
			   <input type="submit" name="Submit" value="下一步">
			   <?php
			   
			   if(!empty($answer))
			   {
			      $sql="select * from ve123_zz_user where user_name='".$user_name."' and answer='$answer'";//echo $sql;
			      $row=$db->get_one($sql);
				  if(empty($row))
				  {
				      echo "<br><br><font class=\"error\">找回密码答案不正确!</font>";
				  }
				  else
				  {
				      ?>
					  <br>
					  <br>
					  3．回复正确<br>
					  3．请输入新的密码：<input type="text" name="password">
					  <input type="submit" name="Submit" value="确定">
					  <?php
					  $password=HtmlReplace(trim($_POST["password"]));
					  if(!empty($password))
					  {
					     $array=array('password'=>md5($password));
					     $db->update("ve123_zz_user",$array,"user_name='".$user_name."'and answer='$answer'");
					     echo "<br>恭喜,修改成功!&nbsp;&nbsp;<a href=\"login.php\">点击登录</a>";
					  }
				  }
			   }
		   }
		
		}
		?>
          </form>
          <p><span class="col_1"><br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br>
          </p>
	</div>
		  
</div>
</center>
</body>
</html>