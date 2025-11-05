<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class TrabajadoresDbModel extends BaseDbModel
{
    public function getTrabajadores(): array
    {
        $sql = "SELECT * FROM trabajadores";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getTrabajadoresPorSalario(): array
    {
        $sql = "SELECT * FROM trabajadores ORDER BY salarioBruto DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getTrabajadoresStandard(): array
    {
        $sql = "SELECT * FROM trabajadores WHERE id_rol = 5";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getTrabajadoresCarlos() : array
    {
        $sql = "SELECT * FROM trabajadores WHERE username LIKE Carlos%";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}