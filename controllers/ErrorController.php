<?php

declare(strict_types=1);

/**
 * Controlador para vistas de errores http
 */
class ErrorController extends BaseController
{
    public function error401()
    {
        $this->error('Error 401. No tienes permiso para acceder.', '401');
    }

    public function error404()
    {
        $this->error('Error 404. No encontrado.', '404');
    }

    public function error500()
    {
        $this->error('Error 500. Error interno.', '500');
    }

    private function error(string $message, string $errorHttp)
    {
        Head::title('error ' . $errorHttp);
        include View::show('error');
    }
}
