<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html  lang="zh-CN">
	<head>
		<title>欢乐票务后台管理系统</title>
		<link rel="stylesheet" href="__CSS__bootstrap.css">
		<link rel="stylesheet" href="__JS__date/jquery.datepick.css">
		<link rel="stylesheet" href="__CSS__admin.css">
		 
 
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
	    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>
		<div id="main">
			 
			<div id="content" class="container">
				<div class="row">
					 
					<div id="article" class="col-md-12">
<div id="userinfo">
	<legend>修改密码</legend>
	<form action="./?m=User&&a=updatePass" method="post">
		<label for="oldpass">原密码：</label>
		<input type="text" name="oldpass">
		<label for="newpass">新密码：</label>
		<input type="password" name="newpass">
		<label for="repass">确认新密码：</label>
		<input type="password" name="repass">
		<input type="submit" value="确认修改">
	</form>
</div>
					</div>
				</div>
			</div>
		</div>

	</body>
	<script src="__JS__jquery-1.7.2.min.js"></script>
	<script src="__JS__bootstrap.min.js"></script>
	<script src="__JS__date/jquery.datepick.js"></script>
	<script src="__JS__date/jquery.datepick-zh-CN.js"></script>
	<script src="__JS__admin.js"></script>
	
</html>