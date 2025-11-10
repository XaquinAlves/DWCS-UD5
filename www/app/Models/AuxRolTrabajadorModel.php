<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class AuxRolTrabajadorModel extends BaseDbModel
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM aux_rol_trabajador ORDER BY nombre_rol";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

}
