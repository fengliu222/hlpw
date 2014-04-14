<?php 
 
	require 'Lib/PHPExcel.php';
	require 'Lib/PHPExcel/Writer/IWriter.php';
	require 'Lib/PHPExcel/Reader/Excel5.php';
	include 'Lib/PHPExcel/IOFactory.php';

	class AdminAction extends Action {
		 
 		public $tplname;
		public function index(){

			if(!isset($_SESSION['admin'])){
				$this -> redirect('/?m=User');
			}else{
				$this -> assign('adminname',$_SESSION['admin']);
				$this -> display('./Tpl/Admin/temp/index.html');
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

		function logout(){
			if(isset($_SESSION['admin'])){
				session('admin',null);
				$this -> redirect("/?m=User");
			}
		}
	}
 ?>