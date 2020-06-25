<?php

declare(strict_types=1);

/**
 * Modelo de categoría de un artículo
 */
class CategoriesModel extends BaseModel
{

	private int $id;
	private string $name;

	public function __construct()
	{
		$table = 'art_categories';
		parent::__construct($table);
	}

	// Gets y sets

	public function setId($id)
	{
		$this->id = (int) $id;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function setName(string $name)
	{
		$this->name = $name;
	}

	public function getName(): string
	{
		return $this->name;
	}

	// Fin gets y sets

	/**
	 * Buscar categoría por ID
	 */
	public function get(): array
	{
		return $this->findById($this->getId());
	}

	/**
	 * Coger todos las categorías que existen
	 */
	public function getAll(): array
	{
		return $this->find();
	}

	/**
	 * Crear nueva categoría
	 */
	public function create(): array
	{
		try {

			$consult = Database::connect()->prepare("INSERT INTO $this->table name VALUES :name");

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

	/**
	 * Borrar categoría por ID
	 */
	public function delete(): array
	{
		return $this->deleteById($this->getId());
	}

	/**
	 * Actualizar categoría por ID
	 */
	public function update(): array
	{
		try {

			$consult = Database::connect()->prepare("UPDATE $this->table SET name = :name WHERE id = :id");

			$consult->bindValue(':name', $this->getName(), PDO::PARAM_STR);
			$consult->bindValue(':id', $this->getId(), PDO::PARAM_INT);

			$consult->execute();

			$result = ['lastId' => $this->getId()];

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
