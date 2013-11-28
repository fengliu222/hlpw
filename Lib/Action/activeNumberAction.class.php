<?php 
	class activeNumberAction extends Action {

		public function index(){
			$placeAction = A("placeControl");
			$indexData['numberCount'] = $this -> activeNumberCount();
			$indexData['placelist'] = $placeAction -> checkOutPlaceList(true);
			$this -> assign($indexData);
			$this -> display('./Tpl/Admin/activeNumber.html');
		}
		/**
		 * 创建激活码（随机数字）
		 * @param  int $lang 激活码长度
		 * @return [type]       [description]
		 */
		
		public function createAcitiveNumber(){

			$numModel = new Model("Activenumber");
 			$resultArr = array();
 			$placename = $_GET['placename'];

 			$lang =intval($_GET['lang'], 10);

			for($k=0; $k<$lang; $k++) {

				$arrTemp = array();
				$arrTemp["placename"] = $placename;
				$arrTemp["number"] = self::randomkeys(12);
				
				$numModel -> add($arrTemp);
				array_push($resultArr, $arrTemp["number"]);
			}
			 
			$this -> ajaxReturn(1,"生成完毕！",1);
		}

		/**
		 * 生成随机数
		 * @param  [type] $length 长度
		 * @return [type]         [description]
		 */
		function randomkeys($length){
			$str = '0123456789';//字符池

			for($i=0;$i<$length;$i++) {
			   $randnum=floor(mt_rand(0,9));
			   $key=$key.$str{$randnum};//生成php随机数
			}

			return $key;
		}
		/**
		 * 剩余激活码
		 */
		public function activeNumberCount(){
			$numModel = new Model("Activenumber");
			return $numModel->count();
		}
	}
 ?>
