<?php 
	class usernumberModel extend Model{
		protected $tableName = 'usednumber'; 
		protected $trueTableName = 'usednumber'; 
		protected $dbName = 'hlpw';
		protected $fields = array(
            'id', 'number', 'placename','createdate','partner'
        ); 
	}
 ?>