<?php

declare(strict_types=1);

?>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get" action="/usuarios">
                <input type="hidden" name="ordenar" value="<?php echo $ordenar ?? 1 ?>">
                <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_nombre">Código de artículo:</label>
                                <input type="text" class="form-control" name="input_codigo"
                                       id="input_codigo" value="<?php echo $input['input_codigo'] ?? ''  ?>" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_nombre">Nombre de artículo:</label>
                                <input type="text" class="form-control" name="input_nombre"
                                       id="input_nombre" value="<?php echo $input['input_nombre'] ?? ''  ?>" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_categoria">Nacionalidad:</label>
                                <select name="input_categoria[]" id="input_categoria" class="form-control select2"
                                        data-placeholder="Categoría" multiple>
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
                                <label for="rango_salario">Rango salarial:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="min_salario" id="min_salario"
                                               value="<?php echo $input['min_salario'] ?? '' ?>" placeholder="Mínimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="max_salario" id="max_salario"
                                               value="<?php echo $input['max_salario'] ?? '' ?>" placeholder="Máximo" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/usuarios" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                        <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12">
        <!-- Card -->
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $tituloEjercicio ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Proveedor</th>
                            <th class="d-none d-sm-table-cell">Coste</th>
                            <th class="d-none d-sm-table-cell">Margen</th>
                            <th class="d-none d-sm-table-cell">PVP</th>
                        </tr>
                        </thead>
                        <tbody>
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