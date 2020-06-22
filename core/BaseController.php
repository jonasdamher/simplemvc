<?php

declare(strict_types=1);

class BaseController
{

	protected array $currentView = [];
	private string $responseModel = '';
	private array $models = [];
	private ?object $jsonReq = null;

	protected function setResponseModel(string $res)
	{
		$this->responseModel = $res;
	}

	public function getResponseModel(): string
	{
		return $this->responseModel;
	}

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

	public function model(string $modelName): object
	{
		return $this->models[$modelName];
	}

	/**
	 * Para recoger respuestas o enviar json
	 */
	public function json(): object
	{
		if (is_null($this->jsonReq)) {
			$this->jsonReq = new JsonRequest;
		}

		return $this->jsonReq;
	}

	protected function view(string $controller, string $action = 'index'): string
	{
		if (!is_dir('views/' . $controller) || !is_file('views/' . $controller . '/' . $action . '.php')) {
			Utils::redirection('error/error500');
		}

		$this->currentView['section'] = $controller;
		$this->currentView['view'] = $action;

		return 'views/index.php';
	}

	protected function submitForm(): bool
	{
		return ($_SERVER['REQUEST_METHOD'] == 'POST');
	}

	public function auth(string $role = null)
	{
		switch ($role) {
			case 'ROLE_ADMIN':

				if (!isset($_SESSION['userId']) || $_SESSION['userIdRol'] != 1 || $_SESSION['userRolIdentity'] != 'ROLE_ADMIN') {
					Utils::redirection('home');
				}

				break;
			default:
				if (isset($_SESSION['userId'])) {
					Utils::redirection('users/profile');
				}
				break;
		}
	}
}
