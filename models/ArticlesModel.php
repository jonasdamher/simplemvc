<?php

declare(strict_types=1);

/**
 * Modelo de artículo
 */
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

	// Gets y sets

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

	// Fin gets y sets

	/**
	 * Buscar artículo por ID
	 */
	public function get(): array
	{
		return $this->findById($this->getId());
	}

	/**
	 * Buscar artículo por urlName
	 */
	public function getArticleByUrlName(): array
	{
		$sql = "SELECT main.id,
		main.title, main.description, main.main, main.idUser, main.idCategory, main.urlName, main.createAt, main.updateAt,
		category.name as categoryName, user.name as user
		FROM $this->table as main
		inner join art_categories as category on main.idCategory=category.id
		inner join users as user on main.idUser=user.id";

		return $this->findSqlByName($sql, 'urlName', $this->getId());
	}

	/**
	 * Coger todos los artículos que existen
	 */
	public function getAll($currentPage, $limit): array
	{
		$offset = (--$currentPage) * $limit;

		$sql = "SELECT main.id,
		main.title, main.description, main.main, main.idUser, main.idCategory, main.urlName, main.createAt, main.updateAt,
		category.name as categoryName, user.name as user
		FROM $this->table as main
		inner join art_categories as category on main.idCategory=category.id
		inner join users as user on main.idUser=user.id LIMIT $offset,$limit";

		return $this->findWithSql($sql);
	}

	public function getAllInSearch($q, $currentPage, $limit): array
	{
		$offset = (--$currentPage) * $limit;

		$sql = "SELECT distinct main.id,
		main.title, main.description, main.main, main.idUser, 
		main.idCategory, main.urlName, main.createAt, 
		main.updateAt,
		category.name as categoryName, user.name as user
		FROM $this->table as main
		inner join art_categories as category on main.idCategory=category.id
		inner join users as user on main.idUser=user.id
		inner join art_tags on main.id=art_tags.idArticle
		where user.name LIKE :q or main.title LIKE :q or 
		category.name LIKE :q or main.createAt LIKE :q or 
		main.description LIKE :q or art_tags.name LIKE :q LIMIT $offset,$limit";

		return $this->basicSearch($sql, $q);
	}

	/**
	 * Crear un artículo
	 */
	public function create(): array
	{
		try {

			$consult = Database::connect()->prepare("INSERT INTO $this->table 
			(title, description, main, idUser , idCategory , urlName,idStatus)
			VALUES 
			(:title, :description, :main, :idUser, :idCategory, :urlName,:idStatus)");

			$consult->bindValue(':title', $this->getTitle(), PDO::PARAM_STR);
			$consult->bindValue(':description', $this->getDescription(), PDO::PARAM_STR);
			$consult->bindValue(':main', $this->getMain(), PDO::PARAM_STR);
			$consult->bindValue(':idUser', $this->getIdUser(), PDO::PARAM_INT);
			$consult->bindValue(':idCategory', $this->getIdCategory(), PDO::PARAM_INT);
			$consult->bindValue(':urlName', $this->getUrlName(), PDO::PARAM_STR);
			$consult->bindValue(':idStatus', 1, PDO::PARAM_INT);

			$consult->execute();

			$result = ['lastId' => Database::connect()->lastInsertId()];

			$this->success($result);
			Sitemap::add($this->getUrlName(), date('Y-m-d'), 'daily');
		} catch (PDOException $e) {

			$this->fail($e->getMessage());
		} finally {

			$consult = null;
			Database::disconnect();
			return $this->response();
		}
	}
}
