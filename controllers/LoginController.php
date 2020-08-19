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

            $this->model('users')->setEmail('email');
            $this->model('users')->setPassword('password');

            $valid = !$this->model('users')->isValidForm();

            if ($valid['success']) {
                $this->setResponseModel($valid['message']);
            } else {

                $login = $this->model('users')->login();

                if (!$login['success']) {
                    $this->setResponseModel($login['message']);
                }
            }
        }

        Head::title('Login');
        Head::description('Login the jonasdamher.');
        Head::robots('noindex, nofollow');

        include View::render('users', 'login');
    }
}
