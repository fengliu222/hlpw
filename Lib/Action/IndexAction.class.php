<?php

class IndexAction extends CommonAction {
	var $infoTemp;

    public function index(){
    	$placemodel = A("placeControl");

    	$indexdata['placelist'] = $placemodel -> checkOutPlaceList(true);
    	ChromePHP::log($indexdata);
    	$this->assign($indexdata);
		$this->display();
	}

	/**
	 * 用户点击提交预定
	 * @return [type] [description]
	 */
	public function formFormat(){

			$newActive = self::activeUqique($_POST);
	 	
		 	// 格式化表单信息前校验消费码正确性
		 	for($i=0; $i<count($newActive); $i++){
		  
		 		if(!self::checkActiveExist($newActive[$i])){
		 			$this -> ajaxReturn(["激活码验证错误，请重新输入！",false],'JSON');
		 			return false;
		 		}
		 	}
		 	 
		 	$this -> $infoTemp = [$_POST["userName"], $_POST["userTel"], $_POST["userIDCard"], $_POST["ariDate"], count($newActive), $newActive];
		 	$this -> ajaxReturn([$this->$infoTemp,true],'JSON');
	}


	/**
     * 将预约写入数据库
     */
    public function saveBuy(){
    	/*写入数据库*/
		$reservation = new Model("reservationlist");
		//  'name', 'tel','idcard','playdate','playercount','playerid'
	 	ChromePHP::log($_POST);
		$resData['name'] = $_POST['name'];
		$resData['tel'] =  $_POST['tel'];
		$resData['idcard'] =  $_POST['idcard'];
		$resData['playdate'] =  $_POST['playdate'];
		$resData['playercount'] =  $_POST['playercount'];
		$resData['playerid'] =  implode(",",$_POST['playerid']) ;	

		

		for($i=0; $i<count( $_POST['playerid'] ); $i++){
	  		
	 		if(self::checkActiveExist( $_POST['playerid'][$i])){
	 			self::deleActivityNumber( $_POST['playerid'][$i]);
	 		}else{
	 			$this -> ajaxReturn(["msg"=>"提交信息有误！"],"JSON");
	 			return false;
	 		}
	 	}	

		$reservation->add($resData);
		$this -> ajaxReturn(["msg"=>"预约成功！"],"JSON");
    }

	/**
	 * 检测激活码处理逻辑
	 * @return [type] [description]
	 */
	
	public function checkActive(){
		$activeNum = $_POST["fieldValue"];
		$ifExistNumber = self::checkActiveExist($activeNum);
		
		if($ifExistNumber){
			$this -> ajaxReturn([$_POST["fieldId"],true],'JSON');
		}else{
			$this -> ajaxReturn([$_POST["fieldId"],false],'JSON');
		}

	}
	/**
	 * 激活码去重
	 * @param  Array $data 原始激活码数组
	 * @return Array       去重后激活码数组
	 */
	
	function activeUqique($data){
		$actives = array();
		foreach($data as $key => $value){
			if(ereg("^passNumber_", $key)){
				array_push($actives, $value);
			}
		} 

		$newActive = array_unique($actives);
		return $newActive;
	}

	/**
	 * 检测激活码是否存在
	 * @param  [type] $activeNum [description]
	 * @return [type]            [description]
	 */
	
	function checkActiveExist($activeNum){
		$Number = new Model("Activenumber");
    	$res = $Number->where("number='".$activeNum."'") -> find();
    	return $res;
    }

    /**
     * 删除激活码表中的相应激活码
     */
    
    function deleActivityNumber($activeNum){
    	$Number = new Model("Activenumber");
    	$res = $Number->where("number='".$activeNum."'") -> delete();
    	return $res;
    }

    
}