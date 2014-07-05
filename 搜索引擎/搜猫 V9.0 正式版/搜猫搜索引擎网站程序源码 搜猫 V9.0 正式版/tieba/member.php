<?php
require(dirname(__FILE__)."/global.php");

if( !isset($_GET['uid']) || !is_numeric($_GET['uid']) || $_GET['uid'] < 1 )
{
	header("location:./");
}
else
{
	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	$memberArr = $TB->getMemberInfo('uid',$_GET['uid']);

	if( empty($memberArr['uid']) )
	{
		header("location:./");
	}
	else
	{
		$groupArr = $userGroup[$memberArr['groupid']];

		if( $memberArr['groupid'] >= 4 )
		{
			$userManage = $TB->getUserManage($memberArr['uid']);
		}
		else
		{
			$userManage = array();
		}

		$authorTopic = $TB->getAuthorTopic($memberArr['uid']);

		$authorReply = $TB->getAuthorReply($memberArr['uid']);

		$tmp = template("member.html");
		 
		$tmp->assign( 'codeName',  $code_name );
		 
		$tmp->assign( 'codeVersion',  $code_version );
		 
		$tmp->assign( 'siteName',  $site_name );
		 
		$tmp->assign( 'siteDomain',  $site_domain );

		$tmp->assign( 'siteCatalog',  $site_catalog );
		 
		$tmp->assign( 'siteIcp',  $site_icp );
		 
		$tmp->assign( 'searchWord',  $memberArr['name'] );
		 
		$tmp->assign( 'searchType',  "3" );
		 
		$tmp->assign( 'loginArr',  $loginArr );
		 
		$tmp->assign( 'memberArr',  $memberArr );
		 
		$tmp->assign( 'groupArr',  $groupArr );
		 
		$tmp->assign( 'userManage',  $userManage );
		 
		$tmp->assign( 'authorTopic',  $authorTopic );
		 
		$tmp->assign( 'authorReply',  $authorReply );
		 
		$tmp->output();
	}

	$DB->close();
}

ob_end_flush();
?>