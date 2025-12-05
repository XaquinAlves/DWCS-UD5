<?php

namespace Com\Daw2\Core;

use Com\Daw2\Controllers\CsvController;
use Com\Daw2\Controllers\ErroresController;
use Com\Daw2\Controllers\InicioController;
use Com\Daw2\Controllers\ProductosController;
use Com\Daw2\Controllers\ProveedoresController;
use Com\Daw2\Controllers\TrabajadoresController;
use Com\Daw2\Controllers\UsuariosController;
use Com\Daw2\Controllers\UsuariosSistemaController;
use Steampixel\Route;

class FrontController
{
    public static function main(): void
    {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            Route::add(
                '/login',
                function () {
                    $controller = new UsuariosSistemaController();
                    $controller->showLogin();
                }
            );

            Route::add(
                '/login',
                function () {
                    $controlador = new UsuariosSistemaController();
                    $controlador->doLogin();
                },
                'post'
            );

            Route::add(
                '/login/google',
                function () {
                    $controller = new UsuariosSistemaController();
                    $controller->showLoginGoogle();
                }
            );

            Route::add(
                '/login/google-oauth.php',
                function () {
                    $controller = new UsuariosSistemaController();
                    $controller->googleLogin();
                }
            );

            Route::add(
                '/google-oauth.php',
                function () {
                    $controller = new UsuariosSistemaController();
                    $controller->googleLogin();
                }
            );

            Route::pathNotFound(
                function () {
                    header('Location: ' . $_ENV['host.folder'] . 'login');
                }
            );
        } else {
            Route::add(
                '/',
                function () {
                    $controlador = new InicioController();
                    $controlador->index();
                },
                'get'
            );

            Route::add(
                '/demo-proveedores',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2', '3']))) {
                        $controlador = new InicioController();
                        $controlador->demo();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/trabajadores-all',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2']))) {
                        $controlador = new TrabajadoresController();
                        $controlador->getAllTrabajadores();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/trabajadores-all-assoc',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2']))) {
                        $controlador = new TrabajadoresController();
                        $controlador->getAllTrabajadoresAssoc();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/trabajadores-salario',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2']))) {
                        $controlador = new TrabajadoresController();
                        $controlador->getAllTrabajadoresBySalario();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/trabajadores-salario-assoc',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2']))) {
                        $controlador = new TrabajadoresController();
                        $controlador->getAllTrabajadoresBySalarioAssoc();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/trabajadores-standard',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2']))) {
                        $controlador = new TrabajadoresController();
                        $controlador->getTrabajadoresStandard();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/trabajadores-standard-assoc',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2']))) {
                        $controlador = new TrabajadoresController();
                        $controlador->getTrabajadoresStandardAssoc();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/trabajadores-carlos',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2']))) {
                        $controlador = new TrabajadoresController();
                        $controlador->getTrabajadoresCarlos();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/trabajadores-carlos-assoc',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2']))) {
                        $controlador = new TrabajadoresController();
                        $controlador->getTrabajadoresCarlosAssoc();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/poblacion-pontevedra',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2']))) {
                        $controlador = new CsvController();
                        $controlador->getPoblacionPontevedra();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/poblacion-grupos-edad',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2']))) {
                        $controlador = new CsvController();
                        $controlador->getPoblacionGruposEdad();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/usuarios',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2']))) {
                        $controlador = new TrabajadoresController();
                        $controlador->getUsuarios();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/productos',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2','3','4']))) {
                        $controlador = new ProductosController();
                        $controlador->getProductos();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/productos/alta',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2','3','4']))) {
                        $controlador = new ProductosController();
                        $controlador->showAltaProducto();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );
            Route::add(
                '/productos/alta',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2','3','4']))) {
                        $controlador = new ProductosController();
                        $controlador->doAltaProducto();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'post'
            );

            Route::add(
                '/proveedores',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2','3']))) {
                        $controlador = new ProveedoresController();
                        $controlador->showProveedores();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/proveedores/alta',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2','3']))) {
                        $controlador = new ProveedoresController();
                        $controlador->showAltaProveedor();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/proveedores/alta',
                function () {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2','3']))) {
                        $controlador = new ProveedoresController();
                        $controlador->doAltaProveedor();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'post'
            );

            Route::add(
                '/proveedores/editar/(\w{3,50})',
                function ($cif) {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2','3']))) {
                        $controlador = new ProveedoresController();
                        $controlador->showEditProveedor($cif);
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/proveedores/editar/(\w{3,50})',
                function ($cif) {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2','3']))) {
                        $controlador = new ProveedoresController();
                        $controlador->doEditProveedor($cif);
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'post'
            );

            Route::add(
                '/proveedores/borrar/(\w{3,50})',
                function ($cif) {
                    if ((in_array($_SESSION['usuario']['id_rol'], ['1', '2','3']))) {
                        $controlador = new ProveedoresController();
                        $controlador->doDeleteProveedor($cif);
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/usuarios/alta',
                function () {
                    if (($_SESSION['usuario']['id_rol'] == '1')) {
                        $controlador = new TrabajadoresController();
                        $controlador->showAltaUsuario();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/usuarios/alta',
                function () {
                    if (($_SESSION['usuario']['id_rol'] == '1')) {
                        $controlador = new TrabajadoresController();
                        $controlador->doAltaUsuario();
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'post'
            );

            Route::add(
                '/usuarios/editar/(\w{3,50})',
                function ($username) {
                    if (($_SESSION['usuario']['id_rol'] == '1')) {
                        $controlador = new TrabajadoresController();
                        $controlador->showEditUsuario($username);
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/usuarios/editar/(\w{3,50})',
                function ($username) {
                    if (($_SESSION['usuario']['id_rol'] == '1')) {
                        $controlador = new TrabajadoresController();
                        $controlador->doEditUsuario($username);
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'post'
            );

            Route::add(
                '/usuarios/borrar/(\w{3,50})',
                function ($username) {
                    if (($_SESSION['usuario']['id_rol'] == '1')) {
                        $controlador = new TrabajadoresController();
                        $controlador->deleteUsuario($username);
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/usuarios/activar/(\w{3,50})',
                function ($username) {
                    if (($_SESSION['usuario']['id_rol'] == '1')) {
                        $controlador = new TrabajadoresController();
                        $controlador->activarUsuario($username);
                    } else {
                        $controlador = new ErroresController();
                        $controlador->error403();
                    }
                },
                'get'
            );

            Route::add(
                '/panel/temas',
                function () {
                    $controlador = new InicioController();
                    $controlador->showSeleccionarTema();
                },
                'get'
            );

            Route::add(
                '/panel/temas',
                function () {
                    $controlador = new InicioController();
                    $controlador->doSeleccionarTema();
                },
                'post'
            );

            Route::add(
                '/temas(\/?[\w-]{0,50})',
                function ($url) {
                    $controlador = new InicioController();
                    $controlador->doSeleccionarTemaModal($url);
                },
                'post'
            );

            Route::add(
                '/panel/usuario',
                function () {
                    $controlador = new UsuariosSistemaController();
                    $controlador->showChangeUsername();
                },
                'get'
            );

            Route::add(
                '/panel/usuario',
                function () {
                    $controlador = new UsuariosSistemaController();
                    $controlador->doChangeUsername();
                },
                'post'
            );

            Route::add(
                '/panel/pass',
                function () {
                    $controlador = new UsuariosSistemaController();
                    $controlador->doCambiarPass();
                },
                'post'
            );

            Route::add(
                '/logout',
                function () {
                    $controlador = new UsuariosSistemaController();
                    $controlador->logOut();
                },
                'get'
            );

            Route::pathNotFound(
                function () {
                    $controller = new ErroresController();
                    $controller->error404();
                }
            );

            Route::methodNotAllowed(
                function () {
                    $controller = new ErroresController();
                    $controller->error405();
                }
            );
        }

        Route::run($_ENV['host.folder']);
    }
}
