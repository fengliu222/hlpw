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
<div id="placecontrol">
	<legend>合作商家</legend>
  
	<div class="partnerList">
		 
			<?php if(is_array($partner)): $i = 0; $__LIST__ = $partner;if( count($__LIST__)==0 ) : echo "$emtpy" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><form  class="listForm form-inline" action="./?m=partner&&a=updatePartner" method="POST">
					<input type="hidden"  name='oldname' value="<?php echo ($vo["partnername"]); ?>" />
					<div class="col-sm-5">
						<input type="text" class="form-control" name='newname' value="<?php echo ($vo["partnername"]); ?>">
					</div>
					<input type="submit" class="btn btn-default sub" value="保存修改" />
					<input type="button" name="del" class="btn btn-danger del" value="删除合作伙伴" />
				</form><?php endforeach; endif; else: echo "$emtpy" ;endif; ?>
	 	
	 	
	</div>
	<input id="addPartner" type="button" class="btn btn-success  btn-large btn-block" value="增加新合作伙伴" />
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