<?php

class ArticlesController extends BaseController {

    public function __construct()
    {
        $this->loadModels(['articles']);
    }

    public function index() {

        $articles = $this->model('articles')->getAll();

        if(!$articles['success']){
            $this->setResponseModel($articles['message'].'articles');
        }

        include $this->view('articles');
    }

    public function create() {
        
        $this->auth('ROLE_ADMIN');

        if($this->submitForm()){

            $this->model('articles')->setName($_POST['name']);
            $this->model('articles')->setPrice($_POST['price']);
            
            $create = $this->model('articles')->create();

        }

        include $this->view('articles', 'create');
    }
}
?>