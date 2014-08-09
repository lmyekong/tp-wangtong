ec.pkg('ec.index');

/** 
 * [城市联动插件调用]
 * @param  {[type]} ) []
 * @return {[type]}   []
 */
ec.load('ec.ui.linkSelect', {
	"onload" : function () {
		ec.linkSelect.region('#linkSelect_1', {
			ids : [ 'province', 'city', "district" ],
			names : [ "province", "city", "district" ],
			css : [ "ec_linkSelect", "ec_linkSelect", "ec_linkSelect" ],
			tips : [ "- 请选择 -", "- 请选择 -" ]
		});
		ec.linkSelect.region('#linkSelect_2', {
			ids : [ 'province1', 'city1', "district1" ],
			names : [ "province1", "city1", "district1" ],
			css : [ "ec_linkSelect", "ec_linkSelect", "ec_linkSelect" ],
			tips : [ "- 请选择 -", "- 请选择 -" ]
		});
	}
});
/** 
 * [搜索模块切换]
 * @param  {[type]} obj [dom对象]
 * @param  {[type]} id  [对象id]
 * @return {[type]}     null
 */
ec.index.tab = function(obj, id){
	$(obj).addClass('hover').siblings().removeClass('hover');
	$('#tab_'+ id).show().siblings().hide();

	$('#search-tool').toggleClass('bg_new', (id == 0));
	$('#label-text').html((id == 1) ? '货源地：' : '车源地：');
};

/**
 * [资讯列表滚动]
 * @return {[type]} null
 */
(function (){

    var $this = $('#scrollNews');
    var thisHeight = (0-$this.height());
    var top = 0;
    var scrollNewsTimeout = null;
    var $isScrollCheckbox = $('#isScroll');
    var _scroll = function (){
        if(top == thisHeight){
            top = 0;
        }
        top -= 1;
        $this.css({"top": top});
        ec.index.scrollTop = top;
    };
    ec.index.startScroll = function (){
    	var isCheck = $isScrollCheckbox.prop('checked');
		if(!isCheck) return;
        clearInterval(scrollNewsTimeout);
        scrollNewsTimeout = setInterval(_scroll, 60);
    };
    ec.index.stopScroll = function () {
        clearInterval(scrollNewsTimeout);
    };

    ec.index.newsScrollInt = function () {
    	var $list = $this.children('table').clone();
		if($isScrollCheckbox.prop('checked')) {
			ec.index.startScroll();
		}
		$this.append($list);
	    $this.hover(ec.index.stopScroll, ec.index.startScroll);
	    $isScrollCheckbox.on('click', function(){
			if(this.checked) {
				ec.index.startScroll();
			} else {
				ec.index.stopScroll();
			}
		})
    };
    ec.index.newsScrollInt();
})();

/* 初始化方法  */
$(function () {
	$('#isHideCity').on('click', function(){
		$('#city-list').slideToggle(200);
	}).prop('checked', false);
});