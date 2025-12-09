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
}
