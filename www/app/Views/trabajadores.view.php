<?php declare(strict_types=1); ?>
<div class="row">
    <div class="col-12">
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
            <form method="post" action="">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $titulo ?></h6>
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
                                    <th>Activo</th>
                                    <th>ID Rol</th>
                                    <th>Pais</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($trabajadores as $trabajador) { ?>
                                <tr>
                                    <td><?php echo $trabajador['username'] ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
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
