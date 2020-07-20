<?php

declare(strict_types=1);

class LoginController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->role();

        $this->modelLoading(['users']);
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

        include View::show('users', 'login');
    }
}
