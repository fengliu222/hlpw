<?php

class IndexAction extends CommonAction {
 

    public function index(){
    	$placemodel = A("placeControl");
    	$indexdata['placelist'] = $placemodel -> checkOutPlaceList(true);
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
		 			$arr = array("激活码验证错误，请重新输入！",false);
		 			$this -> ajaxReturn($arr,'JSON');
		 			return false;
		 		}

		 	}
		 	$infoTemp = array($_POST["userName"], $_POST["userTel"], $_POST["userIDCard"], $_POST["ariDate"], count($newActive), $newActive, $_POST["place"]);
		 	cache('infoTemp',$infoTemp);
 
		 	$this -> ajaxReturn([$infoTemp,true],'JSON');
	}


	/**
     * 将预约写入数据库
     */
    public function saveBuy(){
    	/*写入数据库*/
		$reservation = new Model("reservationlist");
		$usedAct = A("usednumber");
		$infoTemp = cache('infoTemp');
 		 
		$resData['name'] = $infoTemp[0];
		$resData['tel'] =  $infoTemp[1];
		$resData['idcard'] =  $infoTemp[2];
		$resData['playdate'] =  $infoTemp[3];
		$resData['playercount'] =  $infoTemp[4];
		$resData['playerid'] =  implode(",",$infoTemp[5]);	
		$resData['place'] =  $infoTemp[6];

		for($i=0; $i<count( $infoTemp[5] ); $i++){
	  		
	 		if(self::checkActiveExist( $infoTemp[5][$i])){
	 			if($usedAct -> addUsed($infoTemp[5][$i])){
	 		    	self::deleActivityNumber($infoTemp[5][$i]);
	 			}else{
	 				$this -> ajaxReturn(array("msg"=>"服务器出错，请重新提交预约！"),"JSON");
	 				return false;
	 			}
	 		}else{
	 			$this -> ajaxReturn(array("msg"=>"提交信息有误！"),"JSON");
	 			return false;
	 		}
	 	}	

		$reservation->add($resData);
		$this -> ajaxReturn(array("msg"=>"预约成功！"),"JSON");
    }

	/**
	 * 检测激活码处理逻辑
	 * @return [type] [description]
	 */
	
	public function checkActive(){
		$activeNum = $_POST["fieldValue"];
		$ifExistNumber = self::checkActiveExist($activeNum);
		
		if($ifExistNumber){
			$this -> ajaxReturn(array($_POST["fieldId"],true),'JSON');
		}else{
			$this -> ajaxReturn(array($_POST["fieldId"],false),'JSON');
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
?>