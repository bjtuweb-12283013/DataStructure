<?php

//抓全站--- 多线程
function all_links_duo($site_id,$ceng,$include_word,$not_include_word)
{
   global $db; 
   $new_url=array();
   $fenge=array();
   $nei=1;//1代表只收内链 2代表外链 空代表所有
   $numm=20;//开启多少线程
   	echo "<br><b>开始抓取第".$ceng."层</b><br>";
	$ceng++;
	$row=$db->get_one("select * from ve123_links_temp where site_id='".$site_id."' and no_id='0'");
	if(empty($row)){echo "  ---------- 没有新链接了<br>";return;}//如果找不到新增加url,则结束
	  
	  
   $query=$db->query("select * from ve123_links_temp where site_id='".$site_id."' and no_id='0'");
   while($row=$db->fetch_array($query))
	 {		
		  $new_url[]=$row[url];
	 }
   $he_num = ceil(count($new_url)/$numm);//计算需要循环多少次
   $fenge=array_chunk($new_url,$numm);//把数组分割成多少块数组 每块大小$numm 


  /* echo "一共多少个";
   echo count($new_url);
      echo "需要循环";
   echo $he_num;
   echo "次<br>";	*/
   
      
   for($i=0;$i<=$he_num;$i++) 
	 {
		 /*echo "开始循环第 ".$i." 次<br>";
		 print_r($fenge[$i]);
		 echo "<br>";*/
		$fen_url = array();
		$fen_url = cmi($fenge[$i]);
		 //需要把得到的数组  (数组只包括 网址和源码) 分析  写入数据库 ,
			/*echo "<b>本次抓完的网址为</b>";
			print_r($fen_url[url]);
			echo "<br>";*/
		foreach ((array)$fen_url as $url => $file)
  	 	{ 
					$links = array();
					$temp_links = array();
					$cha_temp = array();
					$loy = array();
					$new_links = array();			
					$cha_links = array();
					$cha_links_num = array();
					
					$links = _striplinks($file);			   //从htmlcode中提取网址
					$links = _expandlinks($links, $url);       //补全网址
					$links=check_wai($links,$nei,$url);
					$links=array_values(array_unique($links)); 
							
					$bianma = bianma($file);					  //获取得到htmlcode的编码
					$file  = Convert_File($file,$bianma);		 //转换所有编码为gb2312	
					$loy = clean_lry($file,$url,"html"); 
					$title=$loy["title"];                     //从数组中得到标题,赋值给title	
					$pagesize=number_format(strlen($file)/1024, 0, ".", "");
					$fulltxt=Html2Text($loy["fulltext"]); 
					$description=$loy["description"];         //从数组中得到标题,赋值给description	
					$keywords=$loy["keywords"];               //从数组中得到标题,赋值给keywords	
					$lrymd5=md5($fulltxt);	
					$updatetime=time();
				if($title==""){$title=str_cut($fulltxt,65); }
					
		//根据url,更新内容	
	  		$array=array('lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
      		$db->update("ve123_links",$array,"url='".$url."'");
	
			$all_num = count($links);
	  //开始读取 ve123_links_temp 中所有site_id 为$site_id 的url   然后和抓取的 $links 数组比较,将得到的差集创建到  ve123_links_temp 中
			$query=$db->query("select url from ve123_links_temp where url like '%".getdomain($url)."%'");
			while($row=$db->fetch_array($query))
	 		 {		
				 $temp_links[]=rtrim($row[url],"/");
			  }  
			  		  
			$cha_temp=array_diff($links,$temp_links);
					
  			foreach((array)$cha_temp as $value)
  			 {
			 	if(check_include($value, $include_word, $not_include_word ))
				 {
					 $arral=array('url'=>$value,'site_id'=>$site_id);
					 $db->insert("ve123_links_temp",$arral);
				 }  

			 }				  

	//开始读取 ve123_links 中所有site_id 为 $site_id 的url   然后和抓取的 $links 数组比较,将得到的差集创建到  ve123_links 中  合集则输出 已存在了
			$query=$db->query("select url from ve123_links where url like '%".getdomain($url)."%'");
			while($row=$db->fetch_array($query))
	 		 {		
		 		  $new_links[]=rtrim($row[url],"/");
	  		}  				 
		 
			$cha_links=array_diff($links,$new_links);

			foreach((array)$cha_links as $value)
  			 { 
				if(check_include($value, $include_word, $not_include_word ))
				 {
					$array=array('url'=>$value,'site_id'=>$site_id,'level'=>'1');
					$db->insert("ve123_links",$array);
					$cha_links_num[]=$value;
				 } 
			 }	
			 
			$cha_num = count($cha_links_num);	 
			printLinksReport($cha_num, $all_num, $cl=0);
			 echo "<a href=".$url." target=_blank>".$url. "</a><br>";
			 
			$arral=array('no_id'=>1);
	 	    $db->update("ve123_links_temp",$arral,"url='$url'");	
			 ob_flush();
  	  		 flush();	  	  					
			}
		 }

	
   all_links_duo($site_id,$ceng,$include_word,$not_include_word);//再次调用本函数开始循环
}	


//一键找站  
function find_sites($site_id,$ceng)
{
   global $db; 
   $new_url=array();
   $fenge=array();
   $numm=20;//开启多少线程
   	echo "<br><b>开始抓取第".$ceng."层</b><br>";
	$ceng++;
	$row=$db->get_one("select * from ve123_sites_temp where site_id='".$site_id."' and no_id='0'");
	if(empty($row)){echo "  ---------- 没有新链接了<br>";return;}//如果找不到新增加url,则结束
	  
	  
   $query=$db->query("select * from ve123_sites_temp where site_id='".$site_id."' and no_id='0'");
   while($row=$db->fetch_array($query))
	 {		
		  $new_url[]=$row[url];
	 }
   $he_num = ceil(count($new_url)/$numm);//计算需要循环多少次
   $fenge=array_chunk($new_url,$numm);//把数组分割成多少块数组 每块大小$numm 
    
   for($i=0;$i<=$he_num;$i++) 
	 {
		$fen_url = array();
		$fen_url = cmi($fenge[$i]);
		 //需要把得到的数组  (数组只包括 网址和源码) 分析  写入数据库 ,
		foreach ((array)$fen_url as $url => $file)
  	 	{ 
					$links = array();	
					$fen_link = array();
					$nei_link = array();
					$wai_link = array();
					$new_temp = array();
					$cha_temp = array();
					$new_site = array();
					$cha_site = array();
					$new_lik = array();
					$cha_lik = array();
					
					$links = _striplinks($file);			   //从htmlcode中提取网址
					$links = _expandlinks($links, $url);       //补全网址					
					$fen_link=fen_link($links,$url);            //把内链和外链分开
					$nei_link=array_values(array_unique($fen_link[nei])); //过滤内链 重复的网址
					$wai_link=GetSiteUrl($fen_link[wai]);                //把外链都转换成首页
					$wai_link=array_values(array_unique($wai_link)); //过滤外链 重复的网址


					//读出 ve123_sites_temp 中所有 site_id=-1  and no_id=0
  				  $query=$db->query("select url from ve123_sites_temp where site_id='".$site_id."'");
  				  while($row=$db->fetch_array($query)) { $new_temp[]=$row[url]; }
					$cha_temp=array_diff($nei_link,$new_temp);//与内链进行比较 得出差集
					//将差集创建到 ve123_sites_temp 中
  					foreach((array)$cha_temp as $value)
  					  {		$arral=array('url'=>$value,'site_id'=>$site_id,'no_id'=>0);
							$db->insert("ve123_sites_temp",$arral);
					  }	
	  
					//读出 ve123_sites 中所有 site_id=-1 global $db;
				  $query=$db->query("select url from ve123_sites where site_no='".$site_id."'");
				  while($row=$db->fetch_array($query))  {	$new_site[]=$row[url]; }
					$cha_site=array_diff($wai_link,$new_site);//与外链进行比较 得出差集
					//将差集创建到 ve123_sites 中
 				 	foreach((array)$cha_site as $value)
					  {		$arral=array('url'=>$value,'site_no'=>$site_id);
							$db->insert("ve123_sites",$arral);
					  }			  
	  	
		
					//读出 ve123_links 中所有 site_id=-1 global $db;
					global $db;
			      $query=$db->query("select url from ve123_links where site_id='".$site_id."'");
			      while($row=$db->fetch_array($query)) { $new_lik[]=$row[url]; }
					$cha_lik=array_diff($wai_link,$new_lik);//与外链进行比较 得出差集	
					//将得到的差集 创建到 ve123_links 
					foreach ((array)$cha_lik as $value)
				  	 { 							
					  	$array=array('url'=>$value,'site_id'=>$site_id);
						$db->insert("ve123_links",$array);
						echo "<font color=#C60A00><b>抓取到:</b></font>";
						echo "<a href=".$value." target=_blank>".$value."</a><br>";
					 }
		 
					$arral=array('no_id'=>1);
			 	    $db->update("ve123_sites_temp",$arral,"url='$url'");	
					 ob_flush();
 		 	  		 flush();	  	  					
			 }
	    }

	
   find_sites($site_id,$ceng);//再次调用本函数开始循环
}	



//一键更新 已抓站
function Update_sites($site_id)
{
   global $db; 
   $numm=20;//开启多少线程
   $new_url = array();
   $fenge = array();
   
   $query=$db->query("select url from ve123_links where site_id='".$site_id."' and length(lrymd5)!=32");
   while($row=$db->fetch_array($query))
	 {		
		  $new_url[]=$row[url];
	 }
   $he_num = ceil(count($new_url)/$numm);//计算需要循环多少次
   $fenge=array_chunk($new_url,$numm);//把数组分割成多少块数组 每块大小$numm 
     
   for($i=0;$i<=$he_num;$i++) 
	 {
		$fen_url = array();
		$fen_url = cmi($fenge[$i]);
		 //需要把得到的数组  (数组只包括 网址和源码) 分析  写入数据库 ,
		foreach ((array)$fen_url as $url => $file)
  	 	{ 
					$links = array();
					$temp_links = array();
					$cha_temp = array();
					$loy = array();
					$new_links = array();			
					$cha_links = array();
					$cha_links_num = array();
					
					$bianma = bianma($file);					  //获取得到htmlcode的编码
					$file  = Convert_File($file,$bianma);		 //转换所有编码为gb2312	
						if($file==-1) {echo "<b><font color=#C60A00>抓取失败</b></font> ".$url."<br>"; continue;}
					$loy = clean_lry($file,$url,"html");      //设置分析数组
					$title=$loy["title"];                     //从数组中得到标题,赋值给title	
					$pagesize=number_format(strlen($file)/1024, 0, ".", "");
					$fulltxt=Html2Text($loy["fulltext"]); 
					$description=$loy["description"];         //从数组中得到标题,赋值给description	
					$keywords=$loy["keywords"];               //从数组中得到标题,赋值给keywords	
					$lrymd5=md5($fulltxt);	
					$updatetime=time();
				if($title==""){$title=str_cut($fulltxt,65); }
					
				//根据url,更新内容
		   			echo "<b><font color=#0Ae600>已更新</font></b>";
					echo $title;
					echo "<a href=".$url." target=_blank>".$url. "</a><br>";	
	  		$array=array('lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
      		$db->update("ve123_links",$array,"url='".$url."'");
		 }

	 }
}


//一键找站  暂时不用的
function find_sites_($url)
{
	 $oldtime=time();
	 $site_id = -1;
	 $numm=10;
	 $links=array();
    $fen_link=array();	
	$lrp =array();	
	$nei_link =array();	
	$wai_link =array();	
	$new_temp =array();	
	$cha_temp =array();	
	$new_site =array();	
	$cha_site =array();	
	$new_lik =array();	
	$cha_lik =array();	
	$fenge =array();	
	
	$lrp = cmi($url);
	$links = _striplinks($lrp[$url]);			   //从htmlcode中提取网址
	$links = _expandlinks($links, $url);       //补全网址
	$fen_link=fen_link($links,$url);        //把内链和外链分开
	$nei_link=array_values(array_unique($fen_link[nei])); //过滤内链 重复的网址
	$wai_link=GetSiteUrl($fen_link[wai]);                //把外链都转换成首页
	$wai_link=array_values(array_unique($wai_link)); //过滤外链 重复的网址
		/*print_r($nei_link);
		echo "<br><br>";
		print_r($wai_link);*/
		
	//读出 ve123_sites_temp 中所有 site_id=-1  and no_id=0
	global $db;
   $query=$db->query("select url from ve123_sites_temp where site_id='-1' and no_id='0'");
   while($row=$db->fetch_array($query))
	 {		
		  $new_temp[]=$row[url];
	 }

	$cha_temp=array_diff($nei_link,$new_temp);//与内链进行比较 得出差集

	//将差集创建到 ve123_sites_temp 中
  	foreach((array)$cha_temp as $value)
  	  {
			$arral=array('url'=>$value,'site_id'=>$site_id,'no_id'=>0);
			$db->insert("ve123_sites_temp",$arral);
	  }	



	//读出 ve123_temp 中所有 site_id=-1 global $db;
	global $db;
   $query=$db->query("select url from ve123_sites where site_no='-1'");
   while($row=$db->fetch_array($query))
	 {		
		  $new_site[]=$row[url];
	 }

	$cha_site=array_diff($wai_link,$new_site);//与外链进行比较 得出差集

	//将差集创建到 ve123_sites 中
  	foreach((array)$cha_site as $value)
  	  {
			$arral=array('url'=>$value,'site_no'=>$site_id);
			$db->insert("ve123_sites",$arral);
	  }		
	  
	//读出 ve123_links 中所有 site_id=-1 global $db;
	global $db;
   $query=$db->query("select url from ve123_sites where site_id='-1'");
   while($row=$db->fetch_array($query))
	 {		
		  $new_lik[]=$row[url];
	 }

	$cha_lik=array_diff($wai_link,$new_lik);//与外链进行比较 得出差集	  






//将得到的差集 创建到 ve123_links 
   $he_num = ceil(count($cha_lik)/$numm);//计算需要循环多少次
   $fenge=array_chunk($cha_lik,$numm);//把数组分割成多少块数组 每块大小$numm 
    
   for($i=0;$i<=$he_num;$i++) 
	 {
		$fen_url = array();
		$fen_url = cmi($fenge[$i]);  //多线程开始采集
		foreach ((array)$fen_url as $url => $file)
  	 	{ 							
					$bianma = bianma($file);					  //获取得到htmlcode的编码
					$file  = Convert_File($file,$bianma);		 //转换所有编码为gb2312	
					$loy = clean_lry($file,$url,"html");        //过滤 file 中标题等 到数组
					$title=$loy["title"];                     //从数组中得到标题,赋值给title	
					$pagesize=number_format(strlen($file)/1024, 0, ".", "");
					$fulltxt=Html2Text($loy["fulltext"]); 
					$description=$loy["description"];         //从数组中得到标题,赋值给description	
					$keywords=$loy["keywords"];               //从数组中得到标题,赋值给keywords	
					$lrymd5=md5($fulltxt);	
					$updatetime=time();
				if($title==""){$title=str_cut($fulltxt,65); }
					
		//根据url,更新内容	
	  		$array=array('url'=>$value,'lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
			$db->insert("ve123_links",$array);
			echo "<font color=#C60A00><b>抓取到:</b></font>".$title;
			echo "<a href=".$url." target=_blank>".$url."</a><br>";
	
		 }

	 }
		 
		 
		 
	   $newtime=time();
	   echo "  --- <b>用时:</b>";
	   echo date("H:i:s",$newtime-$oldtime-28800);
	   echo "<br>";
	   del_links_temp($site_id);
}	



//抓全站--- 单线程
function all_url_dan($url,$old,$nei,$ooo,$site_id,$include_word,$not_include_word)
{
   if(!is_url($url)) { return false;}
   global $db,$config;   
	
	$snoopy = new Snoopy;     //国外snoopy程序
	$snoopy->fetchlry($url); 
	$links=$snoopy->resulry; 
		if(!is_array($links)) {return;}
	$links=check_wai($links,$nei,$url);
	$links=array_values(array_unique($links)); 

	$title=$snoopy->title;
	$fulltxt=$snoopy->fulltxt; 
	$lrymd5=md5($fulltxt);
	$pagesize=$snoopy->pagesize;
	$description=$snoopy->description;
	$keywords=$snoopy->keywords;
	$updatetime=time();
	if($title==""){$title=str_cut($fulltxt,65); }

	//读取url,更新内容	
	  $array=array('lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
      $db->update("ve123_links",$array,"url='".$url."'");
		
	$all_num = count($links);
	$temp_links=array();
	$cha_temp=array();

	//开始读取 ve123_links_temp 中所有site_id 为$site_id 的url   然后和抓取的 $links 数组比较,将得到的差集创建到  ve123_links_temp 中
	$query=$db->query("select url from ve123_links_temp where url like '%".getdomain($url)."%'");
	while($row=$db->fetch_array($query))
	  {		
		 $temp_links[]=rtrim($row[url],"/");
	  }  
	$cha_temp=array_diff($links,$temp_links);
			
  	 foreach((array)$cha_temp as $value)
  	 { 
		 $arral=array('url'=>$value,'site_id'=>$site_id);
		 $db->insert("ve123_links_temp",$arral);
	 }				  

	//开始读取 ve123_links 中所有site_id 为 $site_id 的url   然后和抓取的 $links 数组比较,将得到的差集创建到  ve123_links 中  合集则输出 已存在了
	$query=$db->query("select url from ve123_links where url like '%".getdomain($url)."%'");
	while($row=$db->fetch_array($query))
	  {		
		   $new_links[]=rtrim($row[url],"/");
	  }  				 
		 
	$cha_links=array_diff($links,$new_links);
	$cha_num = count($cha_links);
	foreach((array)$cha_links as $value)
  	 { 
		if(check_include($value, $include_word, $not_include_word ))
		 {
			$array=array('url'=>$value,'site_id'=>$site_id,'level'=>'1');
			$db->insert("ve123_links",$array);
		 } 
	 }	
	 
	printLinksReport($cha_num, $all_num, $cl=0);
	 echo "<a href=".$old." target=_blank>".$old. "</a>";
	 ob_flush();
     flush();	  	  
}



//抓全站--- 单线程---不用的
function add_all_url_ ($url,$old,$numm,$ooo,$site_id,$include_word,$not_include_word)
{
   if(!is_url($url)) { return false;}
   global $db,$config;   
	
	$snoopy = new Snoopy;     //国外snoopy程序
	$snoopy->fetchlry($url); 
	$links=$snoopy->resulry; 
		if(!is_array($links)) {return;}
	$links=check_wai($links,$numm,$url);
	$links=array_values(array_unique($links)); 

	$title=$snoopy->title;
	$fulltxt=$snoopy->fulltxt; 
	$lrymd5=md5($fulltxt);
	$pagesize=$snoopy->pagesize;
	$description=$snoopy->description;
	$keywords=$snoopy->keywords;
	$updatetime=time();
	if($title==""){$title=str_cut($fulltxt,65); }

	//读取url,更新内容	
	  $array=array('lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
      $db->update("ve123_links",$array,"url='".$url."'");
		
	$all_num = count($links);
	$temp_links=array();
	$cha_temp=array();

	//开始读取 ve123_links_temp 中所有site_id 为$site_id 的url   然后和抓取的 $links 数组比较,将得到的差集创建到  ve123_links_temp 中
	$query=$db->query("select url from ve123_links_temp where url like '%".getdomain($url)."%'");
	while($row=$db->fetch_array($query))
	  {		
		 $temp_links[]=rtrim($row[url],"/");
	  }  
	$cha_temp=array_diff($links,$temp_links);
  	 foreach((array)$cha_temp as $value)
  	 { 
		 $arral=array('url'=>$value,'site_id'=>$site_id);
		 $db->insert("ve123_links_temp",$arral);
	 }				  

	//开始读取 ve123_links 中所有site_id 为 $site_id 的url   然后和抓取的 $links 数组比较,将得到的差集创建到  ve123_links 中  合集则输出 已存在了
	$query=$db->query("select url from ve123_links where url like '%".getdomain($url)."%'");
	while($row=$db->fetch_array($query))
	  {		
		   $new_links[]=rtrim($row[url],"/");
	  }  				 
	$he_links=array_intersect($links,$new_links);
	$he_num = count($he_links);
		 
	$cha_links=array_diff($links,$new_links);
	$cha_num = count($cha_links);
	foreach((array)$cha_links as $value)
  	 { 
		if(check_include($value, $include_word, $not_include_word ))
		 {
			$array=array('url'=>$value,'site_id'=>$site_id,'level'=>'1');
			$db->insert("ve123_links",$array);
		 } 
	 }	
	 
	printLinksReport($cha_num, $all_num, $cl=0);
	 echo "<a href=".$old." target=_blank>".$old. "</a>";
	 ob_flush();
     flush();	  	  
}


function printLinksReport($cha_num, $all_num, $cl) {
	global $print_results, $log_format;
	$cha_html = " <font color=\"blue\">页面包含<b>$all_num</b>条链接</font>。 <font color=\"red\"><b>$cha_num</b>条新链接。</font>\n";
	$no_html = " <font color=\"blue\">页面包含<b>$all_num</b>条链接</font>。 没有新链接。\n";	
	if($cha_num==0) {print $no_html; flush();}
	else{print $cha_html;}


}


function add_links_insite($link,$old,$numm,$ooo,$site_id,$include_word,$not_include_word)
{
   if(!is_url($link))
   {
      return false;
   }
   global $db,$config;
   
  /* $spider=new spider;  //系统自带蜘蛛
     echo "<b>网站编码</b>（默认GB2312）<b>:";
     $spider->url($link);
     echo "</b><br>";
     $links= $spider->get_insite_links();
	*/
   //$site_url=GetSiteUrl($link);
   $url_old=GetSiteUrl($old);
  	  echo "原始页=".$url_old." - - <";
   	  echo "首层 id=".$site_id."> - - <";
      echo "包含字段=".$include_word.">";
	  echo "<br>";
   /*if($ooo==0)
   {
   		$site=$db->get_one("select * from ve123_sites where url='".$url_old."'");
   		$site_id=$site["site_id"];
   		$include_word=$site["include_word"];  
   		$not_include_word=$site["not_include_word"]; 
   		$spider_depth=$site["spider_depth"];  
   }  */   

$snoopy = new Snoopy;     //国外snoopy程序
$snoopy->fetchlinks($link); 
$links=$snoopy->results; 
$links=check_wai($links,$numm,$link);
$links=array_values(array_unique($links)); 

  	 foreach((array)$links as $value)
  	 { 
	 	 $row=$db->get_one("select * from ve123_links_temp where url='".$value."'");
		 if(empty($row))
	        {
		 		$arral=array('url'=>$value,'site_id'=>$site_id);
			    $db->insert("ve123_links_temp",$arral);
			 }				  
	 
         $value=rtrim($value,"/");
         $row=$db->get_one("select * from ve123_links where url='".$value."'");	 	  
		if (check_include($value, $include_word, $not_include_word )) {
	        	 if(empty($row)&&is_url($value))
	              {
				     echo "<font color=#C60A00><b>抓取到:</b></font>";
			         $array=array('url'=>$value,'site_id'=>$site_id,'level'=>'1');
		             $db->insert("ve123_links",$array);
			      }				  
			   else { echo "<b>已存在了:</b>";}
			   echo "<a href=".$value." target=_blank>".$value. "</a><br>";
				   ob_flush();
                   flush();

                  //$row=$db->get_one("select * from ve123_links_temp where url='".$value."'");

	             // if(empty($row)&&is_url($value))
	             // {
			     //    $array=array('url'=>$value,'site_id'=>$site_id);
		        //     $db->insert("ve123_links_temp",$array);
			     // }
			} 
  		 }
}

//只保留内链或者外链
function check_wai($lry_all,$nei,$url) {
    $lry_nei=array();//站内链接数组
    $lry_wai=array();//站外链接数组
	$new_url=getdomain($url);
	if($nei=="")
	{
	   foreach ((array)$lry_all as $value)
		{
			$lry_nei[]=rtrim($value,"/");
		}
	  return $lry_nei;
	}

    	foreach ((array)$lry_all as $value)
		{
	     	if(getdomain($value)==$new_url)
		 	{
			 	$lry_nei[]=rtrim($value,"/");
				//$lry_nei[]=$value;
			}
		 	else
			 { $lry_wai[]=rtrim($value,"/"); }
		}  
	if($nei==1){return $lry_nei;}
	if($nei==2){return $lry_wai;}
}

//把内链和外链分开
function fen_link($lry_all,$url) {
    $data=array();//站外链接数组
	$new_url=getdomain($url);

    	foreach ((array)$lry_all as $value)
		{
	     	if(getdomain($value)==$new_url)
		 	 {  $data['nei'][]=rtrim($value,"/"); }
		 	else
			 {  $data['wai'][]=rtrim($value,"/"); }
		}  	
	return $data;
}

function check_include($link, $include_word, $not_include_word) {
	$url_word = Array ();
	$not_url_word = Array ();
	$is_shoulu = true;
					
	if ($include_word != "") {
		$url_word = explode(",", $include_word);
	}
	if ($not_include_word != "") {
		$not_url_word = explode(",", $not_include_word);
	}	
	
	foreach ($not_url_word as $v_key) {
		$v_key = trim($v_key);
		if ($v_key != "") {
			if (substr($v_key, 0, 1) == '*') {
				if (preg_match(substr($v_key, 1), $link)) {
					$is_shoulu = false;
					break;
				}
			} else {
				if (!(strpos($link, $v_key) === false)) {
					$is_shoulu = false;
					break;
				}
			}
		}
	}
	if ($is_shoulu && $include_word != "") {
		$is_shoulu = false;
		foreach ($url_word as $v_key) {
			$v_key = trim($v_key);
			if ($v_key != "") {
				if (substr($v_key, 0, 1) == '*') {
					if (preg_match(substr($v_key, 1), $link)) {
						$is_shoulu = true;
						break 2;
					}
				} else {
					if (strpos($link, $v_key) !== false) {
						$is_shoulu = true;
						break;
					}
				}
			}
		}
	}
	return $is_shoulu;
}					 

function add_links_site_fromtemp($in_url)
{
      global $db;
	  $domain=getdomain($in_url);
	  $query=$db->query("select * from ve123_links_temp where url like '%".$domain."%' and no_id='0'");
	  while($row=$db->fetch_array($query))
	  {
	        @$db->query("update ve123_links_temp set no_id='1' where url='".$row["url"]."'");
	        add_links_insite($row["url"],$row["url"],1,1);
			//sleep(3);
	  }
	  //sleep(5);
	  add_links_site_fromtemp($in_url) ;   
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
				   //sleep(1);
		     $row=$db->get_one("select * from ve123_sites where url='".$value."'");
	 
	              if(empty($row)&&is_url($value))
	              {
			         $array=array('url'=>$value,'spider_depth'=>$config["spider_depth"],'addtime'=>time());
		             $db->insert("ve123_sites",$array);
					
			      }
   }
    //sleep(1);
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
			//sleep(3);
	  }
	  //sleep(5);
	  GetUrl_AllSite($in_url) ;
}

function Updan_link($url,$site_id)
{
	global $db;
		 $row=$db->get_one("select * from ve123_links_temp where url='".$url."'");
		 if(empty($row))
	        {
				$arral=array('url'=>$url,'site_id'=>$site_id);
			    $db->insert("ve123_links_temp",$arral); 
			 }
			 
         $row=$db->get_one("select * from ve123_links where url like '%".$url."%'");
		 if(empty($row))
		 {
				     echo "<font color=#C60A00><b>抓取到:</b></font>".$url."<br>";
			         $array=array('url'=>$url,'site_id'=>$site_id,'level'=>'1');
		             $db->insert("ve123_links",$array);	
		 }
		else
		{
		   echo "已存在:".$url."<br>";
		}
}

function Updan_zhua($url,$site_id)
{
	global $db;
	$lrp = array();
	$links = array();
	$fen_link = array();
	$nei_link = array();
	$new_temp = array();
	$cha_temp = array();
	
	$lrp = cmi($url);
	$links = _striplinks($lrp[$url]);			//从htmlcode中提取网址
	$links = _expandlinks($links, $url);        //补全网址
	$fen_link=fen_link($links,$url);            //把内链和外链分开
	$nei_link=array_values(array_unique($fen_link[nei])); //过滤内链 重复的网址
	
		//读出 ve123_sites_temp 中所有 site_id=-1  and no_id=0
    $query=$db->query("select url from ve123_sites_temp where site_id='".$site_id."'");
    while($row=$db->fetch_array($query)) { $new_temp[]=$row[url]; }
	$cha_temp=array_diff($nei_link,$new_temp);//与内链进行比较 得出差集
	//将差集创建到 ve123_sites_temp 中
  	foreach((array)$cha_temp as $value)
  	  {		$arral=array('url'=>$value,'site_id'=>$site_id,'no_id'=>0);
			$db->insert("ve123_sites_temp",$arral);
	  }	
	
}


function Update_link($url)
{
   global $db,$bug_url;
   $is_success=FALSE;
   $is_shoulu=FALSE;
   
   /*$spider=new spider;
   $spider->url($url);
   $title=$spider->title;
   $fulltxt=$spider->fulltxt;
   $lrymd5=md5($spider->fulltxt);
   $pagesize=$spider->pagesize;
   $keywords=$spider->keywords;
   $htmlcode=$spider->htmlcode;
   $description=$spider->description;*/
   
	$snoopy = new Snoopy;     //国外snoopy程序
	$snoopy->fetchtext($url); 
	$title=$snoopy->title;
	$fulltxt=$snoopy->fulltxt; 
	$lrymd5=md5($fulltxt);
	$pagesize=$snoopy->pagesize;
		$description=$snoopy->description;
		$keywords=$snoopy->keywords;
   //echo "fulltxt=".$fulltxt."<br>";
   	
   $updatetime=time();
  			 //$site_url=GetSiteUrl($url);
  			 //$site=$db->get_one("select * from ve123_sites where url='".$site_url."'");
  			 //$site_id=$site["site_id"];
   			//echo "site_id".$site["site_id"]."<br>";
		if($title==""){$title=str_cut($fulltxt,65); }
   		echo "<b><font color=#0Ae600>已更新</font></b>";
		echo $title;
   $array=array('lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
   			//$db->query("update ve123_links set updatetime='".time()."' where url='".$url."'"); //更新时间
        	//$s=array();
        	//$s=explode("?",$title);
		    //$domain=GetSiteUrl($url);
			//$site=$db->get_one("select * from ve123_sites where url='".$domain."'");
                $db->update("ve123_links",$array,"url='".$url."'");
			    $is_success=TRUE;

  if(empty($bug_url))
   {
       exit();
   }
   return $is_success;

}

function Update_All_Link_($in_url='',$days,$qiangzhi)
{
      global $db;
	  $new_url=array();
	  $fen_url=array();
	  $fenge=array();
	  $numm=20;//开启多少线程
	  //if($qiangzhi==0){ $lry="and strlen(lrymd5)!=32";}
	  //else { ;}
	  
	  if(empty($in_url))
	  {
		$sql="select url from ve123_links where length(lrymd5)!=32 order by link_id desc";
	  }
	  else
	  {
	     $sql="select url from ve123_links where url like '%".getdomain($in_url)."%' and length(lrymd5)!=32 order by link_id desc";
	  }
	  echo $sql."<br>";
	  $query=$db->query($sql);
	  while($row=$db->fetch_array($query))
	 	 {		
			 $new_url[]=$row[url];
	 	 }	  
	 $he_num = ceil(count($new_url)/$numm);//计算需要循环多少次
	 //echo "<br><b>需要循环多少次=</b>".$he_num."<br>";

	$fenge=array_chunk($new_url,$numm);//把数组分割成多少块数组 每块大小$numm
	
	for($i=0;$i<=$he_num;$i++) 
	//for($i=0;$i<=1;$i++) 
	 {
		$fen_url=cmi($fenge[$i]);
		 //需要把得到的数组  (数组只包括 网址和源码) 分析  写入数据库 ,
			
		foreach ((array)$fen_url as $url => $file)
  	 	{ 	
					$bianma = bianma($file);					  //获取得到htmlcode的编码
					$file  = Convert_File($file,$bianma);		 //转换所有编码为gb2312	
					$lry = clean_lry($file,$url,"html"); 
					$title=$lry["title"];                     //从数组中得到标题,赋值给title	
					$pagesize=number_format(strlen($file)/1024, 0, ".", "");
					$fulltxt=Html2Text($lry["fulltext"]); 
					$description=$lry["description"];         //从数组中得到标题,赋值给description	
					$keywords=$lry["keywords"];               //从数组中得到标题,赋值给keywords	
					$lrymd5=md5($fulltxt);	
					$updatetime=time();

				if($title==""){$title=str_cut($fulltxt,65); }
   					echo "<b><font color=#0Ae600>已更新</font></b>";
					echo $title;
					echo "<a href=".$url." target=_blank>".$url. "</a><br>";
				$array=array('lrymd5'=>$lrymd5,'title'=>$title,'fulltxt'=>$fulltxt,'description'=>$description,'keywords'=>$keywords,'pagesize'=>$pagesize,'updatetime'=>$updatetime);
                $db->update("ve123_links",$array,"url='".$url."'");							
		}
	 }
}



function cmi($links,$killspace=TRUE,$forhtml=TRUE,$timeout=6,$header=0,$follow=1){

       	    $res=array();//用于保存结果 	    	
    		$mh = curl_multi_init();//创建多curl对象，为了几乎同时执行		
    		foreach ((array)$links as $i => $url) {
    			 $conn[$url]=curl_init($url);//若url中含有gb2312汉字，例如FTP时，要在传入url的时候处理一下，这里不用
    			 curl_setopt($conn[$url], CURLOPT_TIMEOUT, $timeout);//此时间须根据页面的HTML源码出来的时间，一般是在1s内的，慢的话应该也不会6秒，极慢则是在16秒内
    			 curl_setopt($conn[$url], CURLOPT_HEADER, $header);//不返回请求头，只要源码
    			 curl_setopt($conn[$url],CURLOPT_RETURNTRANSFER,1);//必须为1
    			 curl_setopt($conn[$url], CURLOPT_FOLLOWLOCATION, $follow);//如果页面含有自动跳转的代码如301或者302HTTP时，自动拿转向的页面
    			 curl_multi_add_handle ($mh,$conn[$url]);//关键，一定要放在上面几句之下，将单curl对象赋给多对象
    		}
    		//下面一大步的目的是为了减少cpu的无谓负担，暂时不明，来自php.net的建议，几乎是固定用法
    		do {
    				$mrc = curl_multi_exec($mh,$active);//当无数据时或请求暂停时，active=true
    		   } while ($mrc == CURLM_CALL_MULTI_PERFORM);//当正在接受数据时
    		while ($active and $mrc == CURLM_OK)
			 	{//当无数据时或请求暂停时，active=true,为了减少cpu的无谓负担,这一步很难明啊
    				if (curl_multi_select($mh) != -1)
					 {
    					do {  $mrc = curl_multi_exec($mh, $active);
    						} while ($mrc == CURLM_CALL_MULTI_PERFORM);
    				 }
    			 }

    		  foreach ((array)$links as $i => $url) {
    			  $cinfo=curl_getinfo($conn[$url]);//可用于取得一些有用的参数，可以认为是header
					  $res[$url]=curl_multi_getcontent($conn[$url]);
				  if(!$forhtml){//节约内存			
					  $res[$url]=NULL;
				  }
				 /*下面这一段放一些高消耗的程序代码，用来处理HTML，我保留的一句=NULL是要提醒，及时清空对象释放内存，此程序在并发过程中如果源码太大，内在消耗严重
				 //事实上，这里应该做一个callback函数或者你应该将你的逻辑直接放到这里来，我为了程序可重复，没这么做
    			   preg_match_all($preg,$res[$i],$matchlinks);
    			   $res[$i]=NULL;*/
                 
                  curl_close($conn[$url]);//关闭所有对象 
                  curl_multi_remove_handle($mh  , $conn[$url]);   //用完马上释放资源           			   
    			 
    		} 
    		curl_multi_close($mh);$mh=NULL;$conn=NULL;$links=NULL;
      	
    		return $res;
    }

function clean_lry($file, $url, $type) {
	$data=array();
	$file = preg_replace("/<link rel[^<>]*>/i", " ", $file);
	//$file = preg_replace("@<!--sphider_noindex-->.*?<!--\/sphider_noindex-->@si", " ",$file);	
	$file = preg_replace("@<!--.*?-->@si", " ",$file);	
	$file = preg_replace("@<script[^>]*?>.*?</script>@si", " ",$file);

	$file = preg_replace("/&nbsp;/", " ", $file);
	$file = preg_replace("/&raquo;/", " ", $file);
	$file=str_replace("'","‘",$file);
		
	$regs = Array ();	
		preg_match("/<meta +name *=[\"']?description[\"']? *content=[\"']?([^<>'\"]+)[\"']?/i", $file, $regs);
		if (isset ($regs)) 
		{
		 	$description = $regs[1]; 
			$file = str_replace($regs[0], "", $file);
		 }
	$regs = Array ();		 
		preg_match("/<meta +name *=[\"']?keywords[\"']? *content=[\"']?([^<>'\"]+)[\"']?/i", $file, $regs);
		if (isset ($regs))
		 { 
		 	$keywords = $regs[1];
		 	$file = str_replace($regs[0], "", $file);
		 }
	$regs = Array ();	
		$keywords = preg_replace("/[, ]+/", " ", $keywords);

	if (preg_match("@<title *>(.*?)<\/title*>@si", $file, $regs)) {
		$title = trim($regs[1]);
		$file = str_replace($regs[0], "", $file);
	} 
	
	$file = preg_replace("@<style[^>]*>.*?<\/style>@si", " ", $file);

	//create spaces between tags, so that removing tags doesnt concatenate strings
	$file = preg_replace("/<[\w ]+>/", "\\0 ", $file);
	$file = preg_replace("/<\/[\w ]+>/", "\\0 ", $file);
	$file = strip_tags($file);

	//$fulltext = $file;
	//$file .= " ".$title;

	$file = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $file);
    $file = preg_replace('~&#([0-9]+);~e', 'chr("\\1")', $file);
	$file = strtolower($file);

	$file = preg_replace("/&[a-z]{1,6};/", " ", $file);
	$file = preg_replace("/[\*\^\+\?\\\.\[\]\^\$\|\{\)\(\}~!\"\/@#?%&=`?><:,]+/", " ", $file);
	$file = preg_replace("/\s+/", " ", $file);
	//$data['fulltext'] = $fulltext;
	$data['fulltext'] = addslashes($file);
	$data['title'] = addslashes($title);
	$data['description'] = $description;
	$data['keywords'] = $keywords;

	return $data;

}


function bianma($file)
{
			preg_match_all("/<meta.+?charset=([-\w]+)/i",$file,$rs);
			$chrSet=strtoupper(trim($rs[1][0]));
			return $chrSet;	
}
	
function Convert_File($file,$charSet)
{
	             $conv_file = html_entity_decode($file);   
                 $charSet = strtoupper(trim($charSet));
				 if($charSet != "GB2312"&&$charSet != "GBK")
				 {                    
                        $file=convertfile($charSet,"GB2312",$conv_file);
						if($file==-1){ return -1; }
                 }  
				return $file;
}
	
function convertfile($in_charset, $out_charset, $str)
{
		//if(function_exists('mb_convert_encoding'))
		//{
		$in_charset=explode(',',$in_charset);
		$encode_arr = array('GB2312','GBK','UTF-8','ASCII','BIG5','JIS','eucjp-win','sjis-win','EUC-JP');
		$cha_temp=array_intersect($encode_arr,$in_charset);
		$cha_temp=implode('',$cha_temp);
		    if(empty($in_charset)||empty($cha_temp))
			{
                 $encoded = mb_detect_encoding($str, $encode_arr);
				 $in_charset=$encoded;
			}
			if(empty($in_charset)){ return -1; }
			echo $in_charset;
			return mb_convert_encoding($str, $out_charset, $in_charset);
		/*}
		else
		{
			require_once PATH.'include/charset.func.php';
			$in_charset = strtoupper($in_charset);
			$out_charset = strtoupper($out_charset);
			if($in_charset == 'UTF-8' && ($out_charset == 'GBK' || $out_charset == 'GB2312'))
			{
				return utf8_to_gbk($str);
			}
			if(($in_charset == 'GBK' || $in_charset == 'GB2312') && $out_charset == 'UTF-8')
			{
				return gbk_to_utf8($str);
			}
			return $str;
		}*/
}


function Update_All_Link($in_url='',$days,$qiangzhi)
{
      global $db;
	  if(empty($in_url))
	  {
	    //$sql="select * from ve123_links where updatetime<='".(time()-(86400*$days))."' order by link_id desc";//echo $days."<br>";
		$sql="select * from ve123_links order by link_id desc";//echo $days."<br>";
	  }
	  else
	  {
	     $sql="select * from ve123_links where url like '%".getdomain($in_url)."%' order by link_id desc";//echo $days."<br>";
		 //$sql="select * from ve123_links where url like '%".$in_url."%' order by link_id desc";//echo $days."<br>";
	  }
	  //$sql="select * from ve123_links order by link_id";
	  echo $sql."<br>";
	  $query=$db->query($sql);
	  while($row=$db->fetch_array($query))
	  {
	     if(is_url($row["url"]))
		 {
	       // echo "呵呵呵呵".$row["lrymd5"]."<br>";
            ob_flush();
            flush();
            //sleep(1);
			//if($row["lrymd5"]==""){ Update_link($row["url"],$row["lrymd5"]); }
			if($qiangzhi==1){ Update_link($row["url"]); }
			else {
				if(strlen($row["lrymd5"])!=32){ Update_link($row["url"]); }
				else {echo "<b>未改变</b>"; }
				}
		echo "<a href=".$row["url"]." target=_blank>".$row["url"]. "</a><br>";
		 }
			
			////sleep(2);
	  }
	 // echo "<br><b>全部更新完成</b> 完成日期:";
	 // echo date("Y年m月d日 H:i:s",time());
	  //sleep(2);
	 // Update_All_Link($in_url) ;
}


function url_ce($val, $parent_url, $can_leave_domain) {
	global $ext, $mainurl, $apache_indexes, $strip_sessids;

	$valparts = parse_url($val);
	$main_url_parts = parse_url($mainurl);
	//if ($valparts['host'] != "" && $valparts['host'] != $main_url_parts['host']  && $can_leave_domain != 1) {return '';}
	
	reset($ext);
	while (list ($id, $excl) = each($ext))
		if (preg_match("/\.$excl$/i", $val))
			return '';

	if (substr($val, -1) == '\\') {return '';}
	if (isset($valparts['query'])) {if ($apache_indexes[$valparts['query']]) {return '';}}
	if (preg_match("/[\/]?mailto:|[\/]?javascript:|[\/]?news:/i", $val)) {return '';}
	if (isset($valparts['scheme'])) {$scheme = $valparts['scheme'];}
	else {$scheme ="";}
	if (!($scheme == 'http' || $scheme == '' || $scheme == 'https')) {return '';}

	$regs = Array ();
	while (preg_match("/[^\/]*\/[.]{2}\//", $valpath, $regs)) {
		$valpath = str_replace($regs[0], "", $valpath);
	}

	$valpath = preg_replace("/\/+/", "/", $valpath);
	$valpath = preg_replace("/[^\/]*\/[.]{2}/", "",  $valpath);
	$valpath = str_replace("./", "", $valpath);
	if(substr($valpath,0,1)!="/") {$valpath="/".$valpath;}
	
	$query = "";
	if (isset($val_parts['query'])) {$query = "?".$val_parts['query'];}
	if ($main_url_parts['port'] == 80 || $val_parts['port'] == "") {$portq = "";} 
	else {$portq = ":".$main_url_parts['port'];}

	return $val;
}


function iframe_ce($val, $parent_url, $can_leave_domain) {
	global $ext, $mainurl, $apache_indexes, $strip_sessids;

	$valparts = parse_url($val);
	$main_url_parts = parse_url($mainurl);
	//if ($valparts['host'] != "" && $valparts['host'] != $main_url_parts['host']  && $can_leave_domain != 1) {return '';}
	
	reset($ext);
	while (list ($id, $excl) = each($ext))
		if (preg_match("/\.$excl$/i", $val))
			return '';

	if (substr($val, -1) == '\\') {return '';}
	if (isset($valparts['query'])) {if ($apache_indexes[$valparts['query']]) {return '';}}
	if (preg_match("/[\/]?mailto:|[\/]?javascript:|[\/]?news:/i", $val)) {return '';}
	if (isset($valparts['scheme'])) {$scheme = $valparts['scheme'];}
	else {$scheme ="";}
	if (!($scheme == 'http' || $scheme == '' || $scheme == 'https')) {return '';}

	$regs = Array ();
	while (preg_match("/[^\/]*\/[.]{2}\//", $valpath, $regs)) {
		$valpath = str_replace($regs[0], "", $valpath);
	}

	$valpath = preg_replace("/\/+/", "/", $valpath);
	$valpath = preg_replace("/[^\/]*\/[.]{2}/", "",  $valpath);
	$valpath = str_replace("./", "", $valpath);
	if(substr($valpath,0,1)!="/") {$valpath="/".$valpath;}
	
	$query = "";
	if (isset($val_parts['query'])) {$query = "?".$val_parts['query'];}
	if ($main_url_parts['port'] == 80 || $val_parts['port'] == "") {$portq = "";} 
	else {$portq = ":".$main_url_parts['port'];}

	return $val;
}


function _striplinks($document)
{						
		$match = array();
		$links = array();
		preg_match_all("'<\s*(a\s.*?href|[i]*frame\s.*?src)\s*=\s*([\'\"])?([+:%\/\?~=&\\\(\),._a-zA-Z0-9-]*)'isx",$document,$links,PREG_PATTERN_ORDER);		
		foreach ($links[3] as $val)
		  {
			if (($a = url_ce($val, $url, $can_leave_domain)) != '')
			  { $match[] = $a; }
			$checked_urls[$val[1]] = 1;
		  }				
	   return $match;
}
	

function _expandlinks($links,$URI)
{	
		preg_match("/^[^\?]+/",$URI,$match);
		$match = preg_replace("|/[^\/\.]+\.[^\/\.]+$|","",$match[0]);
		$match = preg_replace("|/$|","",$match);
		$match_part = parse_url($match);
		$match_root =
		$match_part["scheme"]."://".$match_part["host"];
		$URI_PARTS = parse_url($URI);
		$host = $URI_PARTS["host"];
				
		$search = array( 	"|^http://".preg_quote($host)."|i",
							"|^(\/)|i",
							"|^(?!http://)(?!mailto:)|i",
							"|/\./|",
							"|/[^\/]+/\.\./|"
						);
						
		$replace = array(	"",
							$match_root."/",
							$match."/",
							"/",
							"/"
						);			
				
		$expandedLinks = preg_replace($search,$replace,$links);

		return $expandedLinks;
}	
	
function foothtml()
{
echo "<div style=\"text-align:center;\"><a target=\"_blank\" href=\"http://www.1230530.com\">Powered by 亿时达</a></div>";
}
?>
