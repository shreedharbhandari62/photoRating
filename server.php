<?php 
session_start();
$message = array(); 
include('database.php');

$sql = "SELECT * FROM ratings ORDER BY RAND() LIMIT 1"; 
$result=mysqli_query($conn,$sql); 
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$message["image"] = $row['image']; 
$message["id"] = $row['id'];
if($row['votes']>0){ 
	$message["average"] = round($row["rated"]/$row["votes"],2); 
	$message["votes"] = $row["votes"]; 
}else{ 
	$message["average"] = 0; 
	$message["votes"] = 0; 
}
if(empty($_SESSION['votes'])){ 
	$_SESSION['votes'] = 10; 
	$message["votesleft"] = $_SESSION['votes']; 
}else{ 
	$message["votesleft"] = $_SESSION['votes']; 
}  

header('Content-type: application/json');
echo json_encode($message); 
?> 