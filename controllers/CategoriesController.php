<?php

declare(strict_types=1);

class CategoriesController extends BaseController
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

    /**
     * API
     */

    public function apiUpdate()
    {
        // Coger todos los datos JSON en petición POST enviado por JS 
        $posts = $this->json->postRequest();

        $this->model('categories')->setId($this->json->getRequest());

        // Pasarle al modelo los datos recogidos por POST
        $this->model('categories')->setName($posts['name']);

        // Crear categoría
        $update = $this->model('categories')->update();

        $this->json->jsonResponse($update);
    }

    public function apiNew()
    {
        // Coger todos los datos JSON en petición POST enviado por JS 
        $posts = $this->json->postRequest();

        // Pasarle al modelo los datos recogidos por POST
        $this->model('categories')->setName($posts['name']);

        // Crear categoría
        $create = $this->model('categories')->create();

        /**
         * Devuelve respuesta de la variable $create, 
         * transforma el array de la variable a un JSON
         */
        $this->json->jsonResponse($create);
    }

    public function apiGet()
    {
        $id = $this->json->getRequest();
        $posts = $this->json->postRequest();

        if($this->auth->compareTokens($posts['_token'])){
            
            $this->model('categories')->setId($id);

            $getCategory = $this->model('categories')->get();
            
            $this->json->jsonResponse($getCategory);
        }
    }

    public function apiDelete()
    {
        $this->model('categories')->setId($this->json->getRequest());

        $this->json->jsonResponse($this->model('categories')->delete());
    }
}
