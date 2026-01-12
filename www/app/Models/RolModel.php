<?php

declare(strict_types=1);
namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class RolModel extends BaseDbModel
{
    public function getAllRoles(): array
    {
        $sql = "SELECT id_rol, rol FROM rol";
        return $this->pdo->query($sql)->fetchAll();
    }
}