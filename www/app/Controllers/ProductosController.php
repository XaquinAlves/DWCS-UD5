<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class ProductosController extends BaseController
{
    public function getProductos(): void
    {
        $modelCats = new \Com\Daw2\Models\CategoriasModel();
        $modelProv = new \Com\Daw2\Models\ProveedoresModel();
        $model = new \Com\Daw2\Models\ProductosModel();

        $copiaGet = $_GET;
        unset($copiaGet['page']);

        $data = array(
            'titulo' => 'Productos',
            'breadcrumb' => ['productos'],
            'seccion' => '/productos',
            'tituloEjercicio' => 'Listado de productos',
            'url' => '/productos?' . http_build_query($copiaGet),
            'listaProveedores' => $modelProv->getProveedores(),
            'listaCategorias' => $modelCats->getCategorias(),
            'listaProductos' => $model->getProductosByFilter($_GET),
            'input' => filter_input_array(INPUT_GET),
            'page' => $model->getPage($_GET),
            'lastPage' => $model->getNumberOfPages($_GET),
            'page_size' => $model->getPageSize($_GET),
            'ordenar' => 1
        );

        $this->view->showViews(array('templates/header.view.php', 'productos.view.php',
            'templates/footer.view.php'), $data);
    }
}