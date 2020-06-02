<?php

declare(strict_types=1);

class ErrorController extends BaseController
{

    public function error404()
    {
        include $this->view('error', '404');
    }

    public function error500()
    {
        include $this->view('error', '500');
    }
}