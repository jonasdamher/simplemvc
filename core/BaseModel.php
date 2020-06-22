<?php

declare(strict_types=1);

class BaseModel
{

	protected string $table = '';

	private array $response = [];

	public function __construct(string $table)
	{
		$this->table = $table;
	}

	protected function success(?array $result, $message = 'Success')
	{
		$this->response = ['success' => true, 'message' => $message, 'result' => $result];
	}

	protected function fail(string $message)
	{
		$this->response = ['success' => false, 'message' => $message];
	}

	protected function response(): array
	{
		return $this->response;
	}

	/**
	 * Devuelve todos los campos de todos los registros de una tabla.
	 */
	protected function find(): array
	{
		try {

			$consult = Database::connect()->prepare("SELECT * FROM $this->table ORDER BY id DESC");
			$consult->execute();

			if ($consult->rowCount() == 0) {
				throw new Exception("Don't exist ");
			}

			$result = $consult->fetchAll(PDO::FETCH_ASSOC);

			$this->success($result);
		} catch (Exception $e) {

			$this->fail($e->getMessage());
		} catch (PDOException $e) {

			$this->fail($e->getMessage());
		} finally {

			$consult = null;
			Database::disconnect();
			return $this->response();
		}
	}

	/**
	 * Devuelve todos los campos de un registro por el ID.
	 */
	protected function findById(int $id): array
	{
		try {

			$consult = Database::connect()->prepare("SELECT * FROM $this->table WHERE id=:id");

			$consult->bindValue(':id', $id, PDO::PARAM_STR);

			$consult->execute();

			if ($consult->rowCount() == 0) {
				throw new Exception('Not found');
			}

			$result = $consult->fetch(PDO::FETCH_ASSOC);

			$this->success($result);
		} catch (Exception $e) {

			$this->fail($e->getMessage());
		} catch (PDOException $e) {

			$this->fail($e->getMessage());
		} finally {

			$consult = null;
			Database::disconnect();
			return $this->response();
		}
	}

	/**
	 * Borra un registro por el ID.
	 */
	protected function deleteById(int $id): array
	{
		try {

			$consult = Database::connect()->prepare("DELETE FROM $this->table WHERE id = :id");

			$consult->bindValue(':id', $id, PDO::PARAM_INT);

			$consult->execute();

			$this->success(null, 'Deleted');
		} catch (PDOException $e) {

			$this->fail($e->getMessage());
		} finally {

			$consult = null;
			Database::disconnect();
			return $this->response();
		}
	}
}
