<?php 

class DBConnection {
	protected $connection;

	public function getConnInstant() {
		if (!isset($this->connection)) {
			$this->connection = new PDO ('mysql:host=localhost;dbname=Product;charset=utf8mb4', 'root', 'root');
		}
		return $this->connection;
	}

	// public function addTemplate($content, $name, $vars) {
	// 	// TODO: Add Check - content,name,vars

	// 	// Add to DB
	// 	// 列名和数据库对应 templates(tcontent)
	// 	$stmt = $this->getConnInstant()->prepare("INSERT into templates(tcontent, tname, tvar) VALUES(:content, :name, :vars)");
	// 	$result = $stmt->execute(
	// 		array(
	// 			':content' => $content,
	// 			':name' => $name,
	// 			':vars' => $vars
	// 		)
	// 	);
	// 	return $result;
	// }

	

	public function getProductByName($name) {
		$stmt = $this->getConnInstant()->prepare("SELECT * FROM product WHERE (name = :name)");
		$stmt->execute(
			array(
				':name'=> $name,
			)
		);
		//fetch 配合搜索结果，取回结果
		$result = $stmt->fetch();
		
		return $result["price"];
		

	}
}

 $db = new DBConnection();
var_dump($db->getProductByName("book"));


 ?>