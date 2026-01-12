<?php

declare(strict_types=1);

?>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get" action="/productos">
                <input type="hidden" name="order" value="<?php echo $order ?? 1 ?>">
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
                                <select name="input_cat" id="input_cat" class="form-control"
                                        data-placeholder="Categoría">
                                    <option value="">-</option>
                                    <?php foreach ($listaCategorias ?? [] as $categoria) { ?>
                                        <option value="<?php echo $categoria['id_cat'] ?>" <?php echo
                                        isset($_GET['input_cat']) && $_GET['input_cat'] == $categoria['id_cat'] ?
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
                                <select name="input_prov[]" id="input_prov" class="form-control select2"
                                        multiple>
                                    <option value="">-</option>
                                    <?php foreach ($listaProveedores ?? [] as $prov) { ?>
                                        <option value="<?php echo $prov['cif'] ?>" <?php echo
                                        isset($_GET['input_prov']) && in_array($prov['cif'], $_GET['input_prov']) ?
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
                                <label for="rango_salario">Coste:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="min_coste" id="min_coste"
                                               value="<?php echo $input['min_coste'] ?? '' ?>" placeholder="Mínimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="max_coste" id="max_coste"
                                               value="<?php echo $input['max_coste'] ?? '' ?>" placeholder="Máximo" />
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
                        <?php if ($_SESSION['permisos']['producto']->canWrite()) { ?>
                            <a href="/productos/alta" class="btn btn-success float-left">Nuevo Producto</a>
                        <?php } ?>
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
                            <th>
                                <a href="<?php echo $url ?? '';
                                echo $order === 1 ? '&order=2' : '&order=1'; ?>">
                                    Código <?php echo $order === 1 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($order === 2 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?php echo $url ?? '';
                                echo $order === 3 ? '&order=4' : '&order=3'; ?>">
                                    Nombre <?php echo $order === 3 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($order === 4 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?php echo $url ?? '';
                                echo $order === 5 ? '&order=6' : '&order=5'; ?>">
                                    Categoría <?php echo $order === 5 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($order === 6 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?php echo $url ?? '';
                                echo $order === 7 ? '&order=8' : '&order=7'; ?>">
                                    Proveedor <?php echo $order === 7 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($order === 8 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th class="d-none d-sm-table-cell">
                                <a href="<?php echo $url ?? '';
                                echo $order === 9 ? '&order=10' : '&order=9'; ?>">
                                    Coste <?php echo $order === 9 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($order === 10 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th class="d-none d-sm-table-cell">
                                <a href="<?php echo $url ?? '';
                                echo $order === 11 ? '&order=12' : '&order=11'; ?>">
                                    Margen <?php echo $order === 11 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($order === 12 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th class="d-none d-sm-table-cell">
                                <a href="<?php echo $url ?? '';
                                echo $order === 13 ? '&order=14' : '&order=13'; ?>">
                                    PVP <?php echo $order === 13 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($order === 14 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <?php if (
                                    $_SESSION['permisos']['producto']->canWrite() ||
                                    $_SESSION['permisos']['producto']->canDelete()
) { ?>
                                <th>Editar / Borrar</th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listaProductos ?? [] as $producto) { ?>
                                <tr class="<?php echo intval($producto['stock']) === 0 ? 'bg-danger' :
                                        ($producto['stock'] < 10 ? 'bg-warning' : '') ?>">
                                    <td><?php echo $producto['codigo'] ?></td>
                                    <td><?php echo $producto['pro_name'] ?></td>
                                    <td><?php echo $producto['categoria'] ?></td>
                                    <td><?php echo $producto['prv_name'] ?></td>
                                    <td class="d-none d-sm-table-cell">
                                        <?php echo number_format(
                                            floatval($producto['coste']),
                                            2,
                                            ',',
                                            '.'
                                        )
                                        ?>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <?php echo number_format(
                                            floatval($producto['margen']),
                                            2,
                                            ',',
                                            '.'
                                        )
                                        ?>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <?php echo number_format(
                                            floatval($producto['pvp']),
                                            2,
                                            ',',
                                            '.'
                                        )
                                        ?>
                                    </td>
                                    <?php if (
                                            $_SESSION['permisos']['producto']->canWrite() ||
                                            $_SESSION['permisos']['producto']->canDelete()
) { ?>
                                        <td>
                                            <?php if ($_SESSION['permisos']['producto']->canWrite()) { ?>
                                                <a href="/productos/editar/<?php echo $producto['codigo'] ?>"
                                                   class="btn btn-success"><i class="fas fa-edit"></i></a>
                                            <?php } ?>
                                            <?php if ($_SESSION['permisos']['producto']->canDelete()) { ?>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#<?php echo $producto['codigo'] ?>borradoModal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <div class="modal fade" id="<?php echo $producto['codigo'] ?>borradoModal"
                                     tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="<?php echo $producto['codigo'] ?>borradoModalLabel">
                                                    ¿Estás seguro de borrar el producto
                                                    <?php echo $producto['pro_name'] ?> ?
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
                                                <a href="/productos/borrar/<?php echo $producto['codigo'] ?>"
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
                    <nav aria-label="Navegacion por paginas">
                        <ul class="pagination justify-content-center">
                            <?php if ($page !== 1) { ?>
                                <li class="page-item">
                                    <a href="<?php echo $url . "&ordenar=$order" . "&page=" . ($page - 1) ?>"
                                       class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&lt;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a href="<?php echo $url . "&ordenar=$order" . "&page=1" ?>"
                                       class="page-link" aria-label="First">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">First</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="page-item active"><a href="#" class="page-link"><?php echo $page ?></a></li>
                            <?php if ($page < $lastPage) { ?>
                                <li class="page-item">
                                    <a href="<?php echo $url . "&ordenar=$order" . "&page=" . ($page + 1)?>"
                                       class="page-link" aria-label="Next">
                                        <span aria-hidden="true">&gt;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a href="<?php echo $url . "&ordenar=$order" . "&page=$lastPage" ?>"
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