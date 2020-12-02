<?php
	/**
	* @author : Shanteshwar Inde
	**/
	
	session_start();
	usleep(1000000);
	$filename = $_SESSION['file'];
	$row = $_SESSION['row_count'];
	session_write_close();
	$fp = new SplFileObject($filename, 'r');
	$fp->seek(PHP_INT_MAX);
	$percent = round(($fp->key())*100/$row);
	$data = array("percent" => $percent, "file_name" => $filename);
	echo json_encode($data);
?>