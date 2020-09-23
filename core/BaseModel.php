<?php

declare(strict_types=1);

/**
 * Modelo base, métodos genéricos para obtener y borrar datos de DB.
 */
class BaseModel extends Validator
{

	protected string $table = '';

	public function __construct(string $table)
	{
		$this->table = $table;
	}

	/**
	 * Devuelve los campos especificados de todos los registros de una tabla.
	 */
	protected function findSqlByName(string $sql, $where, $find): array
	{
		try {

			$consult = Database::connect()->prepare("$sql where main.$where=:reference");
			$consult->bindValue(':reference', $find, PDO::PARAM_STR);
			$consult->execute();

			if ($consult->rowCount() == 0) {
				throw new Exception("Don't exist ");
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
	 * Devuelve todos los campos de todos los registros de una tabla.
	 */
	protected function find(): array
	{
		try {

			$consult = Database::connect()->prepare("SELECT * FROM $this->table");
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
	 * Devuelve todos los campos de todos los registros de una tabla.
	 */
	protected function findWithSql($sql): array
	{
		try {

			$consult = Database::connect()->prepare($sql);
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
	 * Devuelve una búsqueda básica de registros de una consulta sql.
	 */
	protected function basicSearch($sql,$q): array
	{
		try {

			$consult = Database::connect()->prepare($sql);
			$consult->bindValue(':q','%'.$q.'%',PDO::PARAM_STR);
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
	 * Devuelve los campos especificados de todos los registros de una tabla.
	 */
	protected function findFields(string $fields): array
	{
		try {

			$consult = Database::connect()->prepare("SELECT $fields FROM $this->table");
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

			$consult->bindValue(':id', $id, PDO::PARAM_INT);
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
	 * Devuelve los campos especificados de un registro por el ID.
	 */
	protected function findFieldsById(string $fields, int $id): array
	{
		try {

			$consult = Database::connect()->prepare("SELECT $fields FROM $this->table WHERE id=:id");

			$consult->bindValue(':id', $id, PDO::PARAM_INT);
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
	 * Devuelve los campos especificados de todos los registros por el nombre de campo indicado.
	 */
	protected function findAllFieldsByName(string $fields, string $fieldName, string $find): array
	{
		try {

			$consult = Database::connect()->prepare("SELECT $fields FROM $this->table WHERE $fieldName=:field");

			$consult->bindValue(':field', $find, PDO::PARAM_STR);
			$consult->execute();

			if ($consult->rowCount() == 0) {
				throw new Exception('Not found');
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
	 * Devuelve los campos especificados de un registro por el nombre de campo indicado.
	 */
	protected function findFieldsByName(string $fields, string $fieldName, string $find): array
	{
		try {

			$consult = Database::connect()->prepare("SELECT $fields FROM $this->table WHERE $fieldName=:field");

			$consult->bindValue(':field', $find, PDO::PARAM_STR);
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

	protected function countAll(){
		try {

			$consult = Database::connect()->prepare("SELECT count(id) FROM $this->table");

			$consult->execute();

			$result = $consult->fetch(PDO::FETCH_COLUMN);

		} catch (PDOException $e) {

			$this->fail($e->getMessage());
		} finally {

			$consult = null;
			Database::disconnect();
			return $result;
		}
	}

	public function pagination($currentPage, $limit)
	{
		$totalRow = $this->countAll();
		$offset = (1 - $currentPage) * $limit;

		$pages = ceil($totalRow / $limit);
 
		$pagination = [
			'pagination' => [
				['page' => 0, 'active' => false,  'disabled' => false, 'rel' => ''],
				['page' => 0, 'active' => false, 'disabled' => false, 'rel' => ''],
				['page' => 0, 'active' => false, 'disabled' => false, 'rel' => ''],
				['page' => 0, 'active' => false, 'disabled' => false, 'rel' => '']
			],
			'start' => $offset + 1,
			'end' => min(($offset + $limit), $totalRow),
			'pages' => $pages,
			'current' => $currentPage
		];

		$copyPage = ($currentPage - 1);
		$finalPage = false;

		$countPagination = count($pagination['pagination']);

		for ($key = 0; $key < $countPagination; $key++) {
			// Añadir número de página
			if ($currentPage > 1) {

				$pagination['pagination'][$key]['page'] = $copyPage;
				++$copyPage;
				$pagination['pagination'][$key]['rel'] = $copyPage > $currentPage ? 'next' : 'prev';
			} else if ($currentPage <= $pages) {

				$pagination['pagination'][$key]['page'] = ++$copyPage;
				$pagination['pagination'][$key]['rel'] = 'next';
			}

			if ($finalPage) {
				// unset($pagination['pagination'][$key]);
				$pagination['pagination'][$key]['rel'] = '';
				$pagination['pagination'][$key]['disabled'] = true;
			} else if ($pagination['pagination'][$key]['page'] == $currentPage) {
				// Marcar como activo
				$pagination['pagination'][$key]['active'] = true;
				$pagination['pagination'][$key]['rel'] = 'canonical';
			}

			$finalPage = ($pages <= $pagination['pagination'][$key]['page']);
		}

		return $pagination;
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
