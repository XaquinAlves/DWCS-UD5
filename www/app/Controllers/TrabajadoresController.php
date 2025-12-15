<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Libraries\Mensaje;
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

        $data = array(
            'titulo' => 'Alta de usuario',
            'breadcrumb' => ['trabajadores','Usuarios','Alta de usuario'],
            'seccion' => '/usuarios-alta',
            'tituloEjercicio' => 'Datos del usuario',
            'listaRoles' => (new AuxRolTrabajadorModel())->getAll(),
            'listaPaises' => (new AuxPaisModel())->getAll(),
            'input' => $input,
            'errors' => $errors
        );

        $this->view->showViews(array('templates/header.view.php', 'usuario.edit.view.php',
            'templates/footer.view.php'), $data);
    }

    public function doAltaUsuario(): void
    {
        $data = [];
        $errors = $this->checkInputUsuario($_POST);
        if ($errors === []) {
            $model = new TrabajadoresDbModel();
            $result = $model->insertUsuario($_POST);

            if ($result == 1) {
                $this->addFlashMessage(new Mensaje("Usuario insertado correctamente", Mensaje::SUCCESS));
            } else {
                $this->addFlashMessage(new Mensaje("Error indeterminado al guardar el usuario", Mensaje::ERROR));
            }
        } else {
            $this->showAltaUsuario($errors, filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        }
    }

    public function showEditUsuario(string $username, array $errors = [], array $input = []): void
    {
        $data = array(
            'titulo' => 'Edición de usuario',
            'breadcrumb' => ['trabajadores','Usuarios','Alta de usuario'],
            'seccion' => '/usuarios/alta',
            'listaRoles' => (new AuxRolTrabajadorModel())->getAll(),
            'listaPaises' => (new AuxPaisModel())->getAll()
        );
        $model = new TrabajadoresDbModel();
        if ($input === []) {
            $input = $model->find($username);
            if ($input === false) {
                $this->addFlashMessage(new Mensaje("Usuario $username no encontrado", Mensaje::ERROR));
                header('location: /usuarios');
                die;
            }
        }
        $data['input'] = filter_var_array($input, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['errors'] = $errors;
        $this->view->showViews(array('templates/header.view.php', 'usuario.edit.view.php',
            'templates/footer.view.php'), $data);
    }

    public function doEditUsuario(string $username): void
    {
        $errors = $this->checkInputUsuario($_POST, $username);
        if ($errors === []) {
            $model = new TrabajadoresDbModel();
            $result = $model->updateUsuario($_POST);
            if ($result) {
                $this->addFlashMessage(new Mensaje("Usuario $username editado correctamente", Mensaje::SUCCESS));
            } else {
                $this->addFlashMessage(new Mensaje(
                    "Error indeterminado al editar el usuario $username",
                    Mensaje::ERROR
                ));
            }
            header('location: /usuarios');
        } else {
            $this->showEditUsuario(
                $username,
                $errors,
                filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS)
            );
        }
    }

    public function deleteUsuario(string $username): void
    {
        try {
            $model = new TrabajadoresDbModel();
            $result = $model->deleteUsuario($username);
            if ($result) {
                $this->addFlashMessage(new Mensaje("Usuario $username borrado correctamente", Mensaje::SUCCESS));
            } else {
                $this->addFlashMessage(new Mensaje("Error al borrar el usuario $username", Mensaje::ERROR));
            }
            header('location: /usuarios');
        } catch (\PDOException $e) {
            $this->addFlashMessage(new Mensaje($e->getMessage(), Mensaje::WARNING));
            header('location: /usuarios');
        }
    }

    public function activarUsuario(string $username): void
    {
        $model = new TrabajadoresDbModel();
        $user = $model->find($username);

        if ($user['activo'] == 1) {
            $user['activo'] = 0;
            if ($model->updateUsuario($user)) {
                $this->addFlashMessage(new Mensaje("Usuario $username desactivado correctamente", Mensaje::SUCCESS));
            } else {
                $this->addFlashMessage(new Mensaje(
                    "Error indeterminado al desactivar el usuario $username",
                    Mensaje::ERROR
                ));
            }
        } else {
            $user['activo'] = 1;
            if ($model->updateUsuario($user)) {
                $this->addFlashMessage(new Mensaje("Usuario $username activado correctamente", Mensaje::SUCCESS));
            } else {
                $this->addFlashMessage(new Mensaje(
                    "Error indeterminado al activar el usuario $username",
                    Mensaje::ERROR
                ));
            }
        }

        header('location: /usuarios');
    }

    private function checkInputUsuario(array $input, ?string $username = ''): array
    {
        $errors = [];

        if (empty($input['username'])) {
            $errors['username'] = "El nombre de usuario es obligatorio";
        } elseif (!preg_match('/^\w{4,50}$/iu', $input['username'])) {
            $errors['username'] = "El nombre debe estar formado por letras, números o _ y tener entre 4 y
            50 caracteres";
        } elseif ($username === null || $username !== $input['username']) {
            $model = new TrabajadoresDbModel();

            if ($model->find($input['username']) !== false) {
                $errors['username'] = "El nombre de usuario ya existe";
            }
        }


        if (empty($input['salarioBruto'])) {
            $errors['salario'] = "El salario es obligatorio";
        } elseif (!preg_match('/^\d+(,\d{1,2})?/iu', $input['salarioBruto'])) {
            $errors['salario'] = "El salario debe ser un número con dos decimales como máximo, separados por coma";
        } else {
            $salario = (str_replace(',', '.', $input['salarioBruto']));
            if ($salario < 500) {
                $errors['salario'] = "El salario debe ser mayor a 500";
            }
        }

        if (empty($input['retencionIRPF'])) {
            $errors['irpf'] = "El IRPF es obligatorio";
        } elseif (filter_var($input['retencionIRPF'], FILTER_VALIDATE_INT) === false) {
            $errors['irpf'] = "El IRPF debe ser un numero entero entre 0 y 100";
        } else {
            if ($input['retencionIRPF'] < 0 || $input['retencionIRPF'] > 100) {
                $errors['irpf'] = "El IRPF debe ser un numero entero entre 0 y 100";
            }
        }

        if (!isset($input['activo'])) {
            $errors['activo'] = "Seleccione si el trabajador está activo";
        } elseif (filter_var($input['activo'], FILTER_VALIDATE_BOOL, [FILTER_NULL_ON_FAILURE]) === null) {
            $errors['activo'] = "El formato de activo es incorrecto";
        }

        if (empty($input['id_rol'])) {
            $errors['rol'] = "El rol es obligatorio";
        } elseif (filter_var($input['id_rol'], FILTER_VALIDATE_INT) === false) {
            $errors['rol'] = "El rol introducido no es válido";
        } else {
            $modelAuxRol = new AuxRolTrabajadorModel();
            if ($modelAuxRol->find(intval($input['id_rol'])) === false) {
                $errors['rol'] = "El rol no existe";
            }
        }

        if (empty($input['id_country'])) {
            $errors['pais'] = "El pais es obligatorio";
        } elseif (filter_var($input['id_country'], FILTER_VALIDATE_INT) === false) {
            $errors['pais'] = "El pais introducido no es válido";
        } else {
            $modelAuxPais = new AuxPaisModel();
            if ($modelAuxPais->find(intval($input['id_country'])) === false) {
                $errors['pais'] = "El pais no existe";
            }
        }

        return $errors;
    }
}
