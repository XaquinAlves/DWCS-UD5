<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Models\testModel;
use http\Exception\InvalidArgumentException;

class InicioController extends \Com\Daw2\Core\BaseController
{
    public function index(): void
    {
        $data = array(
            'titulo' => 'Página de inicio',
            'breadcrumb' => ['Inicio'],
            'seccion' => '/inicio'
        );
        $this->view->showViews(array('templates/header.view.php', 'inicio.view.php',
            'templates/footer.view.php'), $data);
    }

    public function demo(): void
    {
        $data = array(
            'titulo' => 'Demo html proveedores',
            'breadcrumb' => ['Inicio', 'Demo proveedores'],
            'seccion' => '/demo-proveedores'
        );
        $this->view->showViews(array('templates/header.view.php', 'proveedores.sample.php',
            'templates/footer.view.php'), $data);
    }

    public function showSeleccionarTema(): void
    {
        $data = array(
            'titulo' => 'Configuracion de estilos',
            'breadcrumb' => ['Panel de control', 'Temas'],
            'seccion' => '/panel/temas',
            'tituloCard' => 'Temas'
        );

        $this->
        view->showViews(array('templates/header.view.php', 'styles.view.php', 'templates/footer.view.php'), $data);
    }

    public function doSeleccionarTema(): void
    {
        if (isset($_POST['tema']) && in_array($_POST['tema'], ['default', 'dark-mode'])) {
            setcookie('tema', $_POST['tema'], time() + 3600 * 24, '/');
            $_COOKIE['tema'] = $_POST['tema'];
        }

        $this->showSeleccionarTema();
    }

    public function doSeleccionarTemaModal(string $url = ''): void
    {
        if (isset($_POST['tema']) && in_array($_POST['tema'], ['default', 'dark-mode'])) {
            setcookie('tema', $_POST['tema'], time() + 3600 * 24, '/');
            $_COOKIE['tema'] = $_POST['tema'];
        }

        if ($url === '') {
            header('location: /');
        } else {
            header('location: ' . $url);
        }
    }
}
