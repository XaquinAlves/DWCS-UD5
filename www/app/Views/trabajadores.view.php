<?php

declare(strict_types=1);

?>
<div class="row">
    <div class="col-12">
        <!-- Card -->
        <div class="card shadow mb-4">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $tituloEjercicio ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                        <div class="row">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Salario Bruto</th>
                                    <th>Retención IRPF</th>
                                    <th>Rol</th>
                                    <th>Pais</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($listaTrabajadores as $trabajador) { ?>
                                <tr class="<?php echo !$trabajador['activo'] ? 'bg-danger' : '' ?>">
                                    <td><?php echo $trabajador['nombre'] ?></td>
                                    <td><?php echo $trabajador['salario'] ?></td>
                                    <td><?php echo $trabajador['retencion'] ?></td>
                                    <td><?php echo $trabajador['rol'] ?></td>
                                    <td><?php echo $trabajador['pais'] ?></td>
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
