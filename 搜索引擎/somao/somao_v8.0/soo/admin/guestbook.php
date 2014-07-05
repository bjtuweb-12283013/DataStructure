<?php
require "global.php";
headhtml();
?>
<div class="nav" style="display:;"><a href="?action=addform">添加</a></div>
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
	     $gid=intval($_GET["gid"]);
		 $db->query("delete from ve123_guestbook where gid='".$gid."'");
	break;
}	
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="100">ID</th>
    <th width="100">标题</th>
    <th>内容</th>
    <th width="80">日期</th>
    <th width="80">IP</th>
    <th width="80">操作</th>
  </tr>
  <?php
      if($action=="viewreply")
	  {
	      $replyid=intval($_GET["gid"]);
		  $sql="select * from ve123_guestbook where replyid='".$replyid."'";
	  }
	  else
	  {
	      $sql="select * from ve123_guestbook where replyid='0'";
	  }
      $result=$db->query($sql);
      $total=$db->num_rows($result);//记录总数
      $pagesize=30;//每页显示数
      $totalpage=ceil($total/$pagesize);
      $page=intval($_GET["page"]);
      if($page<=0){$page=1;}
      $offset=($page-1)*$pagesize;
      $result=$db->query($sql." order by gid desc limit $offset,$pagesize");
  while ($rs=$db->fetch_array($result))
  {
  ?>
  <tr>
    <td><?php echo $rs["gid"]?></td>
    <td><a href="?action=viewreply&gid=<?php echo $rs["gid"];?>" title="查看所有回复"><?php echo $rs["title"]?></a></td>
    <td><?php echo str_cut($rs["content"],100);?></td>
    <td><?php echo date("Y-m-d H:i:s",$rs["addtime"]);?></td>
    <td><?php echo $rs["ip"];?></td>
    <td><a href="?action=modify&amp;gid=<?php echo $rs["gid"]?>">修改</a>
	<a href="?action=del&gid=<?php echo $rs["gid"];?>" onclick="if(!confirm('确认删除码?')) return false;">删除</a>	</td>
  </tr>
  <?php
  }
  ?>
</table>
<?php
echo pageshow($page,$totalpage,$total,"?");
?>
<?php
function addform($do_action)
{
global $db;
  if ($do_action=="modify")
  {
      $gid=$_GET["gid"];
	  $sql="select * from ve123_guestbook where gid='$gid'";
	  $rs=$db->get_one($sql);
	  $title=$rs["title"];
	  $content=$rs["content"];
	  $btn_txt="确定修改";
  }
  else
  {
     $btn_txt="确定提交";
  }
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td width="100">标题:</td>
    <td>
      <input type="text" name="title" value="<?php echo $title?>"/>    </td>
  </tr>
  <tr>
    <td>详细说明:</td>
    <td><textarea name="content" cols="80" rows="8"><?php echo $content;?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="gid" value="<?php echo $gid?>">
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
   $title=trim($_POST["title"]);
   $content=trim($_POST["content"]);
   $gid=$_POST["gid"];
   $do_action=$_POST["do_action"];
   if ($do_action=="modify")
   {
     $array=array('title'=>$title,'content'=>$content);
	 $db->update("ve123_guestbook",$array,"gid='$gid'");
	 jsalert("修改成功");
   }
   else
   {
     $array=array('title'=>$title,'content'=>$content);
	 $db->insert("ve123_guestbook",$array);
     jsalert("提交成功");
   }
}
?>

