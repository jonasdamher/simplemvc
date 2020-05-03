<?php

class BaseController
{

	protected $currentView = [];
	private $responseModel;
	private $models = [];

	protected function setResponseModel($res){
		$this->responseModel = $res;
	}

	public function getResponseModel(){
		return $this->responseModel;
	}

	protected function loadModels($modelsName)
	{
		foreach ($modelsName as $modelName) {
			$model = ucfirst($modelName) . 'Model';

			if (file_exists('models/' . $model . '.php')) {
				require_once 'models/' . $model . '.php';
				$this->models[$modelName] = new $model();
			}
		}
	}

	protected function model($modelName)
	{
		return $this->models[$modelName];
	}

	protected function view($controller, $action = 'index')
	{
		if (!is_dir('views/' . $controller) || !is_file('views/' . $controller . '/' . $action . '.php')) {
			Utils::redirection('error/error500');
		}
		$this->currentView['section'] = $controller;
		$this->currentView['view'] = $action;

		return 'views/index.php';
	}

	protected function submitForm()
	{
		return ($_SERVER['REQUEST_METHOD'] == 'POST');
	}

	protected function auth($role = null)
	{

		switch ($role) {
			case 'ROLE_ADMIN':
				if (!isset($_SESSION)) {
					Utils::redirection('home');
				}

				if (!$_SESSION['userInit']) {
					Utils::redirection('home');
				}

				if ($_SESSION['userRol'] != 1) {
					Utils::redirection('home');
				}
				break;
			default:
				if (isset($_SESSION) && isset($_SESSION['userInit'])) {
					Utils::redirection('users/profile');
				}
				break;
		}
	}
}

?>