<?php

declare(strict_types=1);

class ArticlesModel extends BaseModel
{

	private $id;
	private $title;
	private $description;
	private $main;
	private $idUser;
	private $idCategory;
	private $urlName;

	public function __construct()
	{
		$table = 'articles';
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

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setMain($main)
	{
		$this->main = $main;
	}

	public function getMain()
	{
		return $this->main;
	}

	public function setIdUser($idUser)
	{
		$this->idUser = $idUser;
	}

	public function getIdUser()
	{
		return $this->idUser;
	}

	public function setIdCategory($idCategory)
	{
		$this->idCategory = $idCategory;
	}

	public function getIdCategory()
	{
		return $this->idCategory;
	}

	public function setUrlName($urlName)
	{
		$urlName = preg_replace("/[^a-z0-9áéíóúñ\s]/", '', mb_strtolower(trim($urlName)));
		$urlName = preg_replace("/\s/", '-', $urlName);
		$this->urlName = $urlName;
	}

	public function getUrlName()
	{
		return $this->urlName;
	}

	public function get(): array
	{
		return $this->findById($this->getId());
	}

	public function getAll(): array
	{
		return $this->find();
	}

	public function create(): array
	{
		try {

			$consult = Database::connect()->prepare("INSERT INTO $this->table (title, description, main, idUser, idCategory, urlName) VALUES (:title, :description, :main, :idUser, :idCategory, :urlName)");

			$consult->bindValue(':title', $this->getTitle(), PDO::PARAM_STR);
			$consult->bindValue(':description', $this->getDescription(), PDO::PARAM_STR);
			$consult->bindValue(':main', $this->getMain(), PDO::PARAM_STR);
			$consult->bindValue(':idUser', $this->getIdUser(), PDO::PARAM_INT);
			$consult->bindValue(':idCategory', $this->getIdCategory(), PDO::PARAM_INT);
			$consult->bindValue(':urlName', $this->getUrlName(), PDO::PARAM_STR);

			$consult->execute();

			$result = ['lastId' => Database::connect()->lastInsertId()];

			$this->success($result);
		} catch (PDOException $e) {

			$this->fail($e->getMessage());
		} finally {

			$consult = null;
			Database::disconnect();
			return $this->response();
		}
	}
}
?>