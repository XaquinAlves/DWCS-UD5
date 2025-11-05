<?php

declare(strict_types=1);

?>
<div class="row">
    <div class="col-12">
        <!-- Card con textarea -->
        <div class="card shadow mb-4">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $tituloCard ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-striped">
                                <?php $first = true;
                                foreach ($datoscsv as $row) {
                                    if ($first) {
                                        ?>
                                            <thead>
                                                <tr>
                                                    <?php foreach ($row as $column) {
                                                        ?>
                                                        <th><?php echo $column; ?></th>
                                                    <?php }
                                                        $first = false;
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                    <?php } else {
                                        ?>
                                        <tr>
                                            <?php foreach ($row as $column) { ?>
                                                <td><?php echo  $column; ?></td>
                                            <?php }
                                            ?>
                                        </tr>
                                    <?php }
                                }
                                ?>
                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                </div>
                <!-- Card footer -->
                <div class="card-footer">

                </div>
        </div>
    </div>
</div>