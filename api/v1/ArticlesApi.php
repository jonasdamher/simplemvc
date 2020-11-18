<?php

declare(strict_types=1);

class ArticlesApi extends ApiController
{
	public function __construct()
	{
		parent::__construct();

		$this->modelLoading(['articles', 'tags']);
	}

	public function create()
	{
		$this->auth->role('ROLE_ADMIN');

		$json = $this->json->post()->rawRequest();

		// Pasarle al modelo de artículo los datos recogidos por POST
		$this->model('articles')->setTitle($json->title);
		$this->model('articles')->setDescription($json->description);
		$this->model('articles')->setMain($json->main);
		$this->model('articles')->setIdUser($_SESSION['userId']);
		$this->model('articles')->setIdCategory($json->category);
		$this->model('articles')->setUrlName($json->title);

		$create = $this->model('articles')->create();

		if ($create['success'] && count($json->tags) > 0) {

			// Añadir etiquetas si es que las tiene.

			foreach ($json->tags as $tag) {
				$this->model('tags')->setIdArticle($create['result']['lastId']);
				$this->model('tags')->setName($tag);

				$this->model('tags')->create();
			}
		}

		$this->json->jsonResponse($create);
	}
}
