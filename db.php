<?php 

class DBConnection {
	protected $connection;

	public function getConnInstant() {
		if (!isset($this->connection)) {
			$this->connection = new PDO ('mysql:host=localhost;dbname=Product;charset=utf8mb4', 'root', 'root');
		}
		return $this->connection;
	}

	

	

	public function getProductPriceByName($name) {
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


	//增 api/add/{name}/{quantity}
	public function addProduct($name, $quantity) {
		// TODO: Add Check - content,name,vars

		// Add to DB
		// 列名和数据库对应 product(name)
		$stmt = $this->getConnInstant()->prepare("INSERT into product(name, quantity) VALUES(:name, :quantity)");
		$result = $stmt->execute(
			array(
				':name' => $name,
				':quantity' => $quantity
			)
		);
		return $result;
	}

	//查 api/product/{id}
	public function getProductInfoById($id) {
		$stmt = $this->getConnInstant()->prepare("SELECT * FROM product WHERE (id = :id)");
		$result = $stmt->execute(
			array(
				':id'=> $id,
			)
		);
		//fetch 配合搜索结果，取回结果
		$info = $stmt->fetch();
		$result = array(
			'id' => $info['id'],
			'name' => $info['name'],
			'price' => $info['price'],
			'quantity' => $info['quantity'],
		);

		return $result;
	}

	//改 api/update/{id}/{new_quantity}
	public function updateQuantityById($id, $new_quantity) {
		$stmt = $this->getConnInstant()->prepare("UPDATE product SET quantity = :quantity WHERE (id = :id)");
		$result = $stmt->execute(
			array(
				':quantity'=> $new_quantity,
				':id'=> $id,
			)
		);
		return $result;
	}

	//删 api/delete/{id}
	public function deleteById($id) {
		$stmt = $this->getConnInstant()->prepare("DELETE FROM product WHERE (id = :id)");
		$result = $stmt->execute(
			array(
				':id'=> $id,
			)
		);
		return $result;
	}
}

 $db = new DBConnection();
// var_dump($db->getProductByName("pen"));
 var_dump($db->addProduct("book",3));



 ?>