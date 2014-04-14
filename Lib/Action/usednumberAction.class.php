<?php 
	class usednumberAction extends Action {
		public function index(){
			$partnerAction = A("partner");
			$indexData['partnerlist'] = $partnerAction -> getPartner();
			$indexData['today'] = self::getUsedByDays(date("Y-m-d"),date("Y-m-d"));
			$indexData['st'] = date("Y-m-d");
			$indexData['ed'] = date("Y-m-d");
			$indexData['count'] = count($indexData['today']);

			$this -> assign($indexData);
			$this -> display('Admin/dataAna');
		}
		public function addUsed($num){
			$numberModel= new Model("Activenumber");
			$usedModel = M("usednumber");
			$tarData = $numberModel -> where("number='".$num."'") -> select();
			
			if($tarData[0]){
				$curData['createdate'] = $tarData[0]['createdate'];
				$curData['placename'] = $tarData[0]['placename'];
				$curData['number']= $tarData[0]['number'];
				$curData['partner']= $tarData[0]['partner'];

				$usedModel -> add($curData);
				return true;
			}else{
				return false;
			}
		}
		public function doQuery(){
			$st = $_GET['start'];
			$ed = $_GET['end'];
			$indexData['today'] = self::getUsedByDays($st,$ed);
			$indexData['st'] = $st;
			$indexData['ed'] = $ed;
			$indexData['count'] = count($indexData['today']);
			$this -> assign($indexData);
			$html = $this -> fetch('Admin/dataAna');
			$this -> ajaxReturn(1,$html,1);
		}
		/**
		 * 查询指定网站已成功预约的消费码的个数
		 * @param  [type] $partnerid [description]
		 * @return [type]            [description]
		 */
		public function getUsedByPartner($partnerid){
			return 0;
		}

		/**
		 * 查询指定日期已成功预约的消费码的个数
		 * @param  [type] $date [description]
		 * @return [type]       [description]
		 */
		public function getUsedByDate($date){
			return 0;
		}

		/**
		 * 查询指定日期和指定网站已成功预约的消费码个数
		 * @param  [type] $date      [description]
		 * @param  [type] $partnerid [description]
		 * @return [type]            [description]
		 */
		public function getUsedByDateAndPartner($date,$partnerid){
			return 0;
		}

		/**
		 * 指定时间段内成功预约的消费码个数和生成的消费码个数
		 * @param  [type] $startdate [description]
		 * @param  [type] $enddate   [description]
		 * @return [type]            [description]
		 */
		public function getUsedByDays($startdate,$enddate){
			$numberModel =  new Model("Activenumber");
			$numberAct = A("activeNumber");
			$usedModel = M("usednumber");
			$partnerAct = A("partner");

			$st = $startdate." 00:00:00";
			$ed = $enddate." 23:59:59";
			$sqlWhere = 'useddate>str_to_date("'.$st.'","%Y-%m-%d %H:%i:%s") and useddate<str_to_date("'.$ed.'","%Y-%m-%d %H:%i:%s")';
			$allUsed = $usedModel -> where($sqlWhere) -> field("partner") ->select();
			$data = array();
			for($i=0,$l=count($allUsed);$i<$l;$i++){
				$partarr = $partnerAct -> getNameById($allUsed[$i]['partner']);
				$partname = $partarr[0]['name'];
				$salecount = $data[$partname][0] ? ++$data[$partname][0] : 1;
				$remindcount = $data[$partname][1] ? $data[$partname][1] : $numberAct->activeNumberCount($allUsed[$i]['partner']);
				$createcount  = $data[$partname][2] ? $data[$partname][2] : ($numberAct->queryNumberCountByPartnerIdAndDays($st,$ed,$allUsed[$i]['partner'])+self::getUsedByDaysAndPartner($st,$ed,$allUsed[$i]['partner']));
				$data[$partname] = array($salecount,$remindcount,$createcount);
				 
				ChromePHP::log(self::getUsedByDaysAndPartner($st,$ed,$allUsed[$i]['partner']));
			}
			return $data;
			
		}

		/**
		 * 指定时间段内在某家网站成功预约的个数
		 * @param  [type] $startdate [description]
		 * @param  [type] $enddate   [description]
		 * @param  [type] $partnerid [description]
		 * @return [type]            [description]
		 */
	 
		public function getUsedByDaysAndPartner($startdate,$enddate,$partnerid){
			$numberModel =  new Model("Activenumber");
			$numberAct = A("activeNumber");
			$usedModel = M("usednumber");
			$partnerAct = A("partner");

			$st = $startdate;
			$ed = $enddate;
			$sqlWhere = 'createdate>str_to_date("'.$st.'","%Y-%m-%d") and createdate<str_to_date("'.$ed.'","%Y-%m-%d") and partner="'.$partnerid.'"';
			
			$data = $usedModel ->where($sqlWhere) -> count();
			return $data;
		}

		/**
		 * 根据消费码查询合作网站ID
		 * @param  [type] $num [description]
		 * @return [type]      [description]
		 */
		public function getPartnerByNumber($num){
			return 0;
		}
	}
 ?>