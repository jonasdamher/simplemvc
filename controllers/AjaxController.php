<?php

declare(strict_types=1);

class AjaxController extends BaseController
{

    public function __construct()
    {
        $this->auth('ROLE_ADMIN');
    }

    private function responseJson(array $data)
    {
        die(json_encode($data));
    }

    private function requestPost(): array
    {
        try {

            $json = json_decode($_POST['form'], true);

            if (json_last_error() != JSON_ERROR_NONE) {
                throw new Exception(json_last_error());
            }

            return $json;
        } catch (Exception $e) {
            $this->responseJson(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function requestGet()
    {
        try {

            if (!isset($_GET['id'])) {
                throw new Exception("Don't exist id parameter");
            }

            $id = trim($_GET['id']);

            if (empty($id)) {
                throw new Exception("Don't valid id parameter, empty parameter");
            }

            return $id;
        } catch (Exception $e) {
            $this->responseJson(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getCategory()
    {
        $this->loadModels(['categories']);

        $this->model('categories')->setId($this->requestGet());

        $this->responseJson($this->model('categories')->get());
    }

    public function deleteCategory()
    {
        $this->loadModels(['categories']);

        $this->model('categories')->setId($this->requestGet());

        $this->responseJson($this->model('categories')->delete());
    }
}
?>