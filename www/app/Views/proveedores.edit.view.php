<?php

declare(strict_types=1);

?>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="post" action="">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Datos del proveedor</h6>
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
                                        <option value="<?php echo $pais['id'] ?>">
                                            <?php echo ucfirst($pais['country_name']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="direccion">Dirección: </label>
                                <input type="text" name="direccion" id="direccion" class="form-control"
                                       value="<?php echo $input['direccion'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="website">Sitio Web: </label>
                                <input type="text" name="website" id="website" class="form-control"
                                       value="<?php echo $input['website'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/proveedores" class="btn btn-danger">Cancelar</a>
                        <input type="submit" value="Enviar" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
