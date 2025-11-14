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
        $listaUsuarios = $model->getByFilters($_GET);


        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['trabajadores','Usuarios'],
            'seccion' => '/usuarios',
            'tituloEjercicio' => 'Lista de usuarios',
            'url' => '/usuarios?' . $queryParams,
            'listaUsuarios' => $listaUsuarios,
            'listaRoles' => $modelAuxRol->getAll(),
            'listaPaises' => $modelAuxPais->getAll(),
            'input' => filter_input_array(INPUT_GET),
            'ordenar' => $model->getOrderInt($_GET),
            'page' => intval($_GET['page'] ?? 1),
            'lastPage' => $model->getNumberOfPages($_GET)
        );

        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php',
            'templates/footer.view.php'), $data);
    }
}
