<?php

declare(strict_types=1);

/**
 * Controlador para vistas de errores http
 */
class ErrorController extends Controller
{
    public function error401()
    {
        $this->error('Error 401. Dont permission to access.', '401');
    }

    public function error403()
    {
        $this->error('Error 403. Sorry bro, article removed QWQ".', '404');
    }

    public function error404()
    {
        $this->error(`Error 404. Don't found.`, '404');
    }

    public function error500()
    {
        $this->error('Error 500. Internal error.', '500');
    }

    private function error(string $message, string $errorHttp)
    {
        Head::title('error ' . $errorHttp);
        include View::render('error');
    }
}
