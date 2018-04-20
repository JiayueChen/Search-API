<?php 
header("Content-Type:application/json");
// 请求data数据文件
// require_once "data.php";

// 请求数据库
require_once "db.php";

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
	//data.php 的get_price方法
	// $price = get_price($name);

	//db.php方法
	$db = new DBConnection();
    $price = $db->getProductPriceByName($name);
	

	if (empty($price)) {
		response(200, "Product Not Found", NULL);
	} else {
		response(200, "Product Found", $price);
	}
} else {
	response(400, "Invalid Request", NULL);
}


//增 api/add/{name}/{quantity}
//查 api/product/{id}
//改 api/update/{id}/{new_quantity}
//删 api/delete/{id}
$name = $_GET['name'];
$param_array = explode('/', $name);



?>