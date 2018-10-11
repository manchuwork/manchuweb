var ICIBA_HUAYI_COOKIE = "ICIBA_HUAYI_COOKIE";
var ICIBA_WORD = "";
var ICIBA_HUAYI_FLAG = 0;							//是否是本页面第一次划
var ICIBA_HUAYI_GB =0;								//是否设置固定

function addCookie(objName,objValue,objHours){//添加cookie
	var str = objName + "=" + escape(objValue);
	if(objHours > 0){//为0时不设定过期时间，浏览器关闭时cookie自动消失
		var date = new Date();
		var ms = objHours*3600*1000;
		date.setTime(date.getTime() + ms);
		str += "; expires=" + date.toGMTString();
	}
	document.cookie = str;
	//	alert("添加cookie成功");
}
function getCookie(objName){//获取指定名称的cookie的值
	var arrStr = document.cookie.split("; ");
	for(var i = 0;i < arrStr.length;i ++){
		var temp = arrStr[i].split("=");
		if(temp[0] == objName) return unescape(temp[1]);
	}
}
function delCookie(name){//为了删除指定名称的cookie，可以将其过期时间设定为一个过去的时间
	var date = new Date();
	date.setTime(date.getTime() - 10000);
	document.cookie = name + "=a; expires=" + date.toGMTString();
}




String.prototype.Trim = function()
{
	return this.replace(/(^\s*)|(\s*$)/g, "");
}
function ICIBA_HUAYI_searchword(){
	var ICIBA_HUAYI_input= document.getElementById("ICIBA_HUAYI_input");
	var word = ICIBA_HUAYI_input.value;

	loading.style.display = "block";
	var dict=document.getElementById('icIBahyI-main_cont');
	dict.style.display = "none";

	window.console.log('word'+ word);
	//var i_s=iciba_huaci_url_new+'dict.php?word='+encodeURIComponent(word);
    var i_s=buildQueryUrl(word);

	ICIBA_HUAYI_mm(i_s);
}

function ICIBA_HUAYI_CPos(x,y){
	this.x = x;
	this.y = y;
}

/**
* 获得对象的相对浏览器的坐标
*/
function ICIBA_HUAYI_GetObjPos(ATarget)
{
	var target = ATarget;
	var pos = new ICIBA_HUAYI_CPos(target.offsetLeft,target.offsetTop);

	var target = target.offsetParent;

	while(target)

	{
		pos.x += target.offsetLeft;
		pos.y += target.offsetTop;
		target = target.offsetParent
	}
	return pos;
}

function ICIBA_HUAYI_funGetSelectTxt() {
	var txt = "";
	if(document.selection) {
		txt = document.selection.createRange().text;
	} else {
		txt = document.getSelection();
	}
	ICIBA_WORD = txt.toString().Trim();
	return txt.toString().Trim();
};
var eleContainer = eleContainer || document;
var ICIBA_HUACI_HUA = 0;   //状态位  0:划词框消失 1：当鼠标按下时置1 2：如果此位为1的时候松开鼠标此位置2
var ICIBA_HUACI_MOVE = 0;   //状态位
var ICIBA_HUACI_pX  = 0;
var ICIBA_HUACI_pY = 0;
eleContainer.onmousedown = function(ev){
	//	alert(1);
	ev= ev || window.event;
	var obj =  document.getElementById("icIBahyI-main_box");
	var obj_title =  document.getElementById("icIBahyI-main_title");
	var mousePos = ICIBA_HUAYI_mouseCoords(ev);

	var obj_left_x = ICIBA_HUAYI_GetObjPos(obj)["x"];
	var obj_left_y = ICIBA_HUAYI_GetObjPos(obj)["y"];
	var obj_right_x = obj_left_x + obj.scrollWidth;
	var obj_right_y = obj_left_y + obj.scrollHeight;
	var obj_title_right_x = obj_left_x + obj_title.scrollWidth;
	var obj_title_right_y = obj_left_y + obj_title.scrollHeight;

	if(obj.style.display == "none" || !(mousePos.x > obj_left_x && mousePos.x<obj_right_x && mousePos.y>obj_left_y && mousePos.y<obj_right_y )){
		ICIBA_HUACI_HUA = 1;
		if(!ICIBA_HUAYI_GB){
			obj.style.display="none";
		}
	}
	if(obj.style.display == "block" && (mousePos.x > obj_left_x && mousePos.x<obj_title_right_x && mousePos.y>obj_left_y && mousePos.y<obj_title_right_y)){
		ICIBA_HUACI_MOVE = 1;
		ICIBA_HUACI_MDown(ev);
		//		alert(ICIBA_HUACI_MOVE);

	}

}
eleContainer.onmousemove = function(ev){
	ev= ev || window.event;
	if(ICIBA_HUACI_MOVE > 0){
		//		ICIBA_HUACI_MOVE = 2;
		ICIBA_HUACI_MMove(ev);
	}else{
		if(ICIBA_HUACI_HUA == 1){
			ICIBA_HUACI_HUA = 2;
		}
	}
}

function buildQueryUrl(word){
    var i_s=iciba_huaci_url_new+'dict?word='+encodeURIComponent(word);
    return i_s;
}
eleContainer.onmouseup = function(ev){
	//	alert(ICIBA_HUACI_MOVE);
	var yiObj = document.getElementById("icIBahyI-yi")
	var obj =  document.getElementById("icIBahyI-main_box");
	ev= ev || window.event;
	var mousePos = ICIBA_HUAYI_mouseCoords(ev);
	var obj_left_x = ICIBA_HUAYI_GetObjPos(obj)["x"];
	var obj_left_y = ICIBA_HUAYI_GetObjPos(obj)["y"];
	var obj_right_x = obj_left_x + obj.scrollWidth;
	var obj_right_y = obj_left_y + obj.scrollHeight;
	var left = mousePos.x;
	var top = mousePos.y;
	if(ICIBA_HUAYI_ALLOW && ICIBA_HUACI_HUA == 2){
		var dict=document.getElementById('icIBahyI-main_cont');
		var loading=document.getElementById('loading');
		var ICIBA_TOO_LONG=document.getElementById('ICIBA_TOO_LONG');
		if(obj.style.display == "none" || !(mousePos.x > obj_left_x && mousePos.x<obj_right_x && mousePos.y>obj_left_y && mousePos.y<obj_right_y)){
			var txt=ICIBA_HUAYI_funGetSelectTxt();
			if (txt && txt.length<1000) {
				document.getElementById("ICIBA_HUAYI_input").value=txt;

				
				var i_s= buildQueryUrl(txt);
				loading.style.display = "block";
				dict.style.display = "none";
				if(!ICIBA_HUAYI_GB){
					obj.style.left = left + "px";
					obj.style.top = top + "px";
					if(ICIBA_HUAYI_FLAG){
						ICIBA_HUAYI_mm(i_s);
						ICIBA_TOO_LONG.style.display = "none";
						obj.style.display = "block";
					}else{
						yiObj.style.display = "block";
						yiObj.style.left = left + "px";
						yiObj.style.top = top + "px"
					}
				}else{
					ICIBA_HUAYI_mm(i_s);
					ICIBA_TOO_LONG.style.display = "none";
					obj.style.display = "block";
				}
				yiObj.onclick=function(){
					yiObj.style.display = "none";
					dict.style.display = "block";
					ICIBA_HUAYI_mm(i_s);
					ICIBA_TOO_LONG.style.display = "none";
					obj.style.display = "block";
					ICIBA_HUAYI_FLAG = 1;
				}
				return i_s;
			}else if(txt && txt.length>=1000){
				yiObj.style.display = "block";
				yiObj.style.left = left + "px";
				yiObj.style.top = top + "px"
				if(!ICIBA_HUAYI_GB){
					obj.style.left = left + "px";
					obj.style.top = top + "px";
				}
				yiObj.onclick=function(){
					loading.style.display = "none";
					dict.innerHTML='<div id="ICIBA_TOO_LONG" style="height:150px;padding-top:10px;padding-left:10px;" class="footer">您划取的内容太长，建议您去<a href="http://fy.iciba.com" target="_blank">爱词霸翻译</a>页面。</div>';
					obj.style.display = "block";
					yiObj.style.display = "none";
				}

			}
			else {
				yiObj.style.display = "none";
				ICIBA_TOO_LONG.style.display = "none";
				if(!ICIBA_HUAYI_GB){
					obj.style.display = "none";
				}

			}
		}
	}else if(!(mousePos.x > obj_left_x && mousePos.x<obj_right_x && mousePos.y>obj_left_y && mousePos.y<obj_right_y)){
		yiObj.style.display = "none";
		if(!ICIBA_HUAYI_GB){
			obj.style.position = "absolute";
			obj.style.display = "none";
		}
		//		ICIBA_HUAYI_FLAG = 0;
	}
	if(ICIBA_HUACI_MOVE == 1){
		ICIBA_HUACI_MUp(ev);
	}
	var scbiframe =  document.getElementById("icIBahyI-scbiframe");
	scbiframe.style.display = "none";
	ICIBA_HUACI_MOVE = 0;
	ICIBA_HUACI_HUA = 0;
}
eleContainer.ondblclick = function(ev){
	var obj =  document.getElementById("icIBahyI-main_box");
	ev= ev || window.event;
	var mousePos = ICIBA_HUAYI_mouseCoords(ev);
	var obj_left_x = ICIBA_HUAYI_GetObjPos(obj)["x"];
	var obj_left_y = ICIBA_HUAYI_GetObjPos(obj)["y"];
	var obj_right_x = obj_left_x + obj.scrollWidth;
	var obj_right_y = obj_left_y + obj.scrollHeight;
	var left = mousePos.x;
	var top = mousePos.y+10;
	if(ICIBA_HUAYI_ALLOW){
		var dict=document.getElementById('icIBahyI-main_cont');
		var loading=document.getElementById('loading');
		var ICIBA_TOO_LONG=document.getElementById('ICIBA_TOO_LONG');
		if(obj.style.display == "none" || !(mousePos.x > obj_left_x && mousePos.x<obj_right_x && mousePos.y>obj_left_y && mousePos.y<obj_right_y)){
			var txt=ICIBA_HUAYI_funGetSelectTxt();
			if (txt && txt.length<1000) {
				document.getElementById("ICIBA_HUAYI_input").value=txt;
				var i_s=buildQueryUrl(txt);
				if(!ICIBA_HUAYI_GB){
					obj.style.left = left + "px";
					obj.style.top = top + "px"
				}
				obj.style.display = "block";
				loading.style.display = "block";
				dict.style.display = "none";
				ICIBA_TOO_LONG.style.display = "none";
				ICIBA_HUAYI_mm(i_s);
			}else if(txt && txt.length>=1000){
				if(!ICIBA_HUAYI_GB){
					obj.style.left = left + "px";
					obj.style.top = top + "px"
				}
				loading.style.display = "none";
				dict.innerHTML='<div id="ICIBA_TOO_LONG" style="height:150px;padding-top:10px;padding-left:10px;" class="footer">您划取的内容太长，建议您去<a href="http://fy.iciba.com"  target="_blank">爱词霸翻译</a>页面。</div>';
				obj.style.display = "block";
			}
			else {
				ICIBA_TOO_LONG.style.display = "none";
				if(!ICIBA_HUAYI_GB){
					obj.style.display = "none";
				}
			}
		}
	}
	var scbiframe =  document.getElementById("icIBahyI-scbiframe");
	scbiframe.style.display = "none";
}
function ICIBA_HUAYI_mouseCoords(ev)
{
	if(!document.all){
		mouse_x=ev.pageX;
		mouse_y=ev.pageY;
		//firefox By Rlby 2007-12-28
	}else{
		mouse_x=document.documentElement.scrollLeft+ev.clientX;
		mouse_y=document.documentElement.scrollTop+ev.clientY;
		//alert(document.documentElement.scrollTop); 滚动条滚过的高度，+ 显示页面的高度原因是声明后document.body.scrollTop的值永远等于0，解决办法是只需把document.body用 document.documentElement替换即可。By Rlby
	}

	return {
		x:mouse_x,
		y:mouse_y

	};
	//	if(ev.pageX || ev.pageY){
	//		return {x:ev.pageX, y:ev.pageY};
	//	}
	//	return {
	//		x:ev.clientX + document.body.scrollLeft - document.body.clientLeft,
	//		y:ev.clientY + document.body.scrollTop - document.body.clientTop
	//
	//	};

}
function ICIBA_HUAYI_mm(path)
{
    console.log("ICIBA_HUAYI_mm:path:"+path);
    var   e;   if(e=document.getElementById("meizz"))   e.parentNode.removeChild(e);
	var   script=   document.createElement("SCRIPT");   script.defer   =   true;
	script.type="text/javascript";   script.src=path;   script.id="meizz";
	document.getElementsByTagName("HEAD")[0].appendChild(script);
}

function getFlashObject_hanci(movieName) {
	if (window.document[movieName]) {
		return window.document[movieName];
	}
	if (navigator.appName.indexOf("Microsoft Internet")==-1) {
		if (document.embeds && document.embeds[movieName])
		return document.embeds[movieName];
	} else  {
		return document.getElementById(movieName);
	}
}

function asplay_hanci(c){
	//	var mp3 = "http://news.iciba.com/admin/tts/"+c;
	//	alert(c)
	var asound = getFlashObject_hanci("asound_hanci");
	if(asound){
		asound.SetVariable("f",c);
		asound.GotoFrame(1);
	}
}

function asstop_hanci(){
	var asound = getFlashObject_hanci("asound_hanci");
	if(asound){
		asound.GotoFrame(3);
	}
}
/*开始关闭即划即译功能*/
function ICIBA_HUAYI_kg(){
	var iKg=document.getElementById("Jihuajiyi");
	var COOKIE =  getCookie(ICIBA_HUAYI_COOKIE);
	if(COOKIE == undefined)
	{
		addCookie(ICIBA_HUAYI_COOKIE,1,3600*24*30);
	}else{
		ICIBA_HUAYI_ALLOW = COOKIE;
	}

	//开关
	var switchFlag = '';
	switchFlag += '<div class="iciba_switch_bar">';
	if(ICIBA_HUAYI_ALLOW){
		switchFlag +=   '<div class="iciba_switch_bar_wrap on" id="iciba_switch_bar_wrap">';
	} else {
		switchFlag +=   '<div class="iciba_switch_bar_wrap off" id="iciba_switch_bar_wrap">';
	}
	switchFlag +=			'<span class="iciba_switch_on">ON</span><span class="iciba_switch_slider"></span><span class="iciba_switch_off">OFF</span>';
	switchFlag +=		'</div>';
	switchFlag += '</div>';
	switchFlag += '<i class="iciba_switch-icon"></i><span class="iciba_switch_txt"> 即划即译</span>';

	iKg.innerHTML = switchFlag;

	var kg = document.getElementById('iciba_switch_bar_wrap');

	kg.onclick = function (){
		if(ICIBA_HUAYI_ALLOW){
			addCookie(ICIBA_HUAYI_COOKIE,0,3600*24*30);
			ICIBA_HUAYI_ALLOW=0;
			var yiObj = document.getElementById("icIBahyI-yi");
			yiObj.style.display = "none";
			var obj = document.getElementById("icIBahyI-main_box");
			obj.style.display = "none";
			ICIBA_HUAYI_FLAG  = 0;
			ICIBA_HUAYI_GB = 0;
			document.getElementById("icIBahyI-dq").className = "icIBahyI-dq2"

			kg.className="iciba_switch_bar_wrap off";
			kg.title="点击开启即划即译";

		}else{
			addCookie(ICIBA_HUAYI_COOKIE,1,3600*24*30);
			ICIBA_HUAYI_ALLOW=1;
			kg.className="iciba_switch_bar_wrap on";
			kg.title="点击关闭即划即译";
		}
	}
}
/*点击关闭内容窗口*/
document.getElementById("icIBahyI-gb").onclick=function(){
	//	alert(1);
	ICIBA_HUAYI_FLAG = 0;
	ICIBA_HUAYI_GB = 0;
	document.getElementById("icIBahyI-dq").className = "icIBahyI-dq2"
	document.getElementById("icIBahyI-main_box").style.display="none";
}
document.getElementById("icIBahyI-dq").onclick=function(ev){
	ev= ev || window.event;
	var obj =  document.getElementById("icIBahyI-main_box");
	var mousePos = ICIBA_HUAYI_mouseCoords(ev);
	var top = mousePos.y+10;
	if(ICIBA_HUAYI_GB){
		obj.style.top = top+"px";
		this.className = "icIBahyI-dq2"
		obj.style.position = "absolute";
		ICIBA_HUAYI_GB = 0;
	}else{
		//		alert(ICIBA_HUACI_myBrowser());
		if(ICIBA_HUACI_myBrowser() != "IE6" && ICIBA_HUACI_myBrowser() != "IE55" && ICIBA_HUACI_myBrowser() != "Chrome"){
			obj.style.top = top - document.documentElement.scrollTop +"px";
			//			alert(obj.style.top);
			obj.style.position = "fixed";
		}
		this.className = "icIBahyI-dq";
		ICIBA_HUAYI_GB = 1;

	}
}
//清空搜索条件
document.getElementById("hy_clear").onclick = function(e){
	document.getElementById("ICIBA_HUAYI_input").value = '';
}

/*鼠标移动效果*/
//var ICIBA_HUACI_Obj;
//document.getElementById("icIBahyI-main_title").onmouseup=MUp;// 事件会在鼠标按键被松开时发生
//document.onmousemove=MMove;//事件会在鼠标指针移动时发生。
function ICIBA_HUACI_MDown(event) {//事件会在鼠标按键被按下时发生

	var obj =  document.getElementById("icIBahyI-main_box");
	document.getElementById("icIBahyI-yi").style.display="none"
	ICIBA_HUACI_Obj = obj.parentNode;
	if (window.event) {
		event = window.event;
		if (ICIBA_HUACI_Obj.setCapture) {
			ICIBA_HUACI_Obj.setCapture();
		} else if(window.captureEvents){
			window.captureEvents(event.MOUSEMOVE | event.MOUSEUP);
		}
	}
	else {
		window.captureEvents(event.MOUSEMOVE|event.MOUSEUP);
	}

	var mousePos = ICIBA_HUAYI_mouseCoords(event);
	var obj_left_x = ICIBA_HUAYI_GetObjPos(obj)["x"];
	var obj_left_y = ICIBA_HUAYI_GetObjPos(obj)["y"];

	ICIBA_HUACI_pX = mousePos.x - obj_left_x;
	ICIBA_HUACI_pY = mousePos.y - obj_left_y;


}
function ICIBA_HUACI_MMove(event) {
	//	alert(1);
	event = event||window.event;
	document.getElementById("icIBahyI-main_title").style.cursor="move";
	var obj =  document.getElementById("icIBahyI-main_box");
	var mousePos = ICIBA_HUAYI_mouseCoords(event);

	obj.style.left=mousePos.x-ICIBA_HUACI_pX + "px";
	obj.style.top=mousePos.y-ICIBA_HUACI_pY + "px";
}
function ICIBA_HUACI_MUp(event) {
	var obj =  document.getElementById("icIBahyI-main_box");
	document.getElementById("icIBahyI-main_title").style.cursor="default";
	ICIBA_HUACI_Obj = obj.parentNode;
	if(ICIBA_HUACI_Obj){
		if (window.event && ICIBA_HUACI_Obj.releaseCapture) ICIBA_HUACI_Obj.releaseCapture();
		else window.captureEvents(event.MOUSEMOVE|event.MOUSEUP);
		ICIBA_HUACI_Obj=null;
	}

}
function iCIBA_JOINWORD(){
//	var txt = ICIBA_WORD;
	var txt = document.getElementById("icIBahyI-title").innerHTML;
	var url =location.href;
	var src = "http://scb.iciba.com/aiframe.php?word="+encodeURIComponent(txt);
	//		alert(src);
	var ajaxiframe = '<iframe src="'+src+'" width="100%" height="100" allowTransparency="true" frameborder="0" id="icIBahyI-addWL"></iframe>';
	//	alert(ajaxiframe);
	var obj =  document.getElementById("icIBahyI-scbiframe");
	obj.innerHTML = ajaxiframe;
	//	alert(1);
	obj.style.display = "block";

	document.getElementById("icIBahyI-scbiframe").innerHTML=ajaxiframe;
}

ICIBA_HUAYI_kg();

var ICIBA_HUACI_TOP = window.ICIBA_HUACI_TOP = {
	_module: 1,
	curTab: 1,
	user: {
		id: 0,
		name: "",
		email: "",
		mobile: "",
		stat: {
			status: false,
			email: false,
			mobile: false
		}
	},
	initUserCookie: function() {

		var _ustat;
		var _stat = this.readCookie("_ustat");
		if (typeof _stat == "string") {
			try {
				_ustat = eval("(" + _stat + ")");
				this.user.id = _ustat.i;
				this.user.name = _ustat.n;
				//				this.user.email = _ustat.e;
				this.user.stat.status = _ustat.s.u;
				//				this.user.stat.email = ustat.e;
				this.user.stat.mobile = ustat.s.m
			} catch(e) {}
		}
		//		this.showHeaderBar()
	},
	readCookie: function(a) {
		var c = "";
		var b = a + "=";
		if (document.cookie.length > 0) {
			offset = document.cookie.indexOf(b);
			if (offset != -1) {
				offset += b.length;
				end = document.cookie.indexOf(";", offset);
				if (end == -1) {
					end = document.cookie.length
				}
				c = document.cookie.substring(offset, end)
			}
		}
		return decodeURIComponent(c)
	},
	checkLogin: function() {
		if (this.user.id == 0 || this.user.name == "") {
			return false
		}
		return true
	},
	init: function() {
		this.initUserCookie()
	}
};
function ICIBA_HUAYI_KEYDOWN(event){
	e = event ? event :(window.event ? window.event : null);
	if(e.keyCode==13){
		//执行的方法
		ICIBA_HUAYI_searchword();
		//   alert('回车检测到了');
	}
}
ICIBA_HUACI_TOP.initUserCookie();
function ICIBA_HUACI_myBrowser(){
	var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串
	var isOpera = userAgent.indexOf("Opera") > -1; //判断是否Opera浏览器
	var isIE = userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1 && !isOpera ; //判断是否IE浏览器
	var isFF = userAgent.indexOf("Firefox") > -1 ; //判断是否Firefox浏览器
	var isSafari = userAgent.indexOf("Safari") > -1 ; //判断是否Safari浏览器
	var isChrome = userAgent.indexOf("Chrome") > -1 ; //判断是否Safari浏览器

	if(isIE){
		var IE5 = IE55 = IE6 = IE7 = IE8 = false;
		var reIE = new RegExp("MSIE (\\d+\\.\\d+);");
		reIE.test(userAgent);
		var fIEVersion = parseFloat(RegExp["$1"]);

		IE55 = fIEVersion == 5.5 ;
		IE6 = fIEVersion == 6.0 ;
		IE7 = fIEVersion == 7.0 ;
		IE8 = fIEVersion == 8.0 ;

		if(IE55){ return "IE55"; }
		if(IE6){ return "IE6"; }
		if(IE7){ return "IE7"; }
		if(IE8){ return "IE8"; }
	}//isIE end

	if(isFF){ return "FF"; }
	if(isOpera){ return "Opera"; }
	if(isChrome){ return "Chrome"; }

}
