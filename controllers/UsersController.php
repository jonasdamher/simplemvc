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

        include View::show('users', 'profile');
    }

    public function logout()
    {
        $this->model('users')->logout();
    }
}
