<?php

declare(strict_types=1);

class UsersController extends BaseController {

    public function __construct()
    {
        $this->auth('ROLE_ADMIN');
        $this->loadModels(['users']);
    }

    public function profile() {
        
        $this->model('users')->setId($_SESSION['userInit']);
        $user = $this->model('users')->get();
        Head::setDescription('Hola');
        
        include $this->view('users','profile');
    }

    public function logout() {
        $this->model('users')->logout();
    }
}

?>