<?php
require(dirname(__FILE__)."/global.php");

require(dirname(__FILE__)."/class/class_Main.php");

if( isset($_GET['do'],$_POST['rdm']) && $_GET['do'] == "load" )
{
	$tmp = template("header_links.html");

	$tmp->assign( 'siteName',  $site_name );

	$tmp->assign( 'loginArr',  $loginArr );

	$tmp->output();
}
else
{
	$tmp = template("index.html");
	
	$tmp->cache_lifetime = $cache_lifetime;

	$tmp->use_cache();

	$tmp->assign( 'codeName',  $code_name );
	
	$tmp->assign( 'codeVersion',  $code_version );

	$tmp->assign( 'siteName',  $site_name );

	$tmp->assign( 'siteDomain',  $site_domain );

	$tmp->assign( 'siteCatalog',  $site_catalog );

	$tmp->assign( 'siteIcp',  $site_icp );

	$tmp->assign( 'loginArr',  $loginArr );

	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	$category = MainAction::getCategory();

	$tmp->assign( 'category',  $category );

	$hotTopic = MainAction::getTopic("replies");

	$tmp->assign( 'hotTopic',  $hotTopic );

	$newTopic = MainAction::getTopic("tid");

	$tmp->assign( 'newTopic',  $newTopic );

	$topForum = MainAction::getForum();

	$tmp->assign( 'topForum',  $topForum );

	$topMember = MainAction::getMember();

	$tmp->assign( 'topMember',  $topMember );

	$DB->close();

	$friendLink = unserialize(substr(file_get_contents("./database/db.links.php"),13));

	$tmp->assign( 'friendLink',  $friendLink );

	$tmp->output();
}

ob_end_flush();
?>