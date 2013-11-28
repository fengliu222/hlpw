<?php if (!defined('THINK_PATH')) exit();?><html>

<head>
    <title>欢乐票务网--北京欢乐谷在线订票|欢乐谷|北京欢乐谷</title>
    <meta charset='utf-8'>
    <meta Keywords='欢乐谷在线订票,欢乐谷门票,北京欢乐谷门票预订,北京欢乐谷,欢乐谷票务'>
    <!--[if lte IE 6]> 
    <link rel="stylesheet" href="common/css/bootstrap-ie6.min.css">
    <link rel="stylesheet" href="common/css/ie.css">
    <![endif]-->
    <link rel="stylesheet" href="common/css/bootstrap.min.css">
 
    <link rel="stylesheet" href="common/css/common.css">
    <link rel="stylesheet" href="common/css/index.css">
    <link rel="stylesheet" href="common/js/date/jquery.datepick.css">
     <link rel="stylesheet" href="common/css/validationEngine.jquery.css">
</head>

<body>
    <div id="main" class='container'>
        <div id="header"></div>
        <div id="inputForm" class="content">
            <div class="formBlock">
                <form action="?m=Index&&a=buy" method="POST" class="form-horizontal" id="theForm">
                    <div id="scrollContent">
                    <div class="control-group">
                        <lable class="control-label">门票名称</lable>
                        <div class="controls">
                                <select id='parkName'>
                                    <?php if(is_array($placelist)): $i = 0; $__LIST__ = $placelist;if( count($__LIST__)==0 ) : echo "空" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["placename"]); ?>"><?php echo ($vo["placename"]); ?></option><?php endforeach; endif; else: echo "空" ;endif; ?>
                                </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <lable class="control-label" for="userName"> 
                            <span class="require">*</span>取票人姓名</lable>
                        <div class="controls">
                            <input name="userName" id="userName" class="input-xlarge validate[required]"  type="text" placeholder="姓名">
                        </div>

                    </div>
                    <div class="control-group">

                        <lable class="control-label" for="userTel">
                            <span class="require">*</span>取票人手机</lable>
                        <div class="controls">
                            <input name="userTel" id="userTel" class="input-xlarge validate[required,custom[phone]]" type="text">
                        </div>
                    </div>
                    <div class="control-group">

                        <lable class="control-label" for="telConfirm">
                            <span class="require">*</span>取票人手机确认</lable>
                        <div class="controls">
                            <input name="telConfirm" id="telConfirm" class="input-xlarge validate[required,equals[userTel]]" type="text" placeholder="重新输入一遍手机号码">
                        </div>
                    </div>
                    <div class="control-group">

                        <lable class="control-label" for="userIDCard">
                            <span class="require">*</span>身份证</lable>
                        <div class="controls">
                            <input name="userIDCard" id="userIDCard" class="input-xlarge validate[required,chinaIdLoose]" type="text">
                        </div>
                    </div>
                    <div class="control-group">

                        <lable class="control-label" for="ariDate">
                            <span class="require">*</span>出游日期</lable>
                        <div class="controls">
                            <input id="ariDate" name="ariDate" class="input-xlarge validate[required]" type="text">
                        </div>
                    </div>
                    <div class="control-group passBlock">

                        <lable class="control-label" for="passNumber_0">
                            <span class="require">*</span>消费码</lable>
                        <div class="controls activeWrap">
                            <div class="input-append">
                                <input  name="passNumber_0"
                                        id="passNumber_0" 
                                        class="activeNumber input-xlarge validate[custom[yanzhengma12],ajax[ajaxActive]]" 
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