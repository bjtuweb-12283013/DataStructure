<?php if(!defined('IN_CYASK')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset;?>" />
<?php echo $extrahead;?>
<title><?php echo $site_name;?> - Powered by Cyask</title>
<link href="<?php echo $styledir;?>/default.css" type=text/css rel=stylesheet />
</head>

<body>
<center>
<div id="main" style="height:100%">
<div align="left">
<table width=100% align=center border=0>
<tr>
   	<td valign=top width=160>&nbsp;&nbsp;
   	<a href="./"><img src="<?php echo $styledir;?>/1000ask.gif" border=0></a></td>
    <td class=f14 nowrap>&nbsp;&nbsp;<b><a href="./"><?php echo $lang['back_home'];?></a></b></td>
</tr>
</table>
</div>

<div id="c90">
<div class="t3 bcb"><div class="t3t bgb"><?php echo $lang['action_message'];?></div></div>
<div class="b3 bcb mb12">
<div class="w100">
<table cellspacing="0" cellpadding="0" width="100%" height="260" valgin="top" border=0>
<tr><td class="f14" align="center" valign="top">
<br /><br />
<?php echo $show_message;?>
<br /><br />
<?php if($url_forward) { ?>
<a href="<?php echo $url_forward;?>"><?php echo $lang['url_forward'];?></a>
<?php } else { ?>
<a href="javascript:history.back()"><u><?php echo $lang['go_back'];?></u></a>
<?php } ?>
<br /><br />
</td></tr>
</table>
</div>
</div>
</div>
<br />
<div id="ft">
<hr width="99%" size="1" color="#d6e0ef" />
<a href="mailto:<?php echo $admin_email;?>"><?php echo $lang['contact_us'];?></a> - <?php echo $site_name;?> &nbsp;&nbsp;Powered by <a href="http://www.cyask.com" target="_blank">cyask 3.2</a> &copy; 2009. 
<br />
</div>
</div>
</body>
</html>