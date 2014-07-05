<?php
require(dirname(__FILE__)."/global.php");

if( $loginArr['state'] == 0 )
{
	header("location:".$site_catalog);
}
else
{
	if( isset($_GET['do']) && $_GET['do'] == "modify" )
	{
		if( isset($_POST['oldpasswd'],$_POST['newpasswd'],$_POST['reppasswd'],$_POST['useremail']) )
		{
			$oldpasswd = stripslashes(trim($_POST['oldpasswd']));
			
			if( strlen($oldpasswd) < 6 || strlen($oldpasswd) > 18 )
			{
				die("1 您输入的当前密码长度不正确。");
			}
			
			$newpasswd = stripslashes(trim($_POST['newpasswd']));

			$reppasswd = stripslashes(trim($_POST['reppasswd']));

			if( !empty($newpasswd) )
			{
				if( strlen($newpasswd) < 6 || strlen($newpasswd) > 18 )
				{
					die("1 新密码长度应控制在6至18个字符之间。");
				}

				if( $newpasswd != $reppasswd )
				{
					die("1 两次输入的新密码不一致。");
				}

				if( $newpasswd == $oldpasswd )
				{
					die("1 新密码不能与当前密码一样。");
				}

				$profileArr['password'] = md5($newpasswd);

				$profileArr['securekey'] = createSecureKey(9);
			}

			$useremail = strtolower(trim($_POST['useremail']));

			if( strlen($useremail) > 45 || !emailcheck($useremail) )
			{
				die("1 电子邮件地址不合法。");
			}

			$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

			$userArr = $TB->getMemberInfo("`uid`",$loginArr['uid']);

			if( $userArr['password'] == md5($oldpasswd) )
			{
				if( $userArr['email'] != $useremail )
				{
					if( $DB->fetch_one("SELECT COUNT(`uid`) FROM `".$table_member."` WHERE `email`='".$useremail."'") != 0 )
					{
						$DB->close();

						die("1 电子邮箱地址已被占用");
					}

					$profileArr['email'] = $useremail;
				}

				if( isset($profileArr) )
				{
					if( $DB->query( $DB->update_sql("`".$table_member."`",$profileArr,"`uid`=".$userArr['uid']) ) )
					{
						echo "0 相关信息已成功修改！";
					}
					else
					{
						echo "1 数据库繁忙，请重试！";
					}
				}
				else
				{
					echo "0 您好像什么也没修改！";
				}
			}
			else
			{
				echo "1 您输入的当前密码不正确";
			}

			$DB->close();
		}
	}
	else
	{
		$userManage = array();

		$memberAction = isset($_GET['action']) ? $_GET['action'] : "info";
		
		$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

		$memberArr = $TB->getMemberInfo("uid",$loginArr['uid']);

		$groupArr = $userGroup[$memberArr['groupid']];

		if( $memberArr['groupid'] >= 4 )
			$userManage = $TB->getUserManage($memberArr['uid']);

		$DB->close();

		$tmp = template("profile.html");

		$tmp->assign( 'codeName',  $code_name );
		 
		$tmp->assign( 'codeVersion',  $code_version );
		 
		$tmp->assign( 'siteName',  $site_name );
		 
		$tmp->assign( 'siteDomain',  $site_domain );

		$tmp->assign( 'siteCatalog',  $site_catalog );
		 
		$tmp->assign( 'siteIcp',  $site_icp );
		 
		$tmp->assign( 'searchWord',  $memberArr['name'] );
		 
		$tmp->assign( 'searchType',  "3" );

		$tmp->assign( 'loginArr',  $loginArr );

		$tmp->assign( 'groupArr',  $groupArr );

		$tmp->assign( 'memberArr',  $memberArr );

		$tmp->assign( 'userManage',  $userManage );

		$tmp->assign( 'memberAction',  $memberAction );

		$tmp->assign( 'nowTime',  time() );
		 
		$tmp->output();
	}
}

ob_end_flush();
?>