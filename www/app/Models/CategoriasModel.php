<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class CategoriasModel extends BaseDbModel
{
    public function getCategorias(): array
    {
        $sql = "SELECT id_categoria, nombre_categoria FROM categoria ORDER BY nombre_categoria";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}