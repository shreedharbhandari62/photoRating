<?php 
	$DBServer = 'localhost'; 
	$DBUser = 'root'; 
	$DBPass = ''; 
	$DBName = 'rating'; 
	$conn = new mysqli($DBServer,$DBUser,$DBPass,$DBName); 
	if($conn->connect_error){
	 // echo $conn->connect_error;
	  die('Connect Error: ' . $mysqli->connect_error); 
	} 

	function cleanup($data)
	{
		return mysql_escape_string(trim(htmlentities(strip_tags($data))));
	}
?>