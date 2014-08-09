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
    <link rel="stylesheet" media="all" href="/whm/tp-wangtong/Public/style/common.css?20140731" />
    <!--[if lt IE 9]>
    <script src="/whm/tp-wangtong/Public/js/libs/jquery-1.9.0.js"></script>
    <script src="/whm/tp-wangtong/Public/js/common/html5shiv.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script src="/whm/tp-wangtong/Public/js/libs/jquery-2.1.1.js"></script>
    <!--<![endif]-->
    <script src="/whm/tp-wangtong/Public/js/libs/ec.lib.js?<?php echo $VERSION ?>" namespace="ec"></script>
    <!--[if IE 7]><script>ol.isIE7=true;</script><![endif]-->
    <!--[if IE 8]><script>ol.isIE8=true;</script><![endif]-->
    <script src="/whm/tp-wangtong/Public/js/common/ec.base.js?20140731"></script>
	<title>旺通物流管理系统</title>
	<meta name="Keywords" content="" />
	<meta name="Description" content="旺通物流管理系统" />
</head>
<body>

<link rel="stylesheet" media="all" href="/whm/tp-wangtong/Public/style/login.css?20140731" />
<div class="login">
	<div class="login_title">旺通物流管理系统</div>
	<div class="login_form">
		<form action="index.php" method="POST">
		<table width="100%">
			<tr>
				<td width="35%" class="textr">用户名：</td>
				<td><input type="text" name="usname" /></td>
			</tr>
			<tr>
				<td class="textr">密&nbsp;码：</td>
				<td><input type="password" name="passwd" /></td>
			</tr>
			<tr>
				<td class="textr">&nbsp;</td>
				<td>
					<input type="checkbox" name="autoLogin" class="vam"/>
					<span class="vam">自动登录</span>
				</td>
			</tr>
			<tr>
				<td class="textr">&nbsp;</td>
				<td class="login_btn">
					<button type="submit">登录</button>
					<button type="cancel">取消</button>
				</td>
			</tr>
		</table>
		</form>
	</div>
</div>
<div class="footer">
    <p>2014 ©  <a href="http://www.zaozhuangwuliu.com">枣庄物流网</a></p>
</div>
<a id="btn-scrollup" class="up" href="#">up</a>
</body>
</html>