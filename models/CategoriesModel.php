<?php

class CategoriesModel extends BaseModel
{

	private $id;
	private $name;

	public function __construct()
	{
		$table = 'art_categories';
		parent::__construct($table);
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getAll()
	{
		return $this->find();
	}

	public function create()
	{
		try {
			$consult = Database::connect()->prepare("INSERT INTO $this->table (name) VALUE (:name)");
			$consult->bindValue(':name', $this->getName(), PDO::PARAM_STR);
			$consult->execute();

			$result = ['lastId' => Database::connect()->lastInsertId()];

			$consult = null;
			Database::disconnect();

			return $this->success($result);
		} catch (PDOException $e) {
			return $this->fail($e->getMessage());
		}
	}
}
?>