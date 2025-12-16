<div class="row">
    <div class="col-12">
        <div class="alert alert-danger">
            <?php
            if (!empty($cabecera)) {
                ?>
                <h3><i class="fas fa-exclamation-triangle"></i> <?php echo $cabecera ?></h3>
                <?php
            }
            ?>
            <?php
            if (!is_array($texto)) {
                echo $texto;
            }
            else {
                foreach ($texto as $value) {
                    ?>
                    <p class="mt-3"><strong><?php echo $value['titulo'] ?? '' ?></p><p></strong><?php echo $value['valor'] ?></p>
                    <?php
                }
            }?>
        </div>
    </div>
</div>