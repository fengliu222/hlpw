<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<title>欢乐票务后台管理系统</title>
		<link rel="stylesheet" href="__CSS__bootstrap.css">
		<link rel="stylesheet" href="__CSS__admin.css">
			<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
			<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
			<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
			<!--[if (gte IE 9)|!(IE)]><!-->
			<html class="not-ie" lang="en">
			<!--<![endif]-->
		<!--[if IE]>
		   <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
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
<div class="createNumber">
	<legend>生成消费码</legend>
	<form class="form-horizontal">
	  <div class="control-group">
	  	<label class="control-label" for="placename">地点选择：</label>
		  	<select name="placename" id="placename" class="placeselect">
			  	<?php if(is_array($placelist)): $i = 0; $__LIST__ = $placelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["placename"]); ?>"><?php echo ($vo["placename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		  	</select>
	  </div>	
	  <div class="control-group">
	     
	    	<label class="control-label" for="lang">生成数量：</label>
	    	<input name="lang" type="text" value=" " />
	    	<input id="subLang" class="btn" name="subLang" type="button" value="生成"/>
			<input id="exportNum" name="exportNum" class="btn" type="button" value="导出为excel" onclick="window.location.href='?m=activeNumber&&a=exportExcel'" />
	    
	  </div>
	</form>
	  <div>
	  	还有<strong><?php echo ($numberCount); ?></strong>个消费码还未被使用过的。
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