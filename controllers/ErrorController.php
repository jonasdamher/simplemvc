<?php

declare(strict_types=1);

/**
 * Controlador para vistas de errores http
 */
class ErrorController extends BaseController
{

    public function error404()
    {
        Head::title('error 404');
        include View::show('error', '404');
    }

    public function error500()
    {
        Head::title('error 500');
        include View::show('error', '500');
    }
}
