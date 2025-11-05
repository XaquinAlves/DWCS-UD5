<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class TrabajadoresDbModel extends BaseDbModel
{
    public function getTrabajadores(): array
    {
        $sql = "SELECT tr.username as nombre, tr.salarioBruto as salario, tr.retencionIRPF as retencion, tr.activo as
                activo, rol.nombre_rol as rol, co.country_name as pais 
                FROM trabajadores as tr 
                LEFT JOIN aux_rol_trabajador as rol ON rol.id_rol = tr.id_rol 
                LEFT JOIN aux_countries as co ON co.id = tr.id_country";
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