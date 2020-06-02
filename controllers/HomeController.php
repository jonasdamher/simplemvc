<?php

declare(strict_types=1);

class HomeController extends BaseController
{

    public function __construct()
    {
        $this->auth();
        $this->loadModels(['articles']);
    }

    public function index()
    {
        include $this->view('home');
    }
}