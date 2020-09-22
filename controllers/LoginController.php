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

            $users = $this->model('users');

            $users->setEmail('email');
            $users->setPassword('password');

            $valid = !$users->isValidForm();

            if ($valid) {
                $this->setResponseModel($valid['message']);
            } else {

                $login = $users->login();

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
