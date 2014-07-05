var CE_SAFE_MODE=true;
var CE_FONT_FAMILY="SimSun";
var CE_WIDTH="600px";
var CE_HEIGHT="300px";
var CE_SITE_DOMAIN="";
var CE_SKIN_PATH="./cyaskeditor/skins/default/";
var CE_CSS_PATH="./cyaskeditor/common.css";
var CE_UPLOAD_PRO="./cyaskeditor/upload_img.php";
var CE_MENU_BORDER_COLOR='#AAAAAA';
var CE_MENU_BG_COLOR='#EFEFEF';
var CE_MENU_TEXT_COLOR='#222222';
var CE_MENU_SELECTED_COLOR='#CCCCCC';
var CE_TOOLBAR_BORDER_COLOR='#DDDDDD';
var CE_TOOLBAR_BG_COLOR='#EFEFEF';
var CE_FORM_BORDER_COLOR='#DDDDDD';
var CE_FORM_BG_COLOR='#FFFFFF';
var CE_BUTTON_COLOR='#AAAAAA';
var CE_LANG={
INPUT_URL:"请输入正确的图片网络地址。",
INVALID_IMAGE:"请使用gif,jpg,png,bmp格式的图片。",
INPUT_LINK_URL:"请输入链接地址。",
TITLE:"描述",
WIDTH:"宽",
HEIGHT:"高",
BORDER:"边",
CONFIRM:"确定",
CANCEL:"取消",
PREVIEW:"预览",
UPIMAGE:"本地上传",
REMOTE:"网络地址",
NEW_WINDOW:"新窗口",
CURRENT_WINDOW:"当前窗口",
TARGET:"目标"}
var CE_FONT_NAME=Array(Array('SimSun','宋体'),Array('SimHei','黑体'),Array('FangSong_GB2312','仿宋体'),Array('KaiTi_GB2312','楷体'),Array('NSimSun','新宋体'),Array('Arial','Arial'),Array('Arial Black','Arial Black'));
var CE_SPECIAL_CHARACTER=Array(
'§','№','☆','★','○','●','◎','◇','◆','□','℃','■','△','▲','※','→','←','↑','↓','〓','¤','°','︿','￣','♀','♂','α','β','γ','δ','ε','ζ','η','θ','ι','κ','λ','μ','ν','ξ','ο','π','ρ',
'σ','τ','υ','φ','χ','ψ','ω','≈','≡','≠','≤','≥','㎡','‰','㊣','∷','±','×','÷','∫','∮','∝','∞','∧','∨','∑','∏','∪','∩','∈','∵','∴','⊥','∥','∠','⌒','⊙','≌','∽','〖','〗','【','】','&yen;','&reg;','&#8482;','&copy;');
var CE_TOP_TOOLBAR_ICON=Array(
Array('CE_FONTNAME','font.gif','字体'),Array('CE_FONTSIZE','fontsize.gif','文字大小'),Array('CE_TEXTCOLOR','textcolor.gif','文字颜色'),
Array('CE_BOLD','bold.gif','粗体'),Array('CE_ITALIC','italic.gif','斜体'),Array('CE_UNDERLINE','underline.gif','下划线'),Array('CE_REMOVE','removeformat.gif','删除格式'),
Array('CE_LINK','link.gif','创建超级连接'),Array('CE_UNLINK','unlink.gif','取消超级连接'),Array('CE_IMAGE','image.gif','图片'),Array('CE_SPECIALCHAR','specialchar.gif','特殊字符'));
var CE_POPUP_MENU_TABLE=Array("CE_FONTNAME","CE_FONTSIZE","CE_TEXTCOLOR","CE_LINK","CE_IMAGE","CE_SPECIALCHAR");
var CE_FONT_SIZE=Array(Array(1,'8pt'),Array(2,'10pt'),Array(3,'12pt'),Array(4,'14pt'),Array(5,'18pt'),Array(6,'24pt'));
var CE_COLOR_TABLE=Array("#FF0000","#FF00FF","#8A2BE2","#00FF00","#00FFFF","#0000FF","#1E90FF","#00BFFF","#696969","#000000","#2E8B57","#006400","#008000","#7B68EE","#6A5ACD","#483D8B","#191970","#000080","#00008B","#0000CD");
var CE_OBJ_NAME;
var CE_SELECTION;
var CE_RANGE;
var CE_RANGE_TEXT;
var CE_EDITFORM_DOCUMENT;
var CE_IMAGE_DOCUMENT;
var CE_LINK_DOCUMENT;
var CE_BROWSER;
var CE_TOOLBAR_ICON;
function CyaskGetBrowser(){var browser='';var agentInfo=navigator.userAgent.toLowerCase();if(agentInfo.indexOf("msie")>-1){
var re=new RegExp("msie\\s?([\\d\\.]+)","ig");var arr=re.exec(agentInfo);if(parseInt(RegExp.$1)>=5.5){browser='IE';}}else if(agentInfo.indexOf("firefox")>-1){browser='FF';}else if(agentInfo.indexOf("netscape")>-1){
var temp1=agentInfo.split(' ');var temp2=temp1[temp1.length-1].split('/');if(parseInt(temp2[1])>=7){browser='NS';}}else if(agentInfo.indexOf("gecko")>-1){browser='ML';}else if(agentInfo.indexOf("opera")>-1){
var temp1=agentInfo.split(' ');var temp2=temp1[0].split('/');if(parseInt(temp2[1])>=9){browser='OPERA';}}return browser;}
function CyaskGetFileName(file,separator){var temp=file.split(separator);var len=temp.length;var fileName=temp[len-1];return fileName;}
function CyaskGetFileExt(fileName){var temp=fileName.split(".");var len=temp.length;var fileExt=temp[len-1].toLowerCase();return fileExt;}
function CyaskCheckImageFileType(file,separator){if(file.match(/http:\/\/.{3,}/)==null){alert(CE_LANG['INPUT_URL']);return false;}
var fileName=CyaskGetFileName(file,"/");var fileExt=CyaskGetFileExt(fileName);
if(fileExt!='jpg'&&fileExt!='gif'&&fileExt!='png'&&fileExt!='bmp'){alert(CE_LANG['INVALID_IMAGE']);return false;}return true;}
function CyaskHtmlToXhtml(str){
str=str.replace(/<p>&nbsp;<\/p>/gi, "<br />");
str=str.replace(/<p.*?>/gi,"");
str=str.replace(/<\/p>/gi, "<br />");
str=str.replace(/<br.*?>/gi,"<br />");
str=str.replace(/(<img\s+[^>]*[^\/])(>)/gi, "$1 />");
str=str.replace(/(<\w+)(.*?>)/gi,function($0,$1,$2){return($1.toLowerCase()+CyaskConvertAttribute($2));});
str=str.replace(/(<\/\w+>)/gi,function($0,$1){return($1.toLowerCase());});
str=CyaskTrim(str);return str;}
function CyaskConvertAttribute(str){
str=CyaskConvertAttributeChild(str,'style','[^\"\'>]+');
str=CyaskConvertAttributeChild(str,'href','[^\"\'\\s>]+');
str=CyaskConvertAttributeChild(str,'src','[^\"\'\\s>]+');
str=CyaskConvertAttributeChild(str,'color','[^\"\'\\s>]+');
str=CyaskConvertAttributeChild(str,'alt','[^\"\'\\s>]+');
str=CyaskConvertAttributeChild(str,'title','[^\"\'\\s>]+');
str=CyaskConvertAttributeChild(str,'type','[^\"\'\\s>]+');
str=CyaskConvertAttributeChild(str,'face','[^\"\'>]+');
str=CyaskConvertAttributeChild(str,'id','\\w+');
str=CyaskConvertAttributeChild(str,'name','\\w+');
str=CyaskConvertAttributeChild(str,'dir','\\w+');
str=CyaskConvertAttributeChild(str,'target','\\w+');
str=CyaskConvertAttributeChild(str,'align','\\w+');
str=CyaskConvertAttributeChild(str,'width','[\\w%]+');
str=CyaskConvertAttributeChild(str,'height','[\\w%]+');
str=CyaskConvertAttributeChild(str,'border','[\\w%]+');
str=CyaskConvertAttributeChild(str,'hspace','[\\w%]+');
str=CyaskConvertAttributeChild(str,'vspace','[\\w%]+');
str=CyaskConvertAttributeChild(str,'size','[\\w%]+');
str=CyaskConvertAttributeChild(str,'cellspacing','\\d+');
str=CyaskConvertAttributeChild(str,'cellpadding','\\d+');
if(CE_SAFE_MODE==true){str=CyaskClearAttributeScriptTag(str);}
return str;}
function CyaskConvertAttributeChild(str,attName,regStr){
var re=new RegExp("\\s("+attName+"=)[\"']?("+regStr+")[\"']?", "ig");
var reUrl=new RegExp("http://"+CE_SITE_DOMAIN+"(/.*)","i");
str=str.replace(re,function($0,$1,$2){var val=$2;if(val.match(reUrl)!=null){val=val.replace(reUrl,"$1");}if(CE_BROWSER=='IE'&&attName.match(/style/i)!=null){
return(" "+$1.toLowerCase()+"\"" + val.toLowerCase() + "\"");}else{return(" "+$1.toLowerCase()+"\"" + val + "\"");}});return str;}
function CyaskClearAttributeScriptTag(str){
var re=new RegExp("(\\son[a-z]+=)[\"']?[^>]*?[^\\\\\>][\"']?([\\s>])","ig");
str=str.replace(re,function($0,$1,$2){return($1.toLowerCase()+"\"\""+$2);});
return str;}
function CyaskClearScriptTag(str){if(CE_SAFE_MODE==false){return str;}str=str.replace(/<(script.*?)>/gi,"[$1]");str=str.replace(/<\/script>/gi, "[/script]");return str;}
function CyaskTrim(str){str=str.replace(/^\s+|\s+$/g,"");str=str.replace(/[\r\n]+/g,"\r\n");return str;}
function CyaskHtmlentities(str){str=str.replace(/&/g,'&amp;');str=str.replace(/</g,'&lt;');str=str.replace(/>/g,'&gt;');str=str.replace(/"/g,'&quot;');return str;}
function CyaskGetTop(id){var top=28;var tmp='';var obj=document.getElementById(id);
while(eval("obj"+tmp).tagName!="BODY"){tmp+=".offsetParent";top+=eval("obj"+tmp).offsetTop;}return top;}
function CyaskGetLeft(id){var left=2;var tmp='';var obj=document.getElementById(id);
while(eval("obj"+tmp).tagName!="BODY"){tmp+=".offsetParent";left+=eval("obj"+tmp).offsetLeft;}return left;}
function CyaskDisplayMenu(cmd){CyaskEditorForm.focus();CyaskSelection();CyaskDisableMenu();var top,left;top=CyaskGetTop(cmd);
left=CyaskGetLeft(cmd);
document.getElementById('POPUP_'+cmd).style.top=top.toString(10)+'px';
document.getElementById('POPUP_'+cmd).style.left=left.toString(10)+'px';
document.getElementById('POPUP_'+cmd).style.display='block';}
function CyaskDisableMenu(){for(i=0;i<CE_POPUP_MENU_TABLE.length;i++){document.getElementById('POPUP_'+CE_POPUP_MENU_TABLE[i]).style.display='none';}}
function CyaskReloadIframe(){var str=CyaskPopupMenu('CE_IMAGE');document.getElementById('InsertIframe').innerHTML=str;CyaskDrawIframe('CE_IMAGE');}
function CyaskGetMenuCommonStyle(){var str='position:absolute;top:1px;left:1px;font-size:12px;color:'+CE_MENU_TEXT_COLOR+';background-color:'+CE_MENU_BG_COLOR+';border:solid 1px '+CE_MENU_BORDER_COLOR+';z-index:1;display:none;';return str;}
function CyaskGetCommonMenu(cmd,content){var str='';str+='<div id="POPUP_'+cmd+'" style="'+CyaskGetMenuCommonStyle()+'">'+content+'</div>';return str;}
function CyaskCreateColorTable(cmd,eventStr){var str='';str+='<table cellpadding="0" cellspacing="2" border="0">';
for(i=0;i<CE_COLOR_TABLE.length;i++){
if(i==0||(i>=10&&i%10==0)){str+='<tr>';}
str+='<td style="width:12px;height:12px;border:1px solid #AAAAAA;font-size:1px;cursor:pointer;background-color:'+
CE_COLOR_TABLE[i]+';" onmouseover="javascript:this.style.borderColor=\'#000000\';'+((eventStr)?eventStr:'')+'" '+
'onmouseout="javascript:this.style.borderColor=\'#AAAAAA\';" '+
'onclick="javascript:CyaskExecute(\''+cmd+'_END\', \'' + CE_COLOR_TABLE[i] + '\');">&nbsp;</td>';
if(i>=9&&i%(i-1)==0){str+='</tr>';}}str+='</table>';return str;}
function CyaskDrawColorTable(cmd){var str='';str+='<div id="POPUP_'+cmd+'" style="width:160px;padding:2px;'+CyaskGetMenuCommonStyle()+'">';
str+=CyaskCreateColorTable(cmd);str+='</div>';return str;}
function CyaskPopupMenu(cmd){
switch(cmd){
case 'CE_FONTNAME':
var str='';
for(i=0;i<CE_FONT_NAME.length;i++){
str+='<div style="font-family:'+CE_FONT_NAME[i][0]+
';padding:2px;width:160px;cursor:pointer;" '+
'onclick="javascript:CyaskExecute(\'CE_FONTNAME_END\', \'' + CE_FONT_NAME[i][0] + '\');" '+
'onmouseover="javascript:this.style.backgroundColor=\''+CE_MENU_SELECTED_COLOR+'\';" '+
'onmouseout="javascript:this.style.backgroundColor=\''+CE_MENU_BG_COLOR+'\';">'+
CE_FONT_NAME[i][1]+'</div>';}
str=CyaskGetCommonMenu('CE_FONTNAME',str);
return str;
break;
case 'CE_FONTSIZE':
var str='';
for(i=0;i<CE_FONT_SIZE.length;i++){
str+='<div style="font-size:'+CE_FONT_SIZE[i][1]+
';padding:2px;width:120px;cursor:pointer;" '+
'onclick="javascript:CyaskExecute(\'CE_FONTSIZE_END\', \'' + CE_FONT_SIZE[i][0] + '\');" '+
'onmouseover="javascript:this.style.backgroundColor=\''+CE_MENU_SELECTED_COLOR+'\';" '+
'onmouseout="javascript:this.style.backgroundColor=\''+CE_MENU_BG_COLOR+'\';">'+
CE_FONT_SIZE[i][1]+'</div>';}
str=CyaskGetCommonMenu('CE_FONTSIZE',str);
return str;
break;
case 'CE_TEXTCOLOR':
var str='';
str=CyaskDrawColorTable('CE_TEXTCOLOR');
return str;
break;
case 'CE_ICON':
var str='';
var iconNum=36;
str+='<table id="POPUP_'+cmd+'" cellpadding="0" cellspacing="2" style="'+CyaskGetMenuCommonStyle()+'">';
for(i=0;i<iconNum;i++){
if(i==0||(i>=6&&i%6==0)){
str+='<tr>';}
var num;
if((i+1).toString(10).length<2){
num='0'+(i+1);}else{
num=(i+1).toString(10);}
var iconUrl=CE_ICON_PATH+'etc_'+num+'.gif';
str+='<td style="padding:2px;border:0;cursor:pointer;" '+
'onclick="javascript:CyaskExecute(\'CE_ICON_END\', \'' + iconUrl + '\');">'+
'<img src="'+iconUrl+'" style="border:1px solid #EEEEEE;" onmouseover="javascript:this.style.borderColor=\'#AAAAAA\';" '+
'onmouseout="javascript:this.style.borderColor=\'#EEEEEE\';">'+'</td>';
if(i>=5&&i%(i-1)==0){
str+='</tr>';}}
str+='</table>';
return str;
break;
case 'CE_SPECIALCHAR':
var str='';
str+='<table id="POPUP_'+cmd+'" cellpadding="0" cellspacing="2" style="'+CyaskGetMenuCommonStyle()+'">';
for(i=0;i<CE_SPECIAL_CHARACTER.length;i++){
if(i==0||(i>=10&&i%10==0)){
str+='<tr>';}
str+='<td style="padding:2px;border:1px solid #AAAAAA;cursor:pointer;" '+
'onclick="javascript:CyaskExecute(\'CE_SPECIALCHAR_END\', \'' + CE_SPECIAL_CHARACTER[i] + '\');" '+
'onmouseover="javascript:this.style.borderColor=\'#000000\';" '+
'onmouseout="javascript:this.style.borderColor=\'#AAAAAA\';">'+CE_SPECIAL_CHARACTER[i]+'</td>';
if(i>=9&&i%(i-1)==0){
str+='</tr>';}}
str+='</table>';
return str;
break;
case 'CE_IMAGE':
var str='';
str+='<div id="POPUP_'+cmd+'" style="width:230px;'+CyaskGetMenuCommonStyle()+'">';
str+='<iframe name="CyaskImageIframe" id="CyaskImageIframe" frameborder="0" style="width:260px;height:110px;padding:0;margin:0;border:0;">';
str+='</iframe></div>';
return str;
break;
case 'CE_LINK':
var str='';
str+='<div id="POPUP_'+cmd+'" style="width:230px;'+CyaskGetMenuCommonStyle()+'">';
str+='<iframe name="CyaskLinkIframe" id="CyaskLinkIframe" frameborder="0" style="width:230px;height:85px;padding:0;margin:0;border:0;">';
str+='</iframe></div>';
return str;
break;
default:
break;}}
function CyaskDrawIframe(cmd){
if(CE_BROWSER=='IE'){CE_IMAGE_DOCUMENT=document.frames("CyaskImageIframe").document;CE_LINK_DOCUMENT=document.frames("CyaskLinkIframe").document;}
else{CE_IMAGE_DOCUMENT=document.getElementById('CyaskImageIframe').contentDocument;CE_LINK_DOCUMENT=document.getElementById('CyaskLinkIframe').contentDocument;}
switch(cmd){
case 'CE_IMAGE':
var str='<table cellpadding="0" cellspacing="0" style="width:100%;font-size:12px;">'+
'<tr><td colspan="2" height="20"><span id="upwin"></span></td></tr>'+
'<tr><td style="width:60px;padding:5px;">'+CE_LANG['UPIMAGE']+'</td>'+
'<td style="width:200px;padding-bottom:5px;"><iframe name="paste_pic" src="'+CE_UPLOAD_PRO+'" width="190" height="20" style="frameborder:0" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe></td></tr>'+
'<tr><td style="width:60px;padding:5px;">'+CE_LANG['REMOTE']+'</td>'+
'<td style="width:200px;padding-bottom:5px;"><input type="text" id="imgLink" value="http://" maxlength="255" style="width:180px;border:1px solid #555555;" /></td></tr>'+
'<tr><td colspan="2" style="margin:5px;padding-bottom:5px;" align="center">'+
'<input type="submit" name="button" id="'+cmd+'submitButton" value="'+CE_LANG['CONFIRM']+'" onclick="javascript:parent.CyaskDrawImageEnd();" style="border:1px solid #555555;background-color:'+CE_BUTTON_COLOR+';" /> '+
'<input type="button" name="button" value="'+CE_LANG['CANCEL']+'" onclick="javascript:parent.CyaskDisableMenu();" style="border:1px solid #555555;background-color:'+CE_BUTTON_COLOR+';" /></td></tr>'+
'</table>';
CyaskDrawMenuIframe(CE_IMAGE_DOCUMENT,str);break;
case 'CE_LINK':
var str='';str+='<table cellpadding="0" cellspacing="0" style="width:100%;font-size:12px;">'+
'<tr><td style="width:30px;padding:5px;">URL</td>'+
'<td style="width:200px;padding-top:5px;padding-bottom:5px;"><input type="text" id="hyperLink" value="http://" style="width:190px;border:1px solid #555555;background-color:#FFFFFF;"></td>'+
'<tr><td style="padding:5px;">'+CE_LANG['TARGET']+'</td>'+
'<td style="padding-bottom:5px;"><select id="hyperLinkTarget"><option value="_blank" selected="selected">'+CE_LANG['NEW_WINDOW']+'</option><option value="">'+CE_LANG['CURRENT_WINDOW']+'</option></select></td></tr>'+
'<tr><td colspan="2" style="padding-bottom:5px;" align="center">'+
'<input type="submit" name="submit" id="'+cmd+'submitButton" value="'+CE_LANG['CONFIRM']+'" onclick="javascript:parent.CyaskDrawLinkEnd();" style="border:1px solid #555555;PADDING-TOP: 2px; HEIGHT: 18px;background-color:'+CE_BUTTON_COLOR+';" /> '+
'<input type="button" name="button" value="'+CE_LANG['CANCEL']+'" onclick="javascript:parent.CyaskDisableMenu();" style="border:1px solid #555555;PADDING-TOP: 4px; HEIGHT: 18px;background-color:'+CE_BUTTON_COLOR+';" /></td></tr>';
str+='</table>';CyaskDrawMenuIframe(CE_LINK_DOCUMENT,str);break;
default:break;}}
function CyaskDrawMenuIframe(obj,str)
{obj.open();obj.write(str);obj.close();obj.body.style.color=CE_MENU_TEXT_COLOR;obj.body.style.backgroundColor=CE_MENU_BG_COLOR;obj.body.style.margin=0;obj.body.scroll='no';}
function CyaskImagePreview(){
var url=CE_IMAGE_DOCUMENT.getElementById('imgLink').value;
if(CyaskCheckImageFileType(url,"/")==false){return false;}
var imgObj=CE_IMAGE_DOCUMENT.createElement("IMG");
imgObj.src=url;
imgObj.style.width=10;
imgObj.style.height=10;
var el=CE_IMAGE_DOCUMENT.getElementById('upwin');
if(el.hasChildNodes()){el.removeChild(el.childNodes[0]);}
el.appendChild(imgObj);
return imgObj;
}
function CyaskDrawImageEnd(){
var url=CE_IMAGE_DOCUMENT.getElementById('imgLink').value;
if(CyaskCheckImageFileType(url,"/")==false){return false;}
CyaskEditorForm.focus();CyaskSelect();
//var obj=document.createElement("IMG");
var obj=new Image(); 
obj.src=url;
obj.border=0;
var width=parseInt(obj.width);var height=parseInt(obj.height);var rate=parseInt(width/height);
if(width>500){width=500;height=parseInt(width/rate);}
//obj.width=width;obj.height=height;
CyaskInsertItem(obj);
CyaskDisableMenu();
}
function CyaskDrawLinkEnd(){
var range;var url=CE_LINK_DOCUMENT.getElementById('hyperLink').value;var target=CE_LINK_DOCUMENT.getElementById('hyperLinkTarget').value;
if(url.match(/http:\/\/.{3,}/)==null){alert(CE_LANG['INPUT_LINK_URL']);return false;}
CyaskEditorForm.focus();CyaskSelect();var element;
if(CE_BROWSER=='IE'){if(CE_SELECTION.type.toLowerCase()=='control'){var el=document.createElement("a");el.href=url;
if(target){el.target=target;}CE_RANGE.item(0).applyElement(el);}else if(CE_SELECTION.type.toLowerCase()=='text'){
CyaskExecuteValue('CreateLink',url);element=CE_RANGE.parentElement();
if(target){element.target=target;}}}else{CyaskExecuteValue('CreateLink',url);
element=CE_RANGE.startContainer.previousSibling;element.target=target;
if(target){element.target=target;}}CyaskDisableMenu();}
function CyaskSelection(){if(CE_BROWSER=='IE'){CE_SELECTION=CE_EDITFORM_DOCUMENT.selection;CE_RANGE=CE_SELECTION.createRange();CE_RANGE_TEXT=CE_RANGE.text;}else{CE_SELECTION=document.getElementById("CyaskEditorForm").contentWindow.getSelection();CE_RANGE=CE_SELECTION.getRangeAt(0);CE_RANGE_TEXT=CE_RANGE.toString();}}
function CyaskSelect(){if(CE_BROWSER=='IE'){CE_RANGE.select();}}
function CyaskInsertItem(insertNode){
if(CE_BROWSER=='IE'){if(CE_SELECTION.type.toLowerCase()=='control'){CE_RANGE.item(0).outerHTML=insertNode.outerHTML;}else{CE_RANGE.pasteHTML(insertNode.outerHTML);}}
else{CE_SELECTION.removeAllRanges();CE_RANGE.deleteContents();var startRangeNode=CE_RANGE.startContainer;
var startRangeOffset=CE_RANGE.startOffset;var newRange=document.createRange();
if(startRangeNode.nodeType==3 && insertNode.nodeType==3){
startRangeNode.insertData(startRangeOffset,insertNode.nodeValue);
newRange.setEnd(startRangeNode,startRangeOffset+insertNode.length);
newRange.setStart(startRangeNode,startRangeOffset+insertNode.length);}
else{var afterNode;
if(startRangeNode.nodeType==3){
var textNode=startRangeNode;
startRangeNode=textNode.parentNode;
var text=textNode.nodeValue;
var textBefore=text.substr(0,startRangeOffset);
var textAfter=text.substr(startRangeOffset);
var beforeNode=document.createTextNode(textBefore);
var afterNode=document.createTextNode(textAfter);
startRangeNode.insertBefore(afterNode,textNode);
startRangeNode.insertBefore(insertNode,afterNode);
startRangeNode.insertBefore(beforeNode,insertNode);
startRangeNode.removeChild(textNode);}else{
if(startRangeNode.tagName.toLowerCase()=='html'){startRangeNode=startRangeNode.childNodes[0].nextSibling;afterNode=startRangeNode.childNodes[0];}else{afterNode=startRangeNode.childNodes[startRangeOffset];}
startRangeNode.insertBefore(insertNode,afterNode);}
newRange.setEnd(afterNode,0);newRange.setStart(afterNode,0);}CE_SELECTION.addRange(newRange);}
}
function CyaskExecuteValue(cmd,value){CE_EDITFORM_DOCUMENT.execCommand(cmd,false,value);}
function CyaskSimpleExecute(cmd){CyaskEditorForm.focus();CE_EDITFORM_DOCUMENT.execCommand(cmd,false,null);CyaskDisableMenu();}
function CyaskExecute(cmd,value){switch(cmd){
case 'CE_BOLD':CyaskSimpleExecute('bold');break;
case 'CE_ITALIC':CyaskSimpleExecute('italic');break;
case 'CE_UNDERLINE':CyaskSimpleExecute('underline');break;
case 'CE_REMOVE':CyaskSimpleExecute('removeformat');break;
case 'CE_FONTNAME':CyaskDisplayMenu(cmd);break;
case 'CE_FONTNAME_END':CyaskEditorForm.focus();CyaskSelect();CyaskExecuteValue('fontname',value);CyaskDisableMenu();break;
case 'CE_FONTSIZE':CyaskDisplayMenu(cmd);break;
case 'CE_FONTSIZE_END':CyaskEditorForm.focus();value=value.substr(0,1);CyaskSelect();CyaskExecuteValue('fontsize',value);CyaskDisableMenu();break;
case 'CE_TEXTCOLOR':CyaskDisplayMenu(cmd);break;
case 'CE_TEXTCOLOR_END':CyaskEditorForm.focus();CyaskSelect();CyaskExecuteValue('ForeColor',value);CyaskDisableMenu();break;
case 'CE_ICON':CyaskDisplayMenu(cmd);break;
case 'CE_ICON_END':CyaskEditorForm.focus();var element=document.createElement("img");element.src=value;element.border=0;element.alt="";CyaskSelect();CyaskInsertItem(element);CyaskDisableMenu();break;
case 'CE_IMAGE':CyaskDisplayMenu(cmd);CyaskImageIframe.focus();CE_IMAGE_DOCUMENT.getElementById(cmd+'submitButton').focus();break;
case 'CE_LINK':CyaskDisplayMenu(cmd);CyaskLinkIframe.focus();CE_LINK_DOCUMENT.getElementById(cmd+'submitButton').focus();break;
case 'CE_UNLINK':CyaskSimpleExecute('unlink');break;
case 'CE_SPECIALCHAR':CyaskDisplayMenu(cmd);break;
case 'CE_SPECIALCHAR_END':CyaskEditorForm.focus();CyaskSelect();var element=document.createElement("span");element.appendChild(document.createTextNode(value));CyaskInsertItem(element);CyaskDisableMenu();break;
default:break;}}
function CyaskCreateIcon(icon){var str='<img id="'+icon[0]+'" src="'+CE_SKIN_PATH+icon[1]+'" alt="'+icon[2]+'" title="'+icon[2]+
'" align="absmiddle" style="border:1px solid '+CE_TOOLBAR_BG_COLOR+';cursor:pointer;height:20px;';
str+='" onclick="javascript:CyaskExecute(\''+ icon[0] +'\');" '+'onmouseover="javascript:this.style.border=\'1px solid ' + CE_MENU_BORDER_COLOR + '\';" '+
'onmouseout="javascript:this.style.border=\'1px solid ' + CE_TOOLBAR_BG_COLOR + '\';" ';str+='>';return str;}
function CyaskCreateToolbar(){var htmlData='<table cellpadding="0" cellspacing="0" border="0" height="25"><tr>';
for(i=0;i<CE_TOP_TOOLBAR_ICON.length;i++){htmlData+='<td style="padding:1px;">'+CyaskCreateIcon(CE_TOP_TOOLBAR_ICON[i])+'</td>';}htmlData+='</tr></table>';return htmlData;}
function CyaskWriteFullHtml(documentObj,content){var editHtmlData='';editHtmlData+='<html>\r\n<head>\r\n<title>CyaskEditor</title>\r\n';
editHtmlData+='<link href="'+CE_CSS_PATH+'" rel="stylesheet" type="text/css">\r\n</head>\r\n<body>\r\n';
editHtmlData+=content;editHtmlData+='\r\n</body>\r\n</html>\r\n';documentObj.open();documentObj.write(editHtmlData);documentObj.close();}
function CyaskEditor(objName){
this.objName=objName;this.hiddenName=objName;this.siteDomain;this.editorType;this.safeMode;
this.editorWidth;this.editorHeight;this.skinPath;this.iconPath;this.cssPath;
this.menuBorderColor;this.menuBgColor;this.menuTextColor;this.menuSelectedColor;
this.toolbarBorderColor;this.toolbarBgColor;this.formBorderColor;this.formBgColor;this.buttonColor;
this.init=function(){
if(this.siteDomain)CE_SITE_DOMAIN=this.siteDomain;
if(this.safeMode)CE_SAFE_MODE=this.safeMode;
if(this.editorWidth)CE_WIDTH=this.editorWidth;
if(this.editorHeight)CE_HEIGHT=this.editorHeight;
if(this.skinPath)CE_SKIN_PATH=this.skinPath;
if(this.iconPath)CE_ICON_PATH=this.iconPath;
if(this.cssPath)CE_CSS_PATH=this.cssPath;
if(this.menuBorderColor)CE_MENU_BORDER_COLOR=this.menuBorderColor;
if(this.menuBgColor)CE_MENU_BG_COLOR=this.menuBgColor;
if(this.menuTextColor)CE_MENU_TEXT_COLOR=this.menuTextColor;
if(this.menuSelectedColor)CE_MENU_SELECTED_COLOR=this.menuSelectedColor;
if(this.toolbarBorderColor)CE_TOOLBAR_BORDER_COLOR=this.toolbarBorderColor;
if(this.toolbarBgColor)CE_TOOLBAR_BG_COLOR=this.toolbarBgColor;
if(this.formBorderColor)CE_FORM_BORDER_COLOR=this.formBorderColor;
if(this.formBgColor)CE_FORM_BG_COLOR=this.formBgColor;
if(this.buttonColor)CE_BUTTON_COLOR=this.buttonColor;
CE_OBJ_NAME=this.objName;
CE_BROWSER=CyaskGetBrowser();
CE_TOOLBAR_ICON=Array();
for(var i=0;i<CE_TOP_TOOLBAR_ICON.length;i++){CE_TOOLBAR_ICON.push(CE_TOP_TOOLBAR_ICON[i]);}}
this.show=function(){
this.init();
var widthStyle='width:'+CE_WIDTH+';';
var widthArr=CE_WIDTH.match(/(\d+)([px%]{1,2})/);
var iframeWidthStyle='width:'+(parseInt(widthArr[1])-2).toString(10)+widthArr[2]+';';
var heightStyle='height:'+CE_HEIGHT+';';
var heightArr=CE_HEIGHT.match(/(\d+)([px%]{1,2})/);
var iframeHeightStyle='height:'+(parseInt(heightArr[1])-3).toString(10)+heightArr[2]+';';
if(CE_BROWSER==''){
var htmlData='<div id="CyaskEditTextarea" style="'+widthStyle+heightStyle+'">'+
'<textarea name="CyaskCodeForm" id="CyaskCodeForm" style="'+widthStyle+heightStyle+
'padding:0;margin:0;border:1px solid '+CE_FORM_BORDER_COLOR+
';font-size:12px;line-height:16px;font-family:'+CE_FONT_FAMILY+';background-color:'+
CE_FORM_BG_COLOR+';">'+document.getElementsByName(this.hiddenName)[0].value+'</textarea></div>';
document.open();
document.write(htmlData);
document.close();
return;}
var htmlData='<div style="font-family:'+CE_FONT_FAMILY+';">';
htmlData+='<div style="'+widthStyle+';border:1px solid '+CE_TOOLBAR_BORDER_COLOR+';background-color:'+CE_TOOLBAR_BG_COLOR+'">';
htmlData+=CyaskCreateToolbar();
htmlData+='</div><div id="CyaskEditorIframe" style="'+widthStyle+heightStyle+
'border:1px solid '+CE_FORM_BORDER_COLOR+';border-top:0;">'+
'<iframe name="CyaskEditorForm" id="CyaskEditorForm" frameborder="0" style="'+iframeWidthStyle+iframeHeightStyle+
'padding:0;margin:0;border:0;"></iframe></div>';
htmlData+='</div>';
for(var i=0;i<CE_POPUP_MENU_TABLE.length;i++){
if(CE_POPUP_MENU_TABLE[i]=='CE_IMAGE'){
htmlData+='<span id="InsertIframe">';}
htmlData+=CyaskPopupMenu(CE_POPUP_MENU_TABLE[i]);
if(CE_POPUP_MENU_TABLE[i]=='CE_REAL'){
htmlData+='</span>';}}
document.open();
document.write(htmlData);
document.close();
if(CE_BROWSER=='IE'){
CE_EDITFORM_DOCUMENT=document.frames("CyaskEditorForm").document;}else{
CE_EDITFORM_DOCUMENT=document.getElementById('CyaskEditorForm').contentDocument;}
CyaskDrawIframe('CE_IMAGE');
CyaskDrawIframe('CE_LINK');
CE_EDITFORM_DOCUMENT.designMode='On';
CyaskWriteFullHtml(CE_EDITFORM_DOCUMENT,document.getElementsByName(eval(CE_OBJ_NAME).hiddenName)[0].value);
var el=CE_EDITFORM_DOCUMENT.body;
if(el.addEventListener){
el.addEventListener('click',CyaskDisableMenu,false);}else if(el.attachEvent){
el.attachEvent('onclick',CyaskDisableMenu);}}
this.data=function(){
var htmlResult;
if(CE_BROWSER==''){
htmlResult=document.getElementById("CyaskCodeForm").value;}
else{
htmlResult=CE_EDITFORM_DOCUMENT.body.innerHTML;}
CyaskDisableMenu();
htmlResult=CyaskHtmlToXhtml(htmlResult);
htmlResult=CyaskClearScriptTag(htmlResult);
document.getElementsByName(this.hiddenName)[0].value=htmlResult;
return htmlResult;}}