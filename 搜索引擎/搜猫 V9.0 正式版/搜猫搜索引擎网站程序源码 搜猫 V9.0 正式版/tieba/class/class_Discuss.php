<?php
class DiscussAction
{
	function getAllCategory()
	{
		global $DB,$table_catalog;

		$categoryArr = array();

		$Query = $DB->query("SELECT * FROM `".$table_catalog."` WHERE `fatherid` = 0");

		while($Re = $DB->fetch_array($Query))
		{
			$classArr = array();

			$Result = $DB->query("SELECT * FROM `".$table_catalog."` WHERE `fatherid`=".$Re['cid']);

			while($Ce = $DB->fetch_array($Result))
			{
				$classArr[] = array("cid" => $Ce['cid'],"name" => stripslashes($Ce['name']));
			}

			$categoryArr[] = array("cid" => $Re['cid'],"name" => stripslashes($Re['name']),"subcategory"=>$classArr);
		}

		return $categoryArr;
	}

	function getCategoryInfo($cid)
	{
		global $DB,$table_catalog;
		
		$thisArr = array();

		$thatArr = array();

		$categoryArr = array();

		$Arr = $DB->fetch_one_array("SELECT * FROM `".$table_catalog."` WHERE `cid` = ".$cid);

		if( !empty($Arr['cid']) )
		{
			$thisArr = array("cid" => $Arr['cid'],"name" => stripslashes($Arr['name']));

			if( !empty($Arr['fatherid']) )
			{
				$Farr = $DB->fetch_one_array("SELECT * FROM `".$table_catalog."` WHERE `cid` = ".$Arr['fatherid']);

				$thatArr = array("cid" => $Farr['cid'],"name" => stripslashes($Farr['name']));

				$SQL = "SELECT * FROM `".$table_catalog."` WHERE `fatherid`=".$Arr['fatherid'];
			}
			else
			{
				$SQL = "SELECT * FROM `".$table_catalog."` WHERE `fatherid`=".$Arr['cid'];
			}

			$Query = $DB->query($SQL);

			while($Re = $DB->fetch_array($Query))
			{
				$categoryArr[] = array("id"=>$cid,"cid" => $Re['cid'],"name" => stripslashes($Re['name']));
			}
		}

		$return['thisArr'] = $thisArr;

		$return['thatArr'] = $thatArr;
		
		$return['categoryArr'] = $categoryArr;

		return $return;
	}

	function getMemberInfo($field,$value)
	{
		global $DB,$table_member;

		$Re = $DB->fetch_one_array("SELECT * FROM `".$table_member."` WHERE ".$field." = '".$value."'");

		$MemberArr = array(
							"uid" => $Re['uid'],
							"name" => stripslashes($Re['name']),
							"email" => $Re['email'],
							"password" => $Re['password'],
							"securekey" => $Re['securekey'],
							"regdate" => date("Y.m.d",$Re['regdate']),
							"regip" => $Re['regip'],
							"lastdate" => date("Y.m.d",$Re['lastdate']),
							"lastip" => $Re['lastip'],
							"integral" => $Re['integral'],
							"groupid" => $Re['groupid']
							);
		return $MemberArr;
	}
	
	function getUserManage($uid)
	{
		global $DB,$table_apply;

		$ForumArr = array();

		$SQL = "SELECT `fname`,`fid` FROM `".$table_apply."` WHERE `type`=1 AND `uid`=".$uid." AND dispose=1";

		$Query = $DB->query($SQL);

		while($Re = $DB->fetch_array($Query))
		{
			$ForumArr[] = array(
								"fname" => stripslashes($Re['fname']),
								"fid" => $Re['fid']
								);
		}

		return $ForumArr;
	}

	function getBlackList($wf,$page,$num)
	{
		global $DB,$table_black;

		$banArr = array();

		$Total = $DB->fetch_one("SELECT COUNT(`bid`) FROM `".$table_black."` WHERE ".$wf);

		if( $Total > 0 )
		{
			$QSql = "SELECT * FROM `".$table_black."` WHERE ".$wf." ORDER BY `bid` DESC LIMIT ".($page-1)*$num.",".$num;

			$Result = $DB->query($QSql);

			while($Re = $DB->fetch_array($Result))
			{
				$banArr[] = array(
									"bid" => $Re['bid'],
									"fid" => $Re['fid'],
									"uid" => $Re['uid'],
									"uname" => stripslashes($Re['uname']),
									"dateline" => date('Y-m-d H:i',$Re['dateline']),
									"adminid" => $Re['adminid'],
									"adminname" => stripslashes($Re['adminname']),
									);
			}
		}

		$return['Total'] = $Total;

		$return['Black'] = $banArr;
		
		$return['Page'] = $this->Pagination($Total,$num,$page);
		
		return $return;
	}

	function getCategoryForum($wf,$page,$num)
	{
		global $DB,$table_forum;

		$forumArr = array();

		$Total = $DB->fetch_one("SELECT COUNT(`fid`) FROM `".$table_forum."` WHERE `cid` ".$wf);

		if( $Total > 0 )
		{
			$QSql = "SELECT * FROM `".$table_forum."` WHERE `cid` ".$wf." LIMIT ".($page-1)*$num.",".$num;

			$Result = $DB->query($QSql);

			while($Re = $DB->fetch_array($Result))
			{
				$moderatorArr = array();

				if( !empty($Re['moderator']) )
				{
					$exp_moderator = explode("|",$Re['moderator']);

					for($i=0,$modLen=count($exp_moderator);$i<$modLen;$i++)
					{
						$expModerator = explode(",",$exp_moderator[$i]);

						$moderatorArr[] = array("uid"=>$expModerator[0],"name"=>stripslashes($expModerator[1]));
					}
				}

				$forumArr[] = array(
									"fid" => $Re['fid'],
									"name" => stripslashes($Re['name']),
									"synopsis" => Truncate(stripslashes($Re['synopsis']),85),
									"moderator" => $moderatorArr
									);
			}
		}

		$return['Total'] = $Total;

		$return['Forum'] = $forumArr;
		
		$return['Page'] = $this->Pagination($Total,$num,$page);
		
		return $return;
	}

	function getForumInfo($fid)
	{
		global $DB,$table_catalog,$table_forum;

		$Re = $DB->fetch_one_array("SELECT * FROM `".$table_forum."` WHERE `fid` = ".$fid);

		$moderatorArr = array();

		if( !empty($Re['moderator']) )
		{
			$exp_moderator = explode("|",$Re['moderator']);

			for($i=0,$modLen=count($exp_moderator);$i<$modLen;$i++)
			{
				$expModerator = explode(",",$exp_moderator[$i]);

				$moderatorArr[] = array("uid"=>$expModerator[0],"name"=>stripslashes($expModerator[1]));
			}
		}

		$friendArr = array();

		if( !empty($Re['friend']) )
		{
			$exp_friend = explode("|",$Re['friend']);

			for($i=0,$friendLen=count($exp_friend);$i<$friendLen;$i++)
			{
				$expFriend = explode(",",$exp_friend[$i]);

				$friendArr[] = array("id"=>$Re['fid'],"fid"=>$expFriend[0],"name"=>stripslashes($expFriend[1]));
			}
		}

		if( !empty($Re['cid']) )
		{
			$clArr = $DB->fetch_one_array("SELECT `fatherid`,`name` FROM `".$table_catalog."` WHERE `cid`=".$Re['cid']);

			$className = stripslashes($clArr['name']);

			$catalogId = $clArr['fatherid'];

			$clName = $DB->fetch_one("SELECT `name` FROM `".$table_catalog."` WHERE `cid`='".$clArr['fatherid']."'");

			$catalogName = stripslashes($clName);
		}
		else
		{
			$className = "";

			$catalogId = "0";

			$catalogName = "";
		}
		
		$InfoArr = array(
						"fid" => $Re['fid'],
						"classid" => $Re['cid'],
						"classname" => $className,
						"catalogid" => $catalogId,
						"catalogname" => $catalogName,
						"name" => stripslashes($Re['name']),
						"synopsis" => filterHTML($Re['synopsis']),
						"intro" => stripslashes($Re['synopsis']),
						"moderator" => $moderatorArr,
						"friend" => $friendArr,
						"league" => $Re['friend']
						);

		return $InfoArr;
	}

	function getNewTopic($fid)
	{
		global $DB,$table_topic;

		$TopicArr = array();

		$SQL = "SELECT `tid`,`subject` FROM `".$table_topic."` WHERE `fid`=".$fid." ORDER BY `tid` DESC LIMIT 0,15";

		$Query = $DB->query($SQL);

		while($Re = $DB->fetch_array($Query))
		{
			$TopicArr[] = array(
								"tid" => $Re['tid'],
								"title" => filterHTML($Re['subject']),
								"subject" => Truncate(filterHTML($Re['subject']),32),
								);
		}

		return $TopicArr;
	}

	function getAuthorTopic($uid,$tid=0,$num=10)
	{
		global $DB,$table_topic;

		$TopicArr = array();

		$SQL = "SELECT `tid`,`subject`,`dateline`,`views`,`replies` FROM `".$table_topic."` WHERE `authorid`=".$uid;

		if( $tid > 0 )
		{
			$SQL .= " AND `tid` != ".$tid;
		}

		$Query = $DB->query($SQL." ORDER BY `tid` DESC LIMIT 0,".$num);

		while($Re = $DB->fetch_array($Query))
		{
			$TopicArr[] = array(
								"tid" => $Re['tid'],
								"title" => filterHTML($Re['subject']),
								"subject" => Truncate(filterHTML($Re['subject']),32),
								"dateline" => date('Y-m-d H:i',$Re['dateline']),
								"views" => $Re['views'],
								"replies" => $Re['replies'],
								);
		}

		return $TopicArr;
	}

	function getAuthorReply($uid,$num=10)
	{
		global $DB,$table_topic,$table_post;

		$postArr = array();

		$SQL = "SELECT I.`pid`,I.`dateline`,I.`up`,I.`down`,I.`wave`,T.`subject` FROM `".$table_post."` I LEFT JOIN `".$table_topic."` T ON I.`tid`=T.tid";

		$Query = $DB->query($SQL." WHERE I.`authorid` = ".$uid." AND I.`replyfloor` > 0 ORDER BY I.`pid` DESC LIMIT ".$num);

		while($Re = $DB->fetch_array($Query))
		{
			$postArr[] = array(
								"pid" => $Re['pid'],
								"subject" => filterHTML($Re['subject']),
								"dateline" => date('Y-m-d H:i',$Re['dateline']),
								"up" => $Re['up'],
								"down" => $Re['down'],
								"wave" => $Re['wave']
								);
		}

		return $postArr;
	}

	function searchTopic($where,$page,$num)
	{
		global $DB,$table_topic,$table_forum;

		$TopicArr = array();

		$Total = $DB->fetch_one("SELECT COUNT(`tid`) FROM `".$table_topic."` WHERE ".$where);

		if( $Total > 0 )
		{
			$Sql = "SELECT I.`tid`,I.`fid`,I.`author`,I.`authorid`,I.`subject`,I.`dateline`,I.`lasttime`,I.`lastauthor`,I.`lastauthorid`";

			$Sql .= ",I.`views`,I.`replies`,T.`name` FROM `".$table_topic."` I LEFT JOIN `".$table_forum."` T ON I.`fid`=T.`fid`";
			
			$Sql .= " WHERE I.".$where." ORDER BY I.`tid` DESC LIMIT ".($page-1)*$num.",".$num;

			$Result = $DB->query($Sql);

			while($Re = $DB->fetch_array($Result))
			{
				$TopicArr[] = array(
									"tid" => $Re['tid'],
									"fid" => $Re['fid'],
									"fname" => stripslashes($Re['name']),
									"author" => stripslashes($Re['author']),
									"authorid" => $Re['authorid'],
									"subject" => filterHTML($Re['subject']),
									"dateline" => date('Y-n-j',$Re['dateline']),
									"lasttime" => date('Y-n-j H:i',$Re['lasttime']),
									"lastauthor" => stripslashes($Re['lastauthor']),
									"lastauthorid" => $Re['lastauthorid'],
									"views" => $Re['views'],
									"replies" => $Re['replies'],
									);
			}
		}

		$return['TopicNum'] = $Total;

		$return['Topic'] = $TopicArr;
		
		$return['Page'] = $this->Pagination($Total,$num,$page);
		
		return $return;
	}

	function getForumTopicNum($fid)
	{
		global $DB,$table_topic;

		return $DB->fetch_one("SELECT COUNT(`tid`) FROM `".$table_topic."` WHERE `fid`=".$fid);
	}

	function getForumReplyNum($fid)
	{
		global $DB,$table_post;

		return $DB->fetch_one("SELECT COUNT(`pid`) FROM `".$table_post."` WHERE `fid` = ".$fid." AND `replyfloor` > 0");
	}

	function getForumTopic($fid,$page,$num,$digest=false)
	{
		global $DB,$table_topic;

		$TopicArr = array();

		$Tsql = "SELECT COUNT(`tid`) FROM `".$table_topic."` WHERE `fid`=".$fid;

		if( $digest )
		{
			$Tsql .= " AND `digest`=1";
		}

		$Total = $DB->fetch_one($Tsql);

		if( $Total > 0 )
		{
			$QSql = "SELECT * FROM `".$table_topic."` WHERE `fid` = ".$fid." ORDER BY `stick` DESC,`lasttime` DESC";

			if( $digest )
			{
				$QSql = "SELECT * FROM `".$table_topic."` WHERE `fid` = ".$fid." AND `digest`=1 ORDER BY `tid` DESC";
			}

			$Result = $DB->query($QSql." LIMIT ".($page-1)*$num.",".$num);

			while($Re = $DB->fetch_array($Result))
			{
				$TopicArr[] = array(
									"tid" => $Re['tid'],
									"fid" => $Re['fid'],
									"author" => stripslashes($Re['author']),
									"authorid" => $Re['authorid'],
									"authorico" => $Re['authorico'],
									"title" => filterHTML($Re['subject']),
									"subject" => Truncate(filterHTML($Re['subject']),80),
									"dateline" => $Re['dateline'],
									"lasttime" => getCountDown($Re['lasttime']),
									"lastauthor" => stripslashes($Re['lastauthor']),
									"lastauthorid" => $Re['lastauthorid'],
									"lastauthorico" => $Re['lastauthorico'],
									"views" => $Re['views'],
									"replies" => $Re['replies'],
									"stick" => $Re['stick'],
									"digest" => $Re['digest'],
									"isdigest" => $digest,
									"lockout" => $Re['lockout']
									);
			}
		}

		$return['Total'] = $Total;

		$return['Topic'] = $TopicArr;
		
		$return['Page'] = $this->Pagination($Total,$num,$page);
		
		return $return;
	}

	function getTopicInfo($tid)
	{
		global $DB,$table_topic;

		$Re = $DB->fetch_one_array("SELECT * FROM `".$table_topic."` WHERE `tid` = ".$tid);

		$TopicInfo = array(
							"tid" => $Re['tid'],
							"fid" => $Re['fid'],
							"author" => stripslashes($Re['author']),
							"authorid" => $Re['authorid'],
							"authorico" => $Re['authorico'],
							"subject" => filterHTML($Re['subject']),
							"dateline" => $Re['dateline'],
							"lasttime" => getCountDown($Re['lasttime']),
							"lastauthor" => stripslashes($Re['lastauthor']),
							"lastauthorid" => $Re['lastauthorid'],
							"lastauthorico" => $Re['lastauthorico'],
							"views" => $Re['views'],
							"replies" => $Re['replies'],
							"stick" => $Re['stick'],
							"digest" => $Re['digest'],
							"lockout" => $Re['lockout']
							);
		return $TopicInfo;
	}

	function getTopicPost($tid,$page,$num)
	{
		global $DB,$table_post,$table_post2;

		$PostArr = array();

		$TotalPost = $DB->fetch_one("SELECT COUNT(`pid`) FROM `".$table_post."` WHERE `tid` = ".$tid);

		if( $TotalPost > 0 )
		{
			$QSql = "SELECT I.*,T.`message` FROM `".$table_post."` I LEFT JOIN `".$table_post2."` T ON ";

			$QSql .= "I.`pid`=T.`pid` WHERE I.`tid`=".$tid." ORDER BY I.`pid` ASC LIMIT ".($page-1)*$num.",".$num;

			$Result = $DB->query($QSql);

			$floorNum = 0;

			while($Re = $DB->fetch_array($Result))
			{
				$floorNum++;

				$PostArr[] = array(
									"pid" => $Re['pid'],
									"fid" => $Re['fid'],
									"tid" => $Re['tid'],
									"replyfloor" => $Re['replyfloor'],
									"floorpage" => ceil($Re['replyfloor']/$num),
									"author" => stripslashes($Re['author']),
									"authorid" => $Re['authorid'],
									"authorico" => $Re['authorico'],
									"guestname" => $Re['guestname'],
									"subject" => filterHTML($Re['subject']),
									"dateline" => date('Y.m.d H:i:s',$Re['dateline']),
									"message" => UBB(filterHTML($Re['message'])),
									"postip" => $Re['postip'],
									"up" => $Re['up'],
									"down" => $Re['down'],
									"wave" => $Re['wave'],
									"floor" => ($page-1)*$num+$floorNum
									);
			}
		}

		$return['Total'] = $TotalPost;

		$return['Post'] = $PostArr;
		
		$return['Page'] = $this->Pagination($TotalPost,$num,$page);
		
		return $return;
	}

	function getPostInfo($pid)
	{
		global $DB,$table_post;

		$Re = $DB->fetch_one_array("SELECT * FROM `".$table_post."` WHERE `pid` = ".$pid);

		$replyInfo = array(
							"pid" => $Re['pid'],
							"fid" => $Re['fid'],
							"tid" => $Re['tid'],
							"replyfloor" => $Re['replyfloor'],
							"author" => stripslashes($Re['author']),
							"authorid" => $Re['authorid'],
							"authorico" => $Re['authorico'],
							"guestname" => $Re['guestname'],
							"subject" => filterHTML($Re['subject']),
							"dateline" => date('Y.m.d H:i:s',$Re['dateline']),
							"postip" => $Re['postip'],
							"up" => $Re['up'],
							"down" => $Re['down'],
							"wave" => $Re['wave']
							);
		return $replyInfo;
	}
	
	function Pagination($total,$per,$page)
	{
		global $site_catalog,$site_rewrite;

		$allpage = ceil($total/$per);

		$next = $page+1;

		$pre = $page-1;

		$startcount = $page - 3;

		$endcount = $page + 3;

		if( $startcount < 1 )
		{
			$startcount = 1;
		}

		if( $allpage < $endcount )
		{
			$endcount = $allpage;
		}

		$string = $site_catalog.substr(strrchr(str_replace("\\","/",$_SERVER['SCRIPT_FILENAME']),"/"),1)."?";

		foreach( $_GET as $k => $v )
		{
			if( $k != "page" )
			{
				$string.="".$k."=".urlencode($v)."&";
			}
		}

		$pagePre = "";

		$pageFirst = "";

		$pageList = "";

		$pageLast = "";

		$pageNext = "";

		if( $allpage > 1 )
		{
			if( $page > 1 )
			{
				$pagePre = '<a href="'.$string.'page='.$pre.'">上一页</a>';
			}

			if( $page > 5 )
			{
				$pageFirst = '<a href="'.$string.'page=1">1</a>';
			}

			for( $i = $startcount; $i <= $endcount; $i++ )
			{
				$pageList .= $page==$i?'<b>'.$i.'</b>':'<a href="'.$string.'page='.$i.'">'.$i.'</a>';
			}

			if( $page < ($allpage-4) )
			{
				$pageLast = '<a href="'.$string.'page='.$allpage.'">'.$allpage.'</a>';
			}

			if( $page < $allpage )
			{
				$pageNext = '<a href="'.$string.'page='.$next.'">下一页</a>';
			}
		}

		if( $site_rewrite )
		{
			if($pagePre != "")
				$pagePre = $this->urlRewrite($pagePre);

			if($pageFirst != "")
				$pageFirst = $this->urlRewrite($pageFirst);
			
			if($pageList != "")
				$pageList = $this->urlRewrite($pageList);
			
			if($pageLast != "")
				$pageLast = $this->urlRewrite($pageLast);
			
			if($pageNext != "")
				$pageNext = $this->urlRewrite($pageNext);
		}
		
		$return['pageTotal'] = $allpage;
		
		$return['pagePre'] = $pagePre;
		
		$return['pageFirst'] = $pageFirst;
		
		$return['pageList'] = $pageList;
		
		$return['pageLast'] = $pageLast;
		
		$return['pageNext'] = $pageNext;
		
		return $return;
	}

	function urlRewrite($str)
	{
		$str = preg_replace('/\/(forum|topic|category)\.php\?(fid|tid|cid)\=([0-9]+)\&page\=([0-9]+)/is','/\\1-\\3-\\4.html',$str);

		$str = str_replace("/forum-","/bar-",$str);

		return $str;
	}
}
?>