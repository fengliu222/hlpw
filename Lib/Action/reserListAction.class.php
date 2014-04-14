<?php 
	require_once './Lib/PHPExcel.php';       
    require_once './Lib/PHPExcel/Writer/Excel5.php'; 
	class reserListAction extends Action {

		public static $resCache;
		public function index(){
			$placemodel = A("placeControl");
	    	$indexdata['placelist'] = $placemodel -> checkOutPlaceList(true);
	    	$this->assign($indexdata);
			$this -> display('./Tpl/Admin/reserList.html');
		}

		public function ajaxQueryList(){
			$actA = A("activeNumber");
			$usedA = A("usednumber");
			$listModel = M("reservationlist");
			$place = $_GET['place'];
			$queryData = $_GET['data'];
			$queryBy = $_GET['queryBy'];

			if($queryBy != "all"){
				$map[$queryBy] = array('like binary', "%".$queryData."%");
			}else{
				$map["name|tel|idcard|playdate|playerid|place|createdate"] = array('like binary', "%".$queryData."%");
			}
			
			$map["place"] = $place;
   		 	
			$res = $listModel -> where($map) -> order('playdate desc')->select();
			for($key = 0; $key < count($res) ;$key++){
				$numbers = split(",",$res[$key]["playerid"]);
				for($j = 0; $j < count($numbers);$j++){
					$partname = $actA -> getPartnerNameByActiveNumber($numbers[$j]);
					$res[$key]["from"][$j] = $partname;
					$dataStatis[$partname] > 0 ? $dataStatis[$partname]++ : $dataStatis[$partname] = 1; 
				}
			}	
			cache('resCache',$res);	
			cache('dataStatis',$dataStatis);	
			if($res){
				$this -> ajaxReturn(1,array($res,$dataStatis),1);
			}else{
				$this -> ajaxReturn(0,array($res,$dataStatis),0);
			}

		}

		public function exportsExc(){
			$resCache = cache('resCache');
			$dataStatis = cache('dataStatis');
			if(!$resCache){
				$res = "error!";
				$this -> ajaxReturn(0,$res,0);
			}else{
	            $excelAction = A("excel");
	            $obj_phpexcel = new PHPExcel();
	            $data = $resCache;
                $i =2;
       
                $obj_phpexcel->getActiveSheet()->getColumnDimension("A")->setWidth(10);  
				$obj_phpexcel->getActiveSheet()->getColumnDimension("B")->setWidth(14);  
				$obj_phpexcel->getActiveSheet()->getColumnDimension("C")->setWidth(20);  
				$obj_phpexcel->getActiveSheet()->getColumnDimension("D")->setWidth(12);  
				$obj_phpexcel->getActiveSheet()->getColumnDimension("E")->setWidth(16);  
				$obj_phpexcel->getActiveSheet()->getColumnDimension("F")->setWidth(24);  
				$obj_phpexcel->getActiveSheet()->getColumnDimension("G")->setWidth(12);  
				$obj_phpexcel->getActiveSheet()->getColumnDimension("H")->setWidth(21);  
				$obj_phpexcel->getActiveSheet()->getColumnDimension("I")->setWidth(21);  

                $obj_phpexcel -> getActiveSheet()
                   ->setCellValue('A1',"姓名")
                   ->setCellValue('B1',"电话")
                   ->setCellValue('C1',"身份证号")
                   ->setCellValue('D1',"预约人数")
                   ->setCellValue('E1',"预约地点")
                   ->setCellValue('F1',"预约码")
                   ->setCellValue('G1',"来自")
                   ->setCellValue('H1',"游玩时间")
                   ->setCellValue('I1',"提交时间");
                foreach ($data as $key => $value) {
                    $obj_phpexcel-> getActiveSheet()->setCellValue('A'.$i,$value['name']." ");
                    $obj_phpexcel-> getActiveSheet()->setCellValue('B'.$i,$value['tel']." ");
                    $obj_phpexcel-> getActiveSheet()->setCellValue('C'.$i,$value['idcard']." ");
                    $obj_phpexcel-> getActiveSheet()->setCellValue('D'.$i,$value['playercount']." ");
                    $obj_phpexcel-> getActiveSheet()->setCellValue('E'.$i,$value['place']." ");
                    $obj_phpexcel-> getActiveSheet()->setCellValue('F'.$i,$value['playerid']." ");
                    $obj_phpexcel-> getActiveSheet()->setCellValue('G'.$i,join(",",$value['from'])." ");
                    $obj_phpexcel-> getActiveSheet()->setCellValue('H'.$i,$value['playdate']." ");
                    $obj_phpexcel-> getActiveSheet()->setCellValue('I'.$i,$value['createdate']." ");

                    $i++;
                }
                foreach ($dataStatis as $key => $value) {
	                $obj_phpexcel-> getActiveSheet()->setCellValue('A'.$i,$key.":");
	                $obj_phpexcel-> getActiveSheet()->setCellValue('B'.$i,$value);
	                $i++;
	            }
	            $excelAction -> export_data($obj_phpexcel);
			}
		}
	}
?>