<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\CsvModel;

class CsvController extends BaseController
{
    public function getPoblacionPontevedra(): void
    {
        $data = array(
            'titulo' => 'Histórico población Pontevedra',
            'breadcrumb' => ['trabajadores','trabajadores1'],
            'seccion' => '/trabajadores',
            'tituloCard' => 'Datos del CSV'
        );
        $model = new CsvModel($_ENV['folder.data'] . "poblacion_pontevedra.csv");
        $data['datoscsv'] = $model->getPoblacionPontevedra();
        $min = [];
        $min[3] = PHP_INT_MAX;
        $max = [];
        $max[3] = PHP_INT_MIN;

        for ($i = 0; $i < count($data['datoscsv']); $i++) {
            if (
                $data['datoscsv'][$i][0] !== "Municipio" &&
                $data['datoscsv'][$i][0] !== "36 Pontevedra" &&
                $data['datoscsv'][$i][1] === "Total" &&
                $data['datoscsv'][$i][3] !== ""
            ) {
                if (intval($data['datoscsv'][$i][3]) < intval($min[3])) {
                    $min = $data['datoscsv'][$i];
                }
                if (intval($data['datoscsv'][$i][3]) > intval($max[3])) {
                    $max = $data['datoscsv'][$i];
                }
            }
        }

        $data['minimo'] = $min;
        $data['maximo'] = $max;

        $this->view->showViews(array('templates/header.view.php', 'csv.view.php',
            'templates/footer.view.php'), $data);
    }
}
