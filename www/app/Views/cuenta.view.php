<?php

declare(strict_types=1);

?>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="post" action="">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $tituloCard ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="usuario">Nombre de usuario: </label>
                                <input type="text" class="form-control" id="usuario" name="usuario"
                                    value="<?php echo isset($input['usuario']) ? $input['usuario'] :
                                            (isset($_SESSION['usuario']['nombre']) ?? '') ?>">
                            </div>
                            <?php if (isset($errors['usuario'])) { ?>
                                        <p class="text-danger small" >
                                            <?php echo $errors['usuario'] ?>
                                        </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/" class="btn btn-danger">Cancelar</a>
                        <input type="submit" value="<?php echo isset($_SESSION['usuario']) ?
                                'Guardar cambios' : 'Registrarse' ?>" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
            <form method="post" action="/panel/pass">
                <!-- Card Header -->
                <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Cambio de contraseña</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="usuario">Contraseña: </label>
                                <input type="password" class="form-control" id="pass" name="pass">
                            </div>
                            <?php if (isset($errors['pass'])) { ?>
                                <p class="text-danger small" >
                                    <?php echo $errors['pass'] ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/" class="btn btn-danger">Cancelar</a>
                        <input type="submit" value="Cambiar contraseña" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

