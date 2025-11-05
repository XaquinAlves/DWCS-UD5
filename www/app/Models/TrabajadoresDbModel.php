<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class TrabajadoresDbModel extends BaseDbModel
{
    public function getTrabajadores(): array
    {
        $sql = "SELECT tr.username as nombre, tr.salarioBruto as salario, tr.retencionIRPF as retencion, tr.activo,
                rol.nombre_rol as rol, co.country_name as pais 
                FROM trabajadores as tr 
                LEFT JOIN aux_rol_trabajador as rol ON rol.id_rol = tr.id_rol 
                LEFT JOIN aux_countries as co ON co.id = tr.id_country";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getTrabajadoresAsoc(): array
    {
        $sql = "SELECT tr.username as nombre, tr.salarioBruto as salario, tr.retencionIRPF as retencion, tr.activo,
                rol.nombre_rol as rol, co.country_name as pais 
                FROM trabajadores as tr 
                LEFT JOIN aux_rol_trabajador as rol ON rol.id_rol = tr.id_rol 
                LEFT JOIN aux_countries as co ON co.id = tr.id_country";
        $query = $this->mysqli->query($sql);
        $result = [];
        do {
            $result[] = mysqli_fetch_assoc($query);
        } while ($result[count($result) - 1] !== null);
        array_pop($result);
        return $result;
    }
    public function getTrabajadoresPorSalario(): array
    {
        $sql = "SELECT tr.username as nombre, tr.salarioBruto as salario, tr.retencionIRPF as retencion, tr.activo,
                rol.nombre_rol as rol, co.country_name as pais 
                FROM trabajadores as tr 
                LEFT JOIN aux_rol_trabajador as rol ON rol.id_rol = tr.id_rol 
                LEFT JOIN aux_countries as co ON co.id = tr.id_country
                ORDER BY salario DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getTrabajadoresStandard(): array
    {
        $sql = "SELECT tr.username as nombre, tr.salarioBruto as salario, tr.retencionIRPF as retencion, tr.activo,
                rol.nombre_rol as rol, co.country_name as pais 
                FROM trabajadores as tr 
                LEFT JOIN aux_rol_trabajador as rol ON rol.id_rol = tr.id_rol 
                LEFT JOIN aux_countries as co ON co.id = tr.id_country
                WHERE tr.id_rol = 5";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getTrabajadoresCarlos(): array
    {
        $sql = "SELECT tr.username as nombre, tr.salarioBruto as salario, tr.retencionIRPF as retencion, tr.activo,
                rol.nombre_rol as rol, co.country_name as pais 
                FROM trabajadores as tr  
                LEFT JOIN aux_rol_trabajador as rol ON rol.id_rol = tr.id_rol 
                LEFT JOIN aux_countries as co ON co.id = tr.id_country
                WHERE tr.username LIKE 'Carlos%'";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
