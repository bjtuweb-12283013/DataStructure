<?php
class search
{
   var $db;
   var $total;
   var $wd;
   var $wd_split;
   var $wd_array;
   var $wd_count;
   var $totalpage;
   function q($wd,$domain='')
   {
      global $db;
	  $this->db = &$db;
	  $this->wd=$wd;
	  require "../include/splitword.func.php";
	  $sp = new SplitWord();
      $wd_split = $sp->SplitRMM($wd);
	        $sp->Clear();
			$this->wd_split=$wd_split = ereg_replace("[ ]{1,}"," ",trim($wd_split));
			$this->wd_array=$wd_array=explode(" ",$wd_split);
			$this->wd_count=$wd_count=count($wd_split);//echo $wd_count;
	  $tgarray=$this->GetTg();
	  $tgarray_count=count($tgarray);
      $ordersql=" order by  links.tuiguang desc,(";
	  foreach($wd_array as $value)
	  {
     	   $ordersql.="(case when links.title like '%".$value."%' then 1 else 0 end)+";
	  }
	   
	  $ordersql.="(case when links.title like '%".$wd."%' then 8 else 0 end)";
	  // $ordersql=rtrim($ordersql,"+");
	   $ordersql.=") desc";
	   $keywordsql=$this->GetKeywordSql("links.title,' ',links.url,' ',links.fulltxt");
	   if(empty($keywordsql))
	   {
	       $keywordsql="links.title like '%".$wd."%'";
	   }
	   if(empty($domain))
	   {
	      $sql="select links.*,sites.qp from ve123_links links left join ve123_sites sites on links.site_id=sites.site_id where links.title<>'' and ".$keywordsql.$ordersql;
	   }
	   else
	   {
	          if($domain==getdomain($domain))
		      {
		          $sql="select * from ve123_links where title<>'' and url like '%.".$domain."%' or url like '%//".$domain."%'"; //echo $sql;
		      }
	          else
		      {
		           $sql="select * from ve123_links where title<>'' and url regexp 'http://".$domain."'";//echo $sql;
		       }
	   }
	   //echo $sql;
	   $query=$db->query($sql);
	   $this->total=$total=$db->num_rows($query)+$tgarray_count;
	   $pagesize=10;
	   $this->totalpage=$totalpage=ceil($total/$pagesize);
	   $p=intval($_GET["p"]);
	   if($p<=0){$p=1;}
	   $offset=($p-1)*$pagesize;
	   $query=$db->query($sql." limit $offset,$pagesize");
	    while($row=$db->fetch_array($query))
         {
		      $data["title"]=$this->GetRedKeyWord(str_cut($row["title"],50));
			  if(!$row["description"])$row["description"] = $row["fulltxt"];
			  $data["txt"]=$this->GetRedKeyWord(str_cut($row["description"],160));
			  $data["url"]=str_cut($row["url"],400);
			  $data["updatetime"]=date("Y-m-d",$row["updatetime"]);
			  $data["pagesize"]=$row["pagesize"];
			  $data["link_id"]=$row["link_id"];
			  $data["tuiguang"]=$row["tuiguang"];
			  $array[] = $data;
		 }
		 
		 $array_count=count($array);
		 if(empty($array_count))
		 {
		     $newarray=$tgarray;
		 }
		 elseif($p==1&&$tgarray_count>0)
		 {
		     $newarray=array_merge($tgarray,$array);
		 }
		 else
		 {
		     $newarray=$array;
		 }
		 return $newarray;
   }
   function GetTg()
   {
        $db=$this->db;
		$array=array();
		$keywordsql=$this->GetKeywordSql("title,' ',url,' ',description");
	    if(empty($keywordsql))
	    {
	       $keywordsql="title like '%".$this->wd."%'";
	    }
		$sql="select a.*,b.* from ve123_zz_links a left join ve123_zz_user b on a.user_id=b.user_id where b.points>=a.price and a.user_id>0 and ".$keywordsql." order by price desc limit 10";//echo $sql;
	    $query=$db->query($sql);
	    while($row=$db->fetch_array($query))
         {
		      $data["title"]=$this->GetRedKeyWord(str_cut($row["title"],80));
			  $data["title2"]=$row["title"];
			  $data["txt"]=$this->GetRedKeyWord(str_cut($row["description"],250));
			  $data["txt2"]=$row["description"];
			  $data["url"]=str_cut($row["url"],400);
			  $data["updatetime"]=date("Y-m",$row["updatetime"]);
			  $data["pagesize"]=number_format(strlen($row["description"])/1024, 0, ".", "")+1;
			  $data["link_id"]=$row["link_id"];
			  $data["is_tg"]=true;
			  $data["jscode"]=$row["jscode"];
			  $data["pic"]=$row["pic"];
			  $array[] = $data;
		 }
		 return $array;
   }
   	function GetRedKeyWord($fstr)
	{
		//$ks = explode(' ',$this->Keywords);
		$ks=$this->wd_array;
		$kwsql = '';
		foreach($ks as $k)
		{
			$k = trim($k);
			if($k=='')
			{
				continue;
			}
			if(ord($k[0])>0x80 && strlen($k)<0)
			{
				continue;
			}
			$fstr = str_replace($k,"<font color='#C60A00'>$k</font>",$fstr);
		}
		return $fstr;
	}
	function GetKeywordSql($fields)
	{
		//$ks = explode(' ',$this->Keywords);
		$ks=$this->wd_array;
		$kwsql = '';
		$kwsqls = array();
		foreach($ks as $k)
		{
			$k = trim($k);
			if(strlen($k)<2)
			{
				continue;
			}
			if(ord($k[0])>0x80 && strlen($k)<3)
			{
				continue;
			}
			$k = addslashes($k);
			//if($this->SearchType=="title")
			//if(false)
			//{
			//	$kwsqls[] = " arc.title like '%$k%' ";
		//	}
		//	else
		//	{
				$kwsqls[] = " CONCAT(".$fields.") like '%$k%' ";
		//	}
		}
		if(!isset($kwsqls[0]))
		{
			return '';
		}
		else
		{
			//if($this->KType==1)
			//if(1)
			//{
				$kwsql = join(' OR ',$kwsqls);
		//	}
		//	else
		//	{
			//	$kwsql = join(' And ',$kwsqls);
		//	}
			return $kwsql;
		}
	}
	
}
?>