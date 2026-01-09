<?php

declare(strict_types=1);

?>
<div class="row">
    <?php if (isset($errors['error'])) { ?>
    <div class="col-12 bg-gradient-danger">
        <?php echo $errors['error'] ?>
    </div>
    <?php } ?>
    <div class="col-12">
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
            <form method="post" action="">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $tituloEjercicio ?? '' ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="username">Nombre de usuario:</label>
                                <input type="text" class="form-control" name="username"
                                       id="username" value="<?php echo $input['username'] ?? '' ?>"/>
                            </div>
                            <?php if (isset($errors['username'])) { ?>
                                    <span class="text-danger"><?php echo $errors['username'] ?></span>
                            <?php } ?>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_rol">Tipo de usuario:</label>
                                <select name="id_rol" id="id_rol" class="form-control"
                                        data-placeholder="Rol">
                                    <option value="">-</option>
                                    <?php foreach ($listaRoles ?? [] as $rol) { ?>
                                        <option value="<?php echo $rol['id_rol'] ?>" <?php echo
                                        ((isset($input['id_rol']) && $rol['id_rol'] == $input['id_rol']))
                                                        ? 'selected' : '' ?>>
                                            <?php echo ucfirst($rol['nombre_rol']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if (isset($errors['rol'])) { ?>
                                    <span class="text-danger"><?php echo $errors['rol'] ?></span>
                            <?php } ?>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="salarioBruto">Salario:</label>
                                <input type="number" class="form-control" name="salarioBruto" id="salarioBruto"
                                       value="<?php echo $input['salarioBruto'] ?? '' ?>" placeholder="Salario"
                                       step="0.01"/>
                            </div>
                            <?php if (isset($errors['salario'])) { ?>
                                <span class="text-danger"><?php echo $errors['salario']?></span>
                            <?php } ?>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="retencionIRPF">Porcentaje de retención:</label>
                                <input type="number" class="form-control" name="retencionIRPF" id="retencionIRPF"
                                       value="<?php echo isset($input['retencionIRPF']) ?
                                               intval($input['retencionIRPF']) : ''  ?>" placeholder="IRPF" />
                            </div>
                            <?php if (isset($errors['irpf'])) { ?>
                                <span class="text-danger"><?php echo $errors['irpf'] ?></span>
                            <?php } ?>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_country">Nacionalidad:</label>
                                <select name="id_country" id="id_country" class="form-control select1"
                                        data-placeholder="Pais">
                                    <option value="">-</option>
                                    <?php foreach ($listaPaises ?? [] as $pais) { ?>
                                        <option value="<?php echo $pais['id'] ?>"
                                        <?php echo
                                            (isset($input['id_country']) && $pais['id'] == $input['id_country']) ?
                                                'selected' : '' ?>>
                                            <?php echo ucfirst($pais['country_name']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if (isset($errors['pais'])) { ?>
                                <span class="text-danger"><?php echo $errors['pais'] ?></span>
                            <?php } ?>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3 row">
                                <label for="activo">Activo:</label>
                                <select class="form-control" name="activo" id="activo">
                                    <option value="1"
                                            <?php echo (isset($input['activo']) && $input['activo'] == 1) ?
                                                    'selected' : ''?>>
                                        Si
                                    </option>
                                    <option value="0"
                                            <?php echo (isset($input['activo']) && $input['activo'] == 0) ?
                                                    'selected' : ''?>>
                                        No
                                    </option>
                                </select>
                            </div>
                            <?php if (isset($errors['activo'])) { ?>
                                <span class="text-danger"><?php echo $errors['activo'] ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <input type="submit" value="Guardar" name="enviar" class="btn btn-primary ml-2"/>
                        <a href="/trabajadores" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
