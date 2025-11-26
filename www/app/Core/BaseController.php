<?php

  namespace Com\Daw2\Core;

abstract class BaseController
{
    protected View $view;

    public function __construct()
    {
        $this->view = new View(get_class($this));

        $rutaActual = $_SERVER['REQUEST_URI'];
        $rutasPublicas = ['/login'];

        if (!isset($_SESSION['usuario']) && !in_array($rutaActual, $rutasPublicas)) {
            header('location: /login');
        }
    }
}
