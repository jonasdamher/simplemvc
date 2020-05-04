<?php

class TagsModel extends BaseModel
{

	private $id;
	private $idArticle;
	private $name;

	public function __construct()
	{
		$table = 'art_tags';
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

	public function setIdArticle($idArticle)
	{
		$this->idArticle = $idArticle;
	}

	public function getIdArticle()
	{
		return $this->idArticle;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function create()
	{
		try {
			$consult = Database::connect()->prepare("INSERT INTO $this->table (idArticle, name) VALUE (:idArticle, :name)");
			$consult->bindValue(':idArticle', $this->getIdArticle(), PDO::PARAM_INT);
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