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
<div id="placecontrol">
 	<table class="table">
	 		<tr>
	 			<th>景点名称</th>
	 			<th>可用状态</th>
	 		</tr>
	</table>
	<div class="place">
	 	
			<?php if(is_array($place)): $i = 0; $__LIST__ = $place;if( count($__LIST__)==0 ) : echo "$emtpy" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><form  class="listForm form-inline" action="./?m=placeControl&&a=updatePlaceList" method="POST">
					<input type="hidden" name='oldname' value="<?php echo ($vo["placename"]); ?>" />
					<input type="text" name='newname' value="<?php echo ($vo["placename"]); ?>">
				
				
					<select name="available">
						<?php if($vo["available"] == 1): ?><option value="<?php echo ($vo["available"]); ?>"  selected="selected">可用</option>
							<option value="0">不可用</option>
						<?php else: ?>
							<option value="1">可用</option>	
							<option value="<?php echo ($vo["available"]); ?>"  selected="selected">不可用</option><?php endif; ?>
					</select>
				
				
					<input type="submit" class="btn btn-primary sub" value="保存修改" />
					<input type="button" name="del" class="btn btn-danger del" value="删除景点" />
				</form><?php endforeach; endif; else: echo "$emtpy" ;endif; ?>
	 	
	 	
	</div>
	<input id="addPlace" type="button" class="btn btn-success  btn-large btn-block" value="增加新景点" />
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