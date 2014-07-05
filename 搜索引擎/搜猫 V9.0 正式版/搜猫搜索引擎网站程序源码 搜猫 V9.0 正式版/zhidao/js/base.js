function StrCode(str){if(encodeURIComponent) return encodeURIComponent(str);if(escape) return escape(str);}
function UnStrCode(str){if(decodeURIComponent ) return decodeURIComponent (str);if(unescape) return unescape(str);}
function Trim(s){var m = s.match(/^\s*(\S+(\s+\S+)*)\s*$/);return (m == null)?"":m[1];}
function HtmlEncode(text){var re = {'<':'&lt;','>':'&gt;','&':'&amp;','"':'&quot;'};for (i in re) text = text.replace(new RegExp(i,'g'), re[i]);return text;}
function HtmlDecode(text){var re = {'&lt;':'<','&gt;':'>','&amp;':'&','&quot;':'"'};for (i in re) text = text.replace(new RegExp(i,'g'), re[i]);return text;}
function gid(id){return document.getElementById?document.getElementById(id):null;}
function gna(id){return document.getElementsByName?document.getElementsByName(id):null;}
function gname(name){return document.getElementsByTagName?document.getElementsByTagName(name):new Array()}
function addEvent(obj,evType,fn,useCapture ){if (obj.addEventListener){obj.addEventListener( evType, fn, useCapture );return true;}if (obj.attachEvent) return obj.attachEvent( "on" + evType, fn );alert( "Unable to add event listener for " + evType + " to " + obj.tagName );}
function Browser(){var ua, s, i;this.isIE = false;this.isNS = false;this.isOP = false;this.isSF = false;ua = navigator.userAgent.toLowerCase();s = "opera";if ((i = ua.indexOf(s)) >= 0){this.isOP = true;return;}s = "msie";if ((i = ua.indexOf(s)) >= 0) {this.isIE = true;return;}s = "netscape6/";if ((i = ua.indexOf(s)) >= 0) {this.isNS = true;return;}s = "gecko";if ((i = ua.indexOf(s)) >= 0) {this.isNS = true;return;}s = "safari";if ((i = ua.indexOf(s)) >= 0) {this.isSF = true;return;}}
function WarpClass(eID,tID,fID,ev){var eObj = document.getElementById(eID);var tObj = document.getElementById(tID);var fObj = document.getElementById(fID);if (eObj && tObj){if (!tObj.style.display || tObj.style.display == "block"){tObj.style.display = "none";eObj.className = "Warp";if (fObj) fObj.style.display = "none";}else{tObj.style.display = "block";eObj.className = "UnWarp";if (ev) eval(ev);if (fObj) fObj.style.display = "block";}}}
function ScreenConvert()
{
	var browser = new Browser();
	var objScreen = gid("ScreenOver");
	if(!objScreen) var objScreen = document.createElement("div");
	var oS = objScreen.style;
	objScreen.id = "ScreenOver";
	oS.display = "block";
	oS.top = oS.left = oS.margin = oS.padding = "0px";
	oS.width = document.body.scrollWidth;
	oS.height = document.body.scrollHeight;
	oS.position = "absolute";
	oS.zIndex = "3";
	if ((!browser.isSF) && (!browser.isOP)){oS.background = "#cccccc";}else{oS.background = "#cccccc";}
	oS.filter = "alpha(opacity=20)";
	oS.opacity = 0.2;
	oS.MozOpacity = 0.2;
	document.body.appendChild(objScreen);
	var allselect = gname("select");
	for (var i=0; i<allselect.length; i++) allselect[i].style.visibility = "hidden";
}
function ScreenClean()
{
	var objScreen = document.getElementById("ScreenOver");
	if (objScreen) objScreen.style.display = "none";
	var allselect = gname("select");
	for (var i=0; i<allselect.length; i++) allselect[i].style.visibility = "visible";
}
var t_DiglogX,t_DiglogY,t_DiglogW,t_DiglogH;
function DialogLoc()
{
	var dde = document.body;
	if (window.innerWidth)
	{
		//netscape
		var ww = window.innerWidth;
		var wh = window.innerHeight;
		var bgX = window.pageXOffset;
		var bgY = window.pageYOffset;
	}
	else
	{
		//ie
		var ww = dde.offsetWidth;//页面可视宽度
		var wh = dde.offsetHeight;
		var bgX = dde.scrollLeft;//页面滚动宽度
		var bgY = dde.scrollTop;
	}
	t_DiglogX = (bgX + ((ww - t_DiglogW)/2));
	t_DiglogY = (bgY + ((wh - t_DiglogH)/2));
}
function DialogShow(showdata,ow,oh,w,h)
{
	var objDialog = document.getElementById("DialogMove");
	if (!objDialog) objDialog = document.createElement("div");
	t_DiglogW = ow;
	t_DiglogH = oh;
	DialogLoc();
	objDialog.id = "DialogMove";
	var oS = objDialog.style;
	oS.display = "block";
	oS.top = t_DiglogY + "px";
	oS.left = t_DiglogX + "px";
	oS.margin = "0px";
	oS.padding = "0px";
	oS.width = w + "px";
	oS.height = h + "px";
	oS.position = "absolute";
	oS.zIndex = "5";
	oS.background = "#fff";
	oS.border = "solid #000 1px";
	objDialog.innerHTML = showdata;
	document.body.appendChild(objDialog);
}
function DialogHide()
{
	ScreenClean();
	var objDialog = document.getElementById("DialogMove");
	if (objDialog) objDialog.style.display = "none";
}