<?php 
	
	/*
		TODO:
			0.创建数据库的SQL语句集...done
			1.用户登录...done
			2.管理界面
				0.首页也是预约列表
				1.个人预约查询
				2.增加预约
				3.往数据库里增加激活码
					0.激活码存入数据库
					1.导出excel
	*/
	class UserAction extends Action {
		 
		public function index(){
			 
		    if(isset($_SESSION['admin'])){
		    	  $this->success('登陆成功', '?m=Admin');

		    }
 
			$this -> display();
 
		}
		public function adminLogin(){
			$User = new Model('User');
			$usernameFromDB = $User->where('username="'.$_POST['account'].'"')->find();
		  
		 	if($usernameFromDB && $_POST['pass'] == $usernameFromDB['password']){
		 		$_SESSION['admin'] = $_POST['account'];	//存session
		 		if($_POST['openCookie'] == 'on') $_COOKIE['admin'] = $_POST['account']; //下次自动登陆
		 	 	$this->ajaxReturn(1,'success',1);
 
		 	}else{
		 		echo '0';
		 	}
		}
	}
 ?>