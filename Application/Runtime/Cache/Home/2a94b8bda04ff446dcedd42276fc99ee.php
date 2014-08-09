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
<title><?php echo (C("title")); ?></title>
<meta name="Keywords" content="" />
<meta name="Description" content="<?php echo (C("title")); ?>" />

    
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

    <div class="main" id="main">
        <div id="main-content" class="content show_left">
            
            
    <div class="notice relative">
        <p class="fl">
            <span>
                <i class="icon icon_home vam"></i>
                <strong class="vam">公告：</strong>
            </span>
            <span class="notice_li vam">
                <a href="#">这里是最新公告信息这里是最新公告信息...</a>
            </span>
        </p>
        <p class="tool_bar textr fr">
            <label><input id="isHideCity" type="checkbox" autocomplete="off" class="vam" /> <span class="vam">选择城市</span></label>
            <label><input id="isScroll" type="checkbox" autocomplete="off" class="vam" /> <span class="vam">滚动</span></label>
            <label><input id="isEncrypt" type="checkbox" autocomplete="off" class="vam" /> <span class="vam">加密</span></label>
        </p>
    </div>
    <!-- 城市列表 s -->
    <div class="relative">
        <div class="index_city city_list hide" id="city-list">
            <p class="city_content clearfix">
                <?php for($i=0;$i<10;$i+=1){?>
                <a href="#">北京</a><a href="#">深圳</a><a href="#">广州</a><a href="#">上海</a><a href="#">南京</a>
                <?php }?>
            </p>
        </div>
    </div>
    <!-- 城市列表 end -->
    <div class="padding_20 clearfix padding_top_0">
        <!-- 搜索 s -->
        <div class="mod search_list">
            <h2 class="tab_title">
                <span class="hover" onclick="ec.index.tab(this, 0)">车源搜索</span>
                <span onclick="ec.index.tab(this, 1)">货源搜索</span>
                <i class="icon icon_dropdown"></i>
            </h2>
            <div class="mod_box padding_20">
                <div class="search_tool bg_new" id="search-tool">
                    <form action="#">
                        <p class="line"><label id="label-text">车源地：</label><span id="linkSelect_1"></span></p>
                        <p class="line"><label>目的地：</label><span id="linkSelect_2"></span></p>
                        <p class="line">
                          <label>关键字：</label><input type="text" name="keyword" class="keywords">
                          <button type="submit">搜索</button>
                        </p>
                    </form>
                </div>
                <div>
                    <div class="tab_box" id="tab_0">
                        <div class="search_list padding_top_15" id="search_list_0">
                            <table width="100%">
                                <tbody>
                                    <?php for($i=0;$i<5;$i+=1){?>
                                    <tr>
                                      <td><a href="#">这里是最新公告信息这里是最新公告信息</a></td>
                                      <td width="100" align="right">2014-08-01</td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                            <div class="pager" id="list-pager-2">
    <ul>
        <li class="first un_page">第一页</li>
        <li class="prev un_page">上一页</li>
        <li class="pgCurrent">1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
        <li>6</li>
        <li>7</li>
        <li>8</li>
        <li>9</li>
        <li class="next">下一页</li>
        <li class="last">最后一页</li>
        <li class="quick_pager">
            <div class="quickPager_form"><input type="text" /><span>GO</span></div>
        </li>
    </ul>
</div>
                        </div>
                    </div>
                    <div class="tab_box hide" id="tab_1">
                        <div class="search_list padding_top_15" id="search_list_1">
                            <table width="100%">
                                <tbody>
                                    <?php for($i=0;$i<5;$i+=1){?>
                                    <tr>
                                      <td><a href="#">这里是最新公告信息这里是最新公告信息</a></td>
                                      <td width="100" align="right">2014-08-01</td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                            <div class="pager" id="list-pager-2">
    <ul>
        <li class="first un_page">第一页</li>
        <li class="prev un_page">上一页</li>
        <li class="pgCurrent">1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
        <li>6</li>
        <li>7</li>
        <li>8</li>
        <li>9</li>
        <li class="next">下一页</li>
        <li class="last">最后一页</li>
        <li class="quick_pager">
            <div class="quickPager_form"><input type="text" /><span>GO</span></div>
        </li>
    </ul>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 搜索 end -->

        <!-- 滚动资讯 s -->
        <div class="mod search_list">
            <h2>
                <span>最新资讯</span>
                <i class="icon icon_dropdown"></i>
            </h2>
            <div class="mod_box padding_20">
                <div class="scroll_news">
                    <div id="scrollNews" class="scroll_news_content">
                        <table width="100%">
                            <tbody>
                              <?php for($i=0;$i<20;$i+=1){?>
                              <tr>
                                <td><a href="#">这里是最新公告信息这里是最新公告信息</a><?php echo $i;?></td>
                                <td width="100" align="right">2014-08-01</td>
                              </tr>
                              <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- 滚动资讯 end -->
    </div>
    <script src="/Public/js/index.js"></script>

        </div>
    </div>


    <div class="footer">
    <p>2014 <span class="icon_copyright">©</span>  <a href="http://www.zaozhuangwuliu.com">枣庄物流网</a></p>
</div>
<a id="btn-scrollup" class="up" href="#">up</a>

</body>
</html>