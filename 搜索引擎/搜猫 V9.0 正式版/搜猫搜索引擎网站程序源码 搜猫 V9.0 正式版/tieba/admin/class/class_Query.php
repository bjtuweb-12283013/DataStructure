<?php
class QueryAction
{
	function getCategory()
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
				$classArr[] = array("cid" => $Ce['cid'],"fid" => $Ce['fatherid'],"name" => stripslashes($Ce['name']));
			}

			$categoryArr[] = array("cid" => $Re['cid'],"name" => stripslashes($Re['name']),"subcategory"=>$classArr);
		}

		return $categoryArr;
	}

	function getMember($where,$page,$num)
	{
		global $DB,$table_member,$userGroup;

		$MemberArr = array();

		$Total = $DB->fetch_one("SELECT COUNT(`uid`) FROM `".$table_member."`".$where);

		if( $Total > 0 )
		{
			$SQL = "SELECT * FROM `".$table_member."`".$where." ORDER BY `uid` DESC LIMIT ".($page-1)*$num.",".$num;

			$Query = $DB->query($SQL);

			while($Re = $DB->fetch_array($Query))
			{
				$MemberArr[] = array(
									"uid" => $Re['uid'],
									"name" => stripslashes($Re['name']),
									"email" => $Re['email'],
									"password" => $Re['password'],
									"securekey" => $Re['securekey'],
									"regdate" => date("Y.m.d H:i",$Re['regdate']),
									"regip" => $Re['regip'],
									"lastdate" => date("Y.m.d H:i",$Re['lastdate']),
									"lastip" => $Re['lastip'],
									"integral" => $Re['integral'],
									"groupid" => $Re['groupid'],
									"groupname" => $userGroup[$Re['groupid']]['name']
									);
			}
		}

		$return['Total'] = $Total;

		$return['Member'] = $MemberArr;
		
		$return['Page'] = $this->Pagination($Total,$num,$page);
		
		return $return;
	}

	function getMemberInfo($uid)
	{
		global $DB,$table_member;

		$Re = $DB->fetch_one_array("SELECT * FROM `".$table_member."` WHERE `uid`=".$uid);

		$MemberArr = array(
							"uid" => $Re['uid'],
							"name" => stripslashes($Re['name']),
							"email" => $Re['email'],
							"password" => $Re['password'],
							"securekey" => $Re['securekey'],
							"regdate" => date("Y.m.d H:i",$Re['regdate']),
							"regip" => $Re['regip'],
							"lastdate" => date("Y.m.d H:i",$Re['lastdate']),
							"lastip" => $Re['lastip'],
							"integral" => $Re['integral'],
							"groupid" => $Re['groupid']
							);		
		
		return $MemberArr;
	}

	function getBlackList($where1,$where2,$page,$num)
	{
		global $DB,$table_black,$table_forum;

		$banArr = array();

		$Total = $DB->fetch_one("SELECT COUNT(`bid`) FROM `".$table_black."` ".$where1);

		if( $Total > 0 )
		{
			$S = "SELECT I.*,T.`name` FROM `".$table_black."` I LEFT JOIN `".$table_forum."` T ON I.`fid`=T.`fid` ".$where2;

			$Result = $DB->query($S." ORDER BY I.`bid` DESC LIMIT ".($page-1)*$num.",".$num);

			while($Re = $DB->fetch_array($Result))
			{
				$banArr[] = array(
									"bid" => $Re['bid'],
									"fid" => $Re['fid'],
									"fname" => stripslashes($Re['name']),
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

	function getForumCategory($page,$num)
	{
		global $DB,$table_class,$table_catalog;

		$DBArr = array();

		$Total = $DB->fetch_one("SELECT COUNT(`fid`) FROM `".$table_class);

		if( $Total > 0 )
		{
			$S = "SELECT I.*,T.`name` FROM `".$table_class."` I LEFT JOIN `".$table_catalog."` T ON I.`cid`=T.`cid`";

			$Result = $DB->query($S." LIMIT ".($page-1)*$num.",".$num);

			while($Re = $DB->fetch_array($Result))
			{
				$DBArr[] = array(
									"fid" => $Re['fid'],
									"fname" => stripslashes($Re['fname']),
									"cid" => $Re['cid'],
									"cname" => stripslashes($Re['name'])
									);
			}
		}

		$return['Total'] = $Total;

		$return['Forum'] = $DBArr;
		
		$return['Page'] = $this->Pagination($Total,$num,$page);
		
		return $return;
	}

	function getForumList($where1,$where2,$page,$num)
	{
		global $DB,$table_forum,$table_catalog;

		$forumArr = array();

		$Total = $DB->fetch_one("SELECT COUNT(`fid`) FROM `".$table_forum."`".$where1);

		if( $Total > 0 )
		{
			$S = "SELECT I.*,T.`name` AS C FROM `".$table_forum."` I LEFT JOIN `".$table_catalog."` T ON I.`cid`=T.`cid` ";

			$S .= $where2." ORDER BY I.`fid` DESC LIMIT ".($page-1)*$num.",".$num;

			$Result = $DB->query($S);

			while($Re = $DB->fetch_array($Result))
			{
				$forumArr[] = array(
									"fid" => $Re['fid'],
									"cid" => $Re['cid'],
									"cname" => stripslashes($Re['C']),
									"name" => stripslashes($Re['name']),
									"synopsis" => filterHTML($Re['synopsis']),
									"commend" => $Re['commend']
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
		global $DB,$table_forum;

		$Re = $DB->fetch_one_array("SELECT * FROM `".$table_forum."` WHERE `fid` = ".$fid);

		$moderatorArr = array();

		if( !empty($Re['moderator']) )
		{
			$exp_moderator = explode("|",$Re['moderator']);

			for($i=0,$arrLen=count($exp_moderator);$i<$arrLen;$i++)
			{
				$expModerator = explode(",",$exp_moderator[$i]);

				$moderatorArr[] = array("id"=>$Re['fid'],"uid"=>$expModerator[0],"name"=>stripslashes($expModerator[1]));
			}
		}

		$friendArr = array();

		if( !empty($Re['friend']) )
		{
			$exp_friend = explode("|",$Re['friend']);

			for($i=0,$arrLen=count($exp_friend);$i<$arrLen;$i++)
			{
				$expFriend = explode(",",$exp_friend[$i]);

				$friendArr[] = array("id"=>$Re['fid'],"fid"=>$expFriend[0],"name"=>stripslashes($expFriend[1]));
			}
		}
		
		$InfoArr = array(
						"fid" => $Re['fid'],
						"cid" => $Re['cid'],
						"name" => stripslashes($Re['name']),
						"synopsis" => stripslashes($Re['synopsis']),
						"moderator" => $moderatorArr,
						"friend" => $friendArr,
						"commend" => $Re['commend']
						);

		return $InfoArr;
	}

	function getForumTemp($where,$page,$num)
	{
		global $DB,$table_temp;

		$forumArr = array();

		$Total = $DB->fetch_one("SELECT COUNT(`fid`) FROM `".$table_temp."`".$where);

		if( $Total > 0 )
		{
			$S = "SELECT * FROM `".$table_temp."` ".$where." ORDER BY `fid` ASC LIMIT ".($page-1)*$num.",".$num;

			$Result = $DB->query($S);

			while($Re = $DB->fetch_array($Result))
			{
				$forumArr[] = array(
									"fid" => $Re['fid'],
									"name" => stripslashes($Re['name']),
									"synopsis" => stripslashes($Re['synopsis']),
									"founder" => stripslashes($Re['founder']),
									"dateline" => date('Y-m-d H:i',$Re['dateline']),
									"ipaddress" => $Re['ipaddress']
									);
			}
		}

		$return['Total'] = $Total;

		$return['Forum'] = $forumArr;
		
		$return['Page'] = $this->Pagination($Total,$num,$page);
		
		return $return;
	}

	function getApply($where,$page,$num)
	{
		global $DB,$table_apply;

		$applyArr = array();

		$Total = $DB->fetch_one("SELECT COUNT(`aid`) FROM `".$table_apply."`".$where);

		if( $Total > 0 )
		{
			$S = "SELECT * FROM `".$table_apply."` ".$where." ORDER BY `aid` ASC LIMIT ".($page-1)*$num.",".$num;

			$Result = $DB->query($S);

			while($Re = $DB->fetch_array($Result))
			{
				$applyArr[] = array(
									"aid" => $Re['aid'],
									"type" => $Re['type'],
									"uname" => stripslashes($Re['uname']),
									"uid" => $Re['uid'],
									"fname" => stripslashes($Re['fname']),
									"fid" => $Re['fid'],
									"message" => filterHTML($Re['message']),
									"dateline" => date('m-d H:i',$Re['dateline']),
									"dispose" => $Re['dispose']
									);
			}
		}

		$return['Total'] = $Total;

		$return['Apply'] = $applyArr;
		
		$return['Page'] = $this->Pagination($Total,$num,$page);
		
		return $return;
	}

	function getReport($page,$num)
	{
		global $DB,$table_report;

		$ReportArr = array();

		$Total = $DB->fetch_one("SELECT COUNT(`rid`) FROM `".$table_report."`");

		if( $Total > 0 )
		{
			$SQL = "SELECT * FROM `".$table_report."` ORDER BY `rid` ASC LIMIT ".($page-1)*$num.",".$num;

			$Query = $DB->query($SQL);

			while($Re = $DB->fetch_array($Query))
			{
				$ReportArr[] = array(
									"rid" => $Re['rid'],
									"uname" => stripslashes($Re['uname']),
									"uid" => $Re['uid'],
									"fid" => $Re['fid'],
									"tid" => $Re['tid'],
									"pid" => $Re['pid'],
									"author" => stripslashes($Re['author']),
									"authorid" => $Re['authorid'],
									"message" => filterHTML($Re['message']),
									"dateline" => date('m-d H:i',$Re['dateline'])
									);
			}
		}

		$return['Total'] = $Total;

		$return['Report'] = $ReportArr;
		
		$return['Page'] = $this->Pagination($Total,$num,$page);
		
		return $return;
	}

	function getTopic($where,$page,$num)
	{
		global $DB,$table_topic;

		$TopicArr = array();

		$Tsql = "SELECT COUNT(`tid`) FROM `".$table_topic."` ".$where;

		$TotalTopic = $DB->fetch_one($Tsql);

		if( $TotalTopic > 0 )
		{
			$RSql = "SELECT * FROM `".$table_topic."` ".$where." ORDER BY `tid` DESC LIMIT ".($page-1)*$num.",".$num;

			$Result = $DB->query($RSql);

			while($Re = $DB->fetch_array($Result))
			{
				$TopicArr[] = array(
									"tid" => $Re['tid'],
									"fid" => $Re['fid'],
									"author" => stripslashes($Re['author']),
									"authorid" => $Re['authorid'],
									"authorico" => $Re['authorico'],
									"title" => filterHTML($Re['subject']),
									"subject" => Truncate(filterHTML($Re['subject']),84),
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
			}
		}

		$return['Total'] = $TotalTopic;

		$return['Topic'] = $TopicArr;
		
		$return['Page'] = $this->Pagination($TotalTopic,$num,$page);
		
		return $return;
	}

	function getPost($where,$page,$num)
	{
		global $DB,$table_post2;

		$postArr = array();

		$Total = $DB->fetch_one("SELECT COUNT(`pid`) FROM `".$table_post2."` ".$where);

		if( $Total > 0 )
		{
			$Result = $DB->query("SELECT * FROM `".$table_post2."` ".$where." ORDER BY `pid` DESC LIMIT ".($page-1)*$num.",".$num);

			while($Re = $DB->fetch_array($Result))
			{
				$postArr[] = array(
									"pid" => $Re['pid'],
									"tid" => $Re['tid'],
									"message" => stripslashes($Re['message'])
									);
			}
		}

		$return['Total'] = $Total;

		$return['Post'] = $postArr;
		
		$return['Page'] = $this->Pagination($Total,$num,$page);
		
		return $return;
	}

	function Pagination($total,$per,$page)
	{
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

		$string = $_SERVER['PHP_SELF']."?";

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

		$return['pageTotal'] = $allpage;
			
		$return['pagePre'] = $pagePre;
			
		$return['pageFirst'] = $pageFirst;
			
		$return['pageList'] = $pageList;
			
		$return['pageLast'] = $pageLast;
			
		$return['pageNext'] = $pageNext;

		return $return;
	}
}
?>