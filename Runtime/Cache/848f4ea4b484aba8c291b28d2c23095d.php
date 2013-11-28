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
	 		<a href="./?m=Admin&&type=reserList" id='index'>预约查询</a>
	 	</li>
	 	<li>
	 		<a href="./?m=Admin&&type=activeNumber" id='makeNumber'>生成团购码</a>
	 	</li>
	 	<li>
	 		<a href="./?m=Admin&&type=placeControl" id='changePass'>预约地点管理</a>
	 	</li>
	 	<li>
	 		<a href="./?m=Admin&&type=changePass" id='changePass'>修改管理员密码</a>
	 	</li>
	</ul>
</div>
					<div id="article" class="span8">
						<div id="placecontrol">
	<legend>景点管理</legend>
	<div class="place">
		<ul>
			<?php if(is_array($place)): $i = 0; $__LIST__ = $place;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["available"] == 1): ?><li class="ava">
					<form name='<?php echo ($vo["placename"]); ?>' action="?m=placeControl&&a=updatePlaceList" method="POST">
					<input type="hidden" name='oldname' value="<?php echo ($vo["placename"]); ?>" />
					<input type="text" name='newname' value="<?php echo ($vo["placename"]); ?>">
					<div class="placename"><?php echo ($vo["placename"]); ?></div>
					<div class="placeAva">可用</div>
					</form>

				</li>
				<?php else: ?>
					<li class="una">
						<div class="placename"><?php echo ($vo["placename"]); ?></div>
						<div class="placeAva">不可用</div>
					</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
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