<?php

declare(strict_types=1);

class ArticlesController extends BaseController
{

    public function __construct()
    {
        $this->modelLoading(['articles', 'tags', 'categories']);
    }

    public function index()
    {

        $articles = $this->model('articles')->getAll();

        if (!$articles['success']) {
            $this->setResponseModel($articles['message'] . 'articles');
        }

        Head::title('article');

        include $this->view('articles');
    }

    public function create()
    {

        $this->auth('ROLE_ADMIN');

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

        Head::title('article create');

        include $this->view('articles', 'create');
    }
}
