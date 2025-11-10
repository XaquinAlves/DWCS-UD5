<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class UsuariosModel extends BaseDbModel
{
    private const SELECT_FROM_JOIN = "SELECT u.username, rol.nombre_rol, u.salarioBruto, u.retencionIRPF 
        FROM trabajadores AS u LEFT JOIN aux_rol_trabajador as rol ON u.id_rol = rol.id_rol";

    public function getUsuarios(): array
    {
        $sql = self::SELECT_FROM_JOIN;
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getUsuariosByRol(): array
    {
        if (!empty($_GET['input_rol'])) {
            $sql = self::SELECT_FROM_JOIN . " WHERE u.id_rol = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$_GET['input_rol']]);
            return $stmt->fetchAll();
        }
    }

    public function getRoles(): array
    {
        $sql = "SELECT * FROM aux_rol_trabajador";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
