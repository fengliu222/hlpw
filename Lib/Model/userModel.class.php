<?php 
	class userModel extend Model{
		protected $tableName = 'adminuser'; 
		protected $trueTableName = 'adminuser'; 
		protected $dbName = 'hlpw';
		protected $fields = array(
            'id', 'username', 'passowrd',  '_pk' => 'id', '_autoinc' => true
        );

		public function login(){
			
		}
	}
 ?>