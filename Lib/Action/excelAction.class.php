<?php 
	

	function export_data($data = array())
    {
        # code...
 
        $obj_phpexcel = new PHPExcel();
        $obj_phpexcel->getActiveSheet()->setCellValue('a1','Key');
        $obj_phpexcel->getActiveSheet()->setCellValue('b1','Value');        
        if($data){
            $i =2;
            foreach ($data as $key => $value) {
                # code...
                $obj_phpexcel->getActiveSheet()->setCellValue('a'.$i,$value);
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
 ?>