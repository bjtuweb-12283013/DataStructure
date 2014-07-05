<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>云企搜搜索风云榜</title>
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/tree.css">
<link rel="stylesheet" type="text/css" href="css/list.css">
</head>
<body>
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
	</div>	<div class="r main-cont">
		<div class="crumbs"><a href="index.php" target="_blank">云企搜风云榜</a>&nbsp;&nbsp;&gt;&nbsp; 热门搜索排行榜</div>
		<div class="content">
			<h1 class="top10">热门搜索排行榜</h1>
			<div class="list">
				<table cellspacing="0">
					<tbody>
					<tr class="th"><td width="41">排名</td>
					<td colspan="2">关键词</td><td width="73">当日搜索量</td>
					<td width="67">7日搜索量</td>
					<td width="73">当月搜索量</td>
					<td width="68">总搜索量</td>
					</tr>
					<tr>
						<th>1</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%D4%C6%C6%F3%CB%D1%A3%AC%C6%B7%C5%C6%CB%D1%CB%F7%A3%AC%C9%FA%BB%EE%CB%D1%CB%F7%A3%AC%B7%FE%CE%F1%CB%D1%CB%F7%A3%AC&s=">云企搜，品牌搜索，生活搜索，服务搜索，</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>18</td>
						<td>46</td>
                        <td>64</td>
                        <td>1934</td>
						</td>
               		  </tr>
					<tr>
						<th>2</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F0%D3%E7%D6%E1%B3%D0%D6%C6%D4%EC%D3%D0%CF%DE%B9%AB%CB%BE&s=">大连金隅轴承制造有限公司</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>15</td>
						<td>82</td>
                        <td>238</td>
                        <td>1834</td>
						</td>
               		  </tr>
					<tr>
						<th>3</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F5%BA%E2%C3%B3%D2%D7%D3%D0%CF%DE%B9%AB%CB%BE&s=">大连锦衡贸易有限公司</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>5</td>
						<td>40</td>
                        <td>42</td>
                        <td>1511</td>
						</td>
               		  </tr>
					<tr>
						<th>4</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B7%C2%B0%D9%B6%C8%CB%D1%CB%F7%D2%FD%C7%E6&s=">仿百度搜索引擎</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>2</td>
						<td>11</td>
                        <td>12</td>
                        <td>1499</td>
						</td>
               		  </tr>
					<tr>
						<th>5</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=360%B0%B2%C8%AB%CE%C0%CA%BF&s=">360安全卫士</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>7</td>
						<td>129</td>
                        <td>136</td>
                        <td>1479</td>
						</td>
               		  </tr>
					<tr>
						<th>6</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%D0%C2%D7%A2%B2%E1%C6%F3%D2%B5&s=">新注册企业</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>5</td>
						<td>133</td>
                        <td>134</td>
                        <td>1477</td>
						</td>
               		  </tr>
					<tr>
						<th>7</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B7%C2%B0%D9%B6%C8%CB%D1%CB%F7&s=">仿百度搜索</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>4</td>
						<td>19</td>
                        <td>25</td>
                        <td>1406</td>
						</td>
               		  </tr>
					<tr>
						<th>8</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BD%F5%BA%E3%C3%B3%D2%D7%D3%D0%CF%DE%B9%AB%CB%BE&s=">大连锦恒贸易有限公司</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>7</td>
						<td>20</td>
                        <td>22</td>
                        <td>1207</td>
						</td>
               		  </tr>
					<tr>
						<th>9</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%CE%EF%C1%F7%B5%BC%BA%BD&s=">物流导航</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>3</td>
						<td>24</td>
                        <td>25</td>
                        <td>1133</td>
						</td>
               		  </tr>
					<tr>
						<th>10</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%CE%D2%CF%EB%D5%D2%B1%B1%BE%A9%CA%D0%BA%A3%B5%ED%C7%F8%D6%D0%B9%D8%B4%E5%B8%BD%BD%FC%B5%C4%BA%A3%B5%ED%D2%BD%D4%BA&s=">我想找北京市海淀区中关村附近的海淀医院</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>6</td>
						<td>22</td>
                        <td>27</td>
                        <td>1127</td>
						</td>
               		  </tr>
					<tr>
						<th>11</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%BA%BC%D6%DD%B9%AB%CB%BE&s=">杭州公司</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>110</td>
						<td>171</td>
                        <td>175</td>
                        <td>1090</td>
						</td>
               		  </tr>
					<tr>
						<th>12</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=baidu&s=">baidu</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>27</td>
						<td>153</td>
                        <td>177</td>
                        <td>1031</td>
						</td>
               		  </tr>
					<tr>
						<th>13</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%CB%D1%C3%A8%BC%AF%B3%C9%CB%D1%CB%F7%28%D7%EE%D0%C2%29&s=">搜猫集成搜索(最新)</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>5</td>
						<td>8</td>
                        <td>13</td>
                        <td>999</td>
						</td>
               		  </tr>
					<tr>
						<th>14</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B6%AB%DD%B8%BF%C6%BC%BC&s=">东莞科技</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>6</td>
						<td>113</td>
                        <td>113</td>
                        <td>980</td>
						</td>
               		  </tr>
					<tr>
						<th>15</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%CC%EC%D2%E3%C3%B3%D2%D7%D3%D0%CF%DE%B9%AB%CB%BE&s=">大连天毅贸易有限公司</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>9</td>
						<td>33</td>
                        <td>34</td>
                        <td>961</td>
						</td>
               		  </tr>
					<tr>
						<th>16</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%BC%C6%CB%E3%C6%F7&s=">计算器</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>8</td>
						<td>16</td>
                        <td>26</td>
                        <td>910</td>
						</td>
               		  </tr>
					<tr>
						<th>17</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B1%B1%BE%A9%CA%D0%BA%A3%B5%ED%D2%BD%D4%BA&s=">北京市海淀医院</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>14</td>
						<td>53</td>
                        <td>56</td>
                        <td>908</td>
						</td>
               		  </tr>
					<tr>
						<th>18</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B0%A2%C0%EF%C2%E8%C2%E8&s=">阿里妈妈</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>11</td>
						<td>44</td>
                        <td>53</td>
                        <td>887</td>
						</td>
               		  </tr>
					<tr>
						<th>19</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%BA%A3%B5%ED%D2%BD%D4%BA&s=">海淀医院</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>11</td>
						<td>15</td>
                        <td>15</td>
                        <td>881</td>
						</td>
               		  </tr>
					<tr>
						<th>20</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%CB%D1%C3%A8%BC%AF%B3%C9%CB%D1%CB%F7%2F&s=">搜猫集成搜索/</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>6</td>
						<td>35</td>
                        <td>37</td>
                        <td>815</td>
						</td>
               		  </tr>
					<tr>
						<th>21</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%CB%D1%CB%F7&s=">搜索</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>4</td>
						<td>6</td>
                        <td>9</td>
                        <td>800</td>
						</td>
               		  </tr>
					<tr>
						<th>22</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=qq&s=">qq</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>6</td>
						<td>13</td>
                        <td>60</td>
                        <td>792</td>
						</td>
               		  </tr>
					<tr>
						<th>23</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%CD%F8%C2%E7%B9%AB%CB%BE&s=">大连网络公司</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>5</td>
						<td>54</td>
                        <td>60</td>
                        <td>784</td>
						</td>
               		  </tr>
					<tr>
						<th>24</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC&s=">大连</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>5</td>
						<td>9</td>
                        <td>17</td>
                        <td>762</td>
						</td>
               		  </tr>
					<tr>
						<th>25</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B9%A9%D3%A6&s=">供应</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>4</td>
						<td>14</td>
                        <td>23</td>
                        <td>733</td>
						</td>
               		  </tr>
					<tr>
						<th>26</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%CB%D1%C3%A8%BC%AF%B3%C9%CB%D1%CB%F7%28%D7%EE%3F&s=">搜猫集成搜索(最?</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>6</td>
						<td>19</td>
                        <td>21</td>
                        <td>722</td>
						</td>
               		  </tr>
					<tr>
						<th>27</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%25&s=">%</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>8</td>
						<td>55</td>
                        <td>73</td>
                        <td>709</td>
						</td>
               		  </tr>
					<tr>
						<th>28</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=1&s=">1</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>6</td>
						<td>11</td>
                        <td>17</td>
                        <td>707</td>
						</td>
               		  </tr>
					<tr>
						<th>29</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%F6%CE%CD%F8&s=">大连鑫网</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>6</td>
						<td>7</td>
                        <td>57</td>
                        <td>706</td>
						</td>
               		  </tr>
					<tr>
						<th>30</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%BB%FA%D0%B5&s=">大连机械</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>8</td>
						<td>14</td>
                        <td>15</td>
                        <td>663</td>
						</td>
               		  </tr>
					<tr>
						<th>31</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%CD%F8%D5%BE%BD%A8%C9%E8&s=">大连网站建设</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>6</td>
						<td>18</td>
                        <td>24</td>
                        <td>630</td>
						</td>
               		  </tr>
					<tr>
						<th>32</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B0%D9%B6%C8&s=">百度</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>9</td>
						<td>28</td>
                        <td>29</td>
                        <td>625</td>
						</td>
               		  </tr>
					<tr>
						<th>33</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B7%FE%CE%F1%C6%F7%D0%E9%C4%E2%D6%F7%BB%FA&s=">服务器虚拟主机</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>4</td>
						<td>11</td>
                        <td>13</td>
                        <td>621</td>
						</td>
               		  </tr>
					<tr>
						<th>34</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%CD%F8%D5%BE%BD%A8%C9%E8&s=">网站建设</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>7</td>
						<td>13</td>
                        <td>14</td>
                        <td>578</td>
						</td>
               		  </tr>
					<tr>
						<th>35</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%CB%D1&s=">搜</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>4</td>
						<td>9</td>
                        <td>11</td>
                        <td>566</td>
						</td>
               		  </tr>
					<tr>
						<th>36</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=watianxia&s=">watianxia</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>4</td>
						<td>11</td>
                        <td>15</td>
                        <td>542</td>
						</td>
               		  </tr>
					<tr>
						<th>37</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%D0%C2%C6%F3%D2%B5&s=">新企业</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>3</td>
						<td>12</td>
                        <td>37</td>
                        <td>504</td>
						</td>
               		  </tr>
					<tr>
						<th>38</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%CD%F8%B0%C9%CE%AC%BB%A4&s=">网吧维护</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>5</td>
						<td>7</td>
                        <td>9</td>
                        <td>488</td>
						</td>
               		  </tr>
					<tr>
						<th>39</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%CD%F8%D2%B3%C9%E8%BC%C6&s=">大连网页设计</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>5</td>
						<td>20</td>
                        <td>23</td>
                        <td>486</td>
						</td>
               		  </tr>
					<tr>
						<th>40</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%B4%F3%C1%AC%CE%EF%C1%F7&s=">大连物流</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>4</td>
						<td>9</td>
                        <td>9</td>
                        <td>475</td>
						</td>
               		  </tr>
					<tr>
						<th>41</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=dlxinwang&s=">dlxinwang</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>2</td>
						<td>56</td>
                        <td>59</td>
                        <td>473</td>
						</td>
               		  </tr>
					<tr>
						<th>42</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%CE%EF%C1%F7&s=">物流</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>4</td>
						<td>4</td>
                        <td>4</td>
                        <td>427</td>
						</td>
               		  </tr>
					<tr>
						<th>43</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=360&s=">360</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>11</td>
						<td>13</td>
                        <td>13</td>
                        <td>419</td>
						</td>
               		  </tr>
					<tr>
						<th>44</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%D5%BE%B3%A4&s=">站长</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>6</td>
						<td>12</td>
                        <td>13</td>
                        <td>382</td>
						</td>
               		  </tr>
					<tr>
						<th>45</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%C3%C0%C5%AE&s=">美女</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>5</td>
						<td>7</td>
                        <td>11</td>
                        <td>376</td>
						</td>
               		  </tr>
					<tr>
						<th>46</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=2&s=">2</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>5</td>
						<td>11</td>
                        <td>14</td>
                        <td>371</td>
						</td>
               		  </tr>
					<tr>
						<th>47</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%CE%EF%C1%F7%B9%AB%CB%BE&s=">物流公司</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>5</td>
						<td>5</td>
                        <td>7</td>
                        <td>366</td>
						</td>
               		  </tr>
					<tr>
						<th>48</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=ss&s=">ss</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>7</td>
						<td>16</td>
                        <td>19</td>
                        <td>333</td>
						</td>
               		  </tr>
					<tr>
						<th>49</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%CB%D1%C3%A8%BC%AF%B3%C9%CB%D1%CB%F7&s=">搜猫集成搜索</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>8</td>
						<td>24</td>
                        <td>25</td>
                        <td>315</td>
						</td>
               		  </tr>
					<tr>
						<th>50</th>
						<td width="354" class="key"><a target="_blank" href="../s/?wd=%D4%C6%C4%CF%C9%CC%B1%EA%C9%E8%BC%C6&s=">云南商标设计</a></td>
						<td width="11"><a href="http://www.baidu.com/baidu?cl=3&tn=baidutop10&fr=top1000&wd=%CA%E9%BC%C7%D6%AE%C5%AE%B3%D4%BF%D5%E2%C3" target="_blank" class="detail"></a></td>
						
						<td>7</td>
						<td>70</td>
                        <td>71</td>
                        <td>296</td>
						</td>
               		  </tr>
 
					</tbody>
				</table>
			</div>
		</div>
    
		<div class="footer">
			&copy;2012&nbsp;Somao&nbsp;
			<a href="http://www.yunqisou.com/duty/index.html" target="_blank">使用云企搜前必读</a>&nbsp;
			<a href="about_top.php" target="_blank">关于云企搜风云榜</a>
		</div> 
	</div>
    
	<div class="cl"></div>
</div>

<div id="full" style="display:none; width:50px; height:95px; position:fixed; left:50%; top:480px; margin-left:493px;  z-index:100; text-align:center; cursor:pointer;"><a href='javascript:void(0)'><img src="img/return_top.gif" border=0 alt="返回顶部"></a></div>
<script src="js/news_top.js" type="text/javascript"></script>

</body>
</html>

