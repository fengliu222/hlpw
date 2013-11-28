<?php if (!defined('THINK_PATH')) exit();?><html>

<head>
    <title>欢乐票务网--北京欢乐谷在线订票|欢乐谷|北京欢乐谷</title>
    <meta charset='utf-8'>
    <meta Keywords='欢乐谷在线订票,欢乐谷门票,北京欢乐谷门票预订,北京欢乐谷,欢乐谷票务'>
    <script src="common/js/jquery-1.7.2.min.js"></script>
    <script src="common/js/bootstrap.min.js"></script>
    <script src="common/js/jquery.validationEngine-zh_CN.js"></script>
    <script src="common/js/jquery.validationEngine.min.js"></script>
    <script src="common/js/date/jquery.datepick.js"></script>
    <script src="common/js/date/jquery.datepick-zh-CN.js"></script>
    <script src="common/js/common.js"></script>
    <link rel="stylesheet" href="common/css/bootstrap.min.css">
    <link rel="stylesheet" href="common/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="common/css/validationEngine.jquery.css">
    <link rel="stylesheet" href="common/css/common.css">
    <link rel="stylesheet" href="common/js/date/jquery.datepick.css">

</head>

<body>
    <div id="main" class='container'>
        <div id="header"></div>
        <div id="content">
            <!-- 
					表单内容：
						门票名称
						取票人姓名
						取票人手机
						确认手机
						身份证
						出游日期（提示有效期）
						 
						消费码
						验证码
						
						验证逻辑：
							unfoucs验证，消费码ajax验证。

					每一个control-group都可以在验证失败的时候再加一个error的class,然后在Input后面加一个class为help-inline的span
				  -->
            <div class="formBlock">
                <form action="index.php" method="POST" class="form-horizontal" id="theForm">
                    <div class="control-group">
                        <lable class="control-label">门票名称</lable>
                        <div class="controls">
                            <select id='parkName'>
                                <option>北京欢乐谷</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <lable class="control-label" for="userName">
                            <span class="require">*</span>取票人姓名</lable>
                        <div class="controls">
                            <input name="userName" id="userName" class="input-xlarge validate[required]" required type="text" placeholder="姓名">
                        </div>

                    </div>
                    <div class="control-group">

                        <lable class="control-label" for="userTel">
                            <span class="require">*</span>取票人手机</lable>
                        <div class="controls">
                            <input name="userTel" id="userTel" class="input-xlarge validate[required,custom[phone]]" required type="text">
                        </div>
                    </div>
                    <div class="control-group">

                        <lable class="control-label" for="telConfirm">
                            <span class="require">*</span>取票人手机确认</lable>
                        <div class="controls">
                            <input name="telConfirm" id="telConfirm" class="input-xlarge validate[required,equals[userTel]]" required type="text" placeholder="重新输入一遍手机号码">
                        </div>
                    </div>
                    <div class="control-group">

                        <lable class="control-label" for="userIDCard">
                            <span class="require">*</span>身份证</lable>
                        <div class="controls">
                            <input name="userIDCard" id="userIDCard" class="input-xlarge validate[required,chinaIdLoose]" required type="text">
                        </div>
                    </div>
                    <div class="control-group">

                        <lable class="control-label" for="ariDate">
                            <span class="require">*</span>出游日期</lable>
                        <div class="controls">
                            <input id="ariDate" name="ariDate" class="input-xlarge validate[required]" required type="text">
                        </div>
                    </div>
                    <div class="control-group passBlock_0">

                        <lable class="control-label" for="passNumber_0">
                            <span class="require">*</span>消费码</lable>
                        <div class="controls">
                            <div class="input-append">
                                <input name="passNumber_0" id="passNumber_0" class="input-xlarge validate[required]" required type="text" maxlength="12">
                                <button class="btn" type="button">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">

                        <lable class="control-label">
                            <span class="require">*</span>验证码</lable>
                        <div class="controls">
                            <input class="input-xlarge validate[required]" id="yzmInput" required type="text">
                            <div class="yzm"></div>
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
        <div class="clear"></div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#ariDate').datepick({
            dateFormat: 'yy-mm-dd'
        });
    });
    </script>
</body>

</html>