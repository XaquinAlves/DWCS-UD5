<?php

declare(strict_types=1);

?>
<div class="row">
    <div class="col-12">
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
            <form method="get" action="">
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
                                       max="99" placeholder="Id de categoría"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="cat_name">Nombre de categoría: </label>
                                <input type="text" class="form-control" name="cat_name" id="cat_name"
                                       placeholder="Nombre de categoría"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="id_padre">Id del padre: </label>
                                <input type="number" class="form-control" name="id_padre" id="id_padre" min="0"
                                       max="99" placeholder="Id del padre"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="padre_name">Nombre del padre: </label>
                                <input type="text" class="form-control" name="padre_name" id="padre_name"
                                       placeholder="Nombre del padre"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <div class="col-12 text-right">
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
                                <th>Id de categoría</th>
                                <th>Nombre de Categoría</th>
                                <th>Nombre del padre</th>
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
