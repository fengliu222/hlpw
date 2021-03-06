<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<title>欢乐票务后台管理系统</title>
		
		<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	    <![endif]-->
		<link rel="stylesheet" href="Common/CSS/bootstrap.css">
		<link rel="stylesheet" href="Common/CSS/style.css">
	</head>
	<body>
		<div id="main" class='container'>
			<div id="header">
				<h2>欢乐票务网后台登录</h2>
			</div>
			<div id="content">
				<div class="formWrap">
					<form id='formContent' action="User" method="POST">
						<div class="control-group">
							<label for="account">用户名:</label>
							<input class="input-large" type="text" name="account" id="account" required placeholder="请输入用户名">
						</div>
						<div class="control-group">
							<label for="account">密码:</label>
							<input class="input-large" type="password" name="pass" id="pass" required>
						</div>
						<label class="checkbox">
						    <input type="checkbox"> 下次自动登录
						</label>
						<input type="button" class="subButton btn btn-large btn-block btn-primary" value='登录'>
					</form>
				</div>
			</div>
		</div>
	</body>
	<script src="Common/JS/jquery-1.7.2.min.js"></script>
	<script src="Common/JS/bootstrap.min.js"></script>
	<script>
		$(function(){
			$(".subButton").eq(0).bind("click",function(){
				 $.post("?m=User&&a=adminLogin",{
				 	account:$("#account").val(),
				 	pass:$("#pass").val()
				 });
			})
		})
	</script>
</html>