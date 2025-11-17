<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ProveedoresModel extends BaseDbModel
{
    public function getProveedores(): array
    {
        $sql = "SELECT cif, nombre  FROM proveedor";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
