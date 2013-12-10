<?php 
	class reserListAction extends Action {
		public function index(){
			$placemodel = A("placeControl");
	    	$indexdata['placelist'] = $placemodel -> checkOutPlaceList(true);
	    	$this->assign($indexdata);
			$this -> display('./Tpl/Admin/reserList.html');
		}

		public function ajaxQueryList(){
			
			$listModel = M("reservationlist");
			$place = $_GET['place'];
			$queryData = $_GET['data'];

			$map["name|tel|idcard|playdate|playerid|place|createdate"] = array('like binary', "%".$queryData."%");
			$map["place"] = $place;
			// "1271:Illegal mix of collations for operation 'like'
   		 
			$res = $listModel -> where($map) -> order('playdate desc')->select();
			ChromePHP::log($listModel); 
			if($res){
				$this -> ajaxReturn(1,$res,1);
			}else{
				$this -> ajaxReturn(0,$res,0);
			}

		}
	}
?>