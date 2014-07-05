<?php

require_once('global.php');
is_login();
;echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>';echo $config['name'];;echo '推广--首页</title>
        <link type="text/css" rel="stylesheet" media="all" href="images/global.css" />     
	    <style type="text/css">
<!--
.STYLE1 {color: #0000FF}
-->
        </style>
</head>
	<body>
';
headhtml();
;echo '        	    
<div class="wrapper">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="300"><div class="container my-acct">
                        <div id="AccTopCont" class="inner acc-inner">
                            <h4>我的账户</h4>
                            <div class="acc-cont">
                                <ul>
                                    <li id="SingleSatus">
                                        <b>账户：';echo $user['user_name'];;echo '</b>
                                        <p class="status" id="BreadNavigation"><span id="AccName" rel=""></span></p>
                                    </li>
								      <li id="SingleCount"><b>级别：';echo $user['user_group'];;echo '   　(0 普通会员　　1 代理)</span></b>                                    </li>
                                      <li id="SingleCount">
                                        <b>积分：';echo $user['points'];;echo '</b>
                                        <p><em></em>个<a target="_parent" id="PayBillLink" href="getpoints.php" class="pay-bill">如何获得积分</a></p>
                                    </li>
                                </ul>
                                <div id="SelectUser" class="select-users">                                </div>
                          </div>
                            <div id="AccMask" class="mask-module"></div>
                        </div>
                        <div id="AccBack" class="acc-back"></div>
                        
                    </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

';
?>