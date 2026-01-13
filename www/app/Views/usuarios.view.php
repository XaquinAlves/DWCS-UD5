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
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_usuario">Id de usuario: </label>
                                <input type="number" class="form-control" name="id_usuario" id="id_usuario" min="0"
                                       max="999" placeholder="Id de usuario"
                                       value="<?php echo $input['id_usuario'] ?? '' ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="nombre">Nombre: </label>
                                <input type="text" class="form-control" name="nombre" id="nombre"
                                       placeholder="Nombre de usuario"
                                       value="<?php echo $input['nombre'] ?? '' ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="email">Email: </label>
                                <input type="text" class="form-control" name="email" id="email"
                                       placeholder="Email"
                                       value="<?php echo $input['email'] ?? '' ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_rol">Rol:</label>
                                <select name="rol" id="rol" class="form-control"
                                        data-placeholder="Rol">
                                    <option value="">-</option>
                                    <?php foreach ($listaRoles ?? [] as $rol) { ?>
                                        <option value="<?php echo $rol['id_rol'] ?>" <?php echo
                                        isset($_GET['id_rol']) && $_GET['id_rol'] == $rol['id_rol'] ?
                                            'selected' : '' ?>>
                                            <?php echo ucfirst($rol['rol']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="last_date_bf">Ultima conexión antes de: </label>
                                <input type="date" class="form-control" name="last_date_bf" id="last_date_bf"
                                       value="<?php echo $input['last_date'] ?? '' ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="last_date_af">Ultima conexión después de: </label>
                                <input type="date" class="form-control" name="last_date_af" id="last_date_af"
                                       value="<?php echo $input['last_date'] ?? '' ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="last_date">Idioma: </label>
                                <input type="text" class="form-control" name="idioma" id="idioma"
                                       placeholder="Idioma" maxlength="2"
                                       value="<?php echo $input['idioma'] ?? '' ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <?php if ($_SESSION['permisos']['usuario_sistema']->canWrite()) { ?>
                            <a href="/panel/usuario-sistema/alta" class="btn btn-success float-left">Nuevo usuario</a>
                        <?php } ?>
                        <a href="/panel/usuario-sistema" class="btn btn-danger">Limpiar filtros</a>
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
                                <a href="/panel/usuario-sistema?ordenar=<?php echo $ordenar === 1 ? 2 : 1 ?>">
                                    Id de ususario
                                    <?php echo $ordenar === 1 ?
                                        '<i class="fas fa-sort-amount-down-alt"></i>' :
                                        ($ordenar === 2 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="/panel/usuario-sistema?ordenar=<?php echo $ordenar === 3 ? 4 : 3 ?>">
                                    Nombre
                                    <?php echo $ordenar === 3 ?
                                        '<i class="fas fa-sort-amount-down-alt"></i>' :
                                        ($ordenar === 4 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="/panel/usuario-sistema?ordenar=<?php echo $ordenar === 5 ? 6 : 5 ?>">
                                    Email
                                    <?php echo $ordenar === 5 ?
                                        '<i class="fas fa-sort-amount-down-alt"></i>' :
                                        ($ordenar === 6 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="/panel/usuario-sistema?ordenar=<?php echo $ordenar === 7 ? 8 : 7 ?>">
                                    Rol
                                    <?php echo $ordenar === 7 ?
                                        '<i class="fas fa-sort-amount-down-alt"></i>' :
                                        ($ordenar === 8 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="/panel/usuario-sistema?ordenar=<?php echo $ordenar === 9 ? 10 : 9 ?>">
                                    Ultima conexión
                                    <?php echo $ordenar === 9 ?
                                        '<i class="fas fa-sort-amount-down-alt"></i>' :
                                        ($ordenar === 10 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="/panel/usuario-sistema?ordenar=<?php echo $ordenar === 11 ? 12 : 11 ?>">
                                    Idioma
                                    <?php echo $ordenar === 11 ?
                                        '<i class="fas fa-sort-amount-down-alt"></i>' :
                                        ($ordenar === 12 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <?php if (
                                $_SESSION['permisos']['usuario_sistema']->canWrite() ||
                                $_SESSION['permisos']['usuario_sistema']->canDelete()
) { ?>
                                <th>Editar / Borrar</th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listaUsuarios as $usuario) { ?>
                            <tr class="<?php echo $usuario['baja'] != 0 ? 'bg-danger' : '' ?>">
                                <td><?php echo $usuario['id_usuario'] ?></td>
                                <td><?php echo $usuario['nombre'] ?></td>
                                <td><?php echo $usuario['email'] ?></td>
                                <td><?php echo $usuario['rol'] ?></td>
                                <td><?php echo $usuario['last_date'] ?></td>
                                <td><?php echo $usuario['idioma'] ?></td>
                                <?php if (
                                    $_SESSION['permisos']['usuario_sistema']->canWrite() ||
                                    $_SESSION['permisos']['usuario_sistema']->canDelete()
) { ?>
                                    <td>
                                        <?php if ($_SESSION['permisos']['usuario_sistema']->canWrite()) { ?>
                                            <a href="/panel/usuario-sistema/editar/<?php echo $usuario['id_usuario'] ?>"
                                               class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        <?php } ?>
                                        <?php if ($_SESSION['permisos']['usuario_sistema']->canDelete()) { ?>
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
                                            <a href="/panel/usuario-sistema/borrar/<?php echo $usuario['id_usuario'] ?>"
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
