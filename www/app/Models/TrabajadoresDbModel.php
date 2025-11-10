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
            if (!empty($filters['id_rol'])) {
                $sql .= " WHERE u.id_rol = :id_rol";
                $statement = $this->pdo->prepare($sql);
                $statement->bindParam(':id_rol', $filters['id_rol']);
                $statement->execute();
            } elseif (!empty($filters['username'])) {
                $sql .= " WHERE u.username LIKE :username";
                $statement = $this->pdo->prepare($sql);
                $statement->execute(['username' => '%' . $filters['username'] . '%']);
            } elseif (!empty($filters['salario'])) {
                $sql .= " WHERE u.salarioBruto BETWEEN :min AND :max ORDER BY u.salarioBruto DESC";
                $statement = $this->pdo->prepare($sql);
                $statement->execute(['min' => $filters['salario'][0], 'max' => $filters['salario'][1]]);
            }
        } else {
            $statement = $this->pdo->query($sql);
        }

        return $statement->fetchAll();
    }
}
