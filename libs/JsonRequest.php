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
