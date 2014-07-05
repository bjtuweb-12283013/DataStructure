<?php
require "global.php";
headhtml();
?>
<div class="nav" style="display:;"><a href="?">首页</a><a href="?action=addform&p_cid=<?php echo $p_cid?>">添加</a></div>
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
	$db->query("delete from ve123_dh_goodlinks where link_id='".intval($_GET["link_id"])."'");
	break;
}	
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="50">ID</th>
    <th>分类名称</th>
    <th width="80">操作</th>
  </tr>
  <?php
  $result=$db->query("select * from ve123_dh_goodlinks");
  while ($rs=$db->fetch_array($result))
  {
  ?>
  <tr>
    <td><?php echo $rs["link_id"]?></td>
    <td><?php echo $rs["title"];?></td>
    <td><a href="?action=modify&link_id=<?php echo $rs["link_id"];?>">修改</a>&nbsp;&nbsp;<a href="?action=del&link_id=<?php echo $rs["link_id"];?>" onClick="if(!confirm('确定删除吗?')) return false;">删除</a></td>
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
      $link_id=intval($_GET["link_id"]);
	  $sql="select * from ve123_dh_goodlinks where link_id='$link_id'";
	  $rs=$db->get_one($sql);
	  $title=$rs["title"];
	  $url=$rs["url"];
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
    <td width="100">名称:</td>
    <td>
      <input name="title" type="text" value="<?php echo $title?>" size="50" /></td>
  </tr>
  <tr>
    <td>网址:</td>
    <td><input name="url" type="text" size="50"  value="<?php echo $url?>"/></td>
  </tr>
  <tr>
    <td>排序ID:</td>
    <td><input type="text" name="sort_id" value="<?php echo $sort_id?>"/></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="link_id" value="<?php echo $link_id?>">
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
   $url=trim($_POST["url"]);
   $sort_id=intval($_POST["sort_id"]);
   $link_id=intval($_POST["link_id"]);
   $do_action=$_POST["do_action"];
   if ($do_action=="modify")
   {
	 $array=array('title'=>$title,'url'=>$url,'sort_id'=>$sort_id);
	 $db->update("ve123_dh_goodlinks",$array,"link_id='$link_id'");
	 jsalert("修改成功");
   }
   else
   {     
             $array=array('title'=>$title,'url'=>$url,'sort_id'=>$sort_id);
	         $db->insert("ve123_dh_goodlinks",$array);  
			 jsalert("提交成功");
   }
}
?>

