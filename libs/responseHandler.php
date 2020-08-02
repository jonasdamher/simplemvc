<?php

declare(strict_types=1);

class responseHandler
{

	private array $response = ['success' => true, 'message' => ''];

	/**
	 * Para añadir los resultados y/o un mensaje de 
	 * que ha sido satisfactoria la petición a la DB.
	 */
	protected function success(?array $result, $message = 'Success')
	{
		$this->response = ['success' => true, 'message' => $message, 'result' => $result];
	}

	/**
	 * Para añadir un mensaje de que ha fallado algo en una petición a la DB.
	 */
	protected function fail(string $message)
	{
		$this->response = ['success' => false, 'message' => $message];
	}

	/**
	 * Devuelve respuesta de una petición a la DB.
	 */
	protected function response(): array
	{
		return $this->response;
	}
}
