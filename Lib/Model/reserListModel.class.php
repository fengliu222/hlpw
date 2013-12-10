<?php 
	class reserListModel extend Model{
		protected $tableName = 'reservationlist'; 
		protected $trueTableName = 'reservationlist'; 
		protected $dbName = 'hlpw';
		protected $fields = array(
            'name', 'tel','idcard','playdate','playercount','place','playerid'
        );
        
	}
 ?>