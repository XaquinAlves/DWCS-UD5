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
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $tituloCard ?? ''; ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="tema">Escoja el tema de la página</label>
                                <select name="tema" id="tema" class="form-control">
                                    <option value="default">Perdeterminado</option>
                                    <option value="dark-mode">Oscuro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <input type="submit" value="Enviar" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
