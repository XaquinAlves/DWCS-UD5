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
        unset($copiaGet['order']);

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
            'order' => $model->getOrderInt($_GET)
        );

        $this->view->showViews(array('templates/header.view.php', 'productos.view.php',
            'templates/footer.view.php'), $data);
    }

    public function showAltaProducto(array $errors = [], array $input = []): void
    {
        $modelCats = new \Com\Daw2\Models\CategoriasModel();
        $modelProv = new \Com\Daw2\Models\ProveedoresModel();

        $data = array(
            'titulo' => 'Alta de Producto',
            'breadcrumb' => ['productos', 'alta'],
            'seccion' => '/productos/alta',
            'tituloCard' => 'Datos del producto',
            'listaProveedores' => $modelProv->getProveedores(),
            'listaCategorias' => $modelCats->getCategorias(),
            'input' => $input,
            'errors' => $errors
        );

        $this->view->showViews(array('templates/header.view.php', 'productos.edit.view.php',
            'templates/footer.view.php'), $data);
    }

    public function doAltaProducto(): void
    {
        $model = new \Com\Daw2\Models\ProductosModel();
        $errors = [];

        if ($_POST['codigo'] === '') {
            $errors['codigo'] = 'Campo requerido';
        }

        if ($_POST['nombre'] === '') {
            $errors['nombre'] = 'Campo requerido';
        }

        if ($_POST['proveedor'] === '') {
            $errors['proveedor'] = 'Campo requerido';
        }

        if ($_POST['coste'] === '') {
            $errors['coste'] = 'Campo requerido';
        }

        if ($_POST['margen'] === '') {
            $errors['margen'] = 'Campo requerido';
        }

        if ($_POST['stock'] === '') {
            $errors['stock'] = 'Campo requerido';
        }

        if ($_POST['iva'] === '') {
            $errors['iva'] = 'Campo requerido';
        }

        if ($_POST['categoria'] === '') {
            $errors['categoria'] = 'Campo requerido';
        }

        if ($_POST['descripcion'] === '') {
            $errors['descripcion'] = 'Campo requerido';
        }

        if ($errors === []) {
            $model->altaProducto($_POST);
            header('location: /productos');
        } else {
            $this->showAltaProducto($errors, filter_input_array(INPUT_POST));
        }
    }

    public function showEditarProducto(string $codigo, array $errors = [], array $input = []): void
    {
        $modelCats = new \Com\Daw2\Models\CategoriasModel();
        $modelProv = new \Com\Daw2\Models\ProveedoresModel();
        $model = new \Com\Daw2\Models\ProductosModel();

        $data = array(
            'titulo' => 'Edición de Producto',
            'breadcrumb' => ['productos', 'editar'],
            'seccion' => '/productos/editar',
            'tituloCard' => 'Datos del producto',
            'listaProveedores' => $modelProv->getProveedores(),
            'listaCategorias' => $modelCats->getCategorias(),
            'input' => $input,
            'errors' => $errors,
            'producto' => $model->findProductoCodigo($codigo)
        );

        $this->view->showViews(array('templates/header.view.php', 'productos.edit.view.php',
            'templates/footer.view.php'), $data);
    }

    public function doEditarProducto(string $codigo): void
    {
        $model = new \Com\Daw2\Models\ProductosModel();
        $errors = [];
        $producto = $model->findProductoCodigo($codigo);
    }
}