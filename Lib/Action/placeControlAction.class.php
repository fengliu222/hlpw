<?php 

	class placeControlAction extends Action {

		public function index(){
			$indexData['tplname'] = $this -> tplname;
			$indexData['place'] = $this -> checkOutPlaceList();
			$indexData['emtpy'] = '<form  class="listForm form-inline" action="./?m=placeControl&&a=addPlace" method="POST"><input type="text" name="placename" value="" /><select name="available"><option value="1"  selected="selected">可用</option><option value="0">不可用</option></select><input type="submit" class="btn btn-primary sub" value="确认添加" /></form>';
			$this -> assign($indexData);
			$this -> display('./Tpl/Admin/placeControl.html');
		}
		/**
		 * 添加旅游地点
		 */
		
		public function addPlace(){
			$place['placename'] = $_POST["placename"];
			$place['available'] = $_POST["available"];

			$placeModel = new Model("place");
			 
			if($place['placename']){

				if(!$placeModel -> where("placename=".$place['placename']) -> find()){
					$placeModel -> add($place);
					$this->redirect('/?m=placeControl');
 
				}else{
					$this->redirect('/?m=placeControl');
				}
				
			}else{
				$this->redirect('/?m=placeControl');
			}
		}
		
		/**
		 * 查询旅游地点列表
		 */
		
		public function checkOutPlaceList($availabel){
			$placeModel = new Model("place");

			if($availabel){
				$res = $placeModel -> where("available=1") -> field("placename") -> select();
			}else{
				$res = $placeModel -> select();
			}

			return $res;
		}

		/**
		 * 删除旅游地点列表
		 */
		
		public function deletePlace(){
			$placeModel = new Model("place");
			$del = $_POST["placename"];
			$res = $placeModel -> where("placename='".$del."'") -> delete();

			if(!$res){
				 $this->ajaxReturn(0,'删除失败', 0);
			}else{
				  $this->ajaxReturn(1,'删除成功', 1);
			}
		}

		/**
		 * 更新旅游地点
		 */
		
		public function updatePlaceList(){
			$placeModel = new Model("place");
			$oname = $_POST["oldname"];

			$data["placename"] = $_POST["newname"];
			$data["available"] = $_POST["available"];
			
			$res = $placeModel -> where("placename='".$oname."'") -> save($data);
			 
			if($res){
				$this->success('修改成功', './?m=placeControl');

			}else{
				$this->error('修改失败', './?m=placeControl');
			}
		}
	}
 ?>