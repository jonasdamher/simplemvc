<?php

declare(strict_types=1);

/**
 * Clase para recibir/enviar solicitudes JSON.
 */
class JsonRequest
{

	/**
	 * Devuelve una respuesta en formato json.
	 */
	public function jsonResponse(array $data)
	{
		exit(json_encode($data));
	}

	/**
	 * Coge todos los parámetros POST 
	 * que han sido enviados mediante un json.
	 */
	public function postRequest(): array
	{
		try {

			if (!isset($_POST['form'])) {
				throw new Exception("Don't exist parameter 'form' in post request.");
			}

			$json = json_decode($_POST['form'], true);

			if (json_last_error() != JSON_ERROR_NONE) {
				throw new Exception(json_last_error());
			}

			return $json;
		} catch (Exception $e) {
			$this->jsonResponse(['success' => false, 'message' => $e->getMessage()]);
		}
	}

	/**
	 * Para peticiones rawRequest
	 */

	/**
	 * Para saber si la solicitud es de tipo POST.
	 */
	public function post(): object
	{
		try {
			if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
				throw new Exception("Don't exist POST request.");
			}
			return $this;
		} catch (Exception $e) {
			$this->jsonResponse(['success' => false, 'message' => $e->getMessage()]);
		}
	}

	/**
	 * Para saber si la solicitud es de tipo GET.
	 */
	public function get(): object
	{
		try {
			if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
				throw new Exception("Don't exist GET request.");
			}
			return $this;
		} catch (Exception $e) {
			$this->jsonResponse(['success' => false, 'message' => $e->getMessage()]);
		}
	}

	/**
	 * Para saber si la solicitud es de tipo PATCH.
	 */
	public function patch(): object
	{
		try {
			if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
				throw new Exception("Don't exist PATCH request.");
			}
			return $this;
		} catch (Exception $e) {
			$this->jsonResponse(['success' => false, 'message' => $e->getMessage()]);
		}
	}

	/**
	 * Para saber si la solicitud es de tipo PUT.
	 */
	public function put(): object
	{
		try {
			if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
				throw new Exception("Don't exist PUT request.");
			}
			return $this;
		} catch (Exception $e) {
			$this->jsonResponse(['success' => false, 'message' => $e->getMessage()]);
		}
	}

	/**
	 * Para saber si la solicitud es de tipo DELETE.
	 */
	public function delete(): object
	{
		try {
			if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
				throw new Exception("Don't exist DELETE request.");
			}
			return $this;
		} catch (Exception $e) {
			$this->jsonResponse(['success' => false, 'message' => $e->getMessage()]);
		}
	}

	/**
	 * Recoge un objeto json.
	 */
	public function rawRequest(): object
	{
		try {

			$jsonText = trim(file_get_contents('php://input'));

			if (empty($jsonText)) {
				throw new Exception("Don't exist parameter 'form' in post request.");
			}

			$json = json_decode($jsonText);

			if (json_last_error() != JSON_ERROR_NONE) {
				throw new Exception(json_last_error());
			}

			return $json;
		} catch (Exception $e) {
			$this->jsonResponse(['success' => false, 'message' => $e->getMessage()]);
		}
	}

	/**
	 * Coge todos los parámetros GET 
	 * que han sido enviados mediante un json.
	 */
	public function getRequest()
	{
		try {

			if (!isset($_GET['id'])) {
				throw new Exception("Don't exist id parameter.");
			}

			$id = trim($_GET['id']);

			if (empty($id)) {
				throw new Exception("Don't valid id parameter, empty parameter.");
			}

			return $id;
		} catch (Exception $e) {
			$this->jsonResponse(['success' => false, 'message' => $e->getMessage()]);
		}
	}
}
