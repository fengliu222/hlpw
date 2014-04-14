<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
 <head>
  <title>后台管理系统</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="__PUBLIC__/admin/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="__PUBLIC__/admin/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="__PUBLIC__/admin/css/main-min.css" rel="stylesheet" type="text/css" />
 </head>
 <body>

  <div class="header">
    
      <div class="dl-title">
       <!--<img src="/chinapost/Public/__PUBLIC__/admin/img/top.png">-->
      </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo ($adminname); ?></span><a href="/?m=Admin&a=logout" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
      <ul id="J_Nav"  class="nav-list ks-clear">
        		<li class="nav-item dl-selected"><div class="nav-item-inner nav-home">欢乐票务</div></li>	    

      </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
   </div>
  <script type="text/javascript" src="__PUBLIC__/admin/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/admin/js/bui-min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/admin/js/common/main-min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/admin/js/config-min.js"></script>
  <script>
    BUI.use('./__PUBLIC__/admin/js/common/main',function(){
      var config = [{id:'1',menu:[{text:'系统菜单',items:[{id:'12',text:'预约查询',href:'./?m=reserList'},{id:'6',text:'消费码管理',href:'./?m=activeNumber'},{id:'7',text:'用户管理',href:'./?m=userinfo'},{id:'8',text:'景点管理',href:'./?m=placeControl'},{id:'9',text:'数据分析',href:'./?m=usednumber'}]}]}];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>
 </body>
</html>