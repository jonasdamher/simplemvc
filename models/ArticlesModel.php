<?php

class ArticlesModel extends BaseModel {
	
	private $id;
	private $name;
	private $price;

	public function __construct() {
		$table = 'articles';
		parent::__construct($table);
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function setName($name){
		$this->name = $name;
	}
	
	public function getName() {
		return $this->name;
	}

	public function setPrice($price){
		$this->price = $price;
	}
	
	public function getPrice() {
		return $this->price;
	}

	public function getAll(){
		return $this->find();
	}

	public function get(){
		return $this->findById($this->getId());
	}

	public function create(){
		try{
			$consult = Database::connect()->prepare("INSERT INTO $this->table (name, price) VALUE (:name, :price)");
			$consult->bindValue(':name', $this->getName(), PDO::PARAM_STR);
			$consult->bindValue(':price', $this->getPrice(), PDO::PARAM_STR);
			$consult->execute();

			$result = ['lastId'=>Database::connect()->lastInsertId()];
			
			$consult = null;
			Database::disconnect();
			return $this->success($result);

		}catch(PDOException $e) {
			return $this->fail($e->getMessage());
		}
	}
	
}
?>