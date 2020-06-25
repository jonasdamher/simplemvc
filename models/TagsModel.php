<?php

declare(strict_types=1);

/**
 * Modelo de etiqueta de un artículo
 */
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

	// Gets y sets

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

	// Fin gets y sets

	/**
	 * Crear una etiqueta de un artículo
	 */
	public function create(): array
	{
		try {

			$consult = Database::connect()->prepare("INSERT INTO $this->table idArticle, name VALUES :idArticle, :name");

			$consult->bindValue(':idArticle', $this->getIdArticle(), PDO::PARAM_INT);
			$consult->bindValue(':name', $this->getName(), PDO::PARAM_STR);

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
