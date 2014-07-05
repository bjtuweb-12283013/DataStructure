
var sf_mess_lib = {
	loadCss: function (url) {
		var css = document.createElement('link');
		css.setAttribute('rel', 'stylesheet');
		css.setAttribute('type', 'text/css');
		css.setAttribute('href', url);
		document.getElementsByTagName('head')[0].appendChild(css);
	},
	
	getElement: function (id) {
		return document.getElementById(id);
	}
}

var sf_mess_browser = {};
sf_mess_browser.ieVersion = /msie (\d+)/.exec(navigator.userAgent.toLowerCase());
sf_mess_browser.higherThanIE6 = sf_mess_browser.ieVersion && parseInt(sf_mess_browser.ieVersion[1]) > 6;
sf_mess_browser.onQuirkMode = document.compatMode && document.compatMode.indexOf('Back') == 0;

if(sf_mess_browser.ieVersion && !(sf_mess_browser.higherThanIE6)) {
	document.execCommand("BackgroundImageCache", false, true);
}
var SF_MESS_FORM_NAME			= "SfMessForm";
var SF_MESS_WRAP_ID 			= "SfMessWrap";
var SF_MESS_HEAD_ID 			= "SfMessHead";
var SF_MESS_TITLE_ID			= "SfMessTitle";
var SF_MESS_HEAD_ICON_ID 		= "SfMessHeadIcon";
var SF_MESS_BODY_ID 			= "SfMessBody";
var SF_MESS_BODY_TOP_ID 		= "SfMessBodyTop";
var SF_MESS_BODY_MID_ID 		= "SfMessBodyMid";
var SF_MESS_BODY_BOTTOM_ID 		= "SfMessBodyBottom";
var SF_MESS_BODY_FOOT_ID 		= "SfMessBodyFoot"
var SF_MESS_SUBMIT_ID 			= "SfMessSubmit";
var SF_MESS_COPY_ID 			= "SfMessCopy";
var SF_MESS_FRAME_ID 			= "SfMessCopyFrame";
var SF_MESS_TIP_CLASS 			= "SfMessTip";
var SF_MESS_ICON_OPEN_CLASS		= "SfMessIconOpen";
var SF_MESS_ICON_CLOSE_CLASS	= "SfMessIconClose";
var SF_MESS_PREFIX 				= "SfMess_";

var SF_MESS_POST_ACTION         = "action.php";
var SF_MESS_THEME_PATH = 'float/themes/';
var SF_MESS_PATH = "float/sfmess/";

var sf_mess_layout_mod = [];
sf_mess_layout_mod.push('<div id="${SF_MESS_WRAP_ID}" style="top:1000px;${sf_pos_style}">',
'<iframe id="${SF_MESS_FRAME_ID}" name="${SF_MESS_FRAME_ID}" style="display:none;"></iframe>',
'<form style="margin:0;" target="${SF_MESS_FRAME_ID}" name="${SF_MESS_FORM_NAME}" method="post" action="${SF_MESS_POST_ACTION}">',
	'<div id="${SF_MESS_HEAD_ID}">',
		'<div id="${SF_MESS_TITLE_ID}">${sf_mess_cfg.title}</div>',
		'<div class="${SF_MESS_ICON_OPEN_CLASS}" id="${SF_MESS_HEAD_ICON_ID}"></div>',
	'</div>',
	'<div id="${SF_MESS_BODY_ID}">',
		'<div id="${SF_MESS_BODY_TOP_ID}"></div>',
		'<div id="${SF_MESS_BODY_MID_ID}"></div>',
		'<div id="${SF_MESS_BODY_BOTTOM_ID}">',
			'<input id="${SF_MESS_SUBMIT_ID}" type="submit" value="${sf_mess_cfg.send}">',
			'<div id="${SF_MESS_COPY_ID}">${sf_mess_cfg.copyright}</div>',
		'</div>',
		'<div id="${SF_MESS_BODY_FOOT_ID}"></div>',
	'</div>',
'</form>',
'</div>');

if (window.sf_mess_preview) SF_MESS_POST_ACTION = "";

var sf_mess_validate = {
	mustValidate: function (name, defaultValue) {
		var colValue = document.getElementById(SF_MESS_PREFIX + name).value.replace(/(^\s*)|(\s*$)/g, "");
		if (colValue.length <= 0 || 
			colValue == filtInnertip(defaultValue)) {
			return false;
		}
		return true;
	},
	emailValidate: function (innertip) {
		var emailEl = document.getElementById(SF_MESS_PREFIX + 'email');
		if (emailEl) {
			if (emailEl.value == innertip || emailEl.value.length == 0) return true;
			return /^[-0-9.a-z_]+@([0-9a-z][-0-9.a-z_]+\.)+[a-z0-9]{2,4}$/.test(document.getElementById(SF_MESS_PREFIX + 'email').value);
		}
			
		return true;
	},
	messValidate: function () {
		var messVal = document[SF_MESS_FORM_NAME].getElementsByTagName('textarea')[0].value;
		var len = messVal.length;
		for (var i = 0, l = len; i < l; i++) {
			if (messVal.charCodeAt(i) > 127)
				len ++;
		}
		return len <= 2000;
	},
	init: function () {
		document[SF_MESS_FORM_NAME].onsubmit = function () {
			if (window.sf_mess_preview) return false;
			var pass = true;
			var msg = [];			
			
			var intSucNum = 0;
			var noContact = true;
			
			var aetMsg = [];
			for (var i = 0, l = sf_mess_cols.length; i < l; i++) {
				var inputCfg = sf_mess_cols[i];
				if(inputCfg.mbtype == 'address' 
					|| inputCfg.mbtype == 'tel'
					|| inputCfg.mbtype == 'email') {
					if(sf_mess_validate.mustValidate(inputCfg.idname,inputCfg.innertip)) {
						intSucNum++;
					}else{
						aetMsg.push(sf_mess_msg.prefix + inputCfg.tip);
					}
					noContact = false;
				}				
			}
			if(intSucNum==0 && !noContact){
				pass = false;
				msg.push(aetMsg.join('\n'));
			}			

			var oriColumnsState = {'address':0,'tel':0,'email':0};
			var oriColumns = {};
			var emailInnertip = "";
			
			for (var i = 0, l = sf_mess_cols.length; i < l; i++) {
				var inputCfg = sf_mess_cols[i];
				switch (inputCfg.mbtype) {					
					case 'message':
					case 'must':
						if(!sf_mess_validate.mustValidate(inputCfg.idname,inputCfg.innertip)) {
							pass = false;
							msg.push(sf_mess_msg.prefix + inputCfg.tip);
						}
						break;
					case 'email':
						emailInnertip = inputCfg.innertip;
						break;
					default:
						break;
				}
			}

			if (!sf_mess_validate.emailValidate(emailInnertip)) {
				pass = false;
				msg.push(sf_mess_msg.emailErr);
			}

			if(!sf_mess_validate.messValidate()) {
				pass = false;
				msg.push(sf_mess_msg.messErr);
			}
			
			if(!pass) {
				alert(msg.join('\n'));
			} else {
				for (var i = 0, l = sf_mess_cols.length; i < l; i++) {
					var inputCfg = sf_mess_cols[i];
					var hideEl = document.getElementById(SF_MESS_PREFIX + inputCfg.idname + 'hide');
					document.getElementById(SF_MESS_PREFIX + inputCfg.idname).disabled = true;
					if (document.getElementById(SF_MESS_PREFIX + inputCfg.idname).value == inputCfg.innertip) {
						hideEl.value = '';
						continue;
					}
					var utf8Value = encodeURIComponent(document.getElementById(SF_MESS_PREFIX + inputCfg.idname).value);
					hideEl.value = utf8Value;
				}
				sf_mess_lib.getElement(SF_MESS_SUBMIT_ID).disabled = true;
				sfMessTimes = 0;
				sfMessSubmitMonitor();
			}
			return pass;
		}
	}
}

var sfMessTimes;
function sfMessSubmitMonitor () {
    try{
        var hash = sf_mess_lib.getElement(SF_MESS_FRAME_ID).contentWindow.location.hash;
		sfMessTimes ++;
		if (sfMessTimes > 50) {
			alert(sf_mess_msg.fail);
			sf_mess_lib.getElement(SF_MESS_SUBMIT_ID).disabled = false;
			for (var i = 0, l = sf_mess_cols.length; i < l; i++) {
				document.getElementById(SF_MESS_PREFIX + sf_mess_cols[i].idname).disabled = false;
			}
		} else {
			setTimeout(sfMessSubmitMonitor,100);
		}
    } catch (e) {
        sf_mess_lib.getElement(SF_MESS_FRAME_ID).src = "about:blank";
		alert(sf_mess_msg.success);
        sf_mess_lib.getElement(SF_MESS_SUBMIT_ID).disabled = false;
		for (var i = 0, l = sf_mess_cols.length; i < l; i++) {
			var inputCfg = sf_mess_cols[i];
			var inputEl = document.getElementById(SF_MESS_PREFIX + inputCfg.idname);
			inputEl.disabled = false;
			inputEl.value = filtInnertip(inputCfg.innertip);
		}
    }
}

function filtInnertip (str) {
	return str.replace(/&quot;/g, '"').replace(/&#039;/g, "'").replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&amp;/g, "&");
}


if (!window.is_sf_mess_loaded) {
	window.is_sf_mess_loaded = true;
	sf_mess_lib.loadCss(SF_MESS_THEME_PATH + sf_mess_cfg.theme + '/' + sf_mess_cfg.color + '/style.css');
	var sf_pos_style = "right:0";
	if (sf_mess_cfg.mbpos && sf_mess_cfg.mbpos.indexOf('L') == 0) {
		sf_pos_style = "left:0";
	}
	var sf_load_build = 'normal';
	if (sf_mess_cfg.theme == 'friendly') {
		sf_load_build = 'friendly';
	}
	document.write('<script type="text/javascript" src="' + SF_MESS_PATH + 'scripts/build' + sf_load_build + '.js"></script>');
}