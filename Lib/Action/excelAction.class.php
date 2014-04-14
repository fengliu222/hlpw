<?php 
	
    require_once './Lib/PHPExcel.php';       
    require_once './Lib/PHPExcel/Writer/Excel5.php'; 

    class excelAction extends CommonAction{

        public function export_data($obj_phpexcel){
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