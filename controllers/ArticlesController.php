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
    
        Head::js('ckeditor/ckeditor');
        Footer::js('articles');
        include View::show('articles', 'create');
    }

    /**
     * API
     */

    public function apiCreate()
    {
        $this->auth->role('ROLE_ADMIN');

        $posts = $this->json->postRequest();

        // Pasarle al modelo los datos recogidos por POST
        $this->model('articles')->setTitle($posts['title']);
        $this->model('articles')->setDescription($posts['description']);
        $this->model('articles')->setMain($posts['main']);
        $this->model('articles')->setIdUser($_SESSION['userId']);
        $this->model('articles')->setIdCategory($posts['idCategory']);
        $this->model('articles')->setUrlName($posts['title']);

        $create = $this->model('articles')->create();

        $this->json->jsonResponse($create);
    }
}
