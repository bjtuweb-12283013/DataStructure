<?php
$getcode = '0';//获取远程URL源代码的方式，1为CURL获取，0为file_get_contents()获取
function intercept_str($str,$start,$end,$option){
		$strarr=explode($start,$str);
		$tem=$strarr[1];
		if(empty($end)){
		return $tem;
		}else{
		$strarr=explode($end,$tem);
		if($option==1){
		return $strarr[0];
		}
		if($option==2){
		return $start.$strarr[0];
		}
		if($option==3){
		return $strarr[0].$end;
		}else{
		return $start.$strarr[0].$end;
		}
		}
}
function get_contents($url){
              $ch = curl_init();     
              curl_setopt ($ch, CURLOPT_URL, $url);     
              curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt ($ch, CURLOPT_TIMEOUT, 1000); 
              $file_contents = curl_exec($ch);     
              curl_close($ch);
              return $file_contents;
       }
function is_utf8($Somao)
{
	if (preg_match("/^([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}/",$Somao) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}$/",$Somao) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){2,}/",$Somao) == true)
	{
	return  true;
	}
	else
	{
	return false;
	}
 
} 

$q = $_GET['keyword'];
if (!is_utf8($q)){
$q=iconv("gb2312","utf-8",$q);
}
if ( $_SERVER['HTTP_HOST']  )
{
	$s = urlencode( $q );
	$url = "http://www.soku.com/v?".$_SERVER['QUERY_STRING'];
	$start = '<div class="result">';
	$end = '<!--result end-->';
	$Somao_xg_start = '<div class="statinfo">';
	$Somao_xg_end = '<div class="selector">';
	if($getcode=='1'){
	$temp = get_contents( $url, false );
	}
	else{	
	$temp = file_get_contents( $url, false );
	}
	$Somao_xg = intercept_str( $temp, $Somao_xg_start, $Somao_xg_end, 1 );
	$content = intercept_str( $temp, $start, $end, 2 );
	$content = str_replace( "/v?keyword", "./?keyword", $content );

	if (strlen($content)<1){
	$content='<div style="text-align:center;margin:20px;height:300px;">抱歉，搜索“<font color=red>'.$q.'</font>”失败，查询超时或者没有相关内容，<br/><br/>请<a href="#" onClick="window.location.reload()" style="text-decoration:none"><font color=red>【刷新】</font></a>试试，<br><br>或者更换关键字重新搜索。</div>';	
	}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $q?> - 视频搜索| 1230530.com</title>
<meta name="keywords" content="<?php echo $q?>,<?php echo $q?>观看" />
<meta name="description" content="搜索（Somao123.com）,视频搜索引擎，<?php echo $q?> " />
<link type="text/css" rel="stylesheet" href="../images/Somao.css" />
<link type="text/css" rel="stylesheet" href="../images/Somao123.css" />
<style type="text/css">
<!--
.STYLE3 {color: #00c}
-->
</style>
</head>
<body>
<div class="window">
<div class="screen">
<div class="wrap">
	<div class="soku_topbar">
		<div class="main">
			<div class="nav">
			<ul>
			<li><a href="http://www.1230530.com/" target="_blank">官网</a></li>
			<li><a href="http://test.1230530.com/" target="_blank">演示</a></li>
			<li><a href="http://www.1230530.com/buy/" target="_blank">套餐</a></li>
            <li><a href="http://kehu.1230530.com/" target="_blank">服务</a></li>
			</ul>
			</div>
			<div>视频搜索引擎</div>
		</div>
	</div>
<div class="soku_header">
		<div class="main">
		<div class="logo"><a href="../"><img src="../images/logo.gif" alt="视频搜索" /></a></div>
		<div class="soku_tool">
			<div class="tool outer" id="tool">
			<form action="" method="get">

					<input class="sotext" type="text" autocomplete="off" id="headq" name="keyword" value="<?php echo $q?>" maxlength="100"/>
					<button class="sobtn" type="submit">一下</button>

					
					<div class="clear"></div>
			  </form>

				
		  </div>
		
		  </div><!--Somao_tool end-->
		</div><!--main end-->
	</div><!--Somao_header end-->
    	<div class="soku_master">
		<div class="control">
		
			<div class="filter">
				<div class="statinfo"><?php echo $Somao_xg;?>
				<div class="selector">
				<form name="filter_form" action="" method="get">
				<input type="hidden" name="keyword" value="美女">
				<input type="hidden" name="ext" value="2">
				<span class="label">视频筛选:</span>
					<select class="sel" name="time_length" onchange="filter_form.submit();">
						<option value="0" selected>所有长度</option>
						<option value="1">0-4分钟</option>
						<option value="2">4-20分钟</option>
						<option value="3">>=20分钟</option>
					</select>
					<select class="sel" name="limit_date" onchange="filter_form.submit();">
						<option value="0" selected>不限发布时间</option>
						<option value="1">一天内</option>
						<option value="7">一周内</option>
						<option value="31">一月内</option>
					</select>
					<select class="sel" name="hd" onchange="filter_form.submit();">
						<option value="0" selected>不限画质</option>
						<option value="1">高清</option>
					</select>
					<select class="sel" name="site" onchange="filter_form.submit();">
						<option value="0" selected>不限来源</option>
						
									<option value="14">优酷网</option>
								
									<option value="1">土豆网</option>
								
									<option value="2">56网</option>
								
									<option value="10">酷6</option>
								
									<option value="6">搜狐</option>
								
									<option value="3">新浪网</option>
								
									<option value="4">琥珀网</option>
								
									<option value="8">凤凰网</option>
								
									<option value="9">激动网</option>
								
									<option value="13">中关村在线</option>
								
					</select>
					
						<input type="hidden" name="ts" value="MTQsMSwyLDEwLDYsMyw0LDgsOSwxMw==">
					
				  </form>

				</div>
				<div class="clear"></div>	
			</div>
		</div>
<?php echo $content?><!--result end-->
</div>
	<!--Somao_master end-->
	
	<div class="soku_footer">
		<div class="main">
			<div class="soku_tool">
			<form name="f" action="?">
				<div class="tool"><input class="sotext" type="text" name="keyword" value="<?php echo $q?>"/><button class="sobtn" type="submit">一下</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<div align="center" style="margin:10px auto">&copy;2012 中国 菏泽 Somao <a href="/a/mianze.htm"><font color="#999999"><span class="STYLE3">使用前必读</span></a> <span class="STYLE3">
<!--Powered by <a target="_blank" href="http://www.1230530.com/">Somao</a>-->
&nbsp;<a target="_blank" href="http://www.miibeian.gov.cn/"><font color="#999999">鲁ICP备10021065号</a></span><img src="../images/gs.gif" width="15" height="17" />
</body>
</html>
