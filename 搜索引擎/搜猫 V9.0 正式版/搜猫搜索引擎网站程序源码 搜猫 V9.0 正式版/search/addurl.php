<?php
session_start();
error_reporting(0);
require "../global.php";
require "../include/spider/spider_class.php";
//$action=HtmlReplace(trim($_GET["action"]));
  $action=$_GET["action"];
if($action=="add")
{
     $oldurl=$url= HtmlReplace(trim($_POST["url"]));
	$imagecode=trim(HtmlReplace($_POST["code"]));
			if($_SESSION['dd_ckstr']!=$imagecode)
			{
			     jsalert("验证码错误!","url_submit.php");
				break;
			}
	 $query=$db->query("select * from ve123_url_submit where url='$url'");
	 $num=$db->num_rows($query);
	  if($num==0)
	  {
          $array=array('url'=>$url,'ip'=>ip(),'addtime'=>time());
		  $db->insert("ve123_url_submit",$array);
	  }
     //
	 if($config['is_tijiao_shoulu'])
	 {
	   $url= GetSiteUrl($url);
	   $site=$db->get_one("select * from ve123_sites where url='$url'");
	     if(empty($site))
	     {
	       $array=array('url'=>$url,'spider_depth'=>$config["spider_depth"],'indexdate'=>time(),'addtime'=>time());
		   $db->insert("ve123_sites",$array);
	     }
		 $site=$db->get_one("select * from ve123_sites where url='$url'");
	     if(!empty($site))
	     {
		     $row=$db->get_one("select * from ve123_links where url='".$url."'");
		     if(empty($row))
		      {
					 AddAndUpdateUrl($url,"add");
  				     
		      }
			  else
			  {
					 AddAndUpdateUrl($url,"update");
			  }
			  //
			  if($oldurl!=$url)
			  {
			        $row=$db->get_one("select * from ve123_links where url='".rtrim($oldurl,"/")."'");
		            if(empty($row))
		            {
					      AddAndUpdateUrl($oldurl,"add");
  				     
		            }
			        else
			         {
					             AddAndUpdateUrl($oldurl,"update");
			         }
			  }
		 }
	  //
	  }
	  header("location:success.php");
}
function AddAndUpdateUrl($url,$action)
{
    global $db;
					 $spider=new spider;
   				     $spider->url($url);
  				     $title=$spider->title;
  				     $fulltxt=$spider->fulltxt(800);
					 $keywords=$spider->keywords;
                     $description=$spider->description;
   				     $pagesize=$spider->pagesize;
  				     $array=array('url'=>$url,'title'=>$title,'fulltxt'=>$fulltxt,'pagesize'=>$pagesize,'keywords'=>$keywords,'description'=>$description,'updatetime'=>time());
					 if($action=="add")
					 {
					     $db->insert("ve123_links",$array);
					 }
					 elseif($action=="update")
					 {
					     $db->update("ve123_links",$array,"url='".$url."'");  
					 }
  				     
}
?><html>
<head>
<title><?php echo $config["name"];?>搜索指南_网站登录</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<style type="text/css"><!--
.f13 {font-size: 13px;
	line-height: 18px;}
.f14 {font-size: 14px;}
-->
</style>

<SCRIPT language=javascript>
<!--
function CheckForm(thisForm) {
	if (isEmpty(thisForm.url.value) || (thisForm.url.value == "http://")) {
         	alert("你没有输入网站地址!");
      		thisForm.url.focus();
     		return;
    	}
	else if (thisForm.url.value.indexOf("http://") != 0) {
		alert("您少加了http://,请您再检查一次!");
		thisForm.url.focus();
		return;
	}
	else if (thisForm.url.value.indexOf("http://") != thisForm.url.value.lastIndexOf("http://")) {
		alert("您多加了http://,请您再检查一次!");
		thisForm.url.focus();
		return;
	}
	else if (isEmpty(thisForm.code.value)) {
         	alert("你没有输入验证码!");
      		thisForm.code.focus();
     		return;
    	}
	else
    		thisForm.submit();
}
function isEmpty(value) {
  return ((value == null) || (value.length == 0))
}
//-->
</SCRIPT>

</head>
		<FORM name=regform action=?action=add method=post target="_top">
          <table cellspacing=0 cellpadding=0 width=700 align=center border=0>
            <tr>
              <td valign=top class="f13">　　　（例：<?php echo $config["url"];?>）<br>
      　　　
        <input id=url2 size=50 value=http:// 
                  name=url>
                <br>
                　　　 请输入验证码　
<img src="../include/vdimgck.php" border="0" hspace="3" align="absmiddle">
                
<input type=hidden name=ivc value="Vw9SXVYPBg8=">
                <input size=10 
                  name=code>
                <input onClick="CheckForm(document.all['regform']);" type=button value="提交网站" name=Submit2>
              </td>
            </tr>
          </table>
		</FORM>
		</body>
</html>