<?php

declare(strict_types=1);

?>
<div class="row">
    <div class="col-12">
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
            <form method="get" action="">
                <input type="hidden" name="ordenar" value="<?php echo $ordenar ?? 1 ?>">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-4">
                                <label for="cif">CIF: </label>
                                <input type="text" name="cif" id="cif" class="form-control" 
                                       value="<?php echo $input['cif'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-4">
                                <label for="codigo">Código: </label>
                                <input type="text" name="codigo" id="codigo" class="form-control"
                                       value="<?php echo $input['codigo'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="nombre">Nombre: </label>
                                <input type="text" name="nombre" id="nombre" class="form-control"
                                       value="<?php echo $input['nombre'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="email">Email: </label>
                                <input type="text" name="email" id="email" class="form-control"
                                       value="<?php echo $input['email'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_country">País: </label>
                                <select name="id_country" id="id_country" class="form-control">
                                    <option value=""> - </option>
                                    <?php foreach ($listaPaises ?? [] as $pais) { ?>
                                        <option value="<?php echo $pais['id'] ?>" <?php echo isset($input['id_country'])
                                        && $pais['id'] == $input['id_country'] ? 'selected' : '' ?>>
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
                        <a href="/proveedores/alta" class="btn btn-success float-left">Nuevo proveedor</a>
                        <a href="/proveedores" class="btn btn-danger">Cancelar</a>
                        <input type="submit" value="Enviar" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
                <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Listado de proveedores</h6>
            </div>
                <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>
                                <a href="<?php echo $url ?? '' ?>&ordenar=<?php echo $ordenar === 1 ? 2 : 1; ?>">
                                    CIF
                                    <?php echo $ordenar === 1 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($ordenar === 2 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?php echo $url ?? '' ?>&ordenar=<?php echo $ordenar === 3 ? 4 : 3; ?>">
                                    Código
                                    <?php echo $ordenar === 3 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($ordenar === 4 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?php echo $url ?? '' ?>&ordenar=<?php echo $ordenar === 5 ? 6 : 5; ?>">
                                    Nombre
                                    <?php echo $ordenar === 5 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($ordenar === 6 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?php echo $url ?? '' ?>&ordenar=<?php echo $ordenar === 7 ? 8 : 7 ?>">
                                    Email
                                    <?php echo $ordenar === 7 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($ordenar === 8 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?php echo $url ?? '' ?>&ordenar=<?php echo $ordenar === 9 ? 10 : 9 ?>">
                                    Pais
                                    <?php echo $ordenar === 9 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($ordenar === 10 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                </a>
                            </th>
                        </thead>
                        <tbody>
                            <?php foreach ($listaProveedores ?? [] as $proveedor) { ?>
                                <tr>
                                    <td><?php echo $proveedor['cif'] ?></td>
                                    <td><?php echo $proveedor['codigo'] ?></td>
                                    <td><?php echo $proveedor['nombre'] ?></td>
                                    <td><?php echo $proveedor['email'] ?></td>
                                    <td><?php echo $proveedor['country_name'] ?></td>
                                    <td>
                                        <a href="/proveedores/editar/<?php echo $proveedor['cif'] ?>"
                                            class="btn btn-success">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#<?php echo $proveedor['cif'] ?>borradoModal">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="<?php echo $proveedor['cif'] ?>borradoModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="<?php echo $proveedor['cif'] ?>borradoModalLabel">
                                                    ¿Estás seguro de borrar al proveedor
                                                    <?php echo $proveedor['nombre'] ?> ?
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
                                                <a href="/proveedores/borrar/<?php echo $proveedor['cif'] ?>"
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
                <div class="col-12">
                    <nav aria-label="Paginación">
                        <ul class="pagination justify-content-center">
                            <?php if ($page != 1) { ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo $url . "&ordenar=$ordenar" .
                                            '&pagina=1' ?>"
                                       aria-label="First">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">First</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo $url . "&ordenar=$ordenar" .
                                            '&pagina=' . ($page - 1) ?>"
                                       aria-label="Previous">
                                        <span aria-hidden="true">&lt;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="page-item active"><a href="#" class="page-link"><?php echo $page ?></a></li>
                            <?php if ($page < $lastPage) { ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo $url . "&ordenar=$ordenar" .
                                            '&pagina=' . ($page + 1) ?>"
                                       aria-label="Next">
                                        <span aria-hidden="true">&gt;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo $url . "&ordenar=$ordenar" .
                                            '&pagina=' . $lastPage ?>"
                                       aria-label="Last">
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
