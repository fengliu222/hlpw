<?php 
	
	class UserAction extends Action {
		 
		public function index(){
		    if(isset($_SESSION['admin'])){
		    	  $this->success('登陆成功', '?m=Admin');
		    }else{
		    	$this -> display();
		    }
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

		public function updatePass(){
			$old = $_POST["oldpass"];
			$new = $_POST["newpass"];
			$re =  $_POST["repass"];

			$User = new Model('User');
			$usernameFromDB = $User->where('username="'.$_SESSION['admin'].'" and password="'.$old.'"')->find();

			if($usernameFromDB){
				if($new == $re){
					$data['password'] = $new;
					$User -> where('username="'.$_SESSION['admin'].'"')->save($data);
					$this -> success("密码修改成功，请重新登录！");
					if(isset($_SESSION['admin'])){
						session('admin',null);
						$this -> redirect("/?m=User");
					}
				}else{
					$this -> error("新密码两次输入不同，请重新输入",'./?m=userinfo');
				}
			}
			
		}
 
	}
 ?>