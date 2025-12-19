<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Libraries\Mensaje;
use Com\Daw2\Models\CategoriasModel;
use Com\Daw2\Models\ProductosModel;
use Com\Daw2\Models\ProveedoresModel;

class ProductosController extends BaseController
{
    public function getProductos(): void
    {
        $model = new ProductosModel();

        $copiaGet = $_GET;
        unset($copiaGet['page']);
        unset($copiaGet['order']);

        $data = array(
            'titulo' => 'Productos',
            'breadcrumb' => ['productos'],
            'seccion' => '/productos',
            'tituloEjercicio' => 'Listado de productos',
            'url' => '/productos?' . http_build_query($copiaGet),
            'listaProveedores' => (new ProveedoresModel())->getProveedores(),
            'listaCategorias' => (new CategoriasModel())->getCategorias(),
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
        $data = array(
            'titulo' => 'Alta de Producto',
            'breadcrumb' => ['productos', 'alta'],
            'seccion' => '/productos/alta',
            'tituloCard' => 'Datos del producto',
            'listaProveedores' => (new ProveedoresModel())->getProveedores(),
            'listaCategorias' => (new CategoriasModel())->getCategorias(),
            'input' => $input,
            'errors' => $errors
        );

        $this->view->showViews(array('templates/header.view.php', 'productos.edit.view.php',
            'templates/footer.view.php'), $data);
    }

    public function doAltaProducto(): void
    {
        $errors = $this->checkInputProducto($_POST);

        if ($errors === []) {
            $model = new ProductosModel();
            $result = $model->altaProducto($_POST);

            if ($result) {
                $this->addFlashMessage(new Mensaje("Producto guardadp correctamente", Mensaje::SUCCESS));
            } else {
                $this->addFlashMessage(new Mensaje("Error indeterminado al guardar el producto", Mensaje::ERROR));
            }
            header('location: /productos');
        } else {
            $this->showAltaProducto($errors, filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        }
    }

    private function checkInputProducto(array $input, ?string $codigo = ''): array
    {
        $errors = [];

        if ($_POST['codigo'] === '') {
            $errors['codigo'] = 'Campo requerido';
        } elseif (strlen($_POST['codigo']) > 10) {
            $errors['codigo'] = 'El codigo debe de ser de 10 caracteres máximo';
        } elseif ($codigo !== '' && $codigo !== $input['codigo']) {
            $model = new ProductosModel();
            $row = $model->findProductoCodigo($input['codigo']);
            if ($row !== false) {
                $errors['codigo'] = 'El codigo introducido ya está en uso por otro producto';
            }
        }

        if ($_POST['nombre'] === '') {
            $errors['nombre'] = 'Campo requerido';
        } elseif (strlen($_POST['nombre']) > 255) {
            $errors['nombre'] = 'El nombre introducido es demasiado largo';
        }

        if ($_POST['proveedor'] === '') {
            $errors['proveedor'] = 'Campo requerido';
        }

        if ($_POST['coste'] === '') {
            $errors['coste'] = 'Campo requerido';
        } elseif (!is_numeric($_POST['coste'])) {
            $errors['coste'] = 'El coste debe ser un número de hasta 2 decimales';
        } elseif (strrchr($_POST['coste'], '.') && strlen(substr(strrchr($_POST['coste'], '.'), 1)) > 2) {
            $errors['coste'] = 'El coste debe tener hasta 2 decimales';
        }

        if ($_POST['margen'] === '') {
            $errors['margen'] = 'Campo requerido';
        } elseif (!is_numeric($_POST['margen'])) {
            $errors['margen'] = 'El margen debe ser un número de hasta 2 decimales';
        } elseif (strrchr($_POST['margen'], '.') && strlen(substr(strrchr($_POST['margen'], '.'), 1)) > 2) {
            $errors['margen'] = 'El coste debe tener hasta 2 decimales';
        }

        if ($_POST['stock'] === '') {
            $errors['stock'] = 'Campo requerido';
        } elseif (filter_var($_POST['stock'], FILTER_VALIDATE_INT) === false) {
            $errors['stock'] = 'Debe ser un número entero';
        }

        if ($_POST['iva'] === '') {
            $errors['iva'] = 'Campo requerido';
        } elseif (filter_var($_POST['iva'], FILTER_VALIDATE_FLOAT) === false) {
            $errors['iva'] = 'Debe ser un número entero';
        }

        if ($_POST['categoria'] === '') {
            $errors['categoria'] = 'Campo requerido';
        }

        return $errors;
    }

    public function showEditarProducto(string $codigo, array $errors = [], array $input = []): void
    {
        $data = array(
            'titulo' => 'Edición de Producto',
            'breadcrumb' => ['productos', 'editar'],
            'seccion' => '/productos/editar',
            'tituloCard' => 'Datos del producto',
            'listaProveedores' => (new ProveedoresModel())->getProveedores(),
            'listaCategorias' => (new CategoriasModel())->getCategorias()
        );
        $model = new ProductosModel();
        if ($input === []) {
            $input = $model->findProductoCodigo($codigo);
            if ($input === false) {
                $this->addFlashMessage(new Mensaje("Producto $codigo no encontrado", Mensaje::ERROR));
                header('location: /productos');
                die;
            }
        }
        $data['input'] = filter_var_array($input, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['errors'] = $errors;
        $this->view->showViews(array('templates/header.view.php', 'productos.edit.view.php',
            'templates/footer.view.php'), $data);
    }

    public function doEditarProducto(string $codigo): void
    {
        $errors = $this->checkInputProducto($_POST, $codigo);
        if ($errors === []) {
            $model = new ProductosModel();
            $result = $model->updateProducto($codigo, $_POST);
            if ($result) {
                $this->addFlashMessage(new Mensaje("Producto $codigo editado correctamente", Mensaje::SUCCESS));
            } else {
                $this->addFlashMessage(new Mensaje(
                    "Error indeterminado al editar el producto $codigo",
                    Mensaje::ERROR
                ));
            }
            header('location: /productos');
        } else {
            $this->showEditarProducto($codigo, $errors, filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        }
    }

    public function deleteProducto(string $codigo): void
    {
        try {
            $model = new ProductosModel();
            $result = $model->deleteProducto($codigo);
            if ($result) {
                $this->addFlashMessage(new Mensaje("Producto $codigo borrado correctamente", Mensaje::SUCCESS));
            } else {
                $this->addFlashMessage(new Mensaje("Error al borrar el producto $codigo", Mensaje::ERROR));
            }
            header('location: /productos');
        } catch (\PDOException $e) {
            $this->addFlashMessage(new Mensaje($e->getMessage(), Mensaje::WARNING));
            header('location: /productos');
        }
    }
}