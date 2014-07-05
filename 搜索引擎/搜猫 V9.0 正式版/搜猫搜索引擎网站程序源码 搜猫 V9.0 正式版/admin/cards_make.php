<?php
echo '
';
require 'global.php';
headhtml();
set_time_limit(0);
$dopost=HtmlReplace(trim($_POST['dopost']));
$cardtype=HtmlReplace(trim($_POST['cardtype']));
$mnum=HtmlReplace(trim($_POST['mnum']));
$snprefix=HtmlReplace(trim($_POST['snprefix']));
$pwdlen=HtmlReplace(trim($_POST['pwdlen']));
$ctype=HtmlReplace(trim($_POST['ctype']));
$ctype=HtmlReplace(trim($_POST['ctype']));
$pwdgr=HtmlReplace(trim($_POST['pwdgr']));
if(empty($dopost))
{
$dopost = '';
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>点卡生成向导</title>
</head>
<body leftmargin=\'8\' topmargin=\'8\'>
<table width="98%" border="0" cellpadding="1" cellspacing="1" align="center" class="tbtitle" style="background:#CFCFCF;">
  <form action="cards_make.php" name="form1" target="stafrm" method="post">
  <input type="hidden" name="dopost" value="make" />
    <tr>
      <td height="20" bgcolor="#EDF9D5" background=\'images/tbg.gif\'>
      	<table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="30%" style="padding-left:10px;"><strong>点卡生成向导：</strong> </td>
          <td align="right">
          	  <input type="button" name="ss1" value="点卡产品分类" style="width:90px;margin-right:6px" onClick="location=\'cards_type.php\';" class=\'np coolbg\' />
              <input type="button" name="ss2" value="点卡使用记录" style="width:90px" onClick="location=\'cards_manage.php\';" class=\'np coolbg\' />
          </td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">
<table width="90%" border="0" cellpadding="2" cellspacing="2">
          <tr>
            <td width="90">点卡类型：</td>
            <td>
<select name=\'cardtype\' style=\'width:120px\'>
';
$sql='select * from ve123_moneycard_type';
$result=$db->query($sql);
while ($row=$db->fetch_array($result))
{
echo "  <option value='{$row['tid']}'>{$row['pname']}</option>\r\n";
}
;echo '</select>
			</td>
            <td width="90">生成数量：</td>
            <td>
			<input name="mnum" type="text" id="mnum"  style=\'width:120px\' value="100" class=\'pubinputs\' />
			</td>
          </tr>
          <tr>
            <td>点卡前缀：</td>
            <td>
              <input name="snprefix" type="text" id="snprefix"  style=\'width:120px\' value="SN"  class=\'pubinputs\'/>
            </td>
            <td>密码长度：</td>
            <td><input name="pwdlen" type="text" id="pwdlen"  style=\'width:120px\' value="4" class=\'pubinputs\' />
            </td>
          </tr>
          <tr>
            <td>密码类型：</td>
            <td><input type="radio" name="ctype" value="1" class=\'np\' />
              纯数字
              <input name="ctype" type="radio"  value="2" checked=\'1\' class=\'np\' />
              大写字母</td>
            <td>密码组数：</td>
            <td><input name="pwdgr" type="text" id="pwdgr"  style=\'width:120px\' value="3" class=\'np\' />
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td height="31" bgcolor="#ffffff" align="center">
	  <input type="submit" name="Submit" value="开始生成点卡" class=\'np coolbg\' />
      </td>
    </tr>
  </form>
  <tr bgcolor="#F9FCEF">
    <td height="20"> <table width="100%">
        <tr>
          <td width="74%"><strong>结果：</strong></td>
          <td width="26%" align="right"> <script language=\'javascript\'>
            	function ResizeDiv(obj,ty)
            	{
            		if(ty=="+") document.all[obj].style.pixelHeight += 50;
            		else if(document.all[obj].style.pixelHeight>80) document.all[obj].style.pixelHeight = document.all[obj].style.pixelHeight - 50;
            	}
            	</script>
            [<a href=\'#\' onClick="ResizeDiv(\'mdv\',\'+\');">增大</a>] [<a href=\'#\' onClick="ResizeDiv(\'mdv\',\'-\');">缩小</a>]
          </td>
        </tr>
      </table></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td id="mtd">
    	<div id=\'mdv\' style=\'width:100%;height:350px;\'>
        <iframe name="stafrm" frameborder="0" id="stafrm" width="100%" height="100%"></iframe>
      </div>
    </td>
  </tr>
</table>
</body>
</html>
';
}elseif($dopost == 'make')
{
$row=$db->get_one('SELECT * FROM ve123_moneycard_record ORDER BY aid DESC');
!is_array($row) ?$startid=100000 : $startid=$row['aid']+100000;
$row=$db->get_one("SELECT * FROM ve123_moneycard_type WHERE tid='$cardtype'");
$money = $row['money'];
$num = $row['num'];
$mtime = time();
$utime = 0;
$ctid = $cardtype;
$startid++;
$endid = $startid +$mnum;
for(;$startid<$endid;$startid++)
{
$cardid = $snprefix.$startid.'-';
for($p=0;$p<$pwdgr;$p++)
{
for($i=0;$i <$pwdlen;$i++)
{
if($ctype==1)
{
$c = mt_rand(49,57);$c = chr($c);
}
else
{
$c = mt_rand(65,90);
if($c==79)
{
$c = 'M';
}
else
{
$c = chr($c);
}
}
$cardid .= $c;
}
if($p<$pwdgr-1)
{
$cardid .= '-';
}
}
$array3=array('ctid'=>$ctid,'cardid'=>$cardid,'uid'=>0,'isexp'=>0,'mtime'=>$mtime,'utime'=>$utime,'money'=>$money,'num'=>$num);
$db->insert('ve123_moneycard_record',$array3);
echo "成功生成点卡：{$cardid}<br/>";
}
echo "成功生成 {$mnum} 个点卡！";
}
?>