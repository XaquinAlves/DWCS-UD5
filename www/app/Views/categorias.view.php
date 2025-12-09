<?php

declare(strict_types=1);

?>
<div class="row">
    <div class="col-12">
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
            <form method="get" action="">
                <input type="hidden" id="ordenar" name="ordenar" value="<?php echo $ordenar ?>">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="id_cat">Id de categoría: </label>
                                <input type="number" class="form-control" name="id_cat" id="id_cat" min="0"
                                       max="99" placeholder="Id de categoría"
                                       value="<?php echo $input['id_cat'] ?? '' ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="cat_name">Nombre de categoría: </label>
                                <input type="text" class="form-control" name="cat_name" id="cat_name"
                                       placeholder="Nombre de categoría"
                                       value="<?php echo $input['cat_name'] ?? '' ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="id_padre">Id del padre: </label>
                                <input type="number" class="form-control" name="id_padre" id="id_padre" min="0"
                                       max="99" placeholder="Id del padre"
                                       value="<?php echo $input['id_padre'] ?? '' ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="padre_name">Nombre del padre: </label>
                                <input type="text" class="form-control" name="padre_name" id="padre_name"
                                       placeholder="Nombre del padre"
                                       value="<?php echo $input['padre_name'] ?? '' ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/categorias/alta" class="btn btn-success float-left">Nueva categoría</a>
                        <a href="/categorias" class="btn btn-danger">Limpiar filtros</a>
                        <input type="submit" value="Buscar" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>
                                    <a href="/categorias?ordenar=<?php echo $ordenar === 1 ? 2 : 1 ?>">
                                        Id de categoría
                                        <?php echo $ordenar === 1 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($ordenar === 2 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                    </a>
                                </th>
                                <th>
                                    <a href="/categorias?ordenar=<?php echo $ordenar === 3 ? 4 : 3 ?>">
                                        Nombre de Categoría
                                        <?php echo $ordenar === 3 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($ordenar === 4 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                    </a>
                                </th>
                                <th>
                                    <a href="/categorias?ordenar=<?php echo $ordenar === 5 ? 6 : 5 ?>">
                                        Nombre del padre
                                        <?php echo $ordenar === 5 ?
                                            '<i class="fas fa-sort-amount-down-alt"></i>' :
                                            ($ordenar === 6 ? '<i class="fas fa-sort-amount-up-alt"></i>' : '') ?>
                                    </a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($listaCategorias as $categoria) { ?>
                                <tr>
                                    <td><?php echo $categoria['id_cat'] ?></td>
                                    <td><?php echo $categoria['cat_name'] ?></td>
                                    <td><?php echo $categoria['padre_name'] ?></td>
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
