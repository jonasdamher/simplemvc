<?php

declare(strict_types=1);

/**
 * Controlador base, administra los modelos, 
 * permisos de usuario y peticiones formato JSON.
 */
class BaseController
{

	private array $models = [];

	// Otros módulos.
	protected ?Auth $auth = null;

	public function __construct()
	{
		$this->auth = new Auth;
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
}
