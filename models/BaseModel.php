<?php

class BaseModel
{

	protected $table;

	public function __construct($table)
	{
		$this->table = $table;
	}

	protected function success($result, $message = 'Success')
	{
		return ['success' => true, 'message' => $message, 'result' => $result];
	}

	protected function fail($message)
	{
		return ['success' => false, 'message' => $message,];
	}

	protected function find()
	{
		try {
			$sql = "SELECT * FROM $this->table";
			$consult = Database::connect()->prepare($sql);
			$consult->execute();
			$result = $consult->fetchAll(PDO::FETCH_ASSOC);

			$consult = null;
			Database::disconnect();
			return $this->success($result);
		} catch (PDOException $e) {
			return $this->fail($e->getMessage());
		}
	}

	protected function findById($id)
	{
		try {
			$sql = "SELECT * FROM $this->table WHERE id=:id";
			$consult = Database::connect()->prepare($sql);
			$consult->bindValue(':id', $id, PDO::PARAM_STR);
			$consult->execute();
			$result = $consult->fetch(PDO::FETCH_ASSOC);

			$consult = null;
			Database::disconnect();

			return $this->success($result);
		} catch (PDOException $e) {
			return $this->fail($e->getMessage());
		}
	}
}
