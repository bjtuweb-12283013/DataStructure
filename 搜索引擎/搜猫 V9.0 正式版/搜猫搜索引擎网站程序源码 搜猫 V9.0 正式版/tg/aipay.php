<?php

require_once('global.php');
is_login();
$uname=$user['user_name'];
$action=$_REQUEST['action'];
$cardid=$_REQUEST['cardid'];
$row3 = $db->get_one("select * from ve123_zz_user where user_name='$uname'");
$uid = $row3['user_id'];
$points  = $row3['points'];
if($action=='save'){
$imagecode=trim(HtmlReplace($_POST['entered_imagecode']));
if($_SESSION['dd_ckstr']!=$imagecode)
{
echo "<script> alert('验证码错误！') ; history.go(-1);</script>";
exit();
}
$cardid = preg_replace('#[^0-9A-Za-z-]#','',$cardid);
if(empty($cardid))
{
echo "<script> alert('卡号为空！！'); history.go(-1);</script>";
exit();
}
$row = $db->get_one("select * from ve123_moneycard_record where cardid='$cardid'");
if(!is_array($row))
{
echo "<script> alert('卡号错误：不存在此卡号！');history.go(-1); </script>";
exit();
}
if($row['isexp']==-1)
{
echo "<script> alert('此卡号已经失效，不能再次使用！'); history.go(-1);</script>";
exit();
}
$hasMoney = $row['num'];
$utime=time();
$point=$hasMoney+$points;
$array=array('uid'=>$uid,'isexp'=>-1,'utime'=>$utime);
$db->update('ve123_moneycard_record',$array,"cardid='$cardid'");
$array2=array('points'=>$point);
$db->update('ve123_zz_user',$array2,"user_name='$uname'");
$array3=array('card'=>$cardid,'price'=>$hasMoney,'uid'=>$uid,'time'=>$utime);
$db->insert('ve123_card_orders',$array3);
echo "<script> alert('充值成功，你本次增加的金币为：{$hasMoney} 个！');history.go(-1); </script>";
exit();
}
;echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>首页</title>
        <link type="text/css" rel="stylesheet" media="all" href="images/global.css" />     
	</head>
	<body>
';
headhtml();
;echo '        	    
<div class="wrapper">
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>
<h3 class="meTitle">用充值卡充值</h3>
        <form name="formrank" action="" method="post">
           <input type="hidden" name="action" value="save">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
				<tbody>
					<tr>
						<td width="15%" align="right" valign="top">充值卡密码：</td>
						<td><input name="cardid" type="text" id="cardid" size="38" class="intxt" style="width:200px"/></td>
					</tr>
					<tr>
						<td align="right" valign="top">验证码：</td>
						<td><input name="entered_imagecode" type="text" id="entered_imagecode"  size="8" class="intxt" style=\'width:50px;text-transform:uppercase;\' />
							<img src="../include/vdimgck.php" alt="看不清？点击更换" align="absmiddle" style="cursor:pointer" onclick="this.src=this.src+\'?\'" />
                        </td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td align="right" valign="top">&nbsp;</td>
						<td><button class="button2 mt5" type="submit">充值</button></td>
					</tr>
				</tfoot>
			</table>
      </form>

    
    </td>
  </tr>
</table>

<table border=0 cellspacing=1 cellpadding=3 class="tablebg">
  <tr>
    <th>充值卡号</th>
    <th>充值金额</th>
    <th>充值时间</th>
  </tr>
  ';
$query=$db->query("SELECT * FROM `ve123_card_orders` where uid='$uid' LIMIT 0 , 30 ");
while($link=$db->fetch_array($query))
{
;echo '  <tr align="center">
    <td>';echo $link['card'];;echo '</td>
    <td>';echo $link['price'];;echo '&nbsp;积分</td>
    <td>';echo MyDate('Y-m-d  H:i:s',$link['time']);echo '</td>
  </tr>

  ';
}
;echo '</table>

';
function MyDate($format='Y-m-d H:i:s',$timest=0)
{
global $cfg_cli_time;
$cfg_cli_time = 8;
$addtime = $cfg_cli_time * 3600;
if(empty($format))
{
$format = 'Y-m-d H:i:s';
}
return gmdate ($format,$timest+$addtime);
}

?>