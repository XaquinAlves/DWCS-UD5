<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\testModel;
use Com\Daw2\Models\UsuarioSistemaModel;
use http\Exception\InvalidArgumentException;

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

    public function showChangeUsername(array $input = [], array $errors = []): void
    {
        if ($input === []) {
            $input['usuario'] = $_SESSION['usuario']['nombre'] ?? '';
        }

        $data = array(
            'titulo' => isset($_SESSION['usuario']) ? 'Ajustes de la cuenta ' . $_SESSION['usuario']['nombre'] :
                'Login',
            'breadcrumb' => ['Panel', 'Username'],
            'seccion' => '/login',
            'tituloCard' => 'Campos básicos',
            'errors' => $errors,
            'input' => $input
        );

        $this->
        view->showViews(array('templates/header.view.php', 'cuenta.view.php', 'templates/footer.view.php'), $data);
    }

    public function doChangeUsername(): void
    {
        $errors = [];

        if (isset($_POST['usuario']) && $_POST['usuario'] !== '') {
            if (preg_match('/^[\p{L}0-9]{3,20}$/', $_POST['usuario']) === 0) {
                $errors['usuario'] = 'El nombre de usuario debe contener solo letras y números, 
                                        y tener entre 3 y 20 caracteres';
            } else {
                $model = new UsuarioSistemaModel();
                if ($model->changeName($_SESSION['usuario']['nombre'], $_POST['usuario'])) {
                    $_SESSION['usuario']['nombre'] = $_POST['usuario'];
                } else {
                    $errors['usuario'] = 'Error con la base de datos';
                }
            }
        } else {
            $errors['usuario'] = 'El nombre de usuario es obligatorio';
        }

        if ($errors !== []) {
            $this->showChangeUsername(filter_input_array(INPUT_POST), $errors);
        } else {
            header('location: /');
        }
    }

    public function showLogin(array $errors = []): void
    {
        $data = [
            'titulo' => 'Login',
            'breadcrumb' => ['Login'],
            'seccion' => '/login',
            'errors' => $errors
        ];

        $this->view->showViews(array('login.view.php'), $data);
    }

    public function doLogin(): void
    {
        $errors = [];
        $model = new UsuarioSistemaModel();

        if (isset($_POST['email']) && isset($_POST['pass'])) {
            $user = $model->findUsuario($_POST['email']);
            if ($user !== []) {
                $_SESSION['usuario'] = $user;
            } else {
                $errors['login'] = "Datos incorrectos";
            }
        } else {
            $errors['login'] = 'Campo vacío';
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
        header('location: /login');
    }
}
