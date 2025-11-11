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
        $modelAuxRol = new AuxRolTrabajadorModel();
        $modelAuxPais = new AuxPaisModel();
        $input = [];

        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['trabajadores','Usuarios'],
            'seccion' => '/usuarios',
            'tituloEjercicio' => 'Lista de usuarios',
            'listaRoles' => $modelAuxRol->getAll(),
            'listaPaises' => $modelAuxPais->getAll()
        );
        $model = new TrabajadoresDbModel();
        $filters = [];

        if (isset($_GET)) {
            if (!empty($_GET['input_nombre'])) {
                $filters['username'] = $_GET['input_nombre'];
                $input['nombre'] = filter_var($_GET['input_nombre'], FILTER_SANITIZE_STRING);
            }

            if (!empty($_GET['input_rol'])) {
                $filters['id_rol'] = $_GET['input_rol'];
            }

            if (!empty($_GET['max_salario']) && !empty($_GET['min_salario'])) {
                $filters['salario'] = [$_GET['min_salario'], $_GET['max_salario']];
                $input['min_salario'] = filter_var($_GET['min_salario'], FILTER_SANITIZE_NUMBER_FLOAT);
                $input['max_salario'] = filter_var($_GET['max_salario'], FILTER_SANITIZE_NUMBER_FLOAT);
            }

            if (!empty($_GET['input_irpf'])) {
                $filters['irpf'] = $_GET['input_irpf'];
                $input['irpf'] = filter_var($_GET['input_irpf'], FILTER_SANITIZE_NUMBER_INT);
            }

            if (!empty($_GET['input_pais'])) {
                $filters['pais'] = $_GET['input_pais'];
            }
        }

        $data['listaUsuarios'] = $model->getByFilters($filters);
        $data['input'] = $input;

        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php',
            'templates/footer.view.php'), $data);
    }
}
