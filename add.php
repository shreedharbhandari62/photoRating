<?php 
session_start(); 
$message = array(); 
include ('database.php'); 
if(isset($_POST['image'])){
	if ($_SESSION['votes']>1) {	
		$postid =  $_POST['image']; 
		$postvote =  $_POST['vote'];

		$sql = "SELECT * FROM ratings WHERE id = $postid LIMIT 1"; 
		$result = $conn->query($sql); 
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		$rating = $row['rated']; 
		$votes = $row['votes'];

		$rating = $rating + $postvote; 
		$votes++;

		$sql2 = "UPDATE ratings SET rated = $rating, votes = $votes WHERE id = $postid"; 
		$result2 = $conn->query($sql2); 
		$message['type']="SUCCESS"; 
		$message["average"] = round($rating/$votes,2);
		$_SESSION['votes']--;
	}else{	
		$message['type']="TOO MANY VOTES"; 
	}
	$_SESSION['votesremaining']=$_SESSION['votes'];
}else{
	$message['type']="FAIL"; 
} 

header('Content-type: application/json'); 
echo json_encode($message);