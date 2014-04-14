<?php 
	
	require_once './Lib/PHPExcel.php';       
    require_once './Lib/PHPExcel/Writer/Excel5.php'; 
	class activeNumberAction extends Action {

		public function index(){
			$placeAction = A("placeControl");
			$partnerAction = A("partner");
			$indexData['partnerlist'] = $partnerAction -> getPartner();
			$indexData['numberCount'] = $this -> activeNumberCount();
			$indexData['placelist'] = $placeAction -> checkOutPlaceList(true);
			$indexData['createdate'] = $this -> getCreateData();
			$this -> assign($indexData);
			$this -> display('./Tpl/Admin/activeNumber.html');
		}

		public function getCreateData(){
			$numModel = new Model("Activenumber");
			$tempArr = $numModel-> order("createdate desc") -> field("createdate") -> select();
			$resArr = array();
			for($key=0; $key< count($tempArr); $key++) {
				$resArr[$key] = substr($tempArr[$key]["createdate"], 0, strpos($tempArr[$key]["createdate"]," ")); 
			}
			return array_unique($resArr);
		}
		/**
		 * 创建激活码（随机数字）
		 * @param  int $lang 激活码长度
		 * @return [type]       [description]
		 */
		
		public function createAcitiveNumber(){

			$numModel = new Model("Activenumber");
			$partnerAction = A("partner");
 			$resultArr = array();
 			$placename = $_GET['placename'];
 			$partnerid = $partnerAction -> getIdByName($_GET['partnername']);
 			$lang =intval($_GET['lang'], 10);
 			
			for($k=0; $k<$lang; $k++) {

				$arrTemp = array();
				$arrTemp["placename"] = $placename;
				$arrTemp["number"] = self::randomkeys(12);
				$arrTemp["partner"] = $partnerid[0]["id"];
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
		public function activeNumberCount($partid){
			$numModel = new Model("Activenumber");
			if(!$partid)
				return $numModel->count();
			else
				return $numModel->where("partner='".$partid."'")->count();
		}

		/**
		 * 导出激活码到excel
		 */
		public function exports(){
			$numModel = new Model("Activenumber");
			$excelAction = A("excel");
            $place = $_GET['place'];
            $date = $_GET['date'];
            $data = $numModel ->where("placename='".$place."' AND createdate like '".$date."%'")-> order("id desc") -> select();

            $obj_phpexcel = new PHPExcel();
           
            if($data){
                $i =1;
                foreach ($data as $key => $value) {
                    $obj_phpexcel-> getActiveSheet()->setCellValue('a'.$i,$value['number']." ");
                    $i++;
                }
            }else{
            	$this->error('当日没有生成激活码');
            }    

            $excelAction -> export_data($obj_phpexcel);

		}
		public function queryNumberCountByPartnerIdAndDays($start,$end,$partner){
			$numModel = new Model("Activenumber");
			$st = $start;
			$ed = $end;
			$sqlWhere = 'createdate>str_to_date("'.$st.'","%Y-%m-%d %H:%i:%s") and createdate<str_to_date("'.$ed.'","%Y-%m-%d %H:%i:%s") and partner="'.$partner.'"';
			$data = $numModel ->where($sqlWhere) -> count();
			return $data;
		}
		public function getPartnerNameByActiveNumber($num){
			$actM = new Model("usednumber");
			$partA = A("partner");

			$numInfo = $actM -> where("number='".$num."'") -> find();
			
			if($numInfo){
				$pId = $numInfo["partner"];
				$pname = $partA -> getNameById($pId);
				return $pname[0]['name'];
			}else{
				return false;
			}
		}

	}
 ?>
