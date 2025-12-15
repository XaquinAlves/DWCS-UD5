<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;
use Com\Daw2\Libraries\Mensaje;
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
        $data = array(
            'titulo' => 'Añadir nueva categoría',
            'breadcrumb' => ['categorias', 'alta'],
            'seccion' => '/categorias/alta',
            'input' => $input,
            'listaCategorias' => (new CategoriasModel())->getCategorias(),
            'errors' => $errors,
        );

        $this->view->showViews(array('templates/header.view.php', 'categorias.edit.view.php',
            'templates/footer.view.php'), $data);
    }

    public function doAltaCategoria(): void
    {
        $model = new CategoriasModel();
        $errors = $this->checkInputCategoria($_POST);

        if ($errors !== []) {
            $this->showAltaCategoria($errors, filter_input_array(INPUT_POST));
        } else {
            $nombre = $_POST['nombre'];
            if ($model->addCategoria($_POST)) {
                $this->addFlashMessage(new Mensaje("Categoria $nombre añadida correctamente", Mensaje::SUCCESS));
            } else {
                $this->addFlashMessage(new Mensaje(
                    "Error indeterminado al guardar la categoría $nombre",
                    Mensaje::ERROR
                ));
            }
            header('location: /categorias');
        }
    }

    private function checkInputCategoria(array $input): array
    {
        $errors = [];

        if ($_POST['nombre'] === '') {
            $errors['nombre'] = 'Campo requerido';
        } elseif (strlen($_POST['nombre']) > 50) {
            $errors['nombre'] = 'El nombre introducido es demasiado largo, 50 caracteres máximo';
        }

        return $errors;
    }

    public function showEditarCategoria(int $id_cat, array $errors = [], array $input = []): void
    {
        $model = new CategoriasModel();

        $data = array(
            'titulo' => 'Editar categoría',
            'breadcrumb' => ['categorias', 'editar'],
            'seccion' => '/categorias/editar',
            'listaCategorias' => $model->getCategorias()
        );
        if ($input === []) {
            $input = $model->findCategoria($id_cat);
            if ($input === false) {
                $this->addFlashMessage(new Mensaje("Categoria $id_cat no encontrada", Mensaje::ERROR));
                header('location: /categorias');
                die;
            }
        }
        $data['input'] = filter_var_array($input, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $data['errors'] = $errors;

        $this->view->showViews(array('templates/header.view.php', 'categorias.edit.view.php',
            'templates/footer.view.php'), $data);
    }
}
