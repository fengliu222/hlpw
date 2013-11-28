<?php 
	class  placeControlModel extend Model{
		protected $tableName = 'place'; 
		protected $trueTableName = 'place'; 
		protected $dbName = 'hlpw';
		protected $fields = array(
            'placename', 'available'
        );
	}
 ?>