<?php

declare(strict_types=1);

class HomeController extends BaseController
{

    public function __construct()
    {
        $this->auth();
        $this->modelLoading(['articles']);
    }

    public function index()
    {
        Head::title('home');

        include $this->view('home');
    }
}
