<?php
require "global.php";
headhtml();
$sqlcode=stripslashes($_POST["sqlcode"]);
?>
<table width="100%" border="0" cellspacing="1" cellpadding="3" class="tablebg">
<form id="form1" name="form1" method="post" action="?action=runsql">
  <tr>

    <th>SQL工具</th>
  </tr>
  <tr>
 
    <td align="center">
      <textarea name="sqlcode" rows="6" style="width:100%;"><?php echo $sqlcode?></textarea>    </td>
  </tr>
  <tr>

    <td align="center"><input type="submit" name="Submit" value="提交" /></td>
  </tr>
 </form> 
</table>
	<?php
	$action=$_GET["action"];
	if ($action=="runsql")
	{
	 $result=mysql_query($sqlcode);
	 $data=array();
	 while ($r=mysql_fetch_array($result,MYSQL_ASSOC)) $data[]=$r;
	}
	?>
	
<?php if($data){?>
<table width="100%" border="0" cellspacing="1" cellpadding="3" class="tablebg">
	<tr>
	<?php foreach($data[0] as $k=>$v){?>
		<th><?=$k?></th>
	<?php }?>
	</tr>
	<?php foreach($data as $row){?>
		<tr>
			<?php foreach($row as $v){?>
				<td><?=$v?></td>
			<?php }?>
		</tr>
	<?php }?>
</table>
<?php
}
?>

