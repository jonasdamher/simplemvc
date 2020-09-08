<?php

declare(strict_types=1);

class UsersController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->role('ROLE_ADMIN');

        $this->modelLoading(['users']);
    }

    public function profile()
    {

        $this->model('users')->setId($_SESSION['userId']);
        $user = $this->model('users')->get();

        Head::title('profile ' . $_SESSION['userName']);
        include View::render('users', 'profile');
    }

    public function logout()
    {
        $token = $_GET['token'];

        if ($token == $_SESSION['_token']) {
            $this->model('users')->logout();
        }
    }
}
