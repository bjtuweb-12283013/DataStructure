<?php
function is_login()
{
    global $user;
	if(empty($user["user_name"]))
	{
	    header("location:login.php");
	}
}
function get_qijia($keywords)
{
     global $db,$zz_config;
	 $row=$db->get_one("select * from ve123_zz_set_keywords where keywords='".$keywords."'");
	 if(empty($row))
	 {
	    $qijia=$zz_config["default_point"];
	 }
	 else
	 {
	    $qijia=$row["price"];
	 }
	 return $qijia;
}
function headhtml()
{
   global $user,$zz_user_group_array;
   $filename=basename($_SERVER['SCRIPT_NAME']);
   $action=$_REQUEST["action"];
?>
        <div class="head">
        	<div class="head-wrapper">
        		<a href="#" id="Logo" class="logo"><img width="133px" height="43px" src="images/logo.gif" title="开放平台" alt="开放平台" /></a>
        		<div id="RightTopNav" class="right-top-nav">
        			<strong><?php echo $user["user_name"];?></strong>
        			<span id="BridgeHi">级别:<?php echo $user["user_group"];?></span>
        			
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
        			<span<?php if($filename=="index.php"){echo " class=\"current\"";}?>><u></u>
        				<a href="./">首页</a>
        			<i></i></span>
        			<span<?php if($filename=="manage.php"){echo " class=\"current\"";}?>><u></u>
        				<a href="manage.php">开放平台</a>
        			<i></i></span>
					<span<?php if($filename=="../tg/manage.php"){echo " class=\"current\"";}?>><u></u>
        				<a href="../tg/manage.php">推广管理</a>
        			<i></i></span>
					<span<?php if($filename=="union.php"){echo " class=\"current\"";}?>><u></u>
        				<a href="union.php">加盟代码</a>
        			<i></i></span>
					<span<?php if($filename=="account.php"){echo " class=\"current\"";}?>><u></u>
        				<a href="account.php">账户信息</a>
        			<i></i></span>
					<span<?php if($filename=="getpoints.php"){echo " class=\"current\"";}?>><u></u>
        				<a href="getpoints.php">如何获得积分</a>
        			<i></i></span>
        			 <span<?php if($filename=="reports.php"){echo " class=\"current\"";}?>><u></u>
        				<a href="reports.php">报表</a>
        			<i></i></span>
					
					<span<?php if($filename=="tool.php"){echo " class=\"current\"";}?>><u></u>
        				<a href="tool.php">工具</a>
        			<i></i></span>

        		</div>
        	</div>
		<?php
		if($filename=="account.php")
		{
		?>
				<div id="SubNavigation" class="subnav">
		<div class="subnav-wrapper">

			<span<?php if($action==""){echo " class=\"current\"";}?>><i></i><u></u><s></s><b></b><a href="<?php echo $filename;?>" target="_self">个人设定</a></span>
			<span class="split">|</span>
			
			
			<span<?php if($action=="epw"){echo " class=\"current\"";}?>><i></i><u></u><s></s><b></b><a href="?action=epw" target="_self">修改密码</a></span>
			<span class="split"></span>
	
		</div>
	</div>
		<?php
		}
		?>
		<?php
		if($filename=="manage.php")
		{
		?>
				<div id="SubNavigation" class="subnav">
		<div class="subnav-wrapper">

			<span<?php if($action==""){echo " class=\"current\"";}?>><i></i><u></u><s></s><b></b><a href="manage.php?action=addform" target="_self">添加关键词</a></span>
			<span class="split">|</span>
			
			
			
	
		</div>
	</div>
		<?php
		}
		?>
        	<div class="head-bottom"></div>
        </div>
<?php
}
?>
<?php
function foothtml()
{
    global $config;
?>
	</div>
        <div id="MaskDiv" class="maskDivNoColor"></div>
        <div class="foot"><?php echo $config['copyright'];?>
		&nbsp;&nbsp;<a target="_blank" href="http://www.1230530.com/">Powered by 亿时达</a>
		</div>

	</body>
</html>
<?php
}
?>
