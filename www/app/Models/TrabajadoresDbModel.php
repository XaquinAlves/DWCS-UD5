<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class TrabajadoresDbModel extends BaseDbModel
{
    private const ORDER_BY = ['username', 'username DESC', 'nombre_rol', 'nombre_rol DESC', 'salarioBruto',
        'salarioBruto DESC', 'retencionIRPF', 'retencionIRPF DESC', 'country_name', 'country_name DESC'];
    private const SELECT_FROM_JOIN = "SELECT tr.username as nombre, tr.salarioBruto as salario, 
                tr.retencionIRPF as retencion, tr.activo, rol.nombre_rol as rol, co.country_name as pais 
                FROM trabajadores as tr 
                LEFT JOIN aux_rol_trabajador as rol ON rol.id_rol = tr.id_rol 
                LEFT JOIN aux_countries as co ON co.id = tr.id_country";

    private const SELECT_FROM_USR = "SELECT u.username, rol.nombre_rol, u.salarioBruto, u.retencionIRPF, co.country_name
        FROM trabajadores AS u LEFT JOIN aux_rol_trabajador as rol ON u.id_rol = rol.id_rol
        LEFT JOIN aux_countries as co ON co.id = u.id_country";
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
            $params = [];
            $conditions = [];

            if (!empty($filters['username'])) {
                $conditions[] = " u.username LIKE :username";
                $params['username'] = '%' . $filters['username'] . '%';
            }

            if (!empty($filters['id_rol'])) {
                $conditions[] = " u.id_rol = :id_rol";
                $params['id_rol'] = $filters['id_rol'];
            }

            if (!empty($filters['salario'])) {
                if (!empty($filters['salario'][0])) {
                    $conditions[] = " u.salarioBruto >= :min";
                    $params['min'] = $filters['salario'][0];
                }
                if (!empty($filters['salario'][1])) {
                    $conditions[] = " u.salarioBruto <= :max";
                    $params['max'] = $filters['salario'][1];
                }
            }

            if (!empty($filters['irpf'])) {
                if (!empty($filters['irpf'][0])) {
                    $conditions[] = " u.retencionIRPF >= :minirpf";
                    $params['minirpf'] = $filters['irpf'][0];
                }
                if (!empty($filters['irpf'][1])) {
                    $conditions[] = " u.retencionIRPF <= :maxirpf";
                    $params['maxirpf'] = $filters['irpf'][1];
                }
            }

            if (!empty($filters['pais'])) {
                $sentence = "( ";
                for ($i = 0; $i < count($filters['pais']); $i++) {
                    $sentence .= " u.id_country = :pais" . $i . " OR";
                    $params['pais' . $i] = $filters['pais'][$i];
                }
                $conditions[] = rtrim($sentence, "OR") . ") ";
            }

            if (!empty($conditions)) {
                $stringConditions = implode(' AND ', $conditions);
                $sql .= " WHERE " . $stringConditions;
            }

            $sql .= " ORDER BY " . self::ORDER_BY[$this->getOrderInt($filters)];

            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
        } else {
            $statement = $this->pdo->query($sql);
        }

        return $statement->fetchAll();
    }

    public function getOrderInt(array $filters): int
    {
        if (
            empty($filters['ordenar']) || filter_var($filters['ordenar'], FILTER_VALIDATE_INT) === false ||
            $filters['ordenar'] < 1 || $filters['ordenar'] > 10
        ) {
            return 1;
        } else {
            return (int)($filters['ordenar'] - 1);
        }
    }
}
