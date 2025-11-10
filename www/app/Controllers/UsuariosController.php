<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Models\UsuariosModel;

class UsuariosController extends \Com\Daw2\Core\BaseController
{
    public function getUsuarios(): void
    {
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['trabajadores','Usuarios'],
            'seccion' => '/usuarios',
            'tituloEjercicio' => 'Lista de usuarios'
        );

        $model = new UsuariosModel();

        $data['listaUsuarios'] = $model->getUsuarios();
        $data['listaRoles'] = $model->getRoles();

        if (isset($_GET)) {
            if (!empty($_GET['input_rol'])) {
                $data['listaUsuarios'] = $model->getUsuariosByRol();
            }
        }

        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php',
            'templates/footer.view.php'), $data);
    }
}