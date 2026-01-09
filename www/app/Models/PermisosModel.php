<?php

declare(strict_types=1);
namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class PermisosModel extends BaseDbModel
{
    public function getPermisos(int $id_rol): array
    {
        $sql = "SELECT tabla, permisos FROM aux_rol_permisos WHERE id_rol = :id_rol";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id_rol' => $id_rol]);
        $consulta = $stmt->fetchAll();
        $resultado = [];
        foreach ($consulta as $permiso) {
            $resultado[$permiso['tabla']] = $permiso['permisos'];
        }
        return $resultado;
    }
}