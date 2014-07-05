<?php

require_once('global.php');
is_login();
$pagetitle='如何获得积分';
;echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>首页--';echo $pagetitle;;echo '</title>
        <link type="text/css" rel="stylesheet" media="all" href="images/global.css" />     
	</head>
	<body>
';
headhtml();
;echo '        	    
<div class="wrapper">
	<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>';echo $zz_config['getpoints'];;echo '</td>
  </tr>
</table>

'
?>