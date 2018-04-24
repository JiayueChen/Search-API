<?php
header("Content-Type:application/json");
/*require_once "data.php";*/

if($_REQUEST['action']=="add"&&!empty($_REQUEST['name'])&&!empty($_REQUEST['quantity']))
{
	$name=$_REQUEST['name'];
	$quantity=$_REQUEST['quantity'];
	try{
		$conn = new PDO("mysql:host=localhost;dbname=test", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("INSERT INTO product (p_name, p_quantity) VALUES (?,?)");
	    $stmt->execute([$name,$quantity]);
	    $insert_res = $stmt->rowCount();
	    echo $insert_res." record(s) added.";
	}catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}
}elseif($_REQUEST['action']=="product"&&!empty($_REQUEST['id'])) {
	$id=$_REQUEST['id'];
	try{
		$conn = new PDO("mysql:host=localhost;dbname=test", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT * FROM product where p_id=$id"); 
	    $stmt->execute();
	    while($row = $stmt->fetch()){
			echo $row['p_name']." ".$row['P_description']." ".$row['p_quantity']."\n";
		}
	}catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}
}elseif($_REQUEST['action']=="update"&&!empty($_REQUEST['id'])&&!empty($_REQUEST['quantity'])){
	$id=$_REQUEST['id'];
	$quantity=$_REQUEST['quantity'];
	try{
		$conn = new PDO("mysql:host=localhost;dbname=test", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("UPDATE product SET p_quantity=$quantity where p_id=$id"); 
	    $stmt->execute();
	    $update_res = $stmt->rowCount();
	    echo $update_res." record(s) updated.";
	}catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}
}elseif($_REQUEST['action']=="delete"&&!empty($_REQUEST['id'])){
	$id=$_REQUEST['id'];
	try{
		$conn = new PDO("mysql:host=localhost;dbname=test", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("DELETE FROM product WHERE p_id = $id");
	    $stmt->execute();
	    $delete_res = $stmt->rowCount();
	    echo $delete_res." record(s) deleted.";
	}catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}
}else{
	echo "Please check the doucment of this API again.";
}







/*	else
	{
		//interact with database.
		try{
			$conn = new PDO("mysql:host=localhost;dbname=test", "root", "root");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare("SELECT p_quantity FROM product where p_name = '$name'"); 
		    $stmt->execute();
		    $result = $stmt->fetchColumn();

		}catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
		}

		response(200,"Product Found",$result);
	}
	
}
else
{
	response(400,"Invalid Request",NULL);
}

function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);
	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$data;
	
	$json_response = json_encode($response);
	echo $json_response;
}*/