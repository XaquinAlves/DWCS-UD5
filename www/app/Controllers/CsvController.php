<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\CsvModel;

class CsvController extends BaseController
{
    public function getPoblacionPontevedra()
    {
        $data = array(
            'titulo' => 'Histórico población Pontevedra',
            'breadcrumb' => ['trabajadores','trabajadores1'],
            'seccion' => '/trabajadores',
            'tituloCard' => 'Datos del CSV'
        );
        $model = new CsvModel($_ENV['folder.data'] . "poblacion_pontevedra.csv");
        $data['datoscsv'] = $model->getPoblacionPontevedra();

        $this->view->showViews(array('templates/header.view.php', 'csv.view.php',
            'templates/footer.view.php'), $data);
    }
}