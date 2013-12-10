<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html  lang="zh-CN">
	<head>
		<title>欢乐票务后台管理系统</title>
		<link rel="stylesheet" href="__CSS__bootstrap.css">
		<link rel="stylesheet" href="__CSS__admin.css">
		 
 
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
	    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>
		<div id="main">
			<div id="header" >
				<h2 class="container">欢乐票务后台管理系统</h2>
			</div>
			<div id="content" class="container">
				<div class="row">
					<div id="aside" class="col-md-2">
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
					<div id="article" class="col-md-9">
<div class="createNumber">
	<legend>生成消费码</legend>
	<form class="form-horizontal">

	  <div class="form-group">
	  	<label class="col-sm-2 control-label" for="placename">地点选择：</label>
	  		<div class="col-sm-8">
			  	<select name="placename" id="placename" class="form-control placeselect">
				  	<?php if(is_array($placelist)): $i = 0; $__LIST__ = $placelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["placename"]); ?>"><?php echo ($vo["placename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			  	</select>
		  	</div>
	  </div>	

	  <div class="form-group">
	     
	    	<label class="col-sm-2 control-label" for="lang">生成数量：</label>
	    	<div class="col-sm-8">
		    	<input name="lang" class="form-control createCount" type="text" value=" " />
		    </div>
		    	
	  </div>
	  <div class="form-group">
	   <div class="col-sm-offset-2 col-sm-10">
	   	<button  id="subLang" class="btn btn-default" name="subLang" type="button" />生成</button>
			<button  id="exportNum" name="exportNum" class="btn btn-default" type="button">导出为excel</button>
	   </div>
	  		
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