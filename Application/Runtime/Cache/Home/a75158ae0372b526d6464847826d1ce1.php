<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6 oldIE"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldIE"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldIE"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="zh"><!--<![endif]-->
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" media="all" href="/Public/style/common.css?20140731" />
    <!--[if lt IE 9]>
    <script src="/Public/js/libs/jquery-1.9.0.js"></script>
    <script src="/Public/js/common/html5shiv.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script src="/Public/js/libs/jquery-2.1.1.js"></script>
    <!--<![endif]-->
    <script src="/Public/js/libs/ec.lib.js?<?php echo $VERSION ?>" namespace="ec"></script>
    <!--[if IE 7]><script>ol.isIE7=true;</script><![endif]-->
    <!--[if IE 8]><script>ol.isIE8=true;</script><![endif]-->
    <script src="/Public/js/common/ec.base.js?20140731"></script>
	<title>旺通物流管理系统</title>
	<meta name="Keywords" content="" />
	<meta name="Description" content="旺通物流管理系统" />
</head>
<body>

<!-- BEGIN Navbar -->
<div id="navbar" class="navbar">
    <a href="/index.php" class="fl logo">旺通物流管理系统</a> 
    <span class="padding_left_30"><a href="http://www.zaozhuangwuliu.com">www.zaozhuangwuliu.com</a></span>
    <div class="fr top_nav">
        <!--<div class="li news_li"><a href="#" class="icon_btn"><i class="icon icon_news"></i><span>最新资讯</span><em class="yellow">(20)</em></a></div>-->
        <div class="li select_block login">
			<a href="#" class="select_block_title icon_btn"><i class="icon icon_user"></i><span>欢迎，admin</span><i class="icon icon_arr"></i></a>
			<p class="select_box">
				<a href="#">用户资料</a>
				<a href="#">安全退出</a>
			</p>
		</div>
		<div class="li sys_opt"><a href="/index.php/Home/Public/option" title="系统设置"><i class="icon icon_opt"></i></a></div>
    </div>
</div>
<!-- END Navbar -->
<link rel="stylesheet" media="all" href="/Public/style/plugs.css?20140731" />
<!-- BEGIN Container -->
<div class="main" id="main">
    <!-- BEGIN Left -->
    <!-- BEGIN Sidebar -->
<div id="sidebar" class="sidebar">
	<div class="search">
		<form action="#"><input type="input" class="keyword" value="Search"/><button type="submit" class="icon icon_search btn_search"></button></form>
	</div>
    <!-- BEGIN Navlist -->
    <ul class="nav_list" id="nav-list">
        <li  class="active">
            <a href="javascript:;" class="dropdown_toggle nav_li">
                <span>发布资讯</span>
                <i class="icon icon_arr"></i>
            </a>
            <!-- BEGIN Submenu -->
            <ul class="submenu">
                <li class="active"><a href="#">快捷发布</a></li>
                <li><a href="#">发布货源信息</a></li>
                <li><a href="#">发布车源信息</a></li>
                <li><a href="#">信息记录</a></li>
                <li><a href="#">加急记录</a></li>
                <li><a href="#">循环记录</a></li>
            </ul>
            <!-- END Submenu -->
        </li>

        <li>
            <a href="javascript:;" class="dropdown_toggle nav_li">
                <span>实用工具</span>
                <i class="icon icon_arr"></i>
            </a>

            <!-- BEGIN Submenu -->
            <ul class="submenu">
                <li class="active"><a href="#">快递查询</a></li>
				<li><a href="/index.php/Home/Plugs/calculator">计算器</a></li>
				<li><a href="/index.php/Home/Plugs/weather">天气预报</a></li>
				<li><a href="#">地图查询</a></li>
				<li><a href="#">手机归属地查询</a></li>
				<li><a href="#">身份证查询</a></li>
                <li><a href="#">车辆验证</a></li>
            </ul>
            <!-- END Submenu -->
        </li>
        <li>
            <a href="javascript:;" class="dropdown_toggle nav_li">
                <span>其它</span>
                <i class="icon icon_arr"></i>
            </a>

            <!-- BEGIN Submenu -->
            <ul class="submenu">
                <li class="active"><a href="#">子分类</a></li>
                <li><a href="#">子分类</a></li>
                <li><a href="#">子分类</a></li>
                <li><a href="#">子分类</a></li>
                <li><a href="#">子分类</a></li>
                <li><a href="#">子分类</a></li>
            </ul>
            <!-- END Submenu -->
        </li>
    </ul>
    <!-- END Navlist -->

    <!-- BEGIN Sidebar Collapse Button -->
    <i class="icon icon_arr_left visible_desktop" id="sidebar-collapse" title="显示/隐藏左边导航栏"></i>
    <!-- END Sidebar Collapse Button -->
</div>
<!-- END Sidebar -->
<script>
$(function() {
    $('#nav-list .dropdown_toggle').on('click', function(){
        var $submenu = $(this).next();
        var display = $submenu.css('display');
        $submenu.slideToggle(200);
        if(display == 'none') {
            //$submenu.sli
        }
    });
    $('#sidebar-collapse').on('click', function(){
        $(this).toggleClass('icon_arr_right1');
        $('#sidebar').toggleClass('hide_left');
        $('#main-content').toggleClass('show_left');
    });
});
</script>
    <!-- END Left -->
    <!-- BEGIN Content -->
    <div id="main-content" class="content show_left">
        <div class="breadcrumbs">
    <ul>
        <li>
        	<i class="icon icon_home"></i>
            <a href="/index.php">首页</a>
        </li>
        <li><i class="icon icon_arr_right"></i><span id="title"></span></li>
    </ul>
</div>
        <script>
            //设置面包宵
            gid('title').innerHTML = '计算器';
        </script>
        <div class="padding_20">
            <div class="calBox">
                <div class="calu">
                    <input type="text" id="text">      
                    <ul class="one clearfix">
                        <li class="orange clea">清屏</li>
                        <li class="black zheng">+/-</li>
                        <li class="black rec">1/x</li>
                        <li class="num">7</li>
                        <li class="num">8</li>
                        <li class="num">9</li>
                        <li class="gray oper">/</li>
                        <li class="black oper">%</li>
                        <li class="num">4</li>
                        <li class="num">5</li>
                        <li class="num">6</li>
                        <li class="gray oper">*</li>
                        <li class="black sq">√</li>           
                        <!--  -->           
                    </ul>
                    <div class="clearfix">
                        <div class="twoBox fl">
                            <ul class="one fl two">
                                <li class="num">1</li>
                                <li class="num">2</li>
                                <li class="num">3</li>
                                <li class="gray oper">-</li>
                                <li class="zero num">0</li>
                                <li class="num">.</li>
                                <li class="gray oper">+</li>
                            </ul>
                        </div>
                        <ul class="one three clearfix fl">
                            <li class="black deng fl">=</li>
                        </ul>        
                    </div>
                </div>
            </div>
            <input type="text" id="per" style="display:none">
            <input type="text" id="text1" style="display:none">

        </div>
    </div>
</div>
<script>
function findArr(a, c) {
    for (var b = 0; b < a.length; b++) {
        if (a[b] == c) {
            return true
        }
    }
    return false
}
function getClass(d, f) {
    if (document.getElementsByClassName) {
        return d.getElementsByClassName(f)
    } else {
        var a = [];
        var e = document.getElementsByTagName("*");
        for (var c = 0; c < e.length; c++) {
            var b = e[c].className.split(" ");
            if (findArr(b, f)) {
                a.push(e[c])
            }
        }
        return a
    }
};
window.onload = function() {
    var aNum = getClass(document, 'num');
    var oText = document.getElementById('text');
    var aPer = getClass(document, 'oper');
    var oPer = document.getElementById('per');
    var oText1 = document.getElementById('text1');
    var oDeng = getClass(document, 'deng')[0];
    var oSq = getClass(document, 'sq')[0];
    var oRec = getClass(document, 'rec')[0];
    var oZheng = getClass(document, 'zheng')[0];
    var oClea = getClass(document, 'clea')[0];
    var bOnOrOffClick = true;
 
    function fnNum(a) {
 
        var bClear = false;
        oText.value = '0'
 
        for (var i = 0; i < aNum.length; i++) {
            aNum[i].onclick = function() {
                if (!bOnOrOffClick) return;
 
                if (bClear) {
 
                    bClear = false;
                }
 
                if (oText.value.indexOf('.') != -1) {
                    if (this.innerHTML == '.') {
                        return;
                    }
                }
                if (oPer.value && oText.value && oText1.value == '') {
                    oText1.value = oText.value;
                    oText.value = '';
                }
 
                var re = /^0\.{1}\d+$/;
                var re1 = /^([0]\d+)$/;
                oText.value += this.innerHTML;
 
                if (re.test(oText.value)) {
                    return;
                }
 
                if (re1.test(oText.value)) {
                    oText.value = this.innerHTML;
                }
            }
            //符号部分的添加
            for (var j = 0; j < aPer.length; j++) {
                aPer[j].onclick = function() {
 
                    if (oText.value && oPer.value && oText1.value) {
                        var n = eval(oText1.value + oPer.value + oText.value);
                        oText.value = n;
                        oText1.value = '';
                    }
                    oPer.value = this.innerHTML;
                }
 
            }
            //点击等号的时候
            oDeng.onclick = function() {
                //+-*/%的情况
                if (oText1.value == '' && oPer.value == '' && oText.value == '') {
                    return;
                }
                var n = eval(oText1.value + oPer.value + oText.value);
                oText.value = n;
                oText1.value = '';
                oPer.value = '';
                bClear = true;
            }
            //点击开根号的时候
            oSq.onclick = function() {
                var m = Math.sqrt(oText.value);
                oText.value = m;
            }
            //点击倒数的时候
            oRec.onclick = function() {
                var a = 1 / oText.value;
 
                if (oText.value == '0') {
                    a = '正无穷'
                }
                oText.value = a;
            }
            //正负号的时候
            oZheng.onclick = function() {
                if (oText.value > 0) {
                    oText.value = -oText.value;
                } else {
                    oText.value = -oText.value;
                }
            }
            //清屏的时候
            oClea.onclick = function() {
                oText.value = '0';
                oText1.value = '';
                oPer.value = '';
            }
        }
    }
    fnNum(bOnOrOffClick);

}
</script>
<div class="footer">
    <p>2014 ©  <a href="http://www.zaozhuangwuliu.com">枣庄物流网</a></p>
</div>
<a id="btn-scrollup" class="up" href="#">up</a>
</body>
</html>