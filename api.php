<?php 
header("Content-Type:application/json");
require_once "data.php";

function response($status,$status_message,$data){
	header("HTTP/1.1 ".$status);

	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;
	$response['time'] = "18.04.16";

	$json_response = json_encode($response);
	echo $json_response;
}

	//	前端写的name是否为空
if (!empty($_GET['name'])) {
	$name = $_GET['name'];
	$price = get_price($name);

	if (empty($price)) {
		response(200, "Product Not Found", NULL);
	} else {
		response(200, "Product Found", $price);
	}
} else {
	response(400, "Invalid Request", NULL);
}


?>