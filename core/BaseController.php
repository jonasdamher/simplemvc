<?php

declare(strict_types=1);

class BaseController
{

	protected array $currentView = [];
	private string $responseModel = '';
	private array $models = [];

	protected function setResponseModel(string $res)
	{
		$this->responseModel = $res;
	}

	public function getResponseModel(): string
	{
		return $this->responseModel;
	}

	protected function loadModels(array $modelsName)
	{
		foreach ($modelsName as $modelName) {
			$model = ucfirst($modelName) . 'Model';

			if (file_exists('models/' . $model . '.php')) {
				require_once 'models/' . $model . '.php';
				$this->models[$modelName] = new $model();
			}
		}
	}

	protected function model(string $modelName): object
	{
		return $this->models[$modelName];
	}

	protected function view(string $controller, string $action = 'index'): string
	{
		if (!is_dir('views/' . $controller) || !is_file('views/' . $controller . '/' . $action . '.php')) {
			Utils::redirection('error/error500');
		}

		$this->currentView['section'] = $controller;
		$this->currentView['view'] = $action;

		Head::setTitle($action == 'index' ? $controller : $action);

		return 'views/index.php';
	}

	protected function submitForm(): bool
	{
		return ($_SERVER['REQUEST_METHOD'] == 'POST');
	}

	protected function auth(string $role = null)
	{
		switch ($role) {
			case 'ROLE_ADMIN':
				if (!isset($_SESSION['userInit'])) {
					Utils::redirection('home');
				}

				if ($_SESSION['userIdRol'] != 1 || $_SESSION['userRolIdentity'] != 'ROLE_ADMIN') {
					Utils::redirection('home');
				}
				break;
			default:
				if (isset($_SESSION['userInit'])) {
					Utils::redirection('users/profile');
				}
				break;
		}
	}
}
?>