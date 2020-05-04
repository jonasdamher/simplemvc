<?php

class CategoriesController extends BaseController {

    public function __construct()
    {
        $this->auth('ROLE_ADMIN');

        $this->loadModels(['categories']);
    }

    public function index() {

        $articles = $this->model('articles')->getAll();

        if(!$articles['success']){
            $this->setResponseModel($articles['message'].'articles');
        }

        include $this->view('articles');
    }

    public function create() {
        

        if($this->submitForm()){

            $this->model('categories')->setName($_POST['name']);
          
            $create = $this->model('categories')->create();
            
            if(!$create['success']){
                $this->setResponseModel($create['message']);
            }
        }

        include $this->view('categories', 'create');
    }
}
?>