<?php
require "global.php";
headhtml();
?>
<div class="nav" style="display:none;"><a href="?">首页</a><a href="?action=addform&p_cid=<?php echo $p_cid?>">添加</a></div>
<?php
$action=$_GET["action"];
switch ($action)
{
    case "saveform":
    saveform();
    break;

    case "addform":
	addform($action);
	break;
	
	case "modify":
	addform($action);
	break;
	
	case "del":
	$db->query("delete from ve123_zz_user where user_id='".intval($_GET["user_id"])."'");
	break;
}	
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="50">ID</th>
    <th>用户名</th>
    <th width="80">积分</th>
    <th width="80">邮箱</th>
    <th width="80">操作</th>
  </tr>
  <?php
  $result=$db->query("select * from ve123_zz_user");
  while ($rs=$db->fetch_array($result))
  {
  ?>
  <tr>
    <td><?php echo $rs["user_id"]?></td>
    <td><?php echo $rs["user_name"];?></td>
    <td><?php echo $rs["points"];?></td>
    <td><?php echo $rs["email"];?></td>
    <td>
	<a href="?action=modify&user_id=<?php echo $rs["user_id"];?>">修改</a>&nbsp;&nbsp;
	<a href="?action=del&user_id=<?php echo $rs["user_id"];?>" onClick="if(!confirm('确定删除吗?')) return false;">删除</a></td>
  </tr>
  <?php
  }
  ?>
</table>

<?php
function addform($do_action)
{
global $db,$p_cid;
  if ($do_action=="modify")
  {
      $user_id=intval($_GET["user_id"]);
	  $sql="select * from ve123_zz_user where user_id='$user_id'";
	  $rs=$db->get_one($sql);
	  $user_name=$rs["user_name"];
	  $email=$rs["email"];
	  $points=$rs["points"];
	  $sort_id=$rs["sort_id"];
	  $btn_txt="确定修改";
  }
  else
  {
     $btn_txt="确定添加";
  }
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td width="100">用户名:</td>
    <td>
      <input name="user_name" type="text" value="<?php echo $user_name?>" size="50" /></td>
  </tr>
  <tr>
    <td>积分:</td>
    <td><input name="points" type="text" value="<?php echo $points?>" size="50" /></td>
  </tr>
  <tr>
    <td>邮箱:</td>
    <td><input name="email" type="text" size="50"  value="<?php echo $email?>"/></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="user_id" value="<?php echo $user_id?>">
	<input type="hidden" name="do_action" value="<?php echo $do_action?>">
	<input type="submit" name="Submit" value="<?php echo $btn_txt?>" />	</td>
  </tr>
  </form>
</table>
<?php
}
?>

<?php
function saveform()
{
global $db;
   $user_name=trim($_POST["user_name"]);
   $email=trim($_POST["email"]);
   $points=trim($_POST["points"]);
   $user_id=intval($_POST["user_id"]);
   $do_action=$_POST["do_action"];
   if ($do_action=="modify")
   {
	 $array=array('user_name'=>$user_name,'email'=>$email,'points'=>$points);
	 $db->update("ve123_zz_user",$array,"user_id='$user_id'");
	 jsalert("修改成功");
   }
   else
   {     
             $array=array('user_name'=>$user_name,'email'=>$email,'points'=>$points);
	         $db->insert("ve123_zz_user",$array);  
			 jsalert("提交成功");
   }
}
?>

