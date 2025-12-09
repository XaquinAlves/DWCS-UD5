<?php

declare(strict_types=1);

?>

<div class="row">
    <div class="col-12">
        <?php if (isset($errors['db'])) { ?>
            <div class="bg-gradient-danger"><?php echo $errors['db'] ?></div>
        <?php } ?>
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
            <form method="post" action="">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Datos de la categoría</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="nombre">Nombre de categoría: </label>
                                <input type="text" class="form-control" name="nombre" id="nombre"
                                       placeholder="Nombre de categoría"
                                       value="<?php echo $input['nombre'] ?? ($categoria['cat_name'] ?? '') ?>"/>
                                <div class="text-danger">
                                    <?php echo $errors['nombre'] ?? '' ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label for="padre">Categoría padre: </label>
                                <select name="padre" id="padre" class="form-control">
                                    <option value="null">Sin padre</option>
                                    <?php foreach ($listaCategorias as $categoria) { ?>
                                        <option value="<?php echo $categoria['id_cat'] ?>"
                                         <?php echo
                                            (isset($input['padre']) && $input['padre'] === $categoria['id_padre']) ||
                                            (isset($categoriaEditar) &&
                                             $categoriaEditar['id_padre'] === $categoria['id_padre']) ?
                                             'selected' : ''?>>
                                            <?php echo $categoria['cat_name'] ?>
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
                        <a href="/categorias" class="btn btn-danger">Cancelar</a>
                        <input type="submit" value="Guardar" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
