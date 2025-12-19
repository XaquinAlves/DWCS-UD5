<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Libraries\Mensaje;
use Com\Daw2\Models\AuxPaisModel;
use \Com\Daw2\Models\ProveedoresModel;

class ProveedoresController extends BaseController
{
    public function showProveedores(): void
    {
        $model = new \Com\Daw2\Models\ProveedoresModel();
        $modelCountrys = new AuxPaisModel();

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

    public function showAltaProveedor(array $errors = [], array $input = []): void
    {
        $data = array(
            'titulo' => 'Alta Proveedor',
            'breadcrumb' => ['proveedores', 'alta'],
            'seccion' => '/proveedores/alta',
            'listaPaises' => (new AuxPaisModel())->getAll(),
            'input' => $input,
            'errors' => $errors
        );

        $this->view->showViews(array('templates/header.view.php', 'proveedores.edit.view.php',
            'templates/footer.view.php'), $data);
    }

    public function doAltaProveedor(): void
    {
        $errors = $this->checkErrorsProveedorCU($_POST);
        if ($errors === []) {
            $model = new ProveedoresModel();
            $params = [
                'cif' => $_POST['cif'],
                'codigo' => $_POST['codigo'],
                'nombre' => $_POST['nombre'],
                'email' => $_POST['email'],
                'id_country' => $_POST['id_country'],
                'direccion' => $_POST['direccion'],
                'website' => $_POST['website'],
                'telefono' => $_POST['telefono']
            ];
            if ($model->altaProveedor($params)) {
                $this->addFlashMessage(new Mensaje(
                    "Proveedor" . $params['nombre'] . " creado correctamente",
                    Mensaje::SUCCESS
                ));
            } else {
                $this->
                addFlashMessage(new Mensaje(
                    "Error indeterminado al crear el proveedor " . $params['nombre'],
                    Mensaje::ERROR
                ));
            }
            header('location: /proveedores');
        } else {
            $this->showAltaProveedor($errors, filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        }
    }

    public function showEditProveedor(string $cif, array $errors = [], array $input = []): void
    {
        $model = new ProveedoresModel();

        $data = array(
            'titulo' => 'Edición Proveedor',
            'breadcrumb' => ['proveedores', 'editar'],
            'seccion' => '/proveedores/editar',
            'listaPaises' => (new AuxPaisModel())->getAll(),
        );
        if ($input === []) {
            $input = $model->findProveedor($cif);
            if ($input === false) {
                $this->addFlashMessage(new Mensaje("Proveedor con cif $cif no encontrado", Mensaje::ERROR));
                header('location: /categorias');
                die;
            }
        }
        $data['input'] = filter_var_array($input, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['errors'] = $errors;
        $this->view->showViews(array('templates/header.view.php', 'proveedores.edit.view.php',
            'templates/footer.view.php'), $data);
    }

    public function doEditProveedor(string $cif): void
    {
        $errors = $this->checkErrorsProveedorCU($_POST, $cif);
        if ($errors === []) {
            $model = new ProveedoresModel();
            $params = [
                'cif' => $_POST['cif'],
                'codigo' => $_POST['codigo'],
                'nombre' => $_POST['nombre'],
                'email' => $_POST['email'],
                'id_country' => $_POST['id_country'],
                'direccion' => $_POST['direccion'],
                'website' => $_POST['website'],
                'telefono' => $_POST['telefono']
            ];
            if ($model->updateProveedor($params)) {
                $this->addFlashMessage(new Mensaje(
                    "Proveedor " . $params['nombre'] . "modificado correctamente",
                    Mensaje::SUCCESS
                ));
                header('location: /proveedores');
            } else {
                $this->
                addFlashMessage(new Mensaje("Error indeterminado al modificar el proveedor $cif", Mensaje::ERROR));
            }
            header('location: /proveedores');
        } else {
            $this->showEditProveedor($cif, $errors, filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        }
    }

    public function doDeleteProveedor(string $cif): void
    {
        try {
            $model = new ProveedoresModel();
            if ($model->deleteProveedor($cif)) {
                $this->addFlashMessage(new Mensaje("Proveedor $cif borrado correctamente", Mensaje::SUCCESS));
            } else {
                $this->addFlashMessage(new Mensaje("Error indeterminado al borrar el proveedor $cif", Mensaje::ERROR));
            }
            header('location: /proveedores');
        } catch (\PDOException $e) {
            $this->addFlashMessage(new Mensaje($e->getMessage(), Mensaje::WARNING));
            header('location: /proveedores');
        }
    }

    public function checkErrorsProveedorCU(array $input, ?string $cif = ''): array
    {
        $errors = [];

        if ($_POST['cif'] === '') {
            $errors['cif'] = 'Campo requerido';
        } elseif (!preg_match('/^[A-Z]\d{7}[A-Z]$/i', $_POST['cif']) === 0) {
            $errors['cif'] = 'Formato incorrecto, debe tener el formato A1234567A';
        } elseif ($cif === null || $cif !== $input['cif']) {
            $model = new ProveedoresModel();

            if ($model->findProveedorCif($_POST['cif'])) {
                $errors['cif'] = 'El cif introducido ya existe';
            }
        }

        if ($_POST['codigo'] === '') {
            $errors['codigo'] = 'Campo requerido';
        }

        if ($_POST['nombre'] === '') {
            $errors['nombre'] = 'Campo requerido';
        }

        if ($_POST['email'] === '') {
            $errors['email'] = 'Campo requerido';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Formato de email incorrecto';
        }

        if ($_POST['id_country'] === '') {
            $errors['id_country'] = 'Campo requerido';
        }

        if ($_POST['direccion'] === '') {
            $errors['direccion'] = 'Campo requerido';
        }

        if ($_POST['website'] === '') {
            $errors['website'] = 'Campo requerido';
        } elseif (!filter_var($_POST['website'], FILTER_VALIDATE_URL)) {
            $errors['website'] = 'Formato de url incorrecto';
        }

        return $errors;
    }
}