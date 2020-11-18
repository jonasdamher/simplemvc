<?php

declare(strict_types=1);

class CategoriesApi extends ApiController
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->role('ROLE_ADMIN');

		$this->modelLoading(['categories']);
	}

	public function update()
	{
		// Coger todos los datos JSON en petición POST enviado por JS 
		$posts = $this->json->rawRequest();

		$this->model('categories')->setId($this->json->getRequest());

		// Pasarle al modelo los datos recogidos por POST
		$this->model('categories')->setName($posts['name']);

		// Crear categoría
		$update = $this->model('categories')->update();

		$this->json->jsonResponse($update);
	}

	public function create()
	{
		// Coger todos los datos JSON en petición POST enviado por JS 
		$posts = $this->json->postRequest();

		// Pasarle al modelo los datos recogidos por POST
		$this->model('categories')->setName($posts['name']);

		// Crear categoría
		$create = $this->model('categories')->create();

		/**
		 * Devuelve respuesta de la variable $create, 
		 * transforma el array de la variable a un JSON
		 */
		$this->json->jsonResponse($create);
	}

	public function get()
	{
		$id = $this->json->getRequest();
		$posts = $this->json->postRequest();

		if ($this->auth->compareTokens($posts['_token'])) {

			$this->model('categories')->setId($id);

			$getCategory = $this->model('categories')->get();

			$this->json->jsonResponse($getCategory);
		}
	}

	public function delete()
	{
		$this->model('categories')->setId($this->json->getRequest());
		$delete = $this->model('categories')->delete();
		$this->json->jsonResponse($delete);
	}
}
