<?php

declare(strict_types=1);

/**
 * Controlador base, administra los modelos, 
 * vistas, permisos de usuario y peticiones formato JSON.
 */
class BaseController
{

	private array $models = [];
	private string $responseModel = '';

	// Otros módulos.
	protected ?Auth $auth = null;
	protected ?JsonRequest $json = null;
	
	public function __construct()
	{
		$this->auth = new Auth;
		$this->json = new JsonRequest;
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
	 * Cargar un modelo o varios a la vez.
	 */
	public function modelLoading(array $modelsName)
	{
		foreach ($modelsName as $modelName) {
			$model = ucfirst($modelName) . 'Model';

			if (file_exists('models/' . $model . '.php')) {
				require_once 'models/' . $model . '.php';
				$this->models[$modelName] = new $model;
			}
		}
	}

	/**
	 * Te devuelve una instancia del modelo especificado por parámetro.
	 */
	public function model(string $modelName): object
	{
		return $this->models[$modelName];
	}

	/**
	 * Comprueba que exista una petición de tipo POST
	 */
	protected function submitForm(): bool
	{
		return ($_SERVER['REQUEST_METHOD'] == 'POST');
	}

}
