<?php

namespace Com\Daw2\Core;

use Com\Daw2\Controllers\CsvController;
use Com\Daw2\Controllers\ErroresController;
use Com\Daw2\Controllers\InicioController;
use Com\Daw2\Controllers\ProductosController;
use Com\Daw2\Controllers\TrabajadoresController;
use Com\Daw2\Controllers\UsuariosController;
use Steampixel\Route;

class FrontController
{
    public static function main(): void
    {
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
                $controlador = new InicioController();
                $controlador->demo();
            },
            'get'
        );

        Route::add(
            '/trabajadores-all',
            function () {
                $controlador = new TrabajadoresController();
                $controlador->getAllTrabajadores();
            },
            'get'
        );

        Route::add(
            '/trabajadores-all-assoc',
            function () {
                $controlador = new TrabajadoresController();
                $controlador->getAllTrabajadoresAssoc();
            },
            'get'
        );

        Route::add(
            '/trabajadores-salario',
            function () {
                $controlador = new TrabajadoresController();
                $controlador->getAllTrabajadoresBySalario();
            },
            'get'
        );

        Route::add(
            '/trabajadores-salario-assoc',
            function () {
                $controlador = new TrabajadoresController();
                $controlador->getAllTrabajadoresBySalarioAssoc();
            },
            'get'
        );

        Route::add(
            '/trabajadores-standard',
            function () {
                $controlador = new TrabajadoresController();
                $controlador->getTrabajadoresStandard();
            },
            'get'
        );

        Route::add(
            '/trabajadores-standard-assoc',
            function () {
                $controlador = new TrabajadoresController();
                $controlador->getTrabajadoresStandardAssoc();
            },
            'get'
        );

        Route::add(
            '/trabajadores-carlos',
            function () {
                $controlador = new TrabajadoresController();
                $controlador->getTrabajadoresCarlos();
            },
            'get'
        );

        Route::add(
            '/trabajadores-carlos-assoc',
            function () {
                $controlador = new TrabajadoresController();
                $controlador->getTrabajadoresCarlosAssoc();
            },
            'get'
        );

        Route::add(
            '/poblacion-pontevedra',
            function () {
                $controlador = new CsvController();
                $controlador->getPoblacionPontevedra();
            },
            'get'
        );

        Route::add(
            '/poblacion-grupos-edad',
            function () {
                $controlador = new CsvController();
                $controlador->getPoblacionGruposEdad();
            },
            'get'
        );

        Route::add(
            '/usuarios',
            function () {
                $controlador = new TrabajadoresController();
                $controlador->getUsuarios();
            },
            'get'
        );

        Route::add(
            '/productos',
            function () {
                $controlador = new ProductosController();
                $controlador->getProductos();
            },
            'get'
        );

        Route::add(
            '/usuarios/alta',
            function () {
                $controlador = new TrabajadoresController();
                $controlador->showAltaUsuario();
            },
            'get'
        );

        Route::add(
            '/usuarios/alta',
            function () {
                $controlador = new TrabajadoresController();
                $controlador->doAltaUsuario();
            },
            'post'
        );

        Route::add(
            '/usuarios/editar/(\w{3,50})',
            function ($username) {
                $controlador = new TrabajadoresController();
                $controlador->showEditUsuario($username);
            },
            'get'
        );

        Route::add(
            '/usuarios/editar/(\w{3,50})',
            function () {
                $controlador = new TrabajadoresController();
                $controlador->doEditUsuario();
            },
            'post'
        );

        Route::add(
            '/usuarios/borrar/(\w{3,50})',
            function ($username) {
                $controlador = new TrabajadoresController();
                $controlador->deleteUsuario($username);
            },
            'get'
        );

        Route::add(
            '/usuarios/activar/(\w{3,50})',
            function ($username) {
                $controlador = new TrabajadoresController();
                $controlador->activarUsuario($username);
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
        Route::run($_ENV['host.folder']);
    }
}
