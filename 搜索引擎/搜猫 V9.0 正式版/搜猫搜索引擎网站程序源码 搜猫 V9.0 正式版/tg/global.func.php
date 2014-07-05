<?php

function is_login()
{
global $user;
if(empty($user['user_name']))
{
header('location:login.php');
}
}
function get_qijia($keywords)
{
global $db,$zz_config;
$row=$db->get_one("select * from ve123_zz_set_keywords where keywords='".$keywords."'");
if(empty($row))
{
$qijia=$zz_config['default_point'];
}
else
{
$qijia=$row['price'];
}
return $qijia;
}
function headhtml()
{
global $user,$zz_user_group_array;
$filename=basename($_SERVER['SCRIPT_NAME']);
$action=$_REQUEST['action'];
;echo '        <div class="head">
        	<div class="head-wrapper">
        		<a href="#" id="Logo" class="logo"><img width="133px" height="43px" src="../images/log.gif" title="亿时达推广" alt="亿时达推广平台" /></a>
        		<div id="RightTopNav" class="right-top-nav">
        			<strong>';echo $user['user_name'];;echo '</strong>
        			<span id="BridgeHi">级别:';echo $user['user_group'];;echo '</span>
        			
        			<a href="login.php?action=logou">退出</a>
        			<div id="ContactMenu">
        				<div id="BridgeService"></div>
        				<div><span class="block"><a id="RightNavMyPromoAdvLink" target="_blank" href="#">顾问信息</a></span></div>
        				<div><span class="block"><a id="RightNavMessToBdLink" target="_blank" href="#">留言</a></span></div>
        			</div>
        			<iframe id="ContactMenuMask" class="contact-mask"></iframe>
        		</div>
        		<div id="HelpTip" class="right-bottom-nav"></div>
        		<div id="MainNavigation" class="mainnav">
        			<span';if($filename=='index.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="./">首页</a>
					<i></i></span>
        			<span';if($filename=='manage.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="../open/manage.php">开放平台</a>
        			<i></i></span>
        			<span';if($filename=='manage.php'){echo " class=\"current\"";};echo '><u></u>
        			    <a href="manage.php">推广管理</a>
        			<i></i></span>
					<span';if($filename=='tg_open.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="tg_open.php">搜索页右侧推广</a>
        			<i></i></span>
					<span';if($filename=='account.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="account.php">账户信息</a>
        			<i></i></span>
                    <span';if($filename=='aipay.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="aipay.php">会员卡充值</a>
        			<i></i></span>
                    <span';if($filename=='pay.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="pay.php">支付宝充值</a>
        			<i></i></span>
					<span';if($filename=='getpoints.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="getpoints.php">如何获得积分</a>
        			<i></i></span>
        			<span';if($filename=='reports.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="reports.php">报表</a>
        			<i></i></span>
					
					<span';if($filename=='union.php'){echo " class=\"current\"";};echo '><u></u>
        				<a href="union.php">加盟代码</a>
        			<i></i></span> 
       		  </div>
       	  </div>
		';
if($filename=='account.php')
{
;echo '				<div id="SubNavigation" class="subnav">
		<div class="subnav-wrapper">

			<span';if($action==''){echo " class=\"current\"";};echo '><i></i><u></u><s></s><b></b><a href="';echo $filename;;echo '" target="_self">个人设定</a></span>
			<span class="split">|</span>
			
			
			<span';if($action=='epw'){echo " class=\"current\"";};echo '><i></i><u></u><s></s><b></b><a href="?action=epw" target="_self">修改密码</a></span>
			<span class="split"></span>
	
		</div>
	</div>
		';
}
;echo '		';
if($filename=='manage.php')
{
;echo '				<div id="SubNavigation" class="subnav">
		<div class="subnav-wrapper">

			<span';if($action==''){echo " class=\"current\"";};echo '><i></i><u></u><s></s><b></b><a href="';echo $filename;;echo '" target="_self">添加关键词</a></span>
			<span class="split">|</span>
			
			
			
	
		</div>
	</div>
		';
}
;echo '        	<div class="head-bottom"></div>
        </div>
';
}
;echo '';
function foothtml()
{
global $config;
;echo '	</div>
        <div id="MaskDiv" class="maskDivNoColor"></div>
        <div class="foot">';echo $config['copyright'];;echo '		&nbsp;&nbsp;<a target="_blank" href="http://www.1230530.com/">Powered by 1230530.Com</a>
		</div>

	</body>
</html>
';
}

?>
