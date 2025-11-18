<?php

declare(strict_types=1);

?>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get" action="/productos">
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
                                <label for="input_codigo">Código de artículo:</label>
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
                                <label for="input_cat">Categoría:</label>
                                <select name="input_cat[]" id="input_cat" class="form-control select2"
                                        data-placeholder="Categoría" multiple>
                                    <option value="">-</option>
                                    <?php foreach ($listaCategorias ?? [] as $categoria) { ?>
                                        <option value="<?php echo $categoria['id_cat'] ?>"
                                                <?php echo isset($_GET['input_cat'])
                                                && in_array($categoria['id_cat'], $_GET['input_cat']) ?
                                                        'selected' : '' ?>>
                                            <?php echo ucfirst($categoria['cat_name']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="input_prov">Proveedor:</label>
                                <select name="input_prov" id="input_prov" class="form-control"
                                        data-placeholder="Rol">
                                    <option value="">-</option>
                                    <?php foreach ($listaProveedores ?? [] as $prov) { ?>
                                        <option value="<?php echo $prov['cif'] ?>" <?php echo
                                        isset($_GET['input_prov']) && $_GET['input_prov'] == $prov['cif'] ?
                                                'selected' : '' ?>>
                                            <?php echo ucfirst($prov['nombre']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="rango_salario">Stock:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="min_stock" id="min_stock"
                                               value="<?php echo $input['min_stock'] ?? '' ?>" placeholder="Mínimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="max_stock" id="max_stock"
                                               value="<?php echo $input['max_stock'] ?? '' ?>" placeholder="Máximo" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="rango_salario">PVP:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="min_pvp" id="min_pvp"
                                               value="<?php echo $input['min_pvp'] ?? '' ?>" placeholder="Mínimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="max_pvp" id="max_pvp"
                                               value="<?php echo $input['max_pvp'] ?? '' ?>" placeholder="Máximo" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="page_size">Tamaño de página:</label>
                                <select name="page_size" id="page_size" class="form-control select1">
                                    <option value="25">25 registros</option>
                                    <option value="50">50 registros</option>
                                    <option value="75">75 registros</option>
                                    <option value="100">100 registros</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/productos" class="btn btn-danger">Reiniciar filtros</a>
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
                            <?php foreach ($listaProductos ?? [] as $producto) { ?>
                                <tr class="<?php echo intval($producto['stock']) === 0 ? 'bg-danger' :
                                        ($producto['stock'] < 10 ? 'bg-warning' : '') ?>">
                                    <td><?php echo $producto['codigo'] ?></td>
                                    <td><?php echo $producto['pro_name'] ?></td>
                                    <td><?php echo $producto['cat'] ?></td>
                                    <td><?php echo $producto['prv_name'] ?></td>
                                    <td class="d-none d-sm-table-cell"><?php echo $producto['coste'] ?></td>
                                    <td class="d-none d-sm-table-cell"><?php echo $producto['margen'] ?></td>
                                    <td class="d-none d-sm-table-cell"><?php echo $producto['pvp'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Card footer -->
            <div class="card-footer">
                <div class="col-12 text-right">
                    <nav aria-label="Navegacion por paginas">
                        <ul class="pagination justify-content-center">
                            <?php if ($page !== 1) { ?>
                                <li class="page-item">
                                    <a href="<?php echo $url . "&ordenar=$ordenar" . "&page=" . ($page - 1) ?>"
                                       class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&lt;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a href="<?php echo $url . "&ordenar=$ordenar" . "&page=1" ?>"
                                       class="page-link" aria-label="First">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">First</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="page-item active"><a href="#" class="page-link"><?php echo $page ?></a></li>
                            <?php if ($page < $lastPage) { ?>
                                <li class="page-item">
                                    <a href="<?php echo $url . "&ordenar=$ordenar" . "&page=" . ($page + 1)?>"
                                       class="page-link" aria-label="Next">
                                        <span aria-hidden="true">&gt;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a href="<?php echo $url . "&ordenar=$ordenar" . "&page=$lastPage" ?>"
                                       aria-label="Last" class="page-link">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Last</span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>