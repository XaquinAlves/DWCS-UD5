<?php

  namespace Com\Daw2\Core;

abstract class BaseController
{
    protected View $view;

    public function __construct()
    {
        $this->view = new View(get_class($this));
    }
}
