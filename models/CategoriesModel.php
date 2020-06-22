<?php

declare(strict_types=1);

class CategoriesModel extends BaseModel
{

	private int $id;
	private string $name;

	public function __construct()
	{
		$table = 'art_categories';
		parent::__construct($table);
	}

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

	public function delete(): array
	{
		return $this->deleteById($this->getId());
	}

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
