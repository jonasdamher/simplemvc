<?php

declare(strict_types=1);

class CategoriesController extends BaseController
{

    public function __construct()
    {
        $this->auth('ROLE_ADMIN');

        $this->loadModels(['categories']);
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

        include $this->view('categories');
    }
}