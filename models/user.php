<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/config/database.php");

	class User extends Database{
		public static function all(){
			$query = "SELECT * FROM `users` WHERE 1";
			
			$response = self::execute_query($query, array());
			
			return $response;
		}
	}
?>