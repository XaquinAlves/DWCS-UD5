<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

class ErroresController extends \Com\Daw2\Core\BaseController
{
    public function error404(): void
    {
        http_response_code(404);
        $data = ['titulo' => 'Error 404'];
        $data['texto'] = '404. File not found';
        $this->view->showViews(array('templates/header.view.php', 'error.php', 'templates/footer.view.php'), $data);
    }

    public function error403(): void
    {
        http_response_code(403);
        $data = ['titulo' => 'Error 403'];
        $data['texto'] = '403. Forbidden';
        $this->view->showViews(array('templates/header.view.php', 'error.php', 'templates/footer.view.php'), $data);
    }

    public function error405(): void
    {
        http_response_code(405);
        $data = ['titulo' => 'Error 405'];
        $data['texto'] = '405. Method not allowed';

        $this->view->showViews(array('templates/header.view.php', 'error.php', 'templates/footer.view.php'), $data);
    }

    public function showThrowable(\Throwable $t): void
    {
        http_response_code(500);
        $data = ['titulo' => 'Error'];
        $data['cabecera'] = '500. Internal server error';
        if ($_ENV['app.debug'] == 2) {
            throw $t;
        } elseif ($_ENV['app.debug'] == 1) {
            $data['texto'][] = ['titulo' => 'Mensaje: ', 'valor' => $t->getMessage()];
            $data['texto'][] = ['titulo' => 'Línea excepción: ', 'valor' => $t->getFile() . ':' . $t->getLine()];
            $data['texto'][] = ['titulo' => 'Traza del error: ', 'valor' => '<pre>' . $t->getTraceAsString() .
                '</pre>'];
        } else {
            $data['texto'] = 'Excepción en el flujo del sistema.';
        }
        $this->view->showViews(array('templates/header.view.php', 'error.php', 'templates/footer.view.php'), $data);
    }
}
