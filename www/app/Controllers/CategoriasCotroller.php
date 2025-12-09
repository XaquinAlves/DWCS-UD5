<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Models\CategoriasModel;

class CategoriasCotroller extends BaseController
{
    public function showCategorias(): void
    {
        $model = new CategoriasModel();

        $data = array(
            'titulo' => 'Categorías',
            'breadcrumb' => ['categorias'],
            'seccion' => '/categorias',
            'input' => filter_input_array(INPUT_GET),
            'listaCategorias' => $model->getCategoriasByFilters($_GET),
            'ordenar' => $model->getOrder($_GET)
        );

        $this->view->showViews(array('templates/header.view.php', 'categorias.view.php',
            'templates/footer.view.php'), $data);
    }

    public function showAltaCategoria(array $errors = [], array $input = []): void
    {
        $model = new CategoriasModel();

        $data = array(
            'titulo' => 'Añadir nueva categoría',
            'breadcrumb' => ['categorias', 'alta'],
            'seccion' => '/categorias/alta',
            'input' => $input,
            'listaCategorias' => $model->getCategorias(),
            'errors' => $errors,
        );

        $this->view->showViews(array('templates/header.view.php', 'categorias.edit.view.php',
            'templates/footer.view.php'), $data);
    }

    public function doAltaCategoria(): void
    {
        $model = new CategoriasModel();
        $errors = [];

        if ($_POST['nombre'] === '') {
            $errors['nombre'] = 'Campo requerido';
        }

        if ($errors !== []) {
            $this->showAltaCategoria($errors, filter_input_array(INPUT_POST));
        } else {
            if ($model->addCategoria($_POST)) {
                header('location: /categorias');
            } else {
                $errors['db'] = 'Error en la inserción';
                $this->showAltaCategoria($errors, $_POST);
            }
        }
    }

    public function showEditarCategoria(int $id_cat, array $errors = [], array $input = []): void
    {
        $model = new CategoriasModel();

        $data = array(
            'titulo' => 'Editar categoría',
            'breadcrumb' => ['categorias', 'editar'],
            'seccion' => '/categorias/editar',
            'input' => $input,
            'categoriaEditar' => $model->findCategoria($id_cat),
            'listaCategorias' => $model->getCategorias(),
            'errors' => $errors,
        );

        $this->view->showViews(array('templates/header.view.php', 'categorias.edit.view.php',
            'templates/footer.view.php'), $data);
    }
}
