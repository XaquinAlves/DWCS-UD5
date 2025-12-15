<?php

declare(strict_types=1);
?>
<?php
if (isset($flashMessages) && is_array($flashMessages)) {
    foreach ($flashMessages as $flashMessage) {
        ?>
        <div
            class="alert alert-<?php echo $flashMessage->getTipoMensaje(); ?> alert-dismissible fade show"
            role="alert"
        >
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php
            if ($flashMessage->getTitulo() !== '') {
                ?>
                <h5>
                    <i class="<?php echo $flashMessage->getIcon(); ?>"></i> <?php echo $flashMessage->getTitulo(); ?>
                </h5>
                <?php
            }
            ?>
            <p><?php echo $flashMessage->getTexto(); ?></p>
        </div>
        <?php
    }
}
?>
