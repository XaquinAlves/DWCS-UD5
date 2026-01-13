<?php

declare(strict_types=1);

?>

<div class="row">
    <div class="col-12">
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
            <form method="get" action="">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Campos del Usuario</h6>
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
                                <input type="email" class="form-control" name="email" id="email"
                                       placeholder="Email"
                                       value="<?php echo $input['email'] ?? '' ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="pass">Contraseña: </label>
                                <input type="password" class="form-control" name="pass" id="pass"
                                       placeholder="Contraseña"
                                       value="<?php echo $input['pass'] ?? '' ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="rol">Rol:</label>
                                <select name="rol" id="rol" class="form-control"
                                        data-placeholder="Rol">
                                    <option value="">-</option>
                                    <?php foreach ($listaRoles ?? [] as $rol) { ?>
                                        <option value="<?php echo $rol['id_rol'] ?>" <?php echo
                                        isset($_GET['rol']) && $_GET['rol'] == $rol['id_rol'] ?
                                            'selected' : '' ?>>
                                            <?php echo ucfirst($rol['rol']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="idioma">Idioma: </label>
                                <input type="text" class="form-control" name="idioma" id="idioma"
                                       placeholder="Idioma" maxlength="2"
                                       value="<?php echo $input['idioma'] ?? '' ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="mb-3">
                            <label for="id_usuario">Baja: </label>
                            <input type="number" class="form-control" name="id_usuario" id="id_usuario" min="0"
                                   max="1" placeholder="baja"
                                   value="<?php echo $input['baja'] ?? '' ?>"/>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/panel/usuario-sistema" class="btn btn-danger">Cancelar</a>
                        <input type="submit" value="Guardar" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
