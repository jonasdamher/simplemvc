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
        $currentPage = $_GET['page'] ?? 1;
        $limit = $_GET['limit'] ?? 3;

        $articles = $this->model('articles')->getAll($currentPage, $limit);

        if (!$articles['success']) {
            $this->setResponseModel($articles['message'] . 'articles.');
        }

        $pagination = $this->model('articles')->pagination($currentPage,$limit);

        include View::render('articles');
    }

    public function get()
    {
        $id = $_GET['id'] ?? null;

        if (is_null($id)) {
            Utils::redirection('error/error404');
        }

        $this->model('articles')->setId($id);
        $getArticle = $this->model('articles')->getArticleByUrlName();

        if (!$getArticle['success']) {
            Utils::redirection('error/error403');
        }

        $article = $getArticle['result'];

        $this->model('tags')->setIdArticle($article['id']);
        $tags = $this->model('tags')->getAllByIdArticle();

        // Vista

        Head::title($article['title']);
        Head::description($article['description']);

        if ($tags['success']) {
            Head::keyWords($tags['result'], 'name');
        }

        include View::render('articles', 'article');
    }

    public function search()
    {
        $currentPage = $_GET['page'] ?? 1;
        $limit = $_GET['limit'] ?? 3;

        $search = trim($_GET['q']) ?? null;
        $articles = $this->model('articles')->getAllInSearch($search,$currentPage, $limit);

        if (!$articles['success']) {
            $this->setResponseModel($articles['message'] . 'articles.');
        }
        include View::render('articles', 'search');
    }

    public function create()
    {
        $token = $this->auth->_token();
        
        $this->auth->role('ROLE_ADMIN');

        $categories = $this->model('categories')->getAll();

        // Vista
        Head::title('create article');
        Footer::js(['request', 'validator', 'ckeditor/ckeditor', 'articles']);

        include View::render('articles', 'create');
    }

    /**
     * API
     */

    public function apiCreate()
    {
        $this->auth->role('ROLE_ADMIN');

        $posts = $this->json->postRequest();

        // Pasarle al modelo de artículo los datos recogidos por POST
        $this->model('articles')->setTitle($posts['title']);
        $this->model('articles')->setDescription($posts['description']);
        $this->model('articles')->setMain($posts['main']);
        $this->model('articles')->setIdUser($_SESSION['userId']);
        $this->model('articles')->setIdCategory($posts['category']);
        $this->model('articles')->setUrlName($posts['title']);

        $create = $this->model('articles')->create();

        if ($create['success'] && count($posts['tags']) > 0) {

            // Añadir etiquetas si es que las tiene.

            foreach ($posts['tags'] as $tag) {
                $this->model('tags')->setIdArticle($create['result']['lastId']);
                $this->model('tags')->setName($tag);

                $this->model('tags')->create();
            }
        }

        $this->json->jsonResponse($create);
    }
}
