<?php
require(dirname(__FILE__)."/global.php");

if( isset($_GET['uid']) && is_numeric($_GET['uid']) && $_GET['uid'] > 1 )
{
	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	$userArr = $QA->getMemberInfo($_GET['uid']);

	if( empty($userArr['uid']) )
	{
		echo "<script>top.location.href='./user_list.php';</script>";
	}
	else
	{
		if( isset($_POST['usergroup'],$_POST['userpwd'],$_POST['userintegral']) && $_POST['usergroup'] > 0 && isset($userGroup[$_POST['usergroup']]) )
		{
			$passwd = stripslashes(trim($_POST['userpwd']));

			if( !empty($passwd) )
			{
				if( strlen($passwd) < 6 || strlen($passwd) > 18 )
				{
					$DB->close();

					die("密码长度应控制在6至18个字符之间。");
				}

				$userInfo['password'] = md5($passwd);
			}

			$checkSql = "SELECT COUNT(`fid`) FROM `".$table_apply."` WHERE `type`=1 AND `uid`=".$userArr['uid']." AND dispose=1";

			if( $userArr['groupid'] >= 4 && $_POST['usergroup'] < 4 )
			{
				if( $DB->fetch_one($checkSql) >= 1 )
				{
					$DB->close();

					die("请先取消该用户的吧主权限后再降级！");
				}
			}

			if( $_POST['usergroup'] == 4 )
			{
				if( $DB->fetch_one($checkSql) < 1 )
				{
					$DB->close();

					die("该用户没有管理任何吧，不能成为吧主！");
				}
			}

			$userInfo['groupid'] = $_POST['usergroup'];

			$userInfo['integral'] = intval($_POST['userintegral']);

			if( $DB->query( $DB->update_sql("`".$table_member."`",$userInfo,"`uid`=".$userArr['uid']) ) )
			{
				echo "修改成功！";
			}
			else
			{
				echo "数据库繁忙，请重新提交！";
			}
		}
		else
		{
			$tmp = & myTpl("user_edit.html");

			$tmp->assign( 'codeName',  $code_name );

			$tmp->assign( 'codeVersion',  $code_version );

			$tmp->assign( 'siteName',  $site_name );

			$tmp->assign( 'siteDomain',  $site_domain );

			$tmp->assign( 'siteCatalog',  $site_catalog );

			$tmp->assign( 'userGroup',  $userGroup );

			$tmp->assign( 'userArr',  $userArr );

			$tmp->output();
		}
	}

	$DB->close();
}
else
{
	echo "<script>top.location.href='./user_list.php';</script>";
}
?>