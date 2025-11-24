<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\AuxPaisModel;
use Com\Daw2\Models\AuxRolTrabajadorModel;
use Com\Daw2\Models\TrabajadoresDbModel;

class TrabajadoresController extends BaseController
{
    public function getAllTrabajadores(): void
    {
        $data = array(
            'titulo' => 'Trabajadores1',
            'breadcrumb' => ['trabajadores','trabajadores1'],
            'seccion' => '/trabajadores',
            'tituloEjercicio' => 'Lista de todos los trabajadores'
        );
        $model = new TrabajadoresDbModel();

        $data['listaTrabajadores'] = $model->getTrabajadores();

        $this->view->showViews(array('templates/header.view.php', 'trabajadores.view.php',
            'templates/footer.view.php'), $data);
    }

    public function getAllTrabajadoresAssoc(): void
    {
        $data = array(
            'titulo' => 'Trabajadores1 con fetch_assoc()',
            'breadcrumb' => ['trabajadores','trabajadores1'],
            'seccion' => '/trabajadores',
            'tituloEjercicio' => 'Lista de todos los trabajadores'
        );
        $model = new TrabajadoresDbModel();

        $data['listaTrabajadores'] = $model->getTrabajadoresAssoc();

        $this->view->showViews(array('templates/header.view.php', 'trabajadores.view.php',
            'templates/footer.view.php'), $data);
    }

    public function getAllTrabajadoresBySalario(): void
    {
        $data = array(
            'titulo' => 'Trabajadores2',
            'breadcrumb' => ['trabajadores','trabajadores2'],
            'seccion' => '/trabajadores',
            'tituloEjercicio' => 'Lista de todos los trabajadores ordenados por salario'
        );
        $model = new TrabajadoresDbModel();

        $data['listaTrabajadores'] = $model->getTrabajadoresPorSalario();

        $this->view->showViews(array('templates/header.view.php', 'trabajadores.view.php',
            'templates/footer.view.php'), $data);
    }

    public function getAllTrabajadoresBySalarioAssoc(): void
    {
        $data = array(
            'titulo' => 'Trabajadores2 con fetch_assoc()',
            'breadcrumb' => ['trabajadores','trabajadores2'],
            'seccion' => '/trabajadores',
            'tituloEjercicio' => 'Lista de todos los trabajadores ordenados por salario'
        );
        $model = new TrabajadoresDbModel();

        $data['listaTrabajadores'] = $model->getTrabajadoresPorSalarioAssoc();

        $this->view->showViews(array('templates/header.view.php', 'trabajadores.view.php',
            'templates/footer.view.php'), $data);
    }

    public function getTrabajadoresStandard(): void
    {
        $data = array(
            'titulo' => 'Trabajadores3',
            'breadcrumb' => ['trabajadores','trabajadores3'],
            'seccion' => '/trabajadores',
            'tituloEjercicio' => 'Lista de los trabajadores con rol Standard'
        );
        $model = new TrabajadoresDbModel();

        $data['listaTrabajadores'] = $model->getTrabajadoresStandard();

        $this->view->showViews(array('templates/header.view.php', 'trabajadores.view.php',
            'templates/footer.view.php'), $data);
    }

    public function getTrabajadoresStandardAssoc(): void
    {
        $data = array(
            'titulo' => 'Trabajadores3 con fetch_assoc()',
            'breadcrumb' => ['trabajadores','trabajadores3'],
            'seccion' => '/trabajadores',
            'tituloEjercicio' => 'Lista de los trabajadores con rol Standard'
        );
        $model = new TrabajadoresDbModel();

        $data['listaTrabajadores'] = $model->getTrabajadoresStandardAssoc();

        $this->view->showViews(array('templates/header.view.php', 'trabajadores.view.php',
            'templates/footer.view.php'), $data);
    }

    public function getTrabajadoresCarlos(): void
    {
        $data = array(
            'titulo' => 'Trabajadores4',
            'breadcrumb' => ['trabajadores','trabajadores4'],
            'seccion' => '/trabajadores',
            'tituloEjercicio' => 'Lista de los trabajadores con nombre Carlos'
        );
        $model = new TrabajadoresDbModel();

        $data['listaTrabajadores'] = $model->getTrabajadoresCarlos();

        $this->view->showViews(array('templates/header.view.php', 'trabajadores.view.php',
            'templates/footer.view.php'), $data);
    }

    public function getTrabajadoresCarlosAssoc(): void
    {
        $data = array(
            'titulo' => 'Trabajadores4 con fetch_assoc()',
            'breadcrumb' => ['trabajadores','trabajadores4'],
            'seccion' => '/trabajadores',
            'tituloEjercicio' => 'Lista de los trabajadores con nombre Carlos'
        );
        $model = new TrabajadoresDbModel();

        $data['listaTrabajadores'] = $model->getTrabajadoresCarlosAssoc();

        $this->view->showViews(array('templates/header.view.php', 'trabajadores.view.php',
            'templates/footer.view.php'), $data);
    }

    public function getUsuarios(): void
    {
        $model = new TrabajadoresDbModel();
        $modelAuxRol = new AuxRolTrabajadorModel();
        $modelAuxPais = new AuxPaisModel();

        $copiaGet = $_GET;
        unset($copiaGet['ordenar']);
        unset($copiaGet['page']);
        $queryParams = http_build_query($copiaGet);

        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['trabajadores','Usuarios'],
            'seccion' => '/usuarios',
            'tituloEjercicio' => 'Lista de usuarios',
            'url' => '/usuarios?' . $queryParams,
            'listaUsuarios' => $model->getByFilters($_GET),
            'listaRoles' => $modelAuxRol->getAll(),
            'listaPaises' => $modelAuxPais->getAll(),
            'input' => filter_input_array(INPUT_GET),
            'ordenar' => $model->getOrderInt($_GET),
            'page' => $model->getPage($_GET),
            'lastPage' => $model->getNumberOfPages($_GET)
        );

        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php',
            'templates/footer.view.php'), $data);
    }

    public function showAltaUsuario(array $errors = [], array $input = []): void
    {
        $modelAuxRol = new AuxRolTrabajadorModel();
        $modelAuxPais = new AuxPaisModel();

        $data = array(
            'titulo' => 'Alta de usuario',
            'breadcrumb' => ['trabajadores','Usuarios','Alta de usuario'],
            'seccion' => '/usuarios-alta',
            'tituloEjercicio' => 'Datos del usuario',
            'listaRoles' => $modelAuxRol->getAll(),
            'listaPaises' => $modelAuxPais->getAll(),
            'input' => $input
        );

        if ($errors !== []) {
            $data['errors'] = $errors;
        }

        $this->view->showViews(array('templates/header.view.php', 'usuario.edit.view.php',
            'templates/footer.view.php'), $data);
    }

    public function doAltaUsuario(): void
    {
        $errors = $this->checkInputUsuario($_POST);

        if ($errors === []) {
            $model = new TrabajadoresDbModel();
            if ($model->insertUsuario($_POST)) {
                header('location: /usuarios');
            } else {
                $this->showAltaUsuario(['error' => 'Error al insertar el usuario'], $_POST);
            }
        } else {
            $this->showAltaUsuario($errors, $_POST);
        }
    }

    public function showEditUsuario(string $username, array $errors = [], array $input = []): void
    {
        $modelAuxRol = new AuxRolTrabajadorModel();
        $modelAuxPais = new AuxPaisModel();
        $model = new TrabajadoresDbModel();
        $user = $model->find($username);
        if ($user === false) {
            header('location: /usuarios');
        } else {
            $data = array(
                'titulo' => 'Edición de usuario',
                'breadcrumb' => ['trabajadores','Usuarios','Alta de usuario'],
                'seccion' => '/usuarios-alta',
                'listaRoles' => $modelAuxRol->getAll(),
                'listaPaises' => $modelAuxPais->getAll(),
                'input' => filter_var_array($input, FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'usuario' => $user,
                'tituloEjercicio' => 'Datos del usuario ' . $user['username']
            );

            if ($errors !== []) {
                $data['errors'] = $errors;
            }

            $this->view->showViews(array('templates/header.view.php', 'usuario.edit.view.php',
                'templates/footer.view.php'), $data);
        }
    }

    public function doEditUsuario(): void
    {
        $errors = $this->checkInputUsuario($_POST, true);

        if ($errors === []) {
            $model = new TrabajadoresDbModel();
            if ($model->updateUsuario($_POST)) {
                header('location: /usuarios');
            } else {
                $this->showEditUsuario($_POST['input_nombre'], ['error' => 'Error al insertar el usuario'], $_POST);
            }
        } else {
            $this->showEditUsuario($_POST['input_nombre'], $errors, $_POST);
        }
    }

    public function deleteUsuario(string $username): void
    {
        $model = new TrabajadoresDbModel();
        $model->deleteUsuario($username);
        header('location: /usuarios');
    }

    public function activarUsuario(string $username): void
    {
        $model = new TrabajadoresDbModel();
        $user = $model->find($username);
        $params = [
            'input_salario' => $user['salarioBruto'],
            'input_irpf' => $user['retencionIRPF'],
            'input_rol' => $user['id_rol'],
            'input_pais' => $user['id_country'],
            'input_nombre' => $user['username'],
        ];

        if ($user['activo'] == 1) {
            $params['input_activo'] = 0;
        } else {
            $params['input_activo'] = 1;
        }

        $model->updateUsuario($params);
        header('location: /usuarios');
    }

    private function checkInputUsuario(array $input, bool $editMode = false): array
    {
        $errors = [];

        if (empty($input['input_nombre'])) {
            $errors['username'] = "El nombre de usuario es obligatorio";
        } elseif (!preg_match('/^\w{4,50}$/iu', $input['input_nombre'])) {
            $errors['username'] = "El nombre debe estar formado por letras, números o _ y tener entre 4 y
            50 caracteres";
        } elseif (!$editMode) {
            $model = new TrabajadoresDbModel();
            if ($model->find($input['input_nombre']) !== false) {
                $errors['username'] = "El nombre de usuario ya existe";
            }
        }

        if (empty($input['input_salario'])) {
            $errors['salario'] = "El salario es obligatorio";
        } elseif (!preg_match('/^\d+(,\d{1,2})?/iu', $input['input_salario'])) {
            $errors['salario'] = "El salario debe ser un número con dos decimales como máximo, separados por coma";
        } else {
            $salario = (str_replace(',', '.', $input['input_salario']));
            if ($salario < 500) {
                $errors['salario'] = "El salario debe ser mayor a 500";
            }
        }

        if (empty($input['input_irpf'])) {
            $errors['irpf'] = "El IRPF es obligatorio";
        } elseif (filter_var($input['input_irpf'], FILTER_VALIDATE_INT) === false) {
            $errors['irpf'] = "El IRPF debe ser un numero entero entre 0 y 100";
        } else {
            if ($input['input_irpf'] < 0 || $input['input_irpf'] > 100) {
                $errors['irpf'] = "El IRPF debe ser un numero entero entre 0 y 100";
            }
        }

        if (!isset($input['input_activo'])) {
            $errors['activo'] = "Seleccione si el trabajador está activo";
        } elseif (filter_var($input['input_activo'], FILTER_VALIDATE_BOOL, [FILTER_NULL_ON_FAILURE]) === null) {
            $errors['activo'] = "El formato de activo es incorrecto";
        }

        if (empty($input['input_rol'])) {
            $errors['rol'] = "El rol es obligatorio";
        } elseif (filter_var($input['input_rol'], FILTER_VALIDATE_INT) === false) {
            $errors['rol'] = "El rol introducido no es válido";
        } else {
            $modelAuxRol = new AuxRolTrabajadorModel();
            if ($modelAuxRol->find(intval($input['input_rol'])) === false) {
                $errors['rol'] = "El rol no existe";
            }
        }

        if (empty($input['input_pais'])) {
            $errors['pais'] = "El pais es obligatorio";
        } elseif (filter_var($input['input_pais'], FILTER_VALIDATE_INT) === false) {
            $errors['pais'] = "El pais introducido no es válido";
        } else {
            $modelAuxPais = new AuxPaisModel();
            if ($modelAuxPais->find(intval($input['input_pais'])) === false) {
                $errors['pais'] = "El pais no existe";
            }
        }

        return $errors;
    }
}
