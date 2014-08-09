/**
 * Last  Update:2014-04-22
 */


ol.debug = true;//调试模式


ol.load.define("jquery.form" , [{mark:"jquery.form",uri: "../plugs/jquery.form/jquery.form-3.50.js",type: "js",	charset: "utf-8"}]);
ol.load.define("jquery.bgiframe" , [{mark:"jquery.bgiframe",uri: "../plugs/jquery.bgiframe/jquery.bgiframe.js",type: "js",	charset: "utf-8"}]);
ol.load.define("ajax" , [
	"jquery.form",
	{mark:"ajax",uri: "common/ajax.js",type: "js",	charset: "utf-8",depend:true}
]);
ol.load.define("ajaxcdr" , [
	"jquery.form",
	{mark:"ajaxcdr",uri: "common/ajaxcdr.js?20121031",type: "js",	charset: "utf-8",depend:true}
]);
ol.load.define("jquery.datePicker" , [
	{mark:"jquery.datePicker", uri: "../plugs/jquery.datePicker/datePicker.js",type: "js"}
]);
ol.load.define("swfobject" , [
	{mark:"swfobject", uri: "common/swfobject.js",type: "js"}
]);
ol.load.define("ec.box" , [
	"jquery.bgiframe",
	{mark:"ec.box", uri: "../plugs/ec.box/box.source.js",type: "js", depend:true}
]);

ol.load.define("ec.ui.linkSelect" , [
	{mark:"ec.ui.linkSelectData", uri: "../plugs/ec.linkSelect/linkSelectData.js?20140530",type: "js"},
	{mark:"ec.ui.linkSelect", uri: "../plugs/ec.linkSelect/linkSelect.js?20140530",type: "js", depend: true}
]);


//数字输入验证
ec.ui.number = function (selector, options){
	var defaultOpt = {
		max : null,
		min : null,
		showButton : true,
		minusBtn : '<a title="-" class="icon-minus vam" href="javascript:;"><span>-</span></a>',
		plusBtn : '<a title="+" class="icon-plus vam" href="javascript:;"><span>+</span></a>'
	},
	thix = $(selector),
	options = $.extend(defaultOpt, options),
	checkNumber = function(e) { //非法字符过滤 
		var currentKey = e.which,
			val = parseInt(this.value, 10),
			thisVal = (val < 1) ? 1 : val;	
		
		if((currentKey < 37 || currentKey > 40) && currentKey != 8 && currentKey != 46) {
			
			if(thisVal > options.max || thisVal < options.min) { 
				e.preventDefault();
				return false;
			} else {			
				if((currentKey<48 || currentKey>57) && (currentKey <96 || currentKey>105) && currentKey!=9) { 					
					e.preventDefault();
					return false;
				}
				
			}
			
		}
	};

	thix.each(function () {

		var opt = $.extend({}, options),
			inputObj = $(this).css('ime-mode','disabled');

		var tmp = inputObj.attr("max");
		if(tmp)
		{
			options.max = opt.max = parseInt(tmp , 10) || opt.max;
		}

		tmp = inputObj.attr("min");
		if(tmp)
		{
			options.min = opt.min = parseInt(tmp , 10) || opt.min;
		}

		if(opt.showButton)
		{
			//减少
			var minusBtn = $(opt.minusBtn).click(function(){
				var val= inputObj.val() || 0,
					thisVal = parseInt(val , 10) -1;
				if(typeof(opt.min) == "number" && thisVal < opt.min) { 
					return;
				}
				inputObj.val(thisVal).trigger("blur");
			}),
			//增加
			plusBtn = $(opt.plusBtn).click(function(){
				var val= inputObj.val() || 0,
					thisVal = parseInt(val , 10) +1;
				if(typeof(opt.max) == "number" && thisVal > opt.max) { 
					return;
				}
				inputObj.val(thisVal).trigger("blur");
			});
			inputObj.after(plusBtn).before(minusBtn);
		}
		inputObj.data("ovalue" , inputObj.val() || 0)
			.keydown(checkNumber)
			.keyup(function () {
				var thisVal = parseInt(this.value || 0);
				if(typeof(opt.min) == "number" && thisVal < opt.min) { 
					this.value  = opt.min ;
					return;
				}else if(typeof(opt.max) == "number" && thisVal > opt.max) { 
					this.value  = opt.max ;
					return;
				}
			})
			.blur(function () {
				if(typeof opt.onchange === "function") {	
					var oldVal = inputObj.data("ovalue"),
						newVal = this.value || 0,
						diff = parseInt(newVal , 10) -  parseInt(oldVal , 10);
					if(diff == 0)return;
					opt.onchange.call(this , newVal , diff);
					inputObj.data("ovalue" , newVal);
				}
			});

	});
	
};
// 倒计时插件
ec.ui.countdown = function(selector, opt) {

	// Default options
	var options = {
		"onlyDay" : {"day":1, "html" : "<span><em>{#day}</em>DAY</span>"},
		"html" : "<span>{#day}</span><em>:</em>DAY<span>{#hours}</span><em>:</em>HR<span>{#minutes}</span><em>:</em>MIN<span>{#seconds}</span>SECS",
		"now" : new Date().getTime(),
		"startTimes" : ['12/31/2014 12:0:0'],
		"endTime" : null,
		"callback" : null
	};

	var obj = $(selector), 
	timer = obj.data("countdown"),
	timeIndex = 0,
	preTarget,

	opt = $.extend(options, opt), 
	diff, 
	diffMs =  opt.now - new Date().getTime(),
	diffSecs = 0,
	getNext = function() {
		if (timeIndex >= opt.startTimes.length) return false;
		preTarget = opt.startTimes[timeIndex];
		timeIndex++;
		
		return true;
	}, 
	getDiffSec = function(){
		
		diffSecs = Math.round((ec.util.parseDate(preTarget, 'yyyy-MM-dd HH:mm:ss').getTime() - new Date().getTime() - diffMs) / 1000);
		diffSecs = diffSecs <= 0 ? 0 : diffSecs;
		return diffSecs;
	},
	render = function() {
		var html = '';
		diffSecs--;
		if(diffSecs <= 0) {diffSecs=0;}
		diff = {
			day : Math.floor(diffSecs / (24*60*60)),
			hour : (opt.html.indexOf("{#day}") >= 0) 
					? Math.floor(diffSecs / 60 / 60 ) % 24 
					: Math.floor(diffSecs / 60 / 60 ),
			minute : Math.floor(diffSecs / 60) % 60,
			second : diffSecs % 60
		};

		if(options.onlyDay && diff.day > options.onlyDay.day && options.onlyDay){
			html = options.onlyDay.html.replace(/{#day}/g, diff.day);
		} else {
			html = options.html.replace(/{#day}/g, diff.day).replace(/{#hours}/g, diff.hour > 9 ? diff.hour : "0" + diff.hour).replace(
				/{#minutes}/g, diff.minute > 9 ? diff.minute : "0" + diff.minute).replace(/{#seconds}/g, diff.second > 9 ? diff.second : "0" + diff.second);
		}
		obj.html(html);

		return (diffSecs <=0) ? false : true;
	};
	
	if (!opt.startTimes) {
		opt.startTimes = [ opt.endTime ];
	}

	clearInterval(timer);
	while (getNext()) {
		if (getDiffSec() <= 0)
			continue;
		break;
	}

	if (!render()){
		if (opt.callback && ec.util.isFunction(opt.callback)){ 
			opt.callback.call(obj, opt);
		}
		return;
	}

	timer = setInterval(function() {
		
		if (!render()) {
			if (opt.callback && ec.util.isFunction(opt.callback)){ 
				opt.callback.call(obj, opt);
			}

			if (!getNext()) {
				clearInterval(timer);
			} else {
				getDiffSec();
			}
		}
	}, 1000);

	obj.data("countdown", timer);
};


/* 初始化方法  */
$(function () {
	//模块显示或隐藏
	$('#main-content .mod h2 .icon').on('click', function (){
		$(this).closest('h2').next().slideToggle(200);
	});
});






