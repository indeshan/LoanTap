<?php
	/**
	* @author : Shanteshwar Inde
	**/
	
	require_once('connection.php');
	define('CHUNKSIZE', 1000);

	class Model
	{
		private $dbObj;
		private $filename;
		function __construct()
		{
			$this->dbObj = DBConnection::getInstance();
			session_start();
			$time = time();
			$_SESSION['row_count'] = $this->get_total_rows();
			$this->filename = "files/employee" . $time . ".csv";
			$_SESSION['file'] = $this->filename;
			session_write_close();
		}

		function get_total_rows()
		{
			$sql = "SELECT count(1) as total FROM employees";
			$rows = $this->dbObj->execute_query($sql);
			foreach ($rows as $val) {
				$row_count = $val['total'];
			}
			return $row_count;
		}

		function processData()
		{
			$fp = fopen($this->filename, 'w');
			$header=array("emp_no","birth_date","first_name","last_name","gender","hire_date");
			fputcsv($fp, $header);
			$offset = 0;
			$chunkSize = CHUNKSIZE;
			while(1)
			{
				$limit = $offset*$chunkSize;
				$count = 0;
				$sql="SELECT * FROM employees limit $limit, $chunkSize";	
				$data=$this->dbObj->execute_query($sql); 
				if(!empty($data))
				{
					foreach($data as $row)
					{
						fputcsv($fp, $row);
						$count++;
					}
				}
				usleep(500000);
				unset($data);
				if($count<$chunkSize)
					break;
				$offset++;
			}
		}
	}
?>