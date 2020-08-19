<?php

declare(strict_types=1);

class HomeController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->role();
        
        $this->modelLoading(['articles']);
    }

    public function index()
    {
        include View::render('home');
    }
}
