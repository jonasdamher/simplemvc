<?php

declare(strict_types=1);

class HomeController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth->role();
        
        $this->modelLoading(['articles']);
    }

    public function index()
    {
        Footer::js([['name'=>'generic/main','type'=>'module']]);

        include View::render('home');
    }
}
