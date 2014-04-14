<?php 

	class partnerAction extends Action {

		public function index(){
			// $indexData['tplname'] = $this -> tplname;
			// $indexData['place'] = $this -> checkOutPlaceList();
			// $indexData['emtpy'] = '<form  class="listForm form-inline" action="./?m=partner&&a=addPartner" method="POST"><div class="form-group"><input type="text" name="partnername"  class="form-control" value="" /></div><div class="form-group"><input type="submit" class="btn btn-primary sub" value="确认添加" /></div></form>';
			// $this -> assign($indexData);
			// $this -> display('./Tpl/Admin/partnerList.html');
		}
 
		public function addPartner(){
			$partner['name'] = $_POST["name"];
			$partner['totalcount'] = 0;

			$partnerModel = new Model("partner");
			if($partner['name']){
				if(!$partnerModel -> where("name=".$partner['name']) -> find()){
					$partnerModel -> add($partner);
					$this->ajaxReturn(1,$partner['name'], 1);
				}else{
					$this->redirect('/?m=activeNumber');
				}
			}else{
				$this->redirect('/?m=activeNumber');
			}
		}
		
		public function getPartner(){
			$partnerModel = new Model("partner");
			$res = $partnerModel -> field("name") -> select();
			return $res;
		}
 
		
		public function deletePartner(){
			$partnerModel = new Model("partner");
			$del = $_POST["name"];
			$res = $partnerModel -> where("name='".$del."'") -> delete();

			if(!$res){
				 $this->ajaxReturn(0,'删除失败', 0);
			}else{
				  $this->ajaxReturn(1,'删除成功', 1);
			}
		}

		 public function getIdByName($partnername){
		 	$partnerModel = new Model("partner");
			$res = $partnerModel -> where("name='".$partnername."'") -> select();
			ChromePHP::log($res );
			return $res;
		 }

		 public function getNameById($partId){
		 	$partnerModel = new Model("partner");
			$res = $partnerModel -> where("id='".$partId."'") -> select();
			return $res;
		 }
	}
 ?>