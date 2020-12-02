<?php
	/**
	* @author : Shanteshwar Inde
	**/

	class DBConfig
	{
		private static $db_config = array(
										"db_type" => "mysql",
										"db_host" => "localhost",
										"db_name" => "test",
										"db_user" => "root",
										"db_pass" => "root",
										"db_charset" => "utf8",
										"db_port" => "3306"
									);

		static function Load()
		{
			return self::$db_config;
		}
}