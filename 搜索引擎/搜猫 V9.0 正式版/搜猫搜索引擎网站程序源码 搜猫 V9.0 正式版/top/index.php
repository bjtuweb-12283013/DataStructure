<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>云企搜搜索风云榜</title>
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/home.css">
<link rel="stylesheet" type="text/css" href="css/tree.css">
</head>
<body>
<div class="wrap">
  <div class="wrap search-home">
	    <div id="ba" class="clearfix">
            <div id="ba_lg">
                <a href="index.php"><img src="/images/log.gif" alt="搜索风云榜" width="110" height="40" border="0"></a>            </div>
            <div id="ba_sc">
                <p id="ba_nv">
                    <a href="/news" target="_blank">新闻</a>　
                    <a href="/s/" target="_blank">网页</a>　
                    <a href="/tieba" target="_blank">贴吧</a>　
                    <a href="/zhidao" target="_blank">知道</a>　
                    <a href="/mp3" target="_blank">MP3</a>　
                    <a href="/image/" target="_blank">图片</a>　
                    <a href="/video" target="_blank">视频</a>　
                    <a href="/map/" target="_blank">地图</a>　
                </p>
                <form action="/s" name="f">
                    <input value="" maxlength="100" class="ba-kw" name="wd" id="sword">
                    <input type="submit" id="ba_baidu" class="ba-baidu" value="搜索">
                </form>
          </div>
            </div>
<script type="text/javascript">
var d = document,
n = navigator,
k = d.f.sword,
a = d.getElementById("ba_nv").getElementsByTagName("a"),
isIE = navigator.userAgent.indexOf("MSIE") != -1;
if (!isIE || window.opera) {
	d.getElementById("sethome").style.display = "none";
}
for(var i = 0; i < a.length; i++){
		a[i].onclick = function(){
			if(k.value.length > 0){
				var C = this,
				A = C.href,
				B = encodeURIComponent(k.value);
				if (A.indexOf("q=") != -1) {
					C.href = A.replace(/q=[^&$]*/, "q=" + B)
				}
				else{
					this.href += "?q=" + B
				}
			} 
		}
	
}
try {

  document.execCommand('BackgroundImageCache', false, true);

} catch(e) {}
</script>
</div>

<div class="wrap">
  <div class="l side-bar">
		<div class="nav-bar" id="menu">
		   <ul class="menu">
			    <li class="childSelect"><a href="index.php">风云榜首页</a></li>
			    <li class="childUnSelect"><a href="buzz.php?p=top10">实时热点</a></li>
			    <li class="childUnSelect"><a href="buzz.php?p=week">七日关注</a></li>
                <li class="childUnSelect"><a href="buzz.php?p=month">当月关注</a></li>
			    <li class="childUnSelect"><a href="buzz.php?p=topkey">热门搜索</a></li>
		   </ul>
		</div>
		<div class="end"></div>
	</div><div class="r main-cont">
 <div class="box-spe top10 l dis-rb">
	<h1>实时热点</h1>
	<div class="box">
		<div class="t_list">
           <table>
           <tr>
                <td><span class="title no1"><a target="_blank" href="../s/?wd=%BA%BC%D6%DD%B9%AB%CB%BE&s=">杭州公司</a></span></td>
	            <td><span class="clicks">110</span></td>
             </tr>
           <tr>
                <td><span class="title no2"><a target="_blank" href="../s/?wd=baidu&s=">baidu</a></span></td>
	            <td><span class="clicks">27</span></td>
             </tr>
           <tr>
                <td><span class="title no3"><a target="_blank" href="../s/?wd=%D6%D0%B9%FA&s=">中国</a></span></td>
	            <td><span class="clicks">22</span></td>
             </tr>
           <tr>
                <td><span class="title no4"><a target="_blank" href="../s/?wd=%D4%C6%C6%F3%CB%D1%A3%AC%C6%B7%C5%C6%CB%D1%CB%F7%A3%AC%C9%FA%BB%EE%CB%D1%CB%F7%A3%AC%B7%FE%CE%F1%CB%D1%CB%F7%A3%AC&s=">云企搜，品牌搜索，生活搜索，服务搜索，</a></span></td>
	            <td><span class="clicks">18</span></td>
             </tr>
           <tr>
                <td><span class="title no5"><a target="_blank" href="../s/?wd=360%C9%B1%B6%BE%C8%ED%BC%FE&s=">360杀毒软件</a></span></td>
	            <td><span class="clicks">16</span></td>
             </tr>
           <tr>
                <td><span class="title no6"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F0%D3%E7%D6%E1%B3%D0%D6%C6%D4%EC%D3%D0%CF%DE%B9%AB%CB%BE&s=">大连金隅轴承制造有限公司</a></span></td>
	            <td><span class="clicks">15</span></td>
             </tr>
           <tr>
                <td><span class="title no7"><a target="_blank" href="../s/?wd=%CA%D6%BB%FA%B9%E9%CA%F4%B5%D8&s=">手机归属地</a></span></td>
	            <td><span class="clicks">15</span></td>
             </tr>
           <tr>
                <td><span class="title no8"><a target="_blank" href="../s/?wd=%B1%B1%BE%A9%CA%D0%BA%A3%B5%ED%D2%BD%D4%BA&s=">北京市海淀医院</a></span></td>
	            <td><span class="clicks">14</span></td>
             </tr>
           <tr>
                <td><span class="title no9"><a target="_blank" href="../s/?wd=%B9%E3%B8%E6%B4%AB%C3%BD&s=">广告传媒</a></span></td>
	            <td><span class="clicks">14</span></td>
             </tr>
           <tr>
                <td><span class="title no10"><a target="_blank" href="../s/?wd=%BF%D5%BC%E4&s=">空间</a></span></td>
	            <td><span class="clicks">14</span></td>
             </tr>
 
		  </table>
            
        </div>
      </div>
        <div class="bottom"></div>
</div>



<div class="box-spe weekhotspot l dis-rb">
	<h1>七日关注</h1>
        <div class="box">
                <div class="t_list">
			<table>
        	        <tr>
                        	<td><span class="title no1"><a target="_blank" href="../s/?wd=%BA%BC%D6%DD%B9%AB%CB%BE&s=">杭州公司</a></span></td>
	                        <td><span class="clicks">171</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no2"><a target="_blank" href="../s/?wd=baidu&s=">baidu</a></span></td>
	                        <td><span class="clicks">153</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no3"><a target="_blank" href="../s/?wd=%D0%C2%D7%A2%B2%E1%C6%F3%D2%B5&s=">新注册企业</a></span></td>
	                        <td><span class="clicks">133</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no4"><a target="_blank" href="../s/?wd=360%B0%B2%C8%AB%CE%C0%CA%BF&s=">360安全卫士</a></span></td>
	                        <td><span class="clicks">129</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no5"><a target="_blank" href="../s/?wd=%B6%AB%DD%B8%BF%C6%BC%BC&s=">东莞科技</a></span></td>
	                        <td><span class="clicks">113</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no6"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F0%D3%E7%D6%E1%B3%D0%D6%C6%D4%EC%D3%D0%CF%DE%B9%AB%CB%BE&s=">大连金隅轴承制造有限公司</a></span></td>
	                        <td><span class="clicks">82</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no7"><a target="_blank" href="../s/?wd=%D4%C6%C4%CF%C9%CC%B1%EA%C9%E8%BC%C6&s=">云南商标设计</a></span></td>
	                        <td><span class="clicks">70</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no8"><a target="_blank" href="../s/?wd=%B0%D9%B6%C8%CD%B3%BC%C6&s=">百度统计</a></span></td>
	                        <td><span class="clicks">57</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no9"><a target="_blank" href="../s/?wd=dlxinwang&s=">dlxinwang</a></span></td>
	                        <td><span class="clicks">56</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no10"><a target="_blank" href="../s/?wd=%25&s=">%</a></span></td>
	                        <td><span class="clicks">55</span></td>
           	  </tr>
 
			</table>
                </div>
        </div>
        <div class="bottom"></div>
</div>

        
<div class="box-spe flash l">
	<h1>当月搜索</h1>
        <div class="box">
        	<div class="t_list">
                   <div class="bhot"><a href="#" target="_blank">云企搜沸点</a></div>
                   <div class="word-adv" style="overflow:hidden;">
	                	<div id="oneNew">
                        		<a href="#" target="_blank">云企搜搜索风云榜新版开通了！</a><br>
                        		<a href="#" target="_blank">一周搜索热词解读，实时热点！</a><br>
                		</div>
			       </div>
			<table>
        	        <tr>
                        	<td><span class="title no1"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F0%D3%E7%D6%E1%B3%D0%D6%C6%D4%EC%D3%D0%CF%DE%B9%AB%CB%BE&s=">大连金隅轴承制造有限公司</a></span></td>
	                        <td><span class="clicks">238</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no2"><a target="_blank" href="../s/?wd=baidu&s=">baidu</a></span></td>
	                        <td><span class="clicks">177</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no3"><a target="_blank" href="../s/?wd=%BA%BC%D6%DD%B9%AB%CB%BE&s=">杭州公司</a></span></td>
	                        <td><span class="clicks">175</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no4"><a target="_blank" href="../s/?wd=360%B0%B2%C8%AB%CE%C0%CA%BF&s=">360安全卫士</a></span></td>
	                        <td><span class="clicks">136</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no5"><a target="_blank" href="../s/?wd=%D0%C2%D7%A2%B2%E1%C6%F3%D2%B5&s=">新注册企业</a></span></td>
	                        <td><span class="clicks">134</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no6"><a target="_blank" href="../s/?wd=%B6%AB%DD%B8%BF%C6%BC%BC&s=">东莞科技</a></span></td>
	                        <td><span class="clicks">113</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no7"><a target="_blank" href="../s/?wd=%25&s=">%</a></span></td>
	                        <td><span class="clicks">73</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no8"><a target="_blank" href="../s/?wd=%D4%C6%C4%CF%C9%CC%B1%EA%C9%E8%BC%C6&s=">云南商标设计</a></span></td>
	                        <td><span class="clicks">71</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no9"><a target="_blank" href="../s/?wd=%D4%C6%C6%F3%CB%D1%A3%AC%C6%B7%C5%C6%CB%D1%CB%F7%A3%AC%C9%FA%BB%EE%CB%D1%CB%F7%A3%AC%B7%FE%CE%F1%CB%D1%CB%F7%A3%AC&s=">云企搜，品牌搜索，生活搜索，服务搜索，</a></span></td>
	                        <td><span class="clicks">64</span></td>
           	  </tr>
        	        <tr>
                        	<td><span class="title no10"><a target="_blank" href="../s/?wd=qq&s=">qq</a></span></td>
	                        <td><span class="clicks">60</span></td>
           	  </tr>
 
			</table>
         </div>
	</div>
   <div class="bottom"></div>
</div>
        
<div class="cl"></div>

        <div class="group top_keyword" name="BLUEBA_OBJ_ID" id="BLUEBA_OBJ_ID">
            <div class="l top-list">
                <h1>热门搜索</h1>
               
                
                <div id="tabAC1-cont-0" class="">
                <table class="list-table" cellspacing="0">

                <tr>
                   <td class="tno no1"><a target="_blank" href="../s/?wd=%D4%C6%C6%F3%CB%D1%A3%AC%C6%B7%C5%C6%CB%D1%CB%F7%A3%AC%C9%FA%BB%EE%CB%D1%CB%F7%A3%AC%B7%FE%CE%F1%CB%D1%CB%F7%A3%AC&s=">云企搜，品牌搜索，生活搜索，服务搜索，</a></td>
                   <td><em class="trend-t 
				   down                    "></em></td>
                   <td>总：1934</td>
                   <td>月：64</td>
                   <td>周：46</td>
                   <td>日：18</td>
                  </tr>
                <tr>
                   <td class="tno no2"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F0%D3%E7%D6%E1%B3%D0%D6%C6%D4%EC%D3%D0%CF%DE%B9%AB%CB%BE&s=">大连金隅轴承制造有限公司</a></td>
                   <td><em class="trend-t 
				   down                    "></em></td>
                   <td>总：1834</td>
                   <td>月：238</td>
                   <td>周：82</td>
                   <td>日：15</td>
                  </tr>
                <tr>
                   <td class="tno no3"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F5%BA%E2%C3%B3%D2%D7%D3%D0%CF%DE%B9%AB%CB%BE&s=">大连锦衡贸易有限公司</a></td>
                   <td><em class="trend-t 
				   down                    "></em></td>
                   <td>总：1511</td>
                   <td>月：42</td>
                   <td>周：40</td>
                   <td>日：5</td>
                  </tr>
                <tr>
                   <td class="tno no4"><a target="_blank" href="../s/?wd=%B7%C2%B0%D9%B6%C8%CB%D1%CB%F7%D2%FD%C7%E6&s=">仿百度搜索引擎</a></td>
                   <td><em class="trend-t 
				   up                    "></em></td>
                   <td>总：1499</td>
                   <td>月：12</td>
                   <td>周：11</td>
                   <td>日：2</td>
                  </tr>
                <tr>
                   <td class="tno no5"><a target="_blank" href="../s/?wd=360%B0%B2%C8%AB%CE%C0%CA%BF&s=">360安全卫士</a></td>
                   <td><em class="trend-t 
				   up                    "></em></td>
                   <td>总：1479</td>
                   <td>月：136</td>
                   <td>周：129</td>
                   <td>日：7</td>
                  </tr>
                <tr>
                   <td class="tno no6"><a target="_blank" href="../s/?wd=%D0%C2%D7%A2%B2%E1%C6%F3%D2%B5&s=">新注册企业</a></td>
                   <td><em class="trend-t 
				   down                    "></em></td>
                   <td>总：1477</td>
                   <td>月：134</td>
                   <td>周：133</td>
                   <td>日：5</td>
                  </tr>
                <tr>
                   <td class="tno no7"><a target="_blank" href="../s/?wd=%B7%C2%B0%D9%B6%C8%CB%D1%CB%F7&s=">仿百度搜索</a></td>
                   <td><em class="trend-t 
				   down                    "></em></td>
                   <td>总：1406</td>
                   <td>月：25</td>
                   <td>周：19</td>
                   <td>日：4</td>
                  </tr>
                <tr>
                   <td class="tno no8"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F5%BA%E3%C3%B3%D2%D7%D3%D0%CF%DE%B9%AB%CB%BE&s=">大连锦恒贸易有限公司</a></td>
                   <td><em class="trend-t 
				   down                    "></em></td>
                   <td>总：1207</td>
                   <td>月：22</td>
                   <td>周：20</td>
                   <td>日：7</td>
                  </tr>
                <tr>
                   <td class="tno no9"><a target="_blank" href="../s/?wd=%CE%EF%C1%F7%B5%BC%BA%BD&s=">物流导航</a></td>
                   <td><em class="trend-t 
				   down                    "></em></td>
                   <td>总：1133</td>
                   <td>月：25</td>
                   <td>周：24</td>
                   <td>日：3</td>
                  </tr>
                <tr>
                   <td class="tno no10"><a target="_blank" href="../s/?wd=%CE%D2%CF%EB%D5%D2%B1%B1%BE%A9%CA%D0%BA%A3%B5%ED%C7%F8%D6%D0%B9%D8%B4%E5%B8%BD%BD%FC%B5%C4%BA%A3%B5%ED%D2%BD%D4%BA&s=">我想找北京市海淀区中关村附近的海淀医院</a></td>
                   <td><em class="trend-t 
				   down                    "></em></td>
                   <td>总：1127</td>
                   <td>月：27</td>
                   <td>周：22</td>
                   <td>日：6</td>
                  </tr>
 
                  </table>
                </div>
                
            </div>

            <div class="r wind-vane">
                <ul id="tabC1" class="tab-title tabCX">
                    <li class="on" onmouseover="nTabs(this,0);" id="people">最新搜索</li>
                    <li class="nor" onmouseover="nTabs(this,1);" id="place">最新关键字</li>
                </ul>
                <div class="cl"></div>
                <ul id="tabC1-cont-0" class="days">
  
        	      <li><span class="title no1"><a target="_blank" href="../s/?wd=%BC%C6%CB%E3%C6%F7&s=">计算器</a></span></li>
  
        	      <li><span class="title no2"><a target="_blank" href="../s/?wd=%D4%C6%C6%F3%CB%D1%A3%AC%C6%B7%C5%C6%CB%D1%CB%F7%A3%AC%C9%FA%BB%EE%CB%D1%CB%F7%A3%AC%B7%FE%CE%F1%CB%D1%CB%F7%A3%AC&s=">云企搜，品牌搜索，生活搜索，服务搜索，</a></span></li>
  
        	      <li><span class="title no3"><a target="_blank" href="../s/?wd=%B9%E3%B8%E6&s=">广告</a></span></li>
  
        	      <li><span class="title no4"><a target="_blank" href="../s/?wd=2&s=">2</a></span></li>
  
        	      <li><span class="title no5"><a target="_blank" href="../s/?wd=%C6%F3%D2%B5&s=">企业</a></span></li>
  
        	      <li><span class="title no6"><a target="_blank" href="../s/?wd=%D4%C6%C6%F3%CB%D1%CB%D1%CB%F7%D2%FD%C7%E6&s=">云企搜搜索引擎</a></span></li>
  
        	      <li><span class="title no7"><a target="_blank" href="../s/?wd=ss&s=">ss</a></span></li>
  
        	      <li><span class="title no8"><a target="_blank" href="../s/?wd=%CB%D1%C3%A8%BC%AF%B3%C9%CB%D1%CB%F7&s=">搜猫集成搜索</a></span></li>
  
        	      <li><span class="title no9"><a target="_blank" href="../s/?wd=%CE%EF%C1%F7%B9%AB%CB%BE&s=">物流公司</a></span></li>
  
        	      <li><span class="title no10"><a target="_blank" href="../s/?wd=%C3%C0%C5%AE&s=">美女</a></span></li>
 
                </ul>
                <ul id="tabC1-cont-1" class="days none">
        	     <li><span class="title no1"><a target="_blank" href="../s/?wd=%CD%C5%B9%BA&s=">团购</a></span></li>
        	     <li><span class="title no2"><a target="_blank" href="../s/?wd=2345&s=">2345</a></span></li>
        	     <li><span class="title no3"><a target="_blank" href="../s/?wd=hao123&s=">hao123</a></span></li>
        	     <li><span class="title no4"><a target="_blank" href="../s/?wd=%D6%D0%B9%FA&s=">中国</a></span></li>
        	     <li><span class="title no5"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F5%BA%E2%3FD2%D7%D3%D0%CF%3F&s=">大连锦衡?D2子邢?</a></span></li>
        	     <li><span class="title no6"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F5%BA%E2%3FD2%D7%D3%D0%CF%3F&s=">大连锦衡?D2子邢?</a></span></li>
        	     <li><span class="title no7"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F5%BA%E2%3FD2%D7%D3%D0%CF%3F&s=">大连锦衡?D2子邢?</a></span></li>
        	     <li><span class="title no8"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F5%BA%E2%3FD2%D7%D3%D0%CF%3F&s=">大连锦衡?D2子邢?</a></span></li>
        	     <li><span class="title no9"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F5%BA%E2%3FD2%D7%D3%D0%CF%3F&s=">大连锦衡?D2子邢?</a></span></li>
        	     <li><span class="title no10"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F5%BA%E2%3FD2%D7%D3%D0%CF%3F&s=">大连锦衡?D2子邢?</a></span></li>
 
                </ul>
            </div>
            <div class="cl"></div>
        </div>
		<div class="cl"></div>
		<div class="footer">
			&copy;2012&nbsp;Somao&nbsp;
			<a href="#" target="_blank">使用云企搜前必读</a>&nbsp;
			<a href="#" target="_blank">关于云企搜风云榜</a>
		</div>
  </div>
    
	<div class="cl"></div>
</div>

<script src="js/newscrollandtabs.js" type="text/javascript"></script>
<script type="text/javascript">
linkage('tabB2','tabB3','tabC1','cityList1','2',1);linkage('tabB4','tabB5','tabC2','cityList2','26',2);linkage('tabB6','tabB7','tabC3','cityList3','258',3);linkage('tabB8','tabB9','tabC4','cityList4','280',4);linkage('tabB10','tabB11','tabC5','cityList5','297',5);
init();
</script>
</body>
</html>
