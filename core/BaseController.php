<?php

declare(strict_types=1);

/**
 * Controlador base, administra los modelos, 
 * vistas, permisos de usuario y peticiones formato JSON.
 */
class BaseController
{

	protected array $currentView = [];
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
	 * Permite devuelver una vista.
	 */
	protected function view(string $controller, string $action = 'index'): string
	{
		if (!is_dir('views/' . $controller) || !is_file('views/' . $controller . '/' . $action . '.php')) {
			Utils::redirection('error/error500');
		}

		$this->currentView['section'] = $controller;
		$this->currentView['view'] = $action;

		return 'views/index.php';
	}

	/**
	 * Comprueba que exista una petición de tipo POST
	 */
	protected function submitForm(): bool
	{
		return ($_SERVER['REQUEST_METHOD'] == 'POST');
	}

}
