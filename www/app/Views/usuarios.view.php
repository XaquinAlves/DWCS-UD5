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
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_irpf">Porcentaje de retención:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="min_irpf" id="min_irpf"
                                               value="<?php echo $input['min_irpf'] ?? '' ?>" placeholder="Mínimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="max_irpf" id="max_irpf"
                                               value="<?php echo $input['max_irpf'] ?? '' ?>" placeholder="Máximo" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_pais">Nacionalidad:</label>
                                <select name="input_pais[]" id="input_pais" class="form-control select2"
                                        data-placeholder="Pais" multiple>
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
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $tituloEjercicio ?? '' ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>
                                <a href="<?php echo $url ?? ''; echo $ordenar === 1 ? '&ordenar=2' : '&ordenar=1'?>">
                                    Nombre de usuario <?php echo $ordenar === 1 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($ordenar === 2 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?php echo $url ?? ''; echo $ordenar === 3 ? '&ordenar=4' : '&ordenar=3'?>">
                                    Tipo de usuario <?php echo $ordenar === 3 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($ordenar === 4 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?php echo $url ?? ''; echo $ordenar === 5 ? '&ordenar=6 ' : '&ordenar=5'?>">
                                    Salario <?php echo $ordenar === 5 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($ordenar === 6 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?php echo $url ?? ''; echo $ordenar === 7 ? '&ordenar=8' : '&ordenar=7'?>">
                                    Cotización <?php echo $ordenar === 7 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($ordenar === 8 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?php echo $url ?? ''; echo $ordenar === 9 ? '&ordenar=10' : '&ordenar=9'?>">
                                    País <?php echo $ordenar === 9 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($ordenar === 10 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($listaUsuarios ?? [] as $usuario) { ?>
                            <tr>
                                <td><?php echo $usuario['username'] ?></td>
                                <td><?php echo $usuario['nombre_rol'] ?></td>
                                <td><?php echo
                                    number_format(floatval($usuario['salarioBruto']), 2, ',', '.')
                                ?></td>
                                <td><?php echo
                                        number_format(floatval($usuario['retencionIRPF']), 0, ',', '.') . '%'
                                ?></td>
                                <td><?php echo $usuario['country_name'] ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Card footer -->
            <div class="card-footer">
                <div class="col-12">
                    <?php if ($page !== 1) { ?>
                        <a href="<?php echo $url . "&page=" . ($page - 1) ?>" class="breadcrumb float-left">
                            &lt; &lt; Anterior
                        </a>
                        <a href="<?php echo $url . "&page=1" ?>" class="breadcrumb float-left"
                           style="margin-left: 2%">
                            Primero
                        </a>
                    <?php } ?>
                    <?php if ($page !== $lastPage) { ?>
                        <a href="<?php echo $url . "&page=" . ($page + 1)?>" class="breadcrumb float-right">
                            Siguiente &gt; &gt;
                        </a>
                        <a href="<?php echo $url . "&page=$lastPage" ?>" class="breadcrumb float-right"
                           style="margin-right: 2%">
                            Ultimo
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
