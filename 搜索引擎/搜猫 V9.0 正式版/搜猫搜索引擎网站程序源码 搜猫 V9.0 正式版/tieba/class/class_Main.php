<?php
class MainAction
{
	public function getCategory()
	{
		global $DB,$table_catalog;

		$categoryArr = array();

		$Query = $DB->query("SELECT * FROM `".$table_catalog."` WHERE `fatherid` = 0");

		while($Re = $DB->fetch_array($Query))
		{
			$classArr = array();

			$Result = $DB->query("SELECT * FROM `".$table_catalog."` WHERE `fatherid`=".$Re['cid']." LIMIT 5");

			while($Ce = $DB->fetch_array($Result))
			{
				$classArr[] = array("cid" => $Ce['cid'],"name" => stripslashes($Ce['name']));
			}

			$categoryArr[] = array("cid" => $Re['cid'],"name" => stripslashes($Re['name']),"subcategory"=>$classArr);
		}

		return $categoryArr;
	}

	private function showTime($time)
	{
		return ( date('ymd',$time) == date('ymd') ) ? date('H:i',$time) : date('m.d',$time);
	}

	public function getTopic($F,$N=12)
	{
		global $DB,$table_topic;

		$Topic = array();

		$timeDiff = time()-1296000;

		$Sql = "SELECT `tid`,`subject`,`dateline`,`lasttime` FROM `".$table_topic."` WHERE `dateline` > ".$timeDiff." ORDER BY `".$F."` DESC LIMIT ".$N;

		$Query = $DB->query($Sql);

		while($Re = $DB->fetch_array($Query))
		{
			$Topic[] = array(
								"tid" => $Re['tid'],
								"subject" => filterHTML($Re['subject']),
								"time" => self::showTime($Re['dateline']),
								"last" => self::showTime($Re['lasttime'])
							);
		}

		return $Topic;
	}

	public function getForum($N=5)
	{
		global $DB,$table_forum;

		$forumArr = array();

		$Query = $DB->query("SELECT `fid`,`name`,`synopsis` FROM `".$table_forum."` WHERE `commend` > 0 ORDER BY `commend` DESC LIMIT ".$N);

		while($Re = $DB->fetch_array($Query))
		{
			$forumArr[] = array(
								"fid" => $Re['fid'],
								"name" => stripslashes($Re['name']),
								"synopsis" => filterHTML($Re['synopsis'])
								);
		}
		
		return $forumArr;
	}

	public function getMember($N=8)
	{
		global $DB,$table_member;

		$MemberArr = array();

		$Query = $DB->query("SELECT `uid`,`name`,`integral` FROM `".$table_member."` ORDER BY `integral` DESC LIMIT ".$N);

		while($Re = $DB->fetch_array($Query))
		{
			$MemberArr[] = array(
								"uid" => $Re['uid'],
								"name" => stripslashes($Re['name']),
								"integral" => $Re['integral'],
								);
		}
		
		return $MemberArr;
	}
}
?>