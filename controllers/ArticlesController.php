<?php

declare(strict_types=1);

class ArticlesController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

        $this->modelLoading(['articles', 'tags', 'categories']);
    }

    public function index()
    {

        $articles = $this->model('articles')->getAll();

        if (!$articles['success']) {
            $this->setResponseModel($articles['message'] . 'articles');
        }

        include View::show('articles');
    }

    public function create()
    {
        $this->auth->role('ROLE_ADMIN');

        $categories = $this->model('categories')->getAll();

        if ($this->submitForm()) {

            $this->model('articles')->setTitle($_POST['title']);
            $this->model('articles')->setDescription($_POST['description']);
            $this->model('articles')->setMain($_POST['main']);
            $this->model('articles')->setIdUser($_SESSION['userId']);
            $this->model('articles')->setIdCategory($_POST['idCategory']);
            $this->model('articles')->setUrlName($_POST['title']);

            $create = $this->model('articles')->create();

            if (!$create['success']) {
                $this->setResponseModel($create['message']);
            }
        }

        include View::show('articles', 'create');
    }
}
