<?php 
	/*
		TODO:

			0.首页也是预约列表,个人预约查询
			1.导航
			2.往数据库里增加激活码
				0.激活码存入数据库
				1.导出excel
	*/
	require 'Lib/PHPExcel.php';
	require 'Lib/PHPExcel/Writer/IWriter.php';
	require 'Lib/PHPExcel/Reader/Excel5.php';
	include 'Lib/PHPExcel/IOFactory.php';

	class AdminAction extends Action {
		 
 		public $tplname;
		public function index(){

			if(!isset($_SESSION['admin'])){
				echo "<script>window.location.href='?m=User';</script>";
			}else{
 				$this->success('正在跳转到后台...', '?m=placeControl');

			}
		}

		function activeNumber(){ 
			$aAction = A("activeNumber");
			return array("tplname" => $this -> tplname, "numberCount" => $aAction->activeNumberCount());
		}

		function placeControl(){
			$aAction = A("placeControl");
			return array();
		}

		function restList(){
			$this -> assign('tplname',$this -> tplname);
			
		}
	}
 ?>