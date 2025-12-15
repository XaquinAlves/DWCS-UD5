<?php

declare(strict_types=1);

?>

<div class="row">
    <div class="col-12">
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
            <form method="post" action="">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $tituloCard ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="codigo">Código de artículo:</label>
                                <input type="text" class="form-control" name="codigo" maxlength="10"
                                       id="codigo" value="<?php echo $input['codigo'] ?? '' ?>" />
                                <?php if (isset($errors['codigo'])) { ?>
                                    <div class="text-danger"><?php echo $errors['codigo'] ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="nombre">Nombre de artículo:</label>
                                <input type="text" class="form-control" name="nombre" maxlength="255"
                                       id="nombre" value="<?php echo $input['nombre'] ?? ''  ?>" />
                                <?php if (isset($errors['nombre'])) { ?>
                                    <div class="text-danger"><?php echo $errors['nombre'] ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="proveedor">Proveedor:</label>
                                <select name="proveedor" id="proveedor" class="form-control">
                                    <option value="">-</option>
                                    <?php foreach ($listaProveedores ?? [] as $prov) { ?>
                                        <option value="<?php echo $prov['cif'] ?>" <?php echo
                                        ((isset($_GET['proveedor']) && $prov['cif'] == $_GET['proveedor'])) ?
                                                'selected' : '' ?>>
                                            <?php echo ucfirst($prov['nombre']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php if (isset($errors['proveedor'])) { ?>
                                    <div class="text-danger"><?php echo $errors['proveedor'] ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="coste">Coste:</label>
                                <input type="number" class="form-control" name="coste" id="coste" step="0.01"
                                       value="<?php echo $input['coste'] ?? '' ?>"/>
                                <?php if (isset($errors['coste'])) { ?>
                                    <div class="text-danger"><?php echo $errors['coste'] ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="margen">Margen:</label>
                                <input type="number" class="form-control" name="margen" id="margen" step="0.01"
                                       value="<?php echo $input['margen'] ?? '' ?>"/>
                                <?php if (isset($errors['margen'])) { ?>
                                    <div class="text-danger"><?php echo $errors['margen'] ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="stock">Stock:</label>
                                <input type="number" class="form-control" name="stock" id="stock"
                                       value="<?php echo $input['stock'] ?? '' ?>" />
                                <?php if (isset($errors['stock'])) { ?>
                                    <div class="text-danger"><?php echo $errors['stock'] ?></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="iva">Iva:</label>
                                <input type="number" class="form-control" name="iva" id="iva"
                                       value="<?php echo $input['iva'] ?? '' ?>" />
                            </div>
                            <?php if (isset($errors['iva'])) { ?>
                                <div class="text-danger"><?php echo $errors['iva'] ?></div>
                            <?php } ?>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="categoria">Categoría:</label>
                                <select name="categoria" id="categoria" class="form-control"
                                        data-placeholder="Categoría">
                                    <option value="">-</option>
                                    <?php foreach ($listaCategorias ?? [] as $categoria) { ?>
                                        <option value="<?php echo $categoria['id_cat'] ?>" <?php echo
                                        isset($input['categoria']) && $input['categoria'] == $categoria['id_cat'] ?
                                                'selected' : '' ?>>
                                            <?php echo ucfirst($categoria['cat_name']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php if (isset($errors['categoria'])) { ?>
                                <div class="text-danger"><?php echo $errors['categoria'] ?></div>
                            <?php } ?>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="descripcion">Descripción del producto</label>
                                <textarea class="form-control"
                                          name="descripcion" id="descripcion"
                                          placeholder="Descipcion"><?php echo $input['descripcion'] ?? '' ?></textarea>
                            </div>
                            <?php if (isset($errors['descripcion'])) { ?>
                                <div class="text-danger"><?php echo $errors['descripcion'] ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/productos" class="btn btn-danger">Cancelar</a>
                        <input type="submit" value="Guardar" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
