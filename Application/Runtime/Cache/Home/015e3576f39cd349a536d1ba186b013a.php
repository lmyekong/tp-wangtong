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

    
<link rel="stylesheet" media="all" href="/Public/style/public.css?20140731" />

</head>
<body>



    <div class="main" id="main">
        <div id="main-content" class="content show_left">
            
            
<div class="login_reg register">
	<div class="login_reg_title">旺通物流管理系统</div>
	<div class="login_reg_form">
		<form action="/" method="POST">
		<table width="100%">
			<tr>
				<td width="35%" class="textr">&nbsp;</td>
				<td><h3>用户注册</h3></td>
			</tr>
			<tr>
				<td width="35%" class="textr">用户名：</td>
				<td><input type="text" name="usname" /></td>
			</tr>
			<tr>
				<td class="textr">邮箱：</td>
				<td>
					<input type="text" name="email" />
				</td>
			</tr>
			<tr>
				<td class="textr">密&nbsp;码：</td>
				<td><input type="password" name="passwd" /></td>
			</tr>
			<tr>
				<td class="textr">密码确认：</td>
				<td><input type="password" name="passwd2" /></td>
			</tr>
			<tr>
				<td class="textr">&nbsp;</td>
				<td class="login_reg_btn">
					<button type="submit">注册</button>
					<button type="cancel">取消</button>
				</td>
			</tr>
		</table>
		</form>
	</div>
</div>

        </div>
    </div>


    <div class="footer">
    <p>2014 <span class="icon_copyright">©</span>  <a href="http://www.zaozhuangwuliu.com">枣庄物流网</a></p>
</div>
<a id="btn-scrollup" class="up" href="#">up</a>

</body>
</html>