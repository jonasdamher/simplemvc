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
		return ['success' => false, 'message' => $message];
	}

	protected function find()
	{
		try {
			$sql = "SELECT * FROM $this->table";
			$consult = Database::connect()->prepare($sql);
			$consult->execute();

			Database::disconnect();

			if ($consult->rowCount() == 0) {
				$consult = null;
				return $this->fail("Don't exist ");
			}

			$result = $consult->fetchAll(PDO::FETCH_ASSOC);
			$consult = null;

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

			Database::disconnect();

			if ($consult->rowCount() == 0) {
				$consult = null;
				return $this->fail('Not found');
			}

			$result = $consult->fetch(PDO::FETCH_ASSOC);
			$consult = null;

			return $this->success($result);
		} catch (PDOException $e) {
			return $this->fail($e->getMessage());
		}
	}
}
?>