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
<div id="reservationList" class="container">
	<legend>预约查询</legend>
	<div class="form-inline">
		<div class="placeSelector">
			<select class='form-control' name="place" id="rl-place">
				 <?php if(is_array($placelist)): $i = 0; $__LIST__ = $placelist;if( count($__LIST__)==0 ) : echo "空" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["placename"]); ?>"><?php echo ($vo["placename"]); ?></option><?php endforeach; endif; else: echo "空" ;endif; ?>
			</select>
			<label for="queryBy">
				查询依据：
			</label>
			<select class='form-control' name="queryBy" id="rl-queryBy">
				<option value="all">模糊查询</option>
				<option value="createdate">订单时间</option>
				<option value="playdate">出行时间</option>
			</select>
			<label for="queryInput">
				关键字：
			</label>
			<input type="text" class='form-control queryInput' name="queryInput" placeholder="请输入查询条件（姓名、身份证号、时间、消费码、手机号）"><button type="button" class="btn btn-default query" >查询</button>
			<button type="button" class="btn btn-default exports" >导出为Excel</button>
		</div>
 
		<div class="clear"></div>
	</div>
	<div class="row">
		<div class="resTable col-sm-12">
			<table class="table table-striped" id="reserList">
				

			</table>
		</div>
	</div>
	<div class="row">
		 
		<div class="statisblock col-sm-12">
			 
		</div>
	</div>
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