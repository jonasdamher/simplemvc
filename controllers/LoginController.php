<?php

class LoginController extends BaseController
{

    public function __construct()
    {
        $this->auth();
        $this->loadModels(['users']);
    }

    public function index()
    {

        if ($this->submitForm()) {

            $this->model('users')->setEmail($_POST['email']);
            $this->model('users')->setPassword($_POST['password']);

            $login = $this->model('users')->login();

            if (!$login['success']) {
                $this->setResponseModel($login['message']);
            }
        }

        include $this->view('users', 'login');
    }
}
?>