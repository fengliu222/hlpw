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
<div class="createNumber">
	<legend>生成消费码</legend>
	<form class="form-horizontal" method="post" action="#" >

	  <div class="form-group">
	  	<label class="col-sm-2 control-label" for="placename">地点选择：</label>
	  		<div class="col-sm-8">
			  	<select name="placename" id="placename" class="form-control placeselect">
				  	<?php if(is_array($placelist)): $i = 0; $__LIST__ = $placelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["placename"]); ?>"><?php echo ($vo["placename"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			  	</select>
		  	</div>
	  </div>
	  <div class="form-group">
	    	<label class="col-sm-2 control-label" for="lang">指定合作网站：</label>
	    	<div class="col-sm-5">
		    	<select name="partner" id="partner" class="form-control partnerSelect">
				  	<?php if(is_array($partnerlist)): $i = 0; $__LIST__ = $partnerlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			  	</select>
			  	<input type="text" name="newSiteName" class="form-control newSiteName">
		    </div>
		    <div class="col-sm-1">
		    	<input type="button" class="btn btn-default addSite" value="添加站点" /> 
		    </div>
		    <div class="col-sm-1">
		    	<input type="button"  class="btn btn-default removeSite" value="删除当前站点" /> 
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
			<input type="text" id="activeDate" placeholder = "生成日期，不填全部导出">
		  </div>
	  </div>
	</form>
	  <div>
	  	还有<strong><?php echo ($numberCount); ?></strong>个消费码还未被使用过的。
	  </div>
	  <div>
	  	<strong>曾在以下日期生成过消费码：</strong>
	  </div>
	 <?php if(is_array($createdate)): $i = 0; $__LIST__ = $createdate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="cdlist"><?php echo ($vo); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
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