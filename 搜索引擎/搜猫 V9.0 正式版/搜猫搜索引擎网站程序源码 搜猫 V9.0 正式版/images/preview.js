var x_open_path =""; //设置图标地址
<!-- 
if(!x_open_path)
	var x_open_path = '../images/01/';	

var symbol_img = x_open_path + "symbol.gif";
var max_img = x_open_path + "max.gif";
var restore_img = x_open_path + "min.gif";
var close_img = x_open_path + "close.gif";
var help_img = x_open_path + "help.gif";
var title_img = x_open_path + "title.gif";
var bottom_img = x_open_path + "bottom.gif";
var intern_img = x_open_path + "intern.gif";
var grip_img = x_open_path + "grip.gif";
var forward_img = x_open_path + "forward.gif";
var back_img = x_open_path + "back.gif";
var border_img = x_open_path + "border.gif";
var loading_page = x_open_path + "loading.htm";
win_frame = "<div id='x_open_win' style='position:absolute;z-index:100; width: 420px; height: 350px ;left:10px;top:10px;font-size:12px; display:none ' onselectstart='return false'>\r\n";
win_frame += "<div>\r\n";
win_frame += "<table width='100%'  border='0' cellspacing='0' cellpadding='0'>\r\n";
win_frame += "	<tr>\r\n";
win_frame += "		<td width='19'><img src='" + symbol_img + "' width='19' height='21' border='0'  title='重新载入当前网页' onclick='xopen_reload();'//></td>\r\n";
win_frame += "		<td width='5' style='background: url(" + title_img + "); padding:0px'></td><td style='background: url(" + title_img + "); padding:0px' onmousedown='initialize_drag(event)' ondblclick='maximize()'><font color='#333333'><div id='title_msg_layer'><strong>title</strong></div></font>\r\n";
win_frame += "		</td>\r\n";
win_frame += "		<td style='background: url(" + title_img + "); padding:0px' onmousedown='initialize_drag(event)' ondblclick='maximize()'></td>\r\n";
win_frame += "	<td width='44' style='cursor:default; ' align='center'>";
win_frame += "<img src='" + help_img + "' width='12' height='21' border='0' onclick='xopen_about()' title='关于本程式' />";
win_frame += "<img src='" + max_img + "' id='max_button_name' onclick='maximize()' width='16' height='21' border='0' title='放大窗口' />";
win_frame += "<img src='" + close_img + "' onclick='closeit()' width='16' height='21' border='0' title='关闭窗口' />";
win_frame += "</td>\r\n";
win_frame += "	</tr>\r\n";
win_frame += "</table>\r\n";
win_frame += "</div>\r\n";
win_frame += "<div id='x_open_content' align=center style='width:100%;  margin: 0px;background-color: #ffffff;	MOZ-OPACITY:0.50;FILTER :  Alpha(opacity=100);'>\r\n";
win_frame += "<table style='width:100%; height:100%; margin: 0px;' border='0' cellpadding='0' cellspacing='0'>\r\n";
win_frame += "	<tr>\r\n";
win_frame += "		<td width='1'><img src='" + border_img + "' id='border_img_name1' border='0' style='border:0px; width:1px; height:317px; margin: 0px;' /></td>\r\n";
win_frame += "		<td>\r\n";
win_frame += "		<iframe id='x_open_frame' name='x_open_frame' src='" + loading_page + "' frameborder=0 noresize style='width:100%; height:100%;background-color: #ffffff;color: #333;margin: 0px; padding: 0px;border:0px '></iframe>\r\n";
win_frame += "		</td>\r\n";
win_frame += "		<td width='1'><img src='" + border_img + "' id='border_img_name2' border='0' style='border:0px; width:1px; height:317px; margin: 0px;' /></td>\r\n";
win_frame += "	</tr>\r\n";
win_frame += "</table>\r\n";
win_frame += "</div>\r\n";
win_frame += "<div align='center' style='width:100%;height:15px;background: url(" + bottom_img + ");' onselectstart='return false'>\r\n";
win_frame += "<table width='100%'  border='0' cellspacing='0' cellpadding='0'>\r\n";
win_frame += "	<tr>\r\n";
win_frame += "		<td width='19'><img src='" + intern_img + "' width='28' height='15' border='0' /></td>\r\n";
win_frame += "			<td width='42'><img src='" + back_img + "' width='19' height='13' border='0' title='后退' onclick='xopen_back();'/><img src='" + forward_img + "' width='19' height='13' border='0'  title='前进' onclick='xopen_forward();'/></td>\r\n";
win_frame += "		<td><div id='size_info_layer'>&nbsp;</div></td>\r\n";
win_frame += "		<td>&nbsp;</td>\r\n";
win_frame += "		<td width='19'><img src='" + grip_img + "' width='19' height='15' border='0' style='cursor:nw-resize' title='改变窗口大小' onmousedown='return initialize_resize(event)' /></td>\r\n";
win_frame += "	</tr>\r\n";
win_frame += "</table>\r\n";
win_frame += "</div>\r\n";
win_frame += "</div>\r\n";
win_frame += "<div id='x_open_win_border' style='position:absolute;z-index:100;width:0px;height:0px;display:none'></div>\r\n";
window.document.write(win_frame);


// obj
var x_open_win_id = document.getElementById("x_open_win");
var x_open_content_id = document.getElementById("x_open_content");
var title_msg_layer_id = document.getElementById("title_msg_layer");
var x_open_frame_id = document.getElementById("x_open_frame");
var max_button_name_id = document.getElementById("max_button_name");
var border_img_name1_id = document.getElementById("border_img_name1");
var border_img_name2_id = document.getElementById("border_img_name2");
var x_open_win_border_id = document.getElementById("x_open_win_border");	
var size_info_layer_id =  document.getElementById("size_info_layer");	

var dragapproved = false;
var dragresized = false;
var minrestore = 0;
var initialwidth, initialheight;
var x_open_ie5 = document.all && document.getElementById;
var x_open_ns6 = document.getElementById && !document.all;
var title_height = 36;
 

 
function x_open(title, url, width, height){
	if (!x_open_ie5 && !x_open_ns6)
		window.open(url, "", "width=width,height=height,scrollbars=1");
	else{
		x_open_win_id.style.display = '';

		initialwidth = width;
		initialheight = height ;
		change_size(initialwidth, initialheight);
		x_open_win_id.style.left = "10px";
		x_open_win_id.style.top=x_open_ns6 ? window.pageYOffset * 1 + 10 + "px" : iecompattest().scrollTop * 1 + 10 + "px";
		x_open_frame_id.src = url;
		title_msg_layer_id.innerHTML = '<font color=#333333>' + title + '</font>';
	}
}

function iecompattest(){
	return (!window.opera && document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function xopen_about(){
	str = "菏泽搜索引擎(www.1230530.com)版权所有";
	alert(str);
}
function xopen_back(){
	x_open_frame.history.back();
}
function xopen_forward(){
	x_open_frame.history.go(1);
}
function xopen_reload(){
	x_open_frame.location.reload();
}
function closeit(){
	x_open_frame_id.src = loading_page;
	x_open_win_id.style.display = "none";
	return true;
}


function maximize(){
	if (minrestore == 0){
		minrestore = 1; //maximize window
		max_button_name_id.setAttribute("src", restore_img);
		max_button_name_id.setAttribute("title", '还原窗口');
		w = x_open_ns6 ? window.innerWidth - 40 : iecompattest().clientWidth - 20;
		h = x_open_ns6 ? window.innerHeight - 40 : iecompattest().clientHeight - 20;
		change_size(w, h);
	}
	else{
		minrestore=0; //restore window
		max_button_name_id.setAttribute("src", max_img);
		max_button_name_id.setAttribute("title", '放大窗口');
		change_size(initialwidth, initialheight);
	}
	x_open_win_id.style.left = x_open_ns6 ? window.pageXOffset + 10 + "px" : iecompattest().scrollLeft + 10 + "px";
	x_open_win_id.style.top = x_open_ns6 ? window.pageYOffset + 10 + "px" : iecompattest().scrollTop + 10 + "px";
}

function change_size(w, h){ 
		if(w > 150 ) {
			x_open_win_id.style.width = w;
		}else{
			x_open_win_id.style.width = 150;
		}
		if(h > 0 ) {
			x_open_win_id.style.height = border_img_name1_id.style.height = border_img_name2_id.style.height = x_open_frame_id.style.height = h;
		}else{
			x_open_win_id.style.height = border_img_name1_id.style.height = border_img_name2_id.style.height = x_open_frame_id.style.height = 0;
			
		}
		size_info_layer_id.innerHTML = '<font style="font-size:11px;font-family:Courier New">size:' + remove_units(x_open_win_id.style.width) + 'x' + remove_units(x_open_win_id.style.height) + '</font>';
}
 
function remove_units(elem){
	return(parseInt(elem.replace(/px/g,"")));			
}
//<<<drag move

function initialize_drag(e){
	var evt = x_open_ns6 ? e : event;
	offsetx = evt.clientX;
	offsety = evt.clientY;
	tempx = parseInt(x_open_win_id.style.left);
	tempy = parseInt(x_open_win_id.style.top);

	dragapproved = true;
	//x_open_frame.style.display = 'none';
	x_open_frame_id.style.display = 'none';
	document.body.style.cursor = 'move';
	document.onmousemove = drag_drop;
	x_open_win_id.onmouseup = drag_drop_stop;
}

function drag_drop(e){
	if(dragapproved){
		var evt = x_open_ns6 ? e : event;
		x_open_win_id.style.left = tempx + evt.clientX - offsetx + "px";
		x_open_win_id.style.top = tempy + evt.clientY - offsety + "px";
	}
	return false;
}
function drag_drop_stop(e){
	dragapproved = false;
	//x_open_content_id.style.display = '';
	x_open_frame_id.style.display = '';
	document.body.style.cursor = 'default';
	document.onmousemove=null;
}
 
//>>>drag move

//resize===<<<
function initialize_resize(e){
	evt = x_open_ns6 ? e : event;
	x_open_win_border_id.style.left = x_open_win_id.style.left;
	x_open_win_border_id.style.top = x_open_win_id.style.top;
	x_open_win_border_id.style.width = x_open_win_id.style.width;
	x_open_win_border_id.style.height = x_open_win_id.style.height;

	click_x = evt.clientX;
	click_y = evt.clientY;
	evt_width = click_x - remove_units(x_open_win_id.style.left);
	evt_height = click_y - remove_units(x_open_win_id.style.top);
	dragresized = true;
	x_open_win_border_id.style.display = '';
	x_open_win_border_id.style.border='1px #808080 solid';
	
	document.body.style.cursor = 'nw-resize';
	document.onmousemove = drag_resize;
	document.onmouseup = drag_resize_stop;
	return false;
}
function drag_resize(e){
	if(dragresized){
		var evt = x_open_ns6 ? e : event;
		w = evt_width + (evt.clientX - click_x);
		h = evt_height + (evt.clientY - click_y);
		if(w > 0 ) {
			x_open_win_border_id.style.width = w;
		}
		if(h > 0 ) {
			x_open_win_border_id.style.height = h;
		}
	}
	document.body.style.cursor = 'nw-resize';
	return false;
}
function drag_resize_stop(e){
	dragresized=false;
	change_size(remove_units(x_open_win_border_id.style.width), remove_units(x_open_win_border_id.style.height));
	x_open_win_border_id.style.border='0px';
	x_open_win_border_id.style.display = 'none';
	document.body.style.cursor='default';
	document.onmousemove=null;
}
//resize===>>>
	
//-->