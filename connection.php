<?php
	/**
	* @author : Shanteshwar Inde
	**/

	require_once('DBConfig.php');

	class DBConnection
	{
		private static $obj;
		private $connection;

		private function __construct(){
			$this->db_connect();
		}

		public static function getInstance()
		{
			if(!self::$obj)
			{
				self::$obj = new DBConnection();
			}
			return self::$obj;
		}

		private function db_connect()
		{
			$dbConfig = DBConfig::Load();
			$this->connection = new mysqli($dbConfig['db_host'], $dbConfig['db_user'], $dbConfig['db_pass'], $dbConfig['db_name']);
			if ($this->connection->connect_error) {
				die("Connection failed: " . $this->connection->connect_error);
			} 
		}

		public function execute_query($sql)
		{
			$data = $this->connection->query($sql);
			return $data;
		}
	}
?>