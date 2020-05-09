<?php

class BaseModel
{

	protected $table;

	private $response;

	public function __construct($table)
	{
		$this->table = $table;
	}

	protected function success($result, $message = 'Success')
	{
		$this->response = ['success' => true, 'message' => $message, 'result' => $result];
	}

	protected function fail($message)
	{
		$this->response = ['success' => false, 'message' => $message];
	}

	protected function response()
	{
		return $this->response;
	}

	protected function find()
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

	protected function findById($id)
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

	protected function deleteById($id)
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
?>