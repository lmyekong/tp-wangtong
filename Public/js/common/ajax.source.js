/**
AJAX类
Author:		Lulu
Last Edit:	2012-6-25
Version:	0.2
**/

//基于jquery,jquery-form的ajax帮助类
(function() {
	var $ = jQuery;
	ol.ajaxer = function() {
		var self=this;
		this.ajaxer=null;//ajax实例

		this.getOptions = function(options) {
			return {
				data:options.data,
				type: options.type,
				url: options.url,
				timeout:options.timeout>0?options.timeout:undefined,
				async:options.async,
				dataType: options.dataType,
				contentType:"application/x-www-form-urlencoded; charset=UTF-8",
				beforeSend: function() {
					if (typeof(options.beforeSendFunction) == "function") options.beforeSendFunction();
					if (options.button != null)  $(options.button).attr("disabled",true);
					if (options.loadingLayer != null) $(options.loadingLayer).css("display", "block");
				},
				success: function(data) {
					if (typeof(options.afterSendFunction) == "function") options.afterSendFunction(data);
					if (options.loadingLayer != null) $(options.loadingLayer).hide();

					if (typeof(options.successFunction) == "function") options.successFunction(data);
					
					if (options.button != null) $(options.button).attr("disabled",false);
				},
				error: function(xhr,status) {
					if (typeof(options.afterSendFunction) == "function") options.afterSendFunction(xhr,status);
					if (options.loadingLayer != null) $(options.loadingLayer).hide();
					if (options.button != null)  $(options.button).attr("disabled",false);
					if(status==="timeout"&&typeof(options.timeoutFunction)=="function")
					{
						setTimeout(options.timeoutFunction,1);
					}else{
						if (typeof(options.errorFunction) == "function") options.errorFunction(xhr,status);
					}
				}
			}; //return end
		} //this.getOptions end

		this.submit = function(opt) {
			opt = $.extend({} , ol.ajaxer.settings, opt);
			opt.type = "POST";
			var o = $(opt.form);
			if(opt.url){
				o.attr("action",opt.url);
			}else{
				opt.url = o.attr("action"); //alert(opt.url);
			}
			if(this.ajaxer && typeof(this.ajaxer.abort) == "function")this.ajaxer.abort();
			return this.ajaxer=o.ajaxSubmit(this.getOptions(opt));
		} //Submit end
		this.post=function(opt){
			return this.submit(opt);
		},//Post end
		this.get = function(opt) {
			opt = $.extend({} , ol.ajaxer.settings, opt);
			opt.type = "GET";
			if(this.ajaxer && typeof(this.ajaxer.abort) == "function")this.ajaxer.abort();
			return this.ajaxer=$.ajax(this.getOptions(opt));
		} //Get end
		this.load = function(opt) {
			opt = $.extend({} , ol.ajaxer.settings, opt);
			opt.type = "GET";
			opt.dataType = "html";
			if(this.ajaxer && typeof(this.ajaxer.abort) == "function")this.ajaxer.abort();
			return this.ajaxer=$.ajax(this.getOptions(opt));
		} //Load end

	};
	//ol.ajaxer end

	ol.ajaxer.settings = {
		form: "<form></form>",
		type: 'post',
		url: null,
		async:true,//true异步,false同步
		data:{},
		dataType: 'json',
		loadingLayer: null,
		button: null,
		beforeSendFunction:null,//ajax提交前
		afterSendFunction:null,//ajax提交后，数据返回后
		successFunction: null,
		errorFunction: null,
		timeoutFunction:null
	};
})();

ol.ajax=ol.ajaxer;

