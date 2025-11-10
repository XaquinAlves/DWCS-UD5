<?php

declare(strict_types=1);

?>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get" action="/usuarios">
                <input type="hidden" name="order" value="1"/>
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_nombre">Nombre de usuario:</label>
                                <input type="text" class="form-control" name="input_nombre"
                                       id="input_nombre" value="" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_rol">Tipo de usuario:</label>
                                <select name="input_rol" id="input_rol" class="form-control"
                                        data-placeholder="Rol">
                                    <option value="">-</option>
                                    <?php foreach ($listaRoles as $rol) { ?>
                                        <option value="<?php echo $rol['id_rol'] ?>" <?php echo isset($_GET['input_rol'])
                                            && $_GET['input_rol'] == $rol['id_rol'] ? 'selected' : '' ?>>
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
                                        <input type="text" class="form-control" name="min_salario" id="min_salario"
                                               value="" placeholder="Mínimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="max_salario" id="max_salario"
                                               value="" placeholder="Máximo" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_irpf">Porcentaje de retención:</label>
                                <input type="number" class="form-control" name="input_irpf"
                                       id="input_irpf"
                                       value="<?php echo isset($_GET['input_irpf']) &&
                                       $_GET['input_irpf'] == $input['irpf'] ? $input['irpf'] : '' ?>"
                                       min="18" max="30" placeholder="18 - 30" />
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_pais">Nacionalidad:</label>
                                <select name="input_pais" id="input_pais" class="form-control"
                                        data-placeholder="Pais">
                                    <option value="">-</option>
                                    <?php foreach ($listaPaises as $pais) { ?>
                                        <option value="<?php echo $pais['id'] ?>" <?php echo isset($_GET['input_pais'])
                                                && $_GET['input_pais'] == $pais['id'] ?>>
                                            <?php echo ucfirst($pais['country_name']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/usuarios" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
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
                            <th>Nombre de usuario</th>
                            <th>Tipo de usuario</th>
                            <th>Salario</th>
                            <th>Cotización</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listaUsuarios as $usuario) { ?>
                            <tr>
                                <td><?php echo $usuario['username'] ?></td>
                                <td><?php echo $usuario['nombre_rol'] ?></td>
                                <td><?php echo
                                    number_format(floatval($usuario['salarioBruto']), 2, ',', '.')
                                    ?></td>
                                <td><?php echo
                                        number_format(floatval($usuario['retencionIRPF']), 0, ',', '.') . '%'
                                    ?></td>
                            </tr>
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
