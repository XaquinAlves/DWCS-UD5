<?php

declare(strict_types=1);
namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\TrabajadoresDbModel;

class TrabajadoresController extends BaseController
{
    public function getAllTrabajadores(): void
    {
        $data = array(
            'titulo' => 'Trabajadores',
            'breadcrumb' => ['trabajadores'],
            'seccion' => '/trabajadores',
            'tituloEjercicio' => 'Lista de todos los trabajadores'
        );
        $model = new TrabajadoresDbModel();

        $data['listaTrabajadores'] = $model->getTrabajadoresCarlos();

        $this->view->showViews(array('templates/header.view.php', 'trabajadores.view.php', 'templates/footer.view.php'), $data);
    }
}