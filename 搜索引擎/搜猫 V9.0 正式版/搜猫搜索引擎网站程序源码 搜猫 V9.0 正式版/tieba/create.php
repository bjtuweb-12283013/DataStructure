<?php
require(dirname(__FILE__)."/global.php");

require(dirname(__FILE__)."/class/class_Main.php");

if( isset($_GET['do'],$_POST['bar'],$_POST['intro']) && $_GET['do'] == "create" )
{
	$barName = strAddslashes(trim($_POST['bar']));

	$barIntro = filterCode($_POST['intro']);

	if( $create_allow != 1 )
	{
		echo "0 很抱歉，系统当前禁止创建新吧！";
	}
	else
	{
		if( empty($barName) || getStrlen($barName) > 15 || !wordCheck($barName) || !filterCheck($barName) )
		{
			echo "0 很抱歉，您无权创建这个吧！换一个吧名吧 ^_^";
		}
		else
		{
			$intro_length = getStrlen($barIntro);

			if( $intro_length < 10 || $intro_length > 90 )
			{
				echo "0 很抱歉，该吧简介的长度不符合要求 ^_^";
			}
			else
			{
				$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

				$FSQL = "SELECT `fid` FROM `".$table_forum."` WHERE lower(`name`)='".strtolower($barName)."'";

				$forumId = $DB->fetch_one($FSQL);

				if( !empty($forumId) )
				{
					if( $site_rewrite )
						echo "1 ./bar-".$forumId."-1.html";
					else
						echo "1 ./forum.php?fid=".$forumId;
				}
				else
				{
					$TSQL = "SELECT `fid` FROM `".$table_temp."` WHERE lower(`name`)='".strtolower($barName)."'";

					$tempId = $DB->fetch_one($TSQL);

					if( !empty($tempId) )
					{
						echo "0 该吧已创建，正在审核中。";
					}
					else
					{
						$userIP = getClientIP();

						if( $loginArr['state'] == 1 )
						{
							$founder = $loginArr['name'];
						}
						else
						{
							$founder = $userIP;
						}

						$forumArr['name'] = $barName;
						$forumArr['synopsis'] = $barIntro;
						$forumArr['founder'] = $founder;
						$forumArr['dateline'] = time();
						$forumArr['ipaddress'] = $userIP;

						if( $DB->query($DB->insert_sql("`".$table_temp."`",$forumArr)) )
						{
							echo "2 该吧已成功创建，请耐心等待管理员的审核！";
						}
						else
						{
							echo "0 数据库繁忙，请稍候再试！";
						}
					}
				}

				$DB->close();
			}
		}
	}
}
else
{
	if( isset($_GET['name']) && !empty($_GET['name']) )
	{
		$searchWord = trim(filterHTML($_GET['name'],false));
	}
	else
	{
		$searchWord = "";
	}

	$DB->connect($mysql_host,$mysql_user,$mysql_pass,$mysql_dbname);

	$category = MainAction::getCategory();

	$DB->close();

	unset($DB,$TB);

	$tmp = template("create.html");
				 
	$tmp->assign( 'codeName',  $code_name );
				 
	$tmp->assign( 'codeVersion',  $code_version );
				 
	$tmp->assign( 'siteName',  $site_name );
				 
	$tmp->assign( 'siteDomain',  $site_domain );

	$tmp->assign( 'siteCatalog',  $site_catalog );
				 
	$tmp->assign( 'siteIcp',  $site_icp );
				 
	$tmp->assign( 'createAllow',  $create_allow );
				 
	$tmp->assign( 'loginArr',  $loginArr );
				 
	$tmp->assign( 'searchWord',  $searchWord );
			 
	$tmp->assign( 'searchType',  "1" );
				 
	$tmp->assign( 'category',  $category );
				 
	$tmp->output();
}

ob_end_flush();
?>