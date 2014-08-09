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
<style>
.opt_key_list span{margin-right: 20px;}
</style>
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
				<li><a href="/index.php/Home/Plugs/count">计算器</a></li>
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
            gid('title').innerHTML = '设置';
        </script>

		<div class="padding_20" id="weather-list">
    	    <!-- 关键字设置 s -->
            <div class="mod search_list margin_top_15">
                <h2>
                    <span>相关设置</span>
                    <i class="icon icon_dropdown"></i>
                </h2>
                <div class="mod_box padding_20">
                    <h3>关键字设置：</h3>
                    <table width="100%">
                        <tr>
                            <td width="100" class="textr">货物名：</td>
                            <td width="160"><input type="text" name="name" /></td>
                            <td width="70"><button type="button">添加</button></td>
                            <td>
                                <p class="opt_key_list">
                                    <span>常用名1</span>
                                    <span>常用名2</span>
                                    <span>常用名3</span>
                                    <span>常用名4</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="textr">车辆型号：</td>
                            <td><input type="text" name="number" /></td>
                            <td><button type="button">添加</button></td>
                            <td>
                                <p class="opt_key_list">
                                    <span>常用名1</span>
                                    <span>常用名2</span>
                                    <span>常用名3</span>
                                    <span>常用名4</span>
                                </p>
                            </td>
                        </tr>

                    </table>
                    <h3 class="margin_top_30">其它设置：</h3>
                    <table width="100%">
                        <tr>
                            <td width="100" class="textr">&nbsp;</td>
                            <td>
                                <input type="checkbox" name="autoLogin" class="vam"/>
                                <span class="vam">新消息提醒</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- 关键字设置 end -->
            <!-- 城市列表 s -->
            <div class="mod search_list margin_top_15">
                <h2>
                    <span>城市列表</span>
                    <i class="icon icon_dropdown"></i>
                </h2>
                <div class="mod_box padding_20">

                    <form>
                        <label>城市名：</label><input type="text" name="city" />
                        <button type="submit">确定添加</button>
                    </form>

                    <!-- 城市列表 s -->
                    <div class="city_list clearfix">
                      <?php for($i=0;$i<10;$i+=1){?>
                      <a href="#">北京</a><a href="#">深圳</a><a href="#">广州</a><a href="#">上海</a><a href="#">南京</a>
                      <?php }?>
                    </div>
                    <!-- 城市列表 end -->
                </div>
            </div>
            <!-- 城市列表 end -->
		</div>
	</div>
</div>
<div class="footer">
    <p>2014 ©  <a href="http://www.zaozhuangwuliu.com">枣庄物流网</a></p>
</div>
<a id="btn-scrollup" class="up" href="#">up</a>
</body>
</html>