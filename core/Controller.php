<?php

declare(strict_types=1);

class Controller extends BaseController
{

	private string $responseModel = '';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Para guardar la respuesta de un método de un modelo.
	 */
	protected function setResponseModel(string $res)
	{
		$this->responseModel = $res;
	}

	/**
	 * Para mostrar respuesta guardada de un modelo.
	 */
	public function getResponseModel(): string
	{
		return $this->responseModel;
	}

	/**
	 * Comprueba que exista una petición de tipo POST
	 */
	protected function submitForm(): bool
	{
		return ($_SERVER['REQUEST_METHOD'] == 'POST');
	}
}
