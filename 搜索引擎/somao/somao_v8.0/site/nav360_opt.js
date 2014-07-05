function MM_jumpMenu(targ,selObj,restore){ 
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
  setCookie("360WEBINDEXCK", selObj.options[selObj.selectedIndex].value);
}

function googleHint(key){
  if($('gsuggest'))$('gsuggest').parentNode.removeChild($('gsuggest'));
  var sg=document.body.appendChild(document.createElement('script'));
  sg.language='javascript';
  sg.id='gsuggest';
  sg.charset='utf-8';
  sg.src='http://www.google.cn/complete/search?hl=zh-CN&client=suggest&js=true&q=' + encodeURIComponent(key);
}

function myhint(event){
   var keyword=$('kw1');
   var h=$('suggests');
   if(!keyword.value || !keyword.value.length || event.keyCode==27 || event.keyCode==13){
       h.style.display='none';
       return;
   }
   if(event.keyCode==38 || event.keyCode==40){
     if(h.style.display=='none') return;
       if(event.keyCode==38){
         if(h._i==-1)h._i=h.firstChild.rows.length-1;
         else{h._i--;} 
      }else{h._i++;} 
    for(var i=0;i<h.firstChild.rows.length;i++)h.firstChild.rows[i].style.background="#FFF";
      if(h._i >= 0 && h._i < h.firstChild.rows.length)with(h.firstChild.rows[h._i]){
        style.background="#E6E6E6";
        keyword.value=cells[0].attributes['_h'].value;
      }else{
        keyword.value=h._kw;
        h._i=-1;
      } 
}else{
      h._i=-1;
      h._kw=keyword.value;
      googleHint(keyword.value);
      with(h.style){width=keyword.offsetWidth - 2;}
    } 
}

window.google={};
window.google.ac={};
window.google.ac.h=function(a){
 
    if(!a || a.length!=2 ) return;
    if(a[0] != $('kw1').value) return;
    var ihtml='';
 var c = a[1];
    for(var j = 0; j < c.length; j ++) {
        ihtml += '<tr style="cursor:hand" onmousedown="$(\'kw1\').value=\'' +c[j][0] +'\';javascript:searchSubmit(this);" onmouseover="javascript:this.style.background=\'#E6E6E6\'" onmouseout="javascript:this.style.background=\'#FFF\';"><td style="color:#000;font-size:12px;" align="left" _h="'+c[j][0] +'">' +c[j][0] +'</td><td style="color:#090" align="right" style="font-size:11.5px;">约' +c[j][1] +'</td></tr>';
    }
    $('suggests').innerHTML='<table width="100%" border="0" cellpadding="0" cellspacing="0">' + ihtml + '</table>';
    setDisplay('suggests', 1);
};

function searchSubmit(index){
     formInfo = index.parentNode.parentNode.parentNode.parentNode; 
     if(formInfo.tagName == "FORM") {
if($("backUrl")) {$("backUrl").value="http%3A%2F%2Fsearch.book.dangdang.com%2Fsearch.aspx%3Fcatalog%3D01%26SearchFromTop%3D1%26key%3D"+$("kw1").value;}
formInfo.submit();
}
}

window.onload=function(){
init();
getRight();
}
/** search tab start **/

function highlightSearchTab()
{
    var s = getSearchTabByIndex(0);
    var t = getSearchTabByIndex(1);
    displayTab(s, t);
}

/** search tab end **/

var j
function init(){
		var liS=$("selectId").getElementsByTagName("input");
		j=liS.length;
		for(var i=0;i<j;i++){
			liS[i].lisNum = i;
			liS[i].onclick=function(){displayTab(this.lisNum,0);}
		}
		$("setPageIfrm").src='http://hao.360.cn/set.html';
}

var searchs = [];
searchs[0] = [];
searchs[0][0] = new Array("网页","http://www.baidu.com/s", "wd","百度",-1,"http://www.baidu.com/?tn=360se_1_dg","tn:360se_1_dg");
searchs[0][1] = new Array("新闻","http://news.baidu.com/ns", "word","百度",-1,"http://news.baidu.com/ns?word=");
searchs[0][2] = new Array("贴吧","http://tieba.baidu.com/f", "kw","百度",-1,"http://tieba.baidu.com/?tn=360se_1_dg", "tn:360se_1_dg");
searchs[0][3] = new Array("知道","http://zhidao.baidu.com/q", "word","百度", -1,"http://zhidao.baidu.com/q?tn=ikaslist","ct:17;pt:360se_ik;tn:ikaslist");
searchs[0][4] = new Array("MP3","http://mp3.baidu.com/m", "word","百度",-1,"http://mp3.baidu.com/?tn=360se_1_dg","f:ms;ct:134217728;tn:360se_1_dg");
searchs[0][5] = new Array("图片","http://image.baidu.com/i", "word","百度",-1,"http://image.baidu.com/?tn=360se_1_dg","cl:2;lm:-1;ct:201326592;tn:360se_1_dg");
searchs[0][6] = new Array("视频","http://video.baidu.com/v", "word","百度",-1,"http://video.baidu.com/?tn=360se_1_dg","tn:360se_1_dg");
searchs[1] = [];
searchs[1][0] = new Array("网页","http://www.google.cn/search", "q","谷歌", -29, "http://www.google.cn/webhp?client=aff-360daohang", "client:aff-360daohang;hl:zh-CN");
searchs[1][1] = new Array("图片","http://images.google.cn/images", "q","谷歌", -29,"http://images.google.cn/imghp?client=aff-360daohang", "client:aff-360daohang;hl:zh-CN");
searchs[1][2] = new Array("视频","http://video.google.cn/videosearch", "q","谷歌", -29,"http://video.google.cn/?client=aff-360daohang", "client:aff-360daohang;hl:zh-CN");
searchs[1][3] = new Array("地图","http://ditu.google.cn/maps", "q","谷歌", -29,"http://ditu.google.cn/?client=aff-360daohang", "client:aff-360daohang;hl:zh-CN");
searchs[1][4] = new Array("资讯","http://news.google.cn/news/search", "q","谷歌", -29,"http://news.google.cn/?client=aff-360daohang", "client:aff-360daohang;hl:zh-CN");
searchs[1][5] =  new Array("音乐","http://www.google.cn/music/search", "q","谷歌", -29,"http://www.google.cn/music/?client=aff-360daohang", "client:aff-360daohang;hl:zh-CN;ie:gb2312;oe:utf-8");
searchs[2] = [];
searchs[2][0] = new Array("问答","http://www.qihoo.com/wenda.php", "kw","奇虎",-60,"http://www.qihoo.com/wenda.php","do:search;area:0");
searchs[2][1] = new Array("博客","http://www.qihoo.com/wenda.php", "kw","奇虎", -60,"http://www.qihoo.com/wenda.php","do:search;area:1");
searchs[2][2] = new Array("论坛","http://www.qihoo.com/wenda.php", "kw","奇虎", -60,"http://www.qihoo.com/wenda.php","do:search;area:2");
searchs[3] = [];
searchs[3][0] = new Array("淘宝","http://search8.taobao.com/browse/search_auction.htm", "q","购物",-90,"http://www.taobao.com/?pid=mm_12988176_0_0&unid=5005368","pid:mm_12988176_0_0;search_type:auction;commend:all;at_topsearch:1;unid:5005368");
searchs[3][1] = new Array("当当","http://union.dangdang.com/transfer/transfer.aspx", "dd_key","购物", -120,"http://union.dangdang.com/transfer/transfer.aspx?from=488-133054&backurl=http%3A%2F%2Fhome.dangdang.com", "from:488-133054;dd_catalog:01;backUrl:http%3A%2F%2Fsearch.book.dangdang.com%2Fsearch.aspx%3Fcatalog%3D01%26SearchFromTop%3D1%26key%3D");
searchs[3][2] = new Array("卓越","http://www.amazon.cn/search/search.asp", "searchWord","购物", -150,"http://www.amazon.cn/?source=heima8_133054","source:heima8_133054;searchType:1");
searchs[3][3] = new Array("京东","http://www.360buy.com/union/SearchRedirect.aspx", "keyword","购物", -180,"http://www.360buy.com/union/SearchRedirect.aspx?union_Id=175","union_Id:175");

function  displayTab(sNum, tNum){
	$("hidpar").innerHTML = '';
	$("searchForm").action = searchs[sNum][tNum][1];
	$("kw1").name = searchs[sNum][tNum][2];
           $("searchBtn").value = searchs[sNum][tNum][3]+"搜索";
	if($("seBox").style.backgroundPositionY) 
		$("seBox").style.backgroundPositionY = searchs[sNum][tNum][4]+"px";
	else {$("seBox").style.backgroundPosition = "0 "+searchs[sNum][tNum][4]+"px";}
	tabLen = searchs[sNum].length;tabStr = '';
	var selectWeb = document.getElementsByName("searchRadio");
	for(var i=0; i<selectWeb.length; i++)
	{
		if(i == sNum) selectWeb[i].checked=true;
		else selectWeb[i].checked=false;
	}
	for(var i=0; i< tabLen; i++)
	{
		if(i == tNum){tabStr = tabStr + "<b  class='bStyle'>"+searchs[sNum][i][0]+"</b>";}
		else{tabStr = tabStr + "<b onclick='displayTab("+sNum+","+i+")'>"+searchs[sNum][i][0]+"</b>";}
		if(i < tabLen-1) tabStr = tabStr + "|";
	}
	$("searchTab").innerHTML = tabStr;
	$("setUrl").href = searchs[sNum][tNum][5];
	if(searchs[sNum][tNum][6] != null)
	{
		paramArrs = searchs[sNum][tNum][6].split(";");
		for(var i=0; i< paramArrs.length; i++)
		{
			pvalue = paramArrs[i].split(":");
			pel = document.createElement("INPUT");
			pel.type = "hidden";
			pel.name = pvalue[0];
			pel.id = pvalue[0];
			pel.value = pvalue[1];
			$("hidpar").appendChild(pel);
		}
	}
	if(sNum == 3 && tNum == 1)
	{
		$("searchForm").onsubmit=function(){if($("backUrl")) {$("backUrl").value="http%3A%2F%2Fsearch.book.dangdang.com%2Fsearch.aspx%3Fcatalog%3D01%26SearchFromTop%3D1%26key%3D"+$("kw1").value;return true;}};

	}
           if(sNum > 1){sNum = 1;tNum = 0;}
           setSearchTab(sNum+','+tNum);
}	
(function (){ 
    var x="appendChild",y="length",A="split",E="value",Aa="focus";window.hao360cn={};window.hao360cn.check=checkMail;
    function w(a,b){return a.value=b}
    function ja(a,b){return a.name=b}
    function checkMail(a){if(a.MailBox.options.selectedIndex==0){alert("\u63d0\u793a\uff1a\u8bf7\u6b63\u786e\u9009\u62e9\u4f60\u4f7f\u7528\u7684\u90ae\u7bb1");return false;}if(a.Username[E]==""||a.Username[E]=="\u8bf7\u5728\u6b64\u8f93\u5165\u60a8\u7684\u7528\u6237\u540d"){alert("\u63d0\u793a\uff1a\u90ae\u7bb1\u7528\u6237\u540d\u5fc5\u987b\u586b\u5199\uff01");a.Username[Aa]();return false; }if(a.Password[E]==""||a.Password[E][y]<3){alert("\u63d0\u793a\uff1a\u90ae\u7bb1\u5bc6\u7801\u5fc5\u987b\u586b\u5199\u5b8c\u6574\uff01");a.Password[Aa](); return false;}var b=[];
        b["36000"]=new Array("https://passport.baidu.com/?login","username","password");
        b["36001"]=new Array("http://reg.163.com/in.jsp?url=http://fm163.163.com/coremail/fcg/ntesdoor2?language=0&style=1","username","password");
        b["36002"]=new Array("http://vip.163.com/logon.m","username","password","enterVip,true; style,");
        b["36003"]=new Array("http://reg.163.com/logins.jsp","username","password","domain,126.com; url,http://entry.mail.126.com/cgi/ntesdoor?lightweight%3D1%26verifycookie%3D1%26language%3D0%26style%3D-1", "@126.com");
        b["36004"]=new Array("http://mail.sina.com.cn/cgi-bin/login.cgi","u","psw","logintype,uid; product,mail");
        b["36005"]=new Array("http://vip.sina.com.cn/cgi-bin/login.cgi","user","pass");
        b["36006"]=new Array("http://passport.sohu.com/login.jsp","loginid","passwd","fl,1; vr,1|1; appid,1000; ru,http://login.mail.sohu.com/servlet/LoginServlet; eru,http://login.mail.sohu.com/login.jsp; ct,1173080990; sg,5082635c77272088ae7241ccdf7cf062","@sohu.com");
        b["36007"]=new Array("http://passport.sohu.com/login.jsp","loginid","passwd","fl,1; vr,1|1; appid,1013; ru,http://vip.sohu.com/login/viplogin11.jsp; eru,; ct,1173857434; sg,885ebb7884194ee547f224fc8a6a5877", "@vip.sohu.com");
        b["36008"]=new Array("http://passport.21cn.com/maillogin.jsp","LoginName","passwd","NeedMoreSecurity,on; NeedIpCheck,on");
        b["36009"]=new Array("http://g2wm.263.net/xmweb","usr","pass","domain,263.net; func,login");
        b["36010"]=new Array("http://bjweb.163.net/cgi/163/login_pro.cgi","user","pass","type,0; style,10");
        b["36011"]=new Array("http://mail.china.com/xmweb","usr","pass","func,login");
        b["36013"]=new Array("http://edit.bjs.yahoo.com/config/login","login","passwd",".intl,cn; .done,http://mail.yahoo.com");
        b["36014"]=new Array("https://edit.bjs.yahoo.com/config/login","login","passwd","domainss,yahoocn; .intl,cn; .done,http://mail.cn.yahoo.com/inset.html","@yahoo.cn");
        b["36015"]=new Array("https://www.google.com/accounts/ServiceLoginAuth","Email","Passwd","continue,http://mail.google.com/mail?zy=l; service,mail; hl,zh-CN");
        b["36016"]=new Array("http://passport.51.com/login.5p","passport_51_user","passport_51_password","gourl,http://my.51.com/webim/index.php?refer=");
        b["36017"]=new Array("http://passport.sohu.com/login.jsp","loginid","passwd","appid,1005; fl,1; vr,1|1; ru,http://profile.chinaren.com/urs/setcookie.jsp?burl=http://alumni.chinaren.com/; ct,1174378209; sg,84ff7b2e1d8f3dc46c6d17bb83fe72bd","@chinaren.com");
        b["36018"]=new Array("http://login.xiaonei.com/Login.do","email","password");
        b["36021"]=new Array("http://n20svrg3.139.com/default.aspx","txtUserName","txtPassword","loginType,0");
        b["36022"]=new Array("https://reg.163.com/logins.jsp?type=1&product=mailyeah&url=http://entry.mail.yeah.net/cgi/ntesdoor?lightweight%3D1%26verifycookie%3D1%26style%3D-1","username","password","","@yeah.net");
        b["36023"]=new Array("https://www.google.com/accounts/ServiceLoginAuth","Email","Passwd","continue,http://mail.google.com/mail?zy=l; service,mail; hl,zh-CN");
        var c=a.MailBox[E],d=$("Username")[E];if(b[c]!=null){var e=b[c];a.action=e[0];ja($("Username"),e[1]);ja($("Password"),e[2]);if(e[3]!=null){var g=e[3][A]("; "),h=0;for(;h<g[y];h++){var f=g[h][A](","),i=document.createElement("INPUT");i.type="hidden"; ja(i,f[0]);w(i,f[1]);$("MailCheck")[x](i)}}if(e[4]!=null)w($("Username"),d+e[4])}else alert("\u8bf7\u9009\u62e9\u6b63\u786e\u7684\u90ae\u7bb1\uff01");a.submit();w($("Username"),d);w($("Password"),"")}
})();
var _s=window.hao360cn;

function setPage(){
		if($("set").style.display=="none"){
			$("set").style.display="";
			}else{
				$("set").style.display="none";
				}
		}

function col(){
	$("setBt").className="setBtn";
	$("set").style.display="none";
}