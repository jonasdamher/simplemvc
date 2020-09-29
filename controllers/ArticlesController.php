<?php

declare(strict_types=1);

class ArticlesController extends Controller
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

        $pagination = $this->model('articles')->pagination($currentPage, $limit);

        include View::render('articles');
    }

    public function get()
    {
        $id = $_GET['action'] ?? null;

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
        Head::caconical('/'.$id);
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
        $articles = $this->model('articles')->getAllInSearch($search, $currentPage, $limit);

        if (!$articles['success']) {
            $this->setResponseModel($articles['message'] . 'articles.');
        }
        $pagination = $this->model('articles')->pagination($currentPage, $limit);
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
}
