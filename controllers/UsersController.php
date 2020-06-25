<?php

declare(strict_types=1);

class UsersController extends BaseController
{

    public function __construct()
    {
        $this->auth('ROLE_ADMIN');
        $this->modelLoading(['users']);
    }

    public function profile()
    {

        $this->model('users')->setId($_SESSION['userId']);
        $user = $this->model('users')->get();

        // Vista

        Head::title('users');
        include $this->view('users', 'profile');
    }

    public function logout()
    {
        $this->model('users')->logout();
    }
}