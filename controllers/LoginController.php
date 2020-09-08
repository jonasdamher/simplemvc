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
        $token = $this->auth->_token();

        if ($this->submitForm() && $this->auth->compareTokens($token)) {

            $this->model('users')->setEmail('email');
            $this->model('users')->setPassword('password');

            $valid = !$this->model('users')->isValidForm();
            var_dump(  $valid);
            if ($valid) {
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
