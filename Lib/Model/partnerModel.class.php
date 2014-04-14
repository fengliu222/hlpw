<?php 
	class partnerModel extend Model{
		protected $tableName = 'partnerlist'; 
		protected $trueTableName = 'partnerlist'; 
		protected $dbName = 'hlpw';
		protected $fields = array(
            'name', 'lastdate','totalcount'
        ); 
	}
 ?>