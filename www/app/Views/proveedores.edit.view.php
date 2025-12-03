<?php

declare(strict_types=1);

?>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="post" action="">
                <?php if (isset($errors['db'])) { ?>
                    <div class="bg-gradient-danger">
                        <h6 class="font-weight-bold"><?php echo $errors['db'] ?></h6>
                    </div>
                <?php } ?>
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Datos del proveedor</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-4">
                                <label for="cif">CIF: </label>
                                <input type="text" name="cif" id="cif" class="form-control"
                                       value="<?php echo $input['cif'] ?? '' ?>">
                                <?php if (isset($errors['cif'])) { ?>
                                    <div class="text-alert text-danger"><?php echo $errors['cif'] ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-4">
                                <label for="codigo">Código: </label>
                                <input type="text" name="codigo" id="codigo" class="form-control"
                                       value="<?php echo $input['codigo'] ?? '' ?>">
                                <?php if (isset($errors['codigo'])) { ?>
                                    <div class="text-alert text-danger"><?php echo $errors['codigo'] ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="nombre">Nombre: </label>
                                <input type="text" name="nombre" id="nombre" class="form-control"
                                       value="<?php echo $input['nombre'] ?? '' ?>">
                                <?php if (isset($errors['nombre'])) { ?>
                                    <div class="text-alert text-danger"><?php echo $errors['nombre'] ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="email">Email: </label>
                                <input type="text" name="email" id="email" class="form-control"
                                       value="<?php echo $input['email'] ?? '' ?>">
                                <?php if (isset($errors['email'])) { ?>
                                    <div class="text-alert text-danger"><?php echo $errors['email'] ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_country">País: </label>
                                <select name="id_country" id="id_country" class="form-control">
                                    <option value=""> - </option>
                                    <?php foreach ($listaPaises ?? [] as $pais) { ?>
                                        <option value="<?php echo $pais['id'] ?>" <?php echo isset($input['id_country'])
                                        && $input['id_country'] == $pais['id'] ? 'selected' : '' ?>>
                                            <?php echo ucfirst($pais['country_name']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php if (isset($errors['id_country'])) { ?>
                                    <div class="text-alert text-danger"><?php echo $errors['id_country'] ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="direccion">Dirección: </label>
                                <input type="text" name="direccion" id="direccion" class="form-control"
                                       value="<?php echo $input['direccion'] ?? '' ?>">
                                <?php if (isset($errors['direccion'])) { ?>
                                    <div class="text-alert text-danger"><?php echo $errors['direccion'] ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="website">Sitio Web: </label>
                                <input type="text" name="website" id="website" class="form-control"
                                       value="<?php echo $input['website'] ?? '' ?>">
                                <?php if (isset($errors['website'])) { ?>
                                    <div class="text-alert text-danger"><?php echo $errors['website'] ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="telefono">Telefono: </label>
                                <input type="text" name="telefono" id="telefono" class="form-control"
                                       value="<?php echo $input['telefono'] ?? '' ?>">
                            </div>
                            <?php if (isset($errors['telefono'])) { ?>
                                <div class="text-alert text-danger"><?php echo $errors['telefono'] ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/proveedores" class="btn btn-danger">Cancelar</a>
                        <input type="submit" value="Enviar" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
