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
<div id="dataAna">
	<legend>数据汇总</legend>
	<div class="dataDisplay">
		<div class="date">
			<?php if($st == $ed): ?><strong>今日</strong>
			<?php else: ?>
				从
				<strong class="st">
					<?php echo ($st); ?>
				</strong>
				至
				<strong class="end">
					<?php echo ($ed); ?>
				</strong><?php endif; ?>
			数据如下：
		</div>
		<div class="datablock">
			一共有<strong><?php echo ($count); ?></strong>个订单，其中：
		</div>
		<div class="datatable">
			<table class="table table-striped"> 
				<tr>
					<td>网站名称</td>
					<td>该时间段售出</td>
					<td>该时间段生成激活码数量</td>
					<td>数据库中剩余</td>
				</tr>
				<?php if(is_array($today)): $k = 0; $__LIST__ = $today;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
						<td><?php echo ($key); ?></td>
						<td><?php echo ($vo[0]); ?>个</td>
						<td><?php echo ($vo[2]); ?>个</td>
						<td><?php echo ($vo[1]); ?>个</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</table>
		</div>
	</div>
	<div class="formwrap">
		<div class="formblock">
			<form action="?/m=usednumberAction&&a=getUsedByDays" id="qbDate" class="form-inline" role="form" method="post">
				<div class="form-group">
				    <label for="startDate">起始日期:</label>
				    <input type="button" class="form-control" id="startDate" name="startDate" value="选择起始日期">
				</div>
				<div class="form-group">
				    <label for="endDate">终止日期:</label>
				    <input type="button" class="form-control" id="endDate" name="endDate" value="选择终止日期">
				</div>
				<!-- <div class="form-group">
				    <label for="partnerSelect">选择合作网站:</label>
				    <select name="partnerSelect" id="partnerSelect" class="form-control">
				    		<option value="all">全部网站汇总查询</option>
				    	<?php if(is_array($partnerlist)): $i = 0; $__LIST__ = $partnerlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				    </select>
				</div> -->
				
			</form>

			<input type="button" class="btn btn-primary btn-lg btn-block" id="checkbtn" name="checkbtn" value="查询">
			 
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