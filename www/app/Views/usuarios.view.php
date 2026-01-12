<?php

declare(strict_types=1);

?>
<div class="row">
    <div class="col-12">
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
            <form method="get" action="">
                <input type="hidden" id="ordenar" name="ordenar" value="<?php echo $ordenar ?>">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="id_cat">Id de categoría: </label>
                                <input type="number" class="form-control" name="id_cat" id="id_cat" min="0"
                                       max="99" placeholder="Id de categoría"
                                       value="<?php echo $input['id_cat'] ?? '' ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="cat_name">Nombre de categoría: </label>
                                <input type="text" class="form-control" name="cat_name" id="cat_name"
                                       placeholder="Nombre de categoría"
                                       value="<?php echo $input['cat_name'] ?? '' ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="id_padre">Id del padre: </label>
                                <input type="number" class="form-control" name="id_padre" id="id_padre" min="0"
                                       max="99" placeholder="Id del padre"
                                       value="<?php echo $input['id_padre'] ?? '' ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="padre_name">Nombre del padre: </label>
                                <input type="text" class="form-control" name="padre_name" id="padre_name"
                                       placeholder="Nombre del padre"
                                       value="<?php echo $input['padre_name'] ?? '' ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <?php if ($_SESSION['permisos']['usuario_sistema']->canWrite()) { ?>
                            <a href="/usuarios-sistema/alta" class="btn btn-success float-left">Nueva categoría</a>
                        <?php } ?>
                        <a href="/usuarios-sistema" class="btn btn-danger">Limpiar filtros</a>
                        <input type="submit" value="Buscar" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>
                                <a href="/usuarios-sistema?ordenar=<?php echo $ordenar === 1 ? 2 : 1 ?>">
                                    Id de ususario
                                    <?php echo $ordenar === 1 ?
                                        '<i class="fas fa-sort-amount-down-alt"></i>' :
                                        ($ordenar === 2 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="/usuarios-sistema?ordenar=<?php echo $ordenar === 3 ? 4 : 3 ?>">
                                    Nombre
                                    <?php echo $ordenar === 3 ?
                                        '<i class="fas fa-sort-amount-down-alt"></i>' :
                                        ($ordenar === 4 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="/usuarios-sistema?ordenar=<?php echo $ordenar === 5 ? 6 : 5 ?>">
                                    Email
                                    <?php echo $ordenar === 5 ?
                                        '<i class="fas fa-sort-amount-down-alt"></i>' :
                                        ($ordenar === 6 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="/usuarios-sistema?ordenar=<?php echo $ordenar === 7 ? 8 : 7 ?>">
                                    Rol
                                    <?php echo $ordenar === 7 ?
                                        '<i class="fas fa-sort-amount-down-alt"></i>' :
                                        ($ordenar === 8 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="/usuarios-sistema?ordenar=<?php echo $ordenar === 9 ? 10 : 9 ?>">
                                    Ultima conexión
                                    <?php echo $ordenar === 9 ?
                                        '<i class="fas fa-sort-amount-down-alt"></i>' :
                                        ($ordenar === 10 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="/usuarios-sistema?ordenar=<?php echo $ordenar === 11 ? 12 : 11 ?>">
                                    Idioma
                                    <?php echo $ordenar === 11 ?
                                        '<i class="fas fa-sort-amount-down-alt"></i>' :
                                        ($ordenar === 12 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <?php if (
                                $_SESSION['permisos']['usuario-sistema']->canWrite() ||
                                $_SESSION['permisos']['usuario-sistema']->canDelete()
) { ?>
                                <th>Editar / Borrar</th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listaUsuarios as $usuario) { ?>
                            <tr>
                                <td><?php echo $usuario['id_usuario'] ?></td>
                                <td><?php echo $usuario['nombre'] ?></td>
                                <td><?php echo $usuario['email'] ?></td>
                                <td><?php echo $usuario['rol'] ?></td>
                                <td><?php echo $usuario['last_date'] ?></td>
                                <td><?php echo $usuario['idioma'] ?></td>
                                <?php if (
                                    $_SESSION['permisos']['usuario-sistema']->canWrite() ||
                                    $_SESSION['permisos']['usuario-sistema']->canDelete()
) { ?>
                                    <td>
                                        <?php if ($_SESSION['permisos']['usuario-sistema']->canWrite()) { ?>
                                            <a href="/usuarios-sistema/editar/<?php echo $usuario['id_usuario'] ?>"
                                               class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        <?php } ?>
                                        <?php if ($_SESSION['permisos']['usuario-sistema']->canDelete()) { ?>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#<?php
                                                    echo "user" . $usuario['id_usuario'] ?>borradoModal">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        <?php } ?>
                                    </td>
                                <?php } ?>

                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="<?php echo "user" . $usuario['id_usuario'] ?>borradoModal"
                                 tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="<?php echo "user" . $usuario['id_usuario'] ?>borradoModalLabel">
                                                ¿Estás seguro de borrar el usuario
                                                <?php echo $usuario['nombre'] ?> ?
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Cancelar
                                            </button>
                                            <a href="/usuarios-sistema/borrar/<?php echo $usuario['id_usuario'] ?>"
                                               class="btn btn-danger">
                                                Borrar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Card footer -->
            <div class="card-footer">
                <div class="col-12 text-right">

                </div>
            </div>
        </div>
    </div>
</div>
