<?php
require_once("global.php");
is_login();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title><?php echo $config["name"];?>开放平台--首页</title>
        <link type="text/css" rel="stylesheet" media="all" href="images/global.css" />     
	</head>
	<body>
<?php
headhtml();
?>        	    
<div class="wrapper">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250"><div class="container my-acct">
      <div id="div" class="inner acc-inner">
        <h4>模板展示</h4>
        <div class="acc-cont">
          <ul><li id="SingleCount">
            <p>文字类模板</p>
          </li>
            <p><li>图片类模板</li></p>
            <p><li>表格类模板</li></p>
            <p><li>交互类模板</li></p>
          </ul>
          <div id="div2" class="select-users"> </div>
        </div>
        <div id="div3" class="mask-module"></div>
      </div>
      <div id="div4" class="acc-back"></div>
    </div></td>
    <td width="10">&nbsp;</td>
    <td width="457"><div class="container my-acct">
                        <div id="AccTopCont" class="inner acc-inner">
                            <h4>我的账户</h4>
                            <div class="acc-cont">
                                <ul>
                                    <li id="SingleSatus">
                                        <b>账户：<?php echo $user["user_name"];?></b>
                                        <p class="status" id="BreadNavigation"><span id="AccName" rel=""></span></p>
                                    </li>
								<!--	<li id="">
                                        <b>级别：<?php echo $zz_user_group_array[$user["user_group"]];?></b>
                                        <p></p>
                                    </li>-->
                                    <li id="SingleCount">
                                        <b>积分：<?php echo $user["points"];?></b>
                                        <p><em></em>个<a target="_parent" id="PayBillLink" href="getpoints.php" class="pay-bill">如何获得积分</a></p>
                                    </li>
                                </ul>
                                <div id="SelectUser" class="select-users">                                </div>
                            </div>
                            <div id="AccMask" class="mask-module"></div>
                        </div>
                        <div id="AccBack" class="acc-back"></div>
                        
    </div></td>
  </tr>
</table>

