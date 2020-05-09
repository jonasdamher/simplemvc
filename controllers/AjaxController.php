<?php

class AjaxController extends BaseController
{

    public function __construct()
    {
        $this->auth('ROLE_ADMIN');
    }

    private function responseJson($data)
    {
        echo json_encode($data);
    }

    public function getCategory()
    {
        $this->loadModels(['categories']);

        $this->model('categories')->setId($_GET['id']);

        $this->responseJson($this->model('categories')->get());
    }

    public function deleteCategory()
    {
        $this->loadModels(['categories']);
        $id = json_decode($_POST['id'], true);

        $this->model('categories')->setId($id);

        $this->responseJson($this->model('categories')->delete());
    }
}
