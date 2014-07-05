<?php
function add_links_insite($link)
{
   if(!is_url($link))
   {
      return false;
   }
   global $db,$config;
   $spider=new spider;
   $spider->url($link);
   $links= $spider->get_insite_links();
   $site_url=GetSiteUrl($link);
   $site=$db->get_one("select * from ve123_sites where url='".$site_url."'");
   $site_id=$site["site_id"];
   //print_r($links);
   foreach($links as $value)
   {
                  $value=rtrim($value,"/");
                  $row=$db->get_one("select * from ve123_links where url='".$value."'");
	              if(empty($row)&&is_url($value))
	              {
				     echo $value."<br>";
			         $array=array('url'=>$value,'site_id'=>$site_id,'level'=>'1');
		             $db->insert("ve123_links",$array);
			      }
				  else
				  {
				      echo "已存在:".$value."<br>";
				  }
				   ob_flush();
                   flush();
                   sleep(1);
                  $row=$db->get_one("select * from ve123_links_temp where url='".$value."'");
	              if(empty($row)&&is_url($value))
	              {
			         $array=array('url'=>$value);
		             $db->insert("ve123_links_temp",$array);
			      }
   }
}
function add_links_insite_fromtemp($in_url)
{
      global $db;
	  $domain=getdomain($in_url);
	  $query=$db->query("select * from ve123_links_temp where url like '%".$domain."%' and  updatetime<='".(time()-(86400*30))."'");
	  while($row=$db->fetch_array($query))
	  {
	        @$db->query("update ve123_links_temp set updatetime='".time()."' where url='".$row["url"]."'");
	        add_links_insite($row["url"]);
			sleep(3);
	  }
	  sleep(5);
	  add_links_insite_fromtemp($in_url) ;   
}
function insert_links($url)
{
   global $db,$config;
   $spider=new spider;
   $spider->url($url);
   $links= $spider->links();
   $sites= $spider->sites();

   foreach($sites as $value)
   {
   
          $site_url=GetSiteUrl($link);
          $site=$db->get_one("select * from ve123_sites where url='".$site_url."'");
          $site_id=$site["site_id"];
                  $row=$db->get_one("select * from ve123_links where url='".$value."'");
	 
	              if(empty($row)&&is_url($value))
	              {
				  
				     echo $value."<br>";
			         $array=array('url'=>$value,'site_id'=>$site_id,'level'=>'0');
		             $db->insert("ve123_links",$array);
					
			      }
				  else
				  {
				      echo "已存在:".$value."<br>";
				  }
				   ob_flush();
                   flush();
				   sleep(1);
		     $row=$db->get_one("select * from ve123_sites where url='".$value."'");
	 
	              if(empty($row)&&is_url($value))
	              {
			         $array=array('url'=>$value,'spider_depth'=>$config["spider_depth"],'addtime'=>time());
		             $db->insert("ve123_sites",$array);
					
			      }
   }
    sleep(1);
   foreach($links as $value)
   {
         $row=$db->get_one("select * from ve123_links_temp where url='".$value."'");
	     if(empty($row)&&is_url($value))
	     {
			$array=array('url'=>$value);
		    $db->insert("ve123_links_temp",$array);
		 }
   }
}
function GetUrl_AllSite($in_url)
{
      global $db;
	  $query=$db->query("select * from ve123_links_temp where url like '%".$in_url."%' and  updatetime<='".(time()-(86400*30))."'");
	  while($row=$db->fetch_array($query))
	  {
	        @$db->query("update ve123_links_temp set updatetime='".time()."' where url='".$row["url"]."'");
	        insert_links($row["url"]);
			sleep(3);
	  }
	  sleep(5);
	  GetUrl_AllSite($in_url) ;
}
function Update_link($url)
{
   global $db,$bug_url;
   $is_success=FALSE;
   $is_shoulu=FALSE;
   $spider=new spider;
   $spider->url($url);
   $title=$spider->title;
   $fulltxt=$spider->fulltxt(800);
   $pagesize=$spider->pagesize;
   $keywords=$spider->keywords;
   $htmlcode=$spider->htmlcode;
   $description=$spider->description;
   $site_url=GetSiteUrl($url);
   $site=$db->get_one("select * from ve123_sites where url='".$site_url."'");
   $site_id=$site["site_id"];echo $title;
   $array=array('title'=>$title,'fulltxt'=>$fulltxt,'pagesize'=>$pagesize,'keywords'=>$keywords,'description'=>$description,'site_id'=>$site_id);
   $db->query("update ve123_links set updatetime='".time()."' where url='".$url."'");
   if(!empty($title))
   {
        $s=array();
        $s=explode("?",$title);
		
        if($pagesize>1&&count($s)<2)
        {
		    $domain=GetSiteUrl($url);
			$site=$db->get_one("select * from ve123_sites where url='".$domain."'");
			if(!empty($site))
			{
			     if(!empty($site["include_word"]))
				 {
				      foreach(explode(",",$site["include_word"]) as $value)
				     {
				            if(stristr($htmlcode,$value))
							{
							    $include_num+=1;
							}
				     }
					 if($include_num<=0)
					 {
					    $is_shoulu=FALSE;
					 }
				 }
				 else
				 {
				      $is_shoulu=TRUE;
				 }
				  if(!empty($site["not_include_word"]))
				  {
				      foreach(explode(",",$site["not_include_word"]) as $value)
				     {
				            if(stristr($htmlcode,$value))
							{
							    $not_include_num+=1;
							}
				     }
					 if($not_include_num>0)
					 {
					    $is_shoulu=FALSE;
					 }
				  }
			}
			else
			{
			    $is_shoulu=TRUE;
			}
			if($is_shoulu)
			{
                $db->update("ve123_links",$array,"url='".$url."'");
			    //file_put_contents(PATH."k/www/".str_replace("http://","",$url.".html"),$htmlcode);
			    $is_success=TRUE;
			}
        }
	}
  if(empty($bug_url))
   {
       exit();
   }
   return $is_success;

}
function Update_All_Link($in_url='',$days)
{
      global $db;
	  if(empty($in_url))
	  {
	    $sql="select * from ve123_links where updatetime<='".(time()-(86400*$days))."' order by link_id desc";//echo $days."<br>";
	  }
	  else
	  {
	     //$sql="select * from ve123_links where url like '%.".getdomain($in_url)."%' order by link_id desc";//echo $days."<br>";
		 $sql="select * from ve123_links where url like '%".$in_url."%' order by link_id desc";//echo $days."<br>";
	  }
	  //$sql="select * from ve123_links order by link_id";
	  echo $sql;
	  $query=$db->query($sql);
	  while($row=$db->fetch_array($query))
	  {
	     if(is_url($row["url"]))
		 {
	        echo $row["url"]."<br>";
            ob_flush();
            flush();
            sleep(1);
	        Update_link($row["url"]);
		 }
			
			//sleep(2);
	  }
	  sleep(20);
	 // Update_All_Link($in_url) ;
}
function foothtml()
{
echo "<div style=\"text-align:center;\"><a target=\"_blank\" href=\"http://www.somao123.com\">Powered by somao</a></div>";
}
?>