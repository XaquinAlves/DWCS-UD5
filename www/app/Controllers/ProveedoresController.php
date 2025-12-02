<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class ProveedoresController extends BaseController
{
    public function showProveedores(): void
    {
        $model = new \Com\Daw2\Models\ProveedoresModel();
        $modelCountrys = new \Com\Daw2\Models\AuxPaisModel();

        $copiaGet = $_GET;
        unset($copiaGet['ordenar']);
        unset($copiaGet['pagina']);

        $queryParams = http_build_query($copiaGet);

        $data = array(
            'titulo' => 'Proveedores',
            'breadcrumb' => ['proveedores'],
            'seccion' => '/proveedores',
            'listaPaises' => $modelCountrys->getAll(),
            'listaProveedores' => $model->getProveedoresByFilters($_GET),
            'input' => filter_input_array(INPUT_GET),
            'url' => '/proveedores?' . $queryParams,
            'ordenar' => $model->getOrder($_GET),
            'page' => $model->getPage($_GET),
            'lastPage' => $model->getNumberOfPages($_GET)
        );

        $this->view->showViews(array('templates/header.view.php', 'proveedores.view.php',
            'templates/footer.view.php'), $data);
    }

    public function showEditProveedor(): void
    {
        $model = new \Com\Daw2\Models\ProveedoresModel();
        $modelCountrys = new \Com\Daw2\Models\AuxPaisModel();

        $copiaGet = $_GET;

        $queryParams = http_build_query($copiaGet);

        $data = array(
            'titulo' => 'Edición Proveedor',
            'breadcrumb' => ['proveedores', 'editar'],
            'seccion' => '/proveedores/editar',
            'listaPaises' => $modelCountrys->getAll(),
            'listaProveedores' => $model->getProveedoresByFilters($_GET),
            'input' => filter_input_array(INPUT_GET)
        );

        $this->view->showViews(array('templates/header.view.php', 'proveedores.edit.view.php',
            'templates/footer.view.php'), $data);
    }
}