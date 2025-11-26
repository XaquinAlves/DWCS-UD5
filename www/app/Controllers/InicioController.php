<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\testModel;
use http\Exception\InvalidArgumentException;

session_start();

class InicioController extends BaseController
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

    public function showLogin(array $errors = []): void
    {
        $data = array(
            'titulo' => isset($_SESSION['usuario']) ? 'Ajustes de la cuenta ' . $_SESSION['usuario'] : 'Login',
            'breadcrumb' => ['Inicio', 'Login'],
            'seccion' => '/login',
            'tituloCard' => 'Campos básicos',
            'errors' => $errors
        );

        $this->
        view->showViews(array('templates/header.view.php', 'cuenta.view.php', 'templates/footer.view.php'), $data);
    }

    public function doLogin(): void
    {
        $errors = [];

        if (isset($_POST['usuario']) && $_POST['usuario'] !== '') {
            if (preg_match('/^[a-zA-Z0-9]{3,20}$/', $_POST['usuario']) === 0) {
                $errors[] = 'El nombre de usuario debe contener solo letras y numeros, y tener entre 3 y 20 caracteres';
            } else {
                $_SESSION['usuario'] = $_POST['usuario'];
            }
        } else {
            $errors[] = 'El nombre de usuario es obligatorio';
        }

        if ($errors !== []) {
            $this->showLogin($errors);
        } else {
            header('location: /');
        }
    }

    public function logOut(): void
    {
        session_destroy();
        header('location: /');
    }
}
