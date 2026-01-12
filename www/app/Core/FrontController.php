<?php

namespace Com\Daw2\Core;

use Com\Daw2\Controllers\CategoriasCotroller;
use Com\Daw2\Controllers\CsvController;
use Com\Daw2\Controllers\ErroresController;
use Com\Daw2\Controllers\InicioController;
use Com\Daw2\Controllers\ProductosController;
use Com\Daw2\Controllers\ProveedoresController;
use Com\Daw2\Controllers\TrabajadoresController;
use Com\Daw2\Controllers\UsuariosController;
use Com\Daw2\Controllers\UsuariosSistemaController;
use Com\Daw2\Libraries\Permisos;
use Steampixel\Route;

class FrontController
{
    public static function main(): void
    {

        try {
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
                        if ($_SESSION['permisos']['proveedor']->canRead()) {
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
                    '/trabajadores',
                    function () {
                        if ($_SESSION['permisos']['trabajadores']->canRead()) {
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
                    '/trabajadores/alta',
                    function () {
                        if ($_SESSION['permisos']['trabajadores']->canWrite()) {
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
                    '/trabajadores/alta',
                    function () {
                        if ($_SESSION['permisos']['trabajadores']->canWrite()) {
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
                    '/trabajadores/editar/(\w{3,50})',
                    function ($username) {
                        if ($_SESSION['permisos']['trabajadores']->canWrite()) {
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
                    '/trabajadores/editar/(\w{3,50})',
                    function ($username) {
                        if ($_SESSION['permisos']['trabajadores']->canWrite()) {
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
                    '/trabajadores/borrar/(\w{3,50})',
                    function ($username) {
                        if ($_SESSION['permisos']['trabajadores']->canDelete()) {
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
                    '/trabajadores/activar/(\w{3,50})',
                    function ($username) {
                        if ($_SESSION['permisos']['trabajadores']->canWrite()) {
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
                    '/trabajadores-all',
                    function () {
                        if ($_SESSION['permisos']['trabajadores']->canRead()) {
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
                        if ($_SESSION['permisos']['trabajadores']->canRead()) {
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
                        if ($_SESSION['permisos']['trabajadores']->canRead()) {
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
                        if ($_SESSION['permisos']['trabajadores']->canRead()) {
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
                        if ($_SESSION['permisos']['trabajadores']->canRead()) {
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
                        if ($_SESSION['permisos']['trabajadores']->canRead()) {
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
                        if ($_SESSION['permisos']['trabajadores']->canRead()) {
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
                        if ($_SESSION['permisos']['trabajadores']->canRead()) {
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
                        if ($_SESSION['permisos']['csv']->canRead()) {
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
                        if ($_SESSION['permisos']['csv']->canRead()) {
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
                    '/productos',
                    function () {
                        if ($_SESSION['permisos']['producto']->canRead()) {
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
                        if ($_SESSION['permisos']['producto']->canWrite()) {
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
                        if ($_SESSION['permisos']['producto']->canWrite()) {
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
                    '/productos/editar/(\w{3,50})',
                    function ($producto) {
                        if ($_SESSION['permisos']['producto']->canWrite()) {
                            $controlador = new ProductosController();
                            $controlador->showEditarProducto($producto);
                        } else {
                            $controlador = new ErroresController();
                            $controlador->error403();
                        }
                    },
                    'get'
                );
                Route::add(
                    '/productos/editar/(\w{3,50})',
                    function ($producto) {
                        if ($_SESSION['permisos']['producto']->canWrite()) {
                            $controlador = new ProductosController();
                            $controlador->doEditarProducto($producto);
                        } else {
                            $controlador = new ErroresController();
                            $controlador->error403();
                        }
                    },
                    'post'
                );

                Route::add(
                    '/productos/borrar/(\w{3,50})',
                    function ($producto) {
                        if ($_SESSION['permisos']['producto']->canDelete()) {
                            $controlador = new ProductosController();
                            $controlador->deleteProducto($producto);
                        } else {
                            $controlador = new ErroresController();
                            $controlador->error403();
                        }
                    },
                    'get'
                );

                Route::add(
                    '/proveedores',
                    function () {
                        if ($_SESSION['permisos']['proveedor']->canRead()) {
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
                        if ($_SESSION['permisos']['proveedor']->canWrite()) {
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
                        if ($_SESSION['permisos']['proveedor']->canWrite()) {
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
                        if ($_SESSION['permisos']['proveedor']->canWrite()) {
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
                        if ($_SESSION['permisos']['proveedor']->canWrite()) {
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
                        if ($_SESSION['permisos']['proveedor']->canDelete()) {
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
                    '/categorias',
                    function () {
                        if ($_SESSION['permisos']['categoria']->canRead()) {
                            $controlador = new CategoriasCotroller();
                            $controlador->showCategorias();
                        } else {
                            $controlador = new ErroresController();
                            $controlador->error403();
                        }
                    },
                    'get'
                );

                Route::add(
                    '/categorias/alta',
                    function () {
                        if ($_SESSION['permisos']['categoria']->canWrite()) {
                            $controlador = new CategoriasCotroller();
                            $controlador->showAltaCategoria();
                        } else {
                            $controlador = new ErroresController();
                            $controlador->error403();
                        }
                    },
                    'get'
                );

                Route::add(
                    '/categorias/alta',
                    function () {
                        if ($_SESSION['permisos']['categoria']->canWrite()) {
                            $controlador = new CategoriasCotroller();
                            $controlador->doAltaCategoria();
                        } else {
                            $controlador = new ErroresController();
                            $controlador->error403();
                        }
                    },
                    'post'
                );

                Route::add(
                    '/categorias/editar/(\d{1,3})',
                    function ($id_cat) {
                        if ($_SESSION['permisos']['categoria']->canWrite()) {
                            $controlador = new CategoriasCotroller();
                            $controlador->showEditarCategoria((int)$id_cat);
                        } else {
                            $controlador = new ErroresController();
                            $controlador->error403();
                        }
                    },
                    'get'
                );

                Route::add(
                    '/categorias/editar/(\d{1,3})',
                    function ($id_cat) {
                        if ($_SESSION['permisos']['categoria']->canWrite()) {
                            $controlador = new CategoriasCotroller();
                            $controlador->doEditarCategoria((int)$id_cat);
                        } else {
                            $controlador = new ErroresController();
                            $controlador->error403();
                        }
                    },
                    'post'
                );

                Route::add(
                    '/categorias/borrar/(\d{1,3})',
                    function ($id_cat) {
                        if ($_SESSION['permisos']['categoria']->canDelete()) {
                            $controlador = new CategoriasCotroller();
                            $controlador->deleteCategoria((int)$id_cat);
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
        } catch (\Throwable $e) {
            $controller = new ErroresController();
            $controller->showThrowable($e);
        }
    }

}
