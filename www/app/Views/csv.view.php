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
                                            <?php for ($i = 0; $i < count($row); $i++) {
                                                if ($i === 3) {
                                                    $row[$i] = number_format(floatval($row[$i]), 0, ',', '.');
                                                } ?>
                                                <td><?php echo $row[$i] ?></td>
                                            <?php }
                                            ?>
                                        </tr>
                                    <?php }
                                }
                                ?>
                                    </tbody>
                                    <tfoot>
                                    <?php if(isset($maximo)){ ?>
                                        <tr>
                                            <td><?php echo $maximo[0] ?></td>
                                            <td><?php echo $maximo[2] ?></td>
                                            <td>max</td>
                                            <td><?php echo $maximo[3] ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php if(isset($minimo)) { ?>
                                        <tr>
                                            <td><?php echo $minimo[0] ?></td>
                                            <td><?php echo $minimo[2] ?></td>
                                            <td>min</td>
                                            <td><?php echo $minimo[3] ?></td>
                                        </tr>
                                    <?php } ?>
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