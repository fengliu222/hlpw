<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<title>欢乐票务后台管理系统</title>
		<link rel="stylesheet" href="__CSS__bootstrap.css">
		<link rel="stylesheet" href="__CSS__admin.css">
	</head>
	<body>
		<div id="main">
			<div id="header" >
				<h2 class="container">欢乐票务后台管理系统</h2>
			</div>
			<div id="content" class="container">
				<div class="row">
					<div id="aside" class="span3">
	<ul class="nav nav-list">
		 <li class="nav-header">常用功能</li>
	 	<li class="active">
	 		<a href="./?m=reserList" id='index'>预约查询</a>
	 	</li>
	 	<li>
	 		<a href="./?m=activeNumber" id='makeNumber'>生成团购码</a>
	 	</li>
	 	<li>
	 		<a href="./?m=placeControl" id='changePass'>预约地点管理</a>
	 	</li>
	 	<li>
	 		<a href="./?m=changePass" id='changePass'>修改管理员密码</a>
	 	</li>
	</ul>
</div>
					<div id="article" class="span8">
<div id="reservationList">
	
</div>
					</div>
				</div>
			</div>
		</div>

	</body>
	<script src="__JS__jquery-1.7.2.min.js"></script>
	<script src="__JS__bootstrap.min.js"></script>
	<script src="__JS__admin.js"></script>
</html>