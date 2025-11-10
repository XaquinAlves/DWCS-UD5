<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class TrabajadoresDbModel extends BaseDbModel
{
    private const SELECT_FROM_JOIN = "SELECT tr.username as nombre, tr.salarioBruto as salario, 
                tr.retencionIRPF as retencion, tr.activo, rol.nombre_rol as rol, co.country_name as pais 
                FROM trabajadores as tr 
                LEFT JOIN aux_rol_trabajador as rol ON rol.id_rol = tr.id_rol 
                LEFT JOIN aux_countries as co ON co.id = tr.id_country";

    private const SELECT_FROM_USR = "SELECT u.username, rol.nombre_rol, u.salarioBruto, u.retencionIRPF
        FROM trabajadores AS u LEFT JOIN aux_rol_trabajador as rol ON u.id_rol = rol.id_rol";
    public function getTrabajadores(): array
    {
        $sql = self::SELECT_FROM_JOIN;
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getTrabajadoresAssoc(): array
    {
        $sql = self::SELECT_FROM_JOIN;
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
        $sql = self::SELECT_FROM_JOIN . " ORDER BY salario DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getTrabajadoresPorSalarioAssoc(): array
    {
        $sql = self::SELECT_FROM_JOIN . " ORDER BY salario DESC";
        $query = $this->mysqli->query($sql);
        $result = [];

        do {
            $result[] = mysqli_fetch_assoc($query);
        } while ($result[count($result) - 1] !== null);
        array_pop($result);
        return $result;
    }

    public function getTrabajadoresStandard(): array
    {
        $sql = self::SELECT_FROM_JOIN . " WHERE tr.id_rol = 5";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getTrabajadoresStandardAssoc(): array
    {
        $sql = self::SELECT_FROM_JOIN . " WHERE tr.id_rol = 5";
        $query = $this->mysqli->query($sql);
        $result = [];

        do {
            $result[] = mysqli_fetch_assoc($query);
        } while ($result[count($result) - 1] !== null);
        array_pop($result);
        return $result;
    }

    public function getTrabajadoresCarlos(): array
    {
        $sql = self::SELECT_FROM_JOIN . " WHERE tr.username LIKE 'Carlos%'";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getTrabajadoresCarlosAssoc(): array
    {
        $sql = self::SELECT_FROM_JOIN . " WHERE tr.username LIKE 'Carlos%'";
        $query = $this->mysqli->query($sql);
        $result = [];

        do {
            $result[] = mysqli_fetch_assoc($query);
        } while ($result[count($result) - 1] !== null);
        array_pop($result);
        return $result;
    }

    public function getByFilters(array $filters): array
    {
        $sql = self::SELECT_FROM_USR;

        if (!empty($filters)) {
            $set = false;
            $params = [];
            if (!empty($filters['username'])) {
                $sql .= " WHERE u.username LIKE :username";
                $params['username'] = '%' . $filters['username'] . '%';

                $set = true;
            }

            if (!empty($filters['id_rol'])) {
                if ($set) {
                    $sql .= " AND u.id_rol = :id_rol";
                } else {
                    $sql .= " WHERE u.id_rol = :id_rol";
                    $set = true;
                }
                $params['id_rol'] = $filters['id_rol'];
            }

            if (!empty($filters['salario'])) {
                if ($set) {
                    $sql .= " AND u.salarioBruto BETWEEN :min AND :max";
                } else {
                    $sql .= " WHERE u.salarioBruto BETWEEN :min AND :max";
                    $set = true;
                }
                $params['min'] = $filters['salario'][0];
                $params['max'] = $filters['salario'][1];
            }

            if (!empty($filters['irpf'])) {
                if ($set) {
                    $sql .= " AND u.retencionIRPF = :irpf";
                } else {
                    $sql .= " WHERE u.retencionIRPF = :irpf";
                    $set = true;
                }
                $params['irpf'] = $filters['irpf'];
            }

            if (!empty($filters['pais'])) {
                if ($set) {
                    $sql .= " AND u.id_country = :pais";
                } else {
                    $sql .= " WHERE u.id_country = :pais";
                    $set = true;
                }

                $params['pais'] = $filters['pais'];
            }

            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
        } else {
            $statement = $this->pdo->query($sql);
        }

        return $statement->fetchAll();
    }
}
