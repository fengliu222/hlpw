<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html  lang="zh-CN">

<head>
    <title>欢乐票务网--北京欢乐谷在线订票|欢乐谷|北京欢乐谷</title>
    <meta charset='utf-8'>
    <meta Keywords='欢乐谷在线订票,欢乐谷门票,北京欢乐谷门票预订,北京欢乐谷,欢乐谷票务'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <link rel="stylesheet" href="common/css/bootstrap.min.css">
 
    <link rel="stylesheet" href="common/css/common.css">
    <link rel="stylesheet" href="common/css/index.css">
    <link rel="stylesheet" href="common/js/date/jquery.datepick.css">
    <link rel="stylesheet" href="common/css/validationEngine.jquery.css">
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div id="main" class='container'>
        <div id="header"></div>
        <div id="inputForm" class="content">
            <div class="formBlock">
                <form action="?m=Index&&a=buy" method="POST" class="form-horizontal" id="theForm"  role="form">
                    <div id="scrollContent" class=''>
                        <div class="form-group">
                            <div class="col-lg-3 control-label">
                                <lable>门票名称</lable>
                            </div>
                            
                            <div class="col-lg-6">
                                    <select id='parkName'  class="form-control">
                                        <?php if(is_array($placelist)): $i = 0; $__LIST__ = $placelist;if( count($__LIST__)==0 ) : echo "空" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["placename"]); ?>"><?php echo ($vo["placename"]); ?></option><?php endforeach; endif; else: echo "空" ;endif; ?>
                                    </select>
                            </div>

                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-3 control-label">
                                <lable for="userName"> 
                                    <span class="require">*</span>取票人姓名</lable>
                            </div>
                            <div class="col-sm-6">
                                <input name="userName" id="userName" class="form-control validate[required]"  type="text" placeholder="姓名">
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 control-label">
                                <lable for="userTel">
                                    <span class="require">*</span>取票人手机</lable>
                            </div>
                            <div class="col-sm-6">
                                <input name="userTel" id="userTel" class="form-control validate[required,custom[phone]]" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 control-label">
                                <lable for="telConfirm">
                                <span class="require">*</span>取票人手机确认</lable>
                            </div>
                            <div class="col-sm-6">
                                <input name="telConfirm" id="telConfirm" class="form-control validate[required,equals[userTel]]" type="text" placeholder="重新输入一遍手机号码">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 control-label">
                                <lable for="userIDCard">
                                <span class="require">*</span>身份证</lable>
                            </div>
                           
                            <div class="col-sm-6">
                                <input name="userIDCard" id="userIDCard" class="form-control validate[required,chinaIdLoose]" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                             <div class="col-lg-3 control-label">
                                <lable for="ariDate">
                                <span class="require">*</span>出游日期</lable>
                            </div>
                            <div class="col-sm-6">
                                <input id="ariDate" name="ariDate" class="form-control validate[required]" type="text">
                            </div>
                        </div>
                        <div class="form-group passBlock">
                            <div class="col-lg-3 control-label">
                               <lable for="passNumber_0">
                                <span class="require">*</span>消费码</lable>
                            </div>
                            
                            <div class="col-sm-6 activeWrap">
                                <div class="input-append">
                                    <input  name="passNumber_0"
                                            id="passNumber_0" 
                                            class="activeNumber form-control validate[custom[yanzhengma12],ajax[ajaxActive]]" 
                                            data-errormessage-custom-error="消费码为您购买时提供的十二位数字。"  
                                            type="text" 
                                            maxlength="12">
                                    <button class="btn addYZM" type="button">+</button>
                                    <img class="ifIcon" src="" />
                                </div>
                            </div>
                        </div>
     
                    </div>
                    <div class="form-actions">
                        <button type="submit" id="subButton" class="btn btn-primary">提交预订</button>
                        <button type="button" id="reset" class="btn">重置</button>
                        <div id='message'></div>
                    </div>
                </form>
            </div>


        </div>
       
        <div id="confirmForm" class="content dn">
            <div class="confirmWrap">
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            表单信息确认（请务必认真核对您的信息）
                        </tr> 
                    </thead>
                    <tbody>
                        <tr>
                            <td>姓名：</td>
                            <td id="confirmName"></td>
                        </tr>
                        <tr>
                            <td>联系方式：</td>
                            <td id="confirmTel"></td>
                        </tr>
                         <tr>
                            <td>身份证号码：</td>
                            <td id="confirmID"></td>
                        </tr>
                        <tr>
                            <td>出游日期：</td>
                            <td id="confirmDate"></td>
                        </tr>
                        <tr>
                            <td>出游人数：</td>
                            <td id="confirmCount"></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" id="doConfirm" class="btn btn-primary">确认提交</button>
                <button type="button" id="reConfirm" class="btn">返回重新填写</button>
            </div>
        </div>
         <div class="clear"></div>
    </div>
</body>
<script src="common/js/jquery-1.7.2.min.js"></script>
<script src="common/js/bootstrap.min.js"></script>
<script src="common/js/bootstrap-ie.js"></script>
<script src="common/js/jquery.validationEngine-zh_CN.js"></script>
<script src="common/js/jquery.validationEngine.min.js"></script>
<script src="common/js/date/jquery.datepick.js"></script>
<script src="common/js/date/jquery.datepick-zh-CN.js"></script>
<script src="common/js/index.js"></script>

</html>