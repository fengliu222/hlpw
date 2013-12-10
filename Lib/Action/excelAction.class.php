<?php 
	
    require_once './Lib/PHPExcel.php';       
    require_once './Lib/PHPExcel/Writer/Excel5.php'; 

    class excelAction extends Action{

        public function export_data(){
             
            $numModel = new Model("Activenumber");
            $place = $_GET['place'];
            $data = $numModel ->where("placename='".$place."'")-> order("id desc") -> select();

            $obj_phpexcel = new PHPExcel();
           
            if($data){
                $i =1;
                foreach ($data as $key => $value) {
                    # code...
                    ChromePHP::log($value);
                    $obj_phpexcel->getActiveSheet()->setCellValue('a'.$i,$value['number']." ");
                    $i++;
                }
            }    

            $obj_Writer = PHPExcel_IOFactory::createWriter($obj_phpexcel,'Excel5');
            $filename = "outexcel.xls";
            
            header("Content-Type: application/force-download"); 
            header("Content-Type: application/octet-stream"); 
            header("Content-Type: application/download"); 
            header('Content-Disposition:inline;filename="'.$filename.'"'); 
            header("Content-Transfer-Encoding: binary"); 
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
            header("Pragma: no-cache"); 
            $obj_Writer->save('php://output'); 
        }
    }
	
 ?>