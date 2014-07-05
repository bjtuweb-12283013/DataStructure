<?php
require "global.php";
headhtml();
$ad_class=array('1'=>'搜索页右侧低部','2'=>'搜索页右侧(有说明显示)','3'=>'首页广告位');
$type=intval($_GET["type"]);
?>
<div class="nav" style="display:;"><a href="?action=addform&type=<?php echo $type;?>">添加</a></div>
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
	     $ad_id=intval($_GET["ad_id"]);
		 $db->query("delete from ve123_ad where ad_id='".$ad_id."'");
	break;
}	
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg  class_nav" style="display:none">
  <tr>
    <td>
	<?php
	foreach($ad_class as $key=>$value)
	{
	     if($type==$key)
		 {
		    $class=" class=\"selectstyle\"";
		 }
		 else
		 {
		    $class="";
		 }
	     echo "<a".$class." href=\"?type=".$key."\">".$value."</a>";
	}
	?></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg  class_nav">
  <tr>
    <td><?php echo $ad_class[$type];?></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">

  <tr>
    <th width="100">ID</th>
    <th width="100">网站名称</th>
    <th>链接地址</th>
    <th width="80">是否显示</th>
    <th width="80">排序ID</th>
    <th width="80">操作</th>
  </tr>
  <?php
  if(!empty($type))
  {
     $where=" where type='".$type."'";
  }
  $sql="select * from ve123_ad".$where." order by sortid asc";
 // echo $sql;
  $result=$db->query($sql);
  while ($rs=$db->fetch_array($result))
  {
  ?>
  <tr>
    <td><?php echo $rs["ad_id"]?></td>
    <td><?php echo $rs["title"]?></td>
    <td><?php echo "<a href=\"".$rs["siteurl"]."\" target=\"_blank\">".$rs["siteurl"]."</a>";?></td>
    <td>
	<?php
	  if($rs["is_show"])
	  {
	    echo "√";
	  }
	  else
	  {
	    echo "<font color=\"red\">×</font>";
	  }
	?>
	</td>
    <td><?php echo $rs["sortid"];?></td>
    <td><a href="?action=modify&amp;ad_id=<?php echo $rs["ad_id"]?>&type=<?php echo $rs["type"];?>">修改</a>
	<a href="?action=del&ad_id=<?php echo $rs["ad_id"];?>" onclick="if(!confirm('确认删除码?')) return false;">删除</a>	</td>
  </tr>
  <?php
  }
  ?>
</table>

<?php
function addform($do_action)
{
global $db,$type;
  if ($do_action=="modify")
  {
      $ad_id=$_GET["ad_id"];
	  $sql="select * from ve123_ad where ad_id='$ad_id'";
	  $rs=$db->get_one($sql);
	  $title=$rs["title"];
	  $siteurl=$rs["siteurl"];
	  $type=$rs["type"];
	  $content=$rs["content"];
	  $sortid=$rs["sortid"];
	  $is_show=$rs["is_show"];
	  $btn_txt="确定修改";
  }
  else
  {
     $btn_txt="确定提交";
	 $is_show=1;
  }
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=saveform">
  <tr>
    <td width="100">网站名称:</td>
    <td>
      <input name="title" type="text" value="<?php echo $title?>" size="80"/>    </td>
  </tr>
  <tr>
    <td>链接地址:</td>
    <td><input name="siteurl" type="text" value="<?php echo $siteurl?>" size="80" /></td>
  </tr>
  <tr <?php if($do_action=="modify"){echo "style=\"display:none;\"";}?>>
    <td>显示类型:</td>
    <td><input name="type" type="radio" value="1" <?php if($type==1) echo "checked=\"checked\"";?> />
    搜索页右侧
      <input type="radio" name="type" value="2" <?php if($type==2) echo "checked=\"checked\"";?>/>
      搜索页右侧(有说明显示)
	   <input type="radio" name="type" value="3" <?php if($type==3) echo "checked=\"checked\"";?>/>
      首页广告位	  </td>
  </tr>
  <tr>
    <td>排序ID:</td>
    <td><input type="text" name="sortid"  value="<?php echo $sortid?>"/></td>
  </tr>
  <tr>
    <td>是否显示:</td>
    <td><input name="is_show" type="checkbox" value="1" <?php if($is_show){echo "checked=\"checked\"";}?> /></td>
  </tr>
  <tr>
    <td>详细说明:</td>
    <td><textarea name="content" cols="80" rows="8"><?php echo $content;?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<input type="hidden" name="ad_id" value="<?php echo $ad_id?>">
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
   $siteurl=trim($_POST["siteurl"]);
   $type=trim($_POST["type"]);
   $content=trim($_POST["content"]);
   $ad_id=$_POST["ad_id"];
   $sortid=intval($_POST["sortid"]);
   $is_show=intval($_POST["is_show"]);
   $do_action=$_POST["do_action"];
   if ($do_action=="modify")
   {
     $array=array('title'=>$title,'siteurl'=>$siteurl,'type'=>$type,'content'=>$content,'sortid'=>$sortid,'is_show'=>$is_show);
	 $db->update("ve123_ad",$array,"ad_id='$ad_id'");
	 jsalert("修改成功");
   }
   else
   {
     $array=array('title'=>$title,'siteurl'=>$siteurl,'type'=>$type,'content'=>$content,'sortid'=>$sortid,'is_show'=>$is_show);
	 $db->insert("ve123_ad",$array);
     jsalert("提交成功");
   }
}
?>

