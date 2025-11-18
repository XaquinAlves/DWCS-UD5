<?php

declare(strict_types=1);

?>
<div class="row">
    <div class="col-12">
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
            <form method="post" action="/alta-usuario">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $tituloEjercicio ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_nombre">Nombre de usuario:</label>
                                <input type="text" class="form-control" name="input_nombre"
                                       id="input_nombre" value="<?php echo $input['input_nombre'] ?? ''  ?>" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_rol">Tipo de usuario:</label>
                                <select name="input_rol" id="input_rol" class="form-control"
                                        data-placeholder="Rol">
                                    <option value="">-</option>
                                    <?php foreach ($listaRoles ?? [] as $rol) { ?>
                                        <option value="<?php echo $rol['id_rol'] ?>" <?php echo
                                        isset($_GET['input_rol']) && $_GET['input_rol'] == $rol['id_rol'] ?
                                                'selected' : '' ?>>
                                            <?php echo ucfirst($rol['nombre_rol']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="rango_salario">Salario:</label>
                                <input type="number" class="form-control" name="input_salario" id="input_salario"
                                       value="<?php echo $input['input_salario'] ?? '' ?>" placeholder="Salario" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_irpf">Porcentaje de retención:</label>
                                <input type="number" class="form-control" name="input_irpf" id="input_irpf"
                                       value="<?php echo $input['input_irpf'] ?? '' ?>" placeholder="IRPF" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_pais">Nacionalidad:</label>
                                <select name="input_pais" id="input_pais" class="form-control select1"
                                        data-placeholder="Pais">
                                    <option value="">-</option>
                                    <?php foreach ($listaPaises ?? [] as $pais) { ?>
                                        <option value="<?php echo $pais['id'] ?>" <?php echo isset($_GET['input_pais'])
                                        && in_array($pais['id'], $_GET['input_pais']) ? 'selected' : '' ?>>
                                            <?php echo ucfirst($pais['country_name']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <input type="submit" value="Enviar" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
