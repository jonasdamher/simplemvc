<?php

declare(strict_types=1);

class CategoriesController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->role('ROLE_ADMIN');

        $this->modelLoading(['categories']);
    }

    public function index()
    {

        if ($this->submitForm()) {

            $this->model('categories')->setName($_POST['name']);

            $create = $this->model('categories')->create();

            if (!$create['success']) {
                $this->setResponseModel($create['message']);
            }
        }

        $categories = $this->model('categories')->getAll();
        Footer::js(['dom', 'request', 'validator', 'categories']);
        include View::render('categories');
    }
}
