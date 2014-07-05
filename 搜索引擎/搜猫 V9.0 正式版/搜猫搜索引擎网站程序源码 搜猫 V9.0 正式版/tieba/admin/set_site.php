<?php
require(dirname(__FILE__)."/global.php");

if( isset($_POST['site_name'],$_POST['site_domain'],$_POST['site_catalog'],$_POST['site_icp']) )
{
	$siteName = stripslashes(trim($_POST['site_name']));

	if( empty($siteName) || !wordCheck($siteName) )
	{
		die("<script>alert('站点名称不合法');</script>");
	}

	$siteDomain = strtolower(trim($_POST['site_domain']));

	if( empty($siteDomain) || substr($siteDomain,0,7) == "http://" || substr($siteDomain,-1) == "/" )
	{
		die("<script>alert('站点域名不正确');</script>");
	}

	$domainip2long = ip2long(gethostbyname($siteDomain));

	if( $domainip2long == -1 || $domainip2long === FALSE )
	{
		die("<script>alert('域名 ".$siteDomain." 解析尚未生效');</script>");
	}

	$siteCatalog = stripslashes(trim($_POST['site_catalog']));

	if( empty($siteCatalog) || substr($siteCatalog,-1) != "/" || strpos($siteCatalog,'"') )
	{
		die("<script>alert('安装目录不正确');</script>");
	}

	$siteIcp = stripslashes(trim($_POST['site_icp']));

	if( !empty($siteIcp) && ( !wordCheck($siteIcp) || getStrlen($siteIcp) < 10 ) )
	{
		die("<script>alert('备案信息不正确');</script>");
	}

	$siteRewrite = ( isset($_POST['site_rewrite']) ) ? $_POST['site_rewrite'] : 0;

	$siteTimezone = ( isset($_POST['site_timezone']) ) ? $_POST['site_timezone'] : "Asia/Shanghai";

	$createAllow = ( isset($_POST['create_allow']) ) ? $_POST['create_allow'] : 1;

	$cacheLifetime = ( isset($_POST['cache_lifetime']) ) ? $_POST['cache_lifetime']*60 : 60;

	$perTopicNum = ( isset($_POST['per_topic_num']) ) ? $_POST['per_topic_num'] : 50;

	$perPostNum = ( isset($_POST['per_post_num']) ) ? $_POST['per_post_num'] : 30;

	$postAnonymous = ( isset($_POST['post_anonymous']) ) ? $_POST['post_anonymous'] : 0;

	$integralTopic = ( isset($_POST['integral_topic']) ) ? $_POST['integral_topic'] : 2;

	$integralReply = ( isset($_POST['integral_reply']) ) ? $_POST['integral_reply'] : 1;

	$integralElite = ( isset($_POST['integral_elite']) ) ? $_POST['integral_elite'] : 3;

	$config_str = "<?php";

	$config_str .= "\n";

	$config_str .= '$code_name			= "'.$code_name.'";';

	$config_str .= "\n\n";

	$config_str .= '$code_version		= "'.$code_version.'";';

	$config_str .= "\n\n";

	$config_str .= '$site_name			= "'.$siteName.'";';

	$config_str .= "\n\n";

	$config_str .= '$site_domain		= "'.$siteDomain.'";';

	$config_str .= "\n\n";

	$config_str .= '$site_catalog		= "'.$siteCatalog.'";';

	$config_str .= "\n\n";

	$config_str .= '$site_rewrite		= '.$siteRewrite.';';

	$config_str .= "\n\n";

	$config_str .= '$site_icp			= "'.$siteIcp.'";';

	$config_str .= "\n\n";

	$config_str .= '$site_timezone		= "'.$siteTimezone.'";';

	$config_str .= "\n\n";

	$config_str .= '$create_allow		= '.$createAllow.';';

	$config_str .= "\n\n";

	$config_str .= '$cache_lifetime		= '.$cacheLifetime.';';

	$config_str .= "\n\n";

	$config_str .= '$per_topic_num		= '.$perTopicNum.';';

	$config_str .= "\n\n";

	$config_str .= '$per_post_num		= '.$perPostNum.';';

	$config_str .= "\n\n";

	$config_str .= '$post_anonymous		= '.$postAnonymous.';';

	$config_str .= "\n\n";

	$config_str .= '$integral_topic		= '.$integralTopic.';';

	$config_str .= "\n\n";

	$config_str .= '$integral_reply		= '.$integralReply.';';

	$config_str .= "\n\n";

	$config_str .= '$integral_elite		= '.$integralElite.';';

	$config_str .= "\n";

	$config_str .= '?>';

	$configFile = dirname(__FILE__)."/../database/config_site.php";

	if( @is_writable($configFile) )
	{
		$handle = @fopen($configFile, 'w');

		if ( @flock($handle, LOCK_EX) )
		{
			@fwrite($handle, $config_str);

			@flock($handle, LOCK_UN);
		}
			
		@fclose($handle);

		die("<script>alert('修改成功');</script>");
	}
	else
	{
		die("<script>alert('config_site.php 文件不可写');</script>");
	}
}

$timeZoneArr = unserialize(substr(file_get_contents("./include/db.zone.php"),13));

$tmp = & myTpl("set_site.html");
			 
$tmp->assign( 'timeZone', $timeZoneArr );
			 
$tmp->assign( 'codeName', $code_name );
			 
$tmp->assign( 'codeVersion', $code_version );
			 
$tmp->assign( 'siteName', $site_name );
			 
$tmp->assign( 'siteDomain', $site_domain );
			 
$tmp->assign( 'siteCatalog', $site_catalog );
			 
$tmp->assign( 'siteRewrite', $site_rewrite );
			 
$tmp->assign( 'siteIcp', $site_icp );
			 
$tmp->assign( 'siteTimezone', $site_timezone );
			 
$tmp->assign( 'createAllow', $create_allow );
			 
$tmp->assign( 'cacheLifetime', $cache_lifetime );
			 
$tmp->assign( 'perTopic', $per_topic_num );
			 
$tmp->assign( 'perPost', $per_post_num );

$tmp->assign( 'postAnonymous', $post_anonymous );
			 
$tmp->assign( 'integralTopic', $integral_topic );
			 
$tmp->assign( 'integralReply', $integral_reply );
			 
$tmp->assign( 'integralElite', $integral_elite );
			 
$tmp->output();
?>