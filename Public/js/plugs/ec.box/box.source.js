/*
* ol.box plugin
* Version 1.2 (2012-7-13)
* @requires jQuery v1.2.6 or later
*
* Example at: http://www.open-lib.com/
*
* Copyright (c) 2009-2011 Open-Lib.Com
* Dual licensed under the MIT and GPL licenses:
* http://www.opensource.org/licenses/mit-license.php
* http://www.gnu.org/licenses/gpl.html
*
* Read the related post and contact the author at http://www.open-lib.com/
*
* This version is far from perfect and doesn't manage it's own state, therefore contributions are more than welcome!
*
* Usage: var box=new ol.box("something...",{boxid:"div1"});
*		box.open();
*		box.close();
*
* Tested in IE6 IE7 Firefox. Any browser strangeness, please report.
*/
window.ol || (window.ol = {});

(function() {

	var $,//jQuery
	$win,//$(window)
	$doc,//$(document)
	isIE6=true,

	_defaults 	= {
		boxid: "ol_box",
		boxclass:"ol_box",
		type: 'dialog',
		title: '',
		width: 0,
		height: 0,
		showTitle: true,
		showButton: true,
		showCancel: true,
		showOk: true,
		okBtnName: '确定',
		cancelBtnName: '取消',
		timeout: 0,
		draggable: true,
		modal: true,
		zIndex: 500,
		remember:false,
		position: 'center',
		clickOut: null,//点击box外调用的function
		onclose: null,
		onopen: null,
		oncancel: null,
		onok: null,
		blur:null,//关闭窗口后的焦点
		focus:null,//打开窗口中默认的焦点
		autoHeight : true,//自动高度(当内容高度大于设定的高度)
		autoPosition : true,//自动修正位置（当scroll resize时）
		//For type=ajax
		cache: false
	};
	var _getDoc=function(){
		return document.compatMode == 'CSS1Compat' ? document.documentElement : document.body;
	};
	var _getWinSize=function(){
		var doc=_getDoc();
		return {
				width: Math.max( doc.scrollWidth, doc.clientWidth || 0 ) - 1,
				height: Math.max( doc.scrollHeight, doc.clientHeight || 0 ) - 1
		};
	};
	var type={};
	type.dialog={
		html :  '<div>' +
				'<div class="box-ct">' +
				'	<div class="box-header">' +
				'		<div class="box-tl"></div>' +
				'		<div class="box-tc">' +
				'			<div class="box-tc1"></div>' +
				'			<div class="box-tc2"><a href="javascript:;" onclick="return false;" title="关闭" class="box-close"></a><span class="box-title"></span></div>' +
				'		</div>' +
				'		<div class="box-tr"></div>' +
				'	</div>' +
				'	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;">' +
				'		<tr>' +
				'			<td class="box-cl"></td>' +
				'			<td class="box-cc">' +
				'				<div class="box-content"></div>' +
				'				<div class="box-button">' +
				'					<a class="box-cancel" href="javascript:;"><span>取消</span></a>' +
				'					<a class="box-ok" href="javascript:;"><span>确定</span></a>' +
				'				</div>' +
				'			</td>' +
				'			<td class="box-cr"></td>' +
				'		</tr>' +
				'	</table>' +
				'	<div class="box-bottom">' +
				'		<div class="box-bl"></div>' +
				'		<div class="box-bc"></div>' +
				'		<div class="box-br"></div>' +
				'	</div>' +
				'</div>' +
				'</div>',
		initContent:function(self){
			self.setContent(self.content);
		},
		setContent:function(self,content,callback){
			self.content=content||self.content;
			self.setContent(self.content);
			if(typeof(callback)=="function")callback();
		}
	};//dialog end
	type.ajax={
		initContent:function(self){},
		setContent:function(self,content,callback){
			self._b_button.hide();
			self.setContent('<div class="box-loading"></div>');
			if (self._b_content.height()<90)self._b_content.height(Math.max(90, self.options.height));
			if (self._box.width()<200) self._box.width(Math.max(200, self.options.width));

			//ajax
			var ajaxurl = content||self.content;
			if(typeof(ajaxurl)!="string")
			{
				alert("please set ajax url.");
				return;
			}
			self.content=ajaxurl;
			if (self.options.cache == false) {
				if (ajaxurl.indexOf('?') == -1) {
					ajaxurl += "?_t="+Math.random();
				} else {
					ajaxurl += "&_t="+Math.random();
				}
			}
			$.get(ajaxurl, function(data) {
				if(self.options.showButton)self._b_button.show();
				self.setContent(data);
				if(typeof(callback)=="function")callback();
			});
		}
	};//ajax end
	type.iframe={
		initContent:function(self){},
		setContent:function(self,content,callback){
			var url = content||self.content;
			if(typeof(url)!="string")
			{
				alert("please set iframe url.");
				return;
			}

			self.content=url;
			var name="box-iframe-"+(new Date()).getTime();
			self.setContent('<iframe class="boxIframe" width="100%" height="100%" frameborder="0" name="'+name+'"></iframe><script>window["'+name+'"].location.href="'+url+'";</script>');
			if(typeof(callback)=="function")callback();
		},
		closeEvent:function(self){
			if(!self.options.remember)
			{
				self.find("iframe").each(function(){
					//this.contentWindow.document.write('');//清空iframe的内容
					this.contentWindow.close();//避免iframe内存泄漏
					jQuery(this).remove();//删除iframe
				});
			}
		}
	};//frame end

	ol.box=function(content,options){
		this.options=null;
		//当前操作类型
		this._type=null;
		//遮罩jq对象
		this._mask=null;
		//事件
		this._events={};
		//对话框jq对象
		this._box=null;
		//box的内容窗口的jq对象
		this._b_content=null;
		//box的按钮栏jq对象
		this._b_button=null;
		this.content=content;
		//是否已经填充内容
		this._initedContent=false;

		//内部临时变量
		this._onbox=false;
		this._isOpen=false;

		//初始化对象
		$=jQuery;
		$win=$(window);
		$doc=$(document);
		isIE6= ol.IE6,

		this.options  = $.extend({},_defaults, options);
		this.init();
	};
	ol.box.prototype={
		init:function(){
			this.initConfig();
			if(this.options.modal)this.initMask();
			this.initBox();
			this.initEvent();
		},
		initBox:function(){
			//移除已经存在的box
			$("#"+this.options.boxid+"."+this.options.boxclass).remove();
			this._box = $(this._type.html).css({
				visibility:"hidden",
				position: 'absolute',
				top:0,
				left:0,
				zIndex: this.options.zIndex
			}).bgiframe();
			this._b_button=this._box.find(".box-button");
			this._b_content=this._box.find(".box-content");
			this.renderBox(this.options);
			this._box.appendTo('body');
			this._type.initContent(this);
		},
		initConfig:function(){
			switch(this.options.type)
			{
				case "ajax":
					this._type=type.ajax;
					break;
				case "iframe":
					this._type=type.iframe;
					break;
				default:
					this._type=type.dialog;
					break;
			}
			this._type=$.extend({},type.dialog, this._type);
		},
		initEvent:function(){
			var thix=this;
			if (this.options.draggable && this.options.showTitle) {
				this._box.find('.box-header').mousedown(function(event){
					var h  = this;
						o  = document,
						ox = parseInt(thix._box.css("left"),10),
						oy = parseInt(thix._box.css("top"),10),
						mx = event.clientX,
						my = event.clientY,
						
						size=_getWinSize(),
						box_w = thix._box.outerWidth(true),
						box_h = thix._box.outerHeight(true);	

					if(h.setCapture)h.setCapture();

					var mousemove=function(event){
						if (window.getSelection) {
							window.getSelection().removeAllRanges();
						} else {
							document.selection.empty();
						}
						var left = Math.max(ox+event.clientX-mx, 0),
							top = Math.max(oy+event.clientY-my, 0);

						left = Math.min(left , size.width - box_w);
						top = Math.min(top , size.height - box_h);

						thix._box.css({left: left, top: top});
					};
					var mouseup=function(){
						if(h.releaseCapture)h.releaseCapture();
						$doc.unbind('mousemove',mousemove);
						$doc.unbind('mouseup',mouseup);
					};
					$doc.mousemove(mousemove).mouseup(mouseup);
				});
			}else{
				this._box.find('.box-header').css("cursor","default");
			}//if end
		},
		//渲染box
		renderBox:function(options){
			var css={zIndex:options.zIndex,position:"absolute"};
			if (options.boxid)this._box.attr('id', options.boxid);
			if (options.boxclass)this._box.attr("class",options.boxclass);

			if (!options.showTitle) {
				this._box.find('.box-header').hide();
			}else{
				if (options.title == '') {
				} else {
					this.setTitle(options.title);
				}
			}
			if (!options.showButton) {
				this._b_button.hide();
			}else{
				if (!options.showCancel) {
					this._b_button.find('.box-cancel').hide();
				}
				if (!options.showOk) {
					this._b_button.find(".box-ok").hide();
				}
			}
			this._b_button.find(".box-ok span").html(options.okBtnName);
			this._b_button.find(".box-cancel span").html(options.cancelBtnName);
			this._box.css(css);
		},
		setTitle:function(title){
			this._box.find(".box-title").html(title);
			return this;
		},
		//设置BOX的内容
		setContent:function(content){
			if(typeof(content)=="undefined"||content==null)return;
			this._initedContent=true;
			this._b_content.empty().html(content);
			var thix=this;
			//调整窗口大小
			if(this.options.width>0){
				this._box.css("width",this.options.width);
			}else{
				this._box.css("width",null);
			}
			if(this.options.height>0){
				var css= {
					"height" : this.options.height
				};
				this.options.autoHeight || (css["overflow-y"] = "auto");
				this._b_content.css(css);

			}else{
				this._b_content.css("height","auto");
			}
			//调整位置
			this.setPosition();
			//绑定按钮事件
			this._box.find(".box-close, .box-cancel, .box-ok").unbind('click').click(function(){thix.close();});
			if (typeof(this.options.onok) == "function") {
				this._box.find(".box-ok").unbind('click').click(function(){thix.options.onok.call(this,thix);});
			}
			if (typeof(this.options.oncancel) == "function") {
				this._box.find(".box-cancel").unbind('click').click(function(){thix.options.oncancel.call(this,thix);});
			}
			//绑定键盘事件
			this._box.find(".box-close, .box-cancel, .box-ok").unbind('keypress').bind("keypress",function(e){
				e = e||window.event;
				var key = e.which||e.charCode||e.keyCode;
				switch(key)
				{
					case 27://esc
						thix.close();
						return false;
					case 32://空格
					case 13://回车
						$(document.activeElement).trigger("click");
						return false;
				}
			});
		},
		//打开box事件
		openEvent:function(){
			if(this._isOpen)return;
			var thix=this;
			//自动更新位置
			if(this.options.autoPosition)
			{
				if(this.options.position!="center")
				{
					var timer;
					this._events["scroll"]=function(){
							clearTimeout(timer);
							timer=setTimeout(function(){
								thix.setPosition();
							},300);
					};
					$win.scroll(this._events["scroll"]);
				}
				this._events["resize"]=function(){
					thix.setPosition();
				};
				$win.resize(this._events["resize"]);
			}//if end
			if(this.options.timeout>0)
			{
				this._events["timeout"]=setTimeout(function(){
					thix.close();
				},this.options.timeout);
			}//if end
			//点击空白处事件
			this._onbox=true;
			if(this.options.clickOut)
			{
				this._events["box_click"]=function(event){
					thix._onbox=true;
				};
				this._events["document_click"]=function(event){
					if (event.button!=0) return true;
					if(thix._onbox===false)
					{
						thix.options.clickOut(thix);
					}
					thix._onbox=false;
				};
				this._box.bind("click",this._events["box_click"]);
				$doc.bind("click",this._events["document_click"]);
			}//if end

			if(this.options.modal)
			{
				this.showMask();
			}
			if(this.options.onopen)this.options.onopen(this);
			if (this.options.focus) {
				$(this.options.focus).focus();
			}
			this._isOpen=true;
		},
		//关闭box事件
		closeEvent:function(){
			clearTimeout(this._events["timeout"]);
			if(this._events["scroll"])$win.unbind("scroll",this._events["scroll"]);
			if(this._events["resize"])$win.unbind("resize",this._events["resize"]);
			if(this._events["box_click"])this._box.unbind("click",this._events["box_click"]);
			if(this._events["document_click"])$doc.unbind("click",this._events["document_click"]);

			if(this.options.modal)
			{
				this.hideMask();
			}
			if(this.options.onclose)this.options.onclose(this);
			//设置关闭后的焦点
			if (this.options.blur) {
				$(this.options.blur).focus();
			}
			this._isOpen=false;
			if(this._type.closeEvent)this._type.closeEvent(this);
		},
		//设置位置
		setPosition:function(){
			if(this.options.position=="center")
			{
				var w_t=$win.scrollTop();
				var w_l=$win.scrollLeft();
				var w_h=$win.height();
				var w_w=$win.width();
				var box_w=this._box.outerWidth(true);
				var box_c_h=this._b_content.outerHeight(true);
				var box_h_h=this._box.find(".box-header:first").outerHeight(true);
				var box_h_b=this._box.find(".box-bottom:first").outerHeight(true);
				var box_h=box_c_h+box_h_h+box_h_b;

				var offset={
					x:(w_w-box_w)/2,
					y:(w_h-box_h)/2
				};
				var css={
					position:"fixed"
				};

				//窗口可视面积比box大
				if(offset.x<0)
				{
					css.width=w_w;//重新调整大小
					offset.x=0;
				}
				if(offset.y<0)
				{
					css.height=w_h;
					offset.y=0;
				}

				css.top=offset.y;
				css.left=offset.x;

				if(isIE6)
				{
					css.position="absolute";

					var h=$("html");
					if(!h.css("background-image")||h.css("background-image")=="none")h.css("background-image","url(about:blank)");

					this._box[0].style.setExpression('left', '(document.documentElement || document.body).scrollLeft+'+css.left+'+"px"');
					this._box[0].style.setExpression('top', '(document.documentElement || document.body).scrollTop+'+css.top+'+"px"');
					delete css["top"];
					delete css["left"];
				}
				this._box.css(css);
				return;
			}else if(Object.prototype.toString.call(this.options.position) === "[object Object]"){
					var top=this.options.position.top||0;
					var left=this.options.position.left||0;
					if(this.options.position.ref)
					{
						var ref=$(this.options.position.ref);
						var offset=ref.offset();
						top+=offset.top;
						top+=ref.outerHeight(true);
						left+=offset.left;
					}
					this._box.css({
						top:top,
						left:left
					});
			}
		},
		//构造窗口显示内容
		renderContent:function(content,callback){
			if(typeof(content)!="undefined"&&content!=null)this._initedContent=false;
			if(!this._initedContent||!this.options.remember)
			{
				this._type.setContent(this,content,callback);
			}else{
				this.setPosition();
				this.openEvent();
			}
		},
		open:function(content,options){
			if(this._isOpen)
			{
				this.closeEvent();
			}
			this.options  = $.extend({},this.options, options);
			var thix=this;
			this.renderContent(content,function(){
				thix.openEvent();
			});
			this._box.stop().addClass('scaleIn').css({
				"visibility":"visible",
				"opacity":null
			});

			return this;
		},
		close:function(){
			this.closeEvent();
			this._box.removeClass('scaleIn').css("visibility","hidden");
		},
		isOpen:function(){
			return this._isOpen;
		},
		//渐入
		fadeIn:function(content,options,ms){
			this.options  = $.extend({},this.options, options);
			this.renderContent(content);
			var opacity=this._box.css("opacity")||1;
			this._box.css({
				"opacity":0,
				"visibility":"visible"
			}).stop().animate({opacity:opacity},ms);
			this.openEvent();
		},
		//渐出
		fadeOut:function(ms){
			var thix=this;
			this.closeEvent();
			this._box.stop().animate({opacity:0},ms,function(){
				thix._box.css({
					visibility:"hidden",
					opacity:null
				});
			});
		},
		find:function(selector){
			return this._b_content.find(selector);
		},
		getBox:function(){
			return this._box;
		},
		//遮罩
		initMask:function(){
			this._mask=$("<div class='ol_box_mask'></div>").css({
				visibility:"hidden",
				width: 0,
				height:0,
				zIndex: this.options.zIndex
			}).appendTo('body').bgiframe();
			var thix=this;
			this._events["masker_resize"]=function(){
				thix._mask.css(_getWinSize());
			};
		},
		showMask:function(){
			var css=_getWinSize();
			css.visibility="visible";
			this._mask.css(css);
			$win.bind("resize",this._events["masker_resize"]);
		},
		hideMask:function(){
			this._mask.css({
				visibility:"hidden",
				width:0,
				height:0
			});
			$win.unbind("resize",this._events["masker_resize"]);
		}/*,
		//取得遮照高度
		_bheight:function() {
			if (isIE6) {
				var scrollHeight = Math.max(
					document.documentElement.scrollHeight,
					document.body.scrollHeight
				);
				var offsetHeight = Math.max(
					document.documentElement.offsetHeight,
					document.body.offsetHeight
				);

				if (scrollHeight < offsetHeight) {
					return $win.height();
				} else {
					return scrollHeight;
				}
			} else {
				return $doc.height();
			}
		},
		//取得遮照宽度
		_bwidth:function() {
			if (isIE6) {
				var scrollWidth = Math.max(
					document.documentElement.scrollWidth,
					document.body.scrollWidth
				);
				var offsetWidth = Math.max(
					document.documentElement.offsetWidth,
					document.body.offsetWidth
				);

				if (scrollWidth < offsetWidth) {
					return $win.width();
				} else {
					return scrollWidth;
				}
			} else {
				return $doc.width();
			}
		}
		*/
	}
})();
