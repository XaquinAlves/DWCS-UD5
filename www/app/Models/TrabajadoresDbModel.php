<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;
use PDO;

class TrabajadoresDbModel extends BaseDbModel
{
    private const ORDER_BY = ['username', 'username DESC', 'nombre_rol', 'nombre_rol DESC', 'salarioBruto',
        'salarioBruto DESC', 'retencionIRPF', 'retencionIRPF DESC', 'country_name', 'country_name DESC'];

    private const SELECT_FROM_JOIN = "SELECT tr.username as nombre, tr.salarioBruto as salario, 
                tr.retencionIRPF as retencion, tr.activo, rol.nombre_rol as rol, co.country_name as pais 
                FROM trabajadores as tr 
                LEFT JOIN aux_rol_trabajador as rol ON rol.id_rol = tr.id_rol 
                LEFT JOIN aux_countries as co ON co.id = tr.id_country";
    private const SELECT_FROM_USR = "SELECT u.username, rol.nombre_rol, u.salarioBruto, u.retencionIRPF,
       co.country_name, u.activo
        FROM trabajadores AS u LEFT JOIN aux_rol_trabajador as rol ON u.id_rol = rol.id_rol
        LEFT JOIN aux_countries as co ON co.id = u.id_country";
    private const SELECT_COUNT = "SELECT COUNT(u.username) FROM trabajadores u";

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
        $queryItems = $this->buildUsuariosQuery($filters);
        $params = $queryItems['params'];
        $sql .=  $queryItems['sql'];

        $sql .= " ORDER BY " . self::ORDER_BY[$this->getOrderInt($filters) - 1] . " LIMIT :offset,25";

        $statement = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $statement->bindValue($key, $value);
        }
        $statement->bindValue(':offset', ((intval($filters['page'] ?? 1) - 1) * 25), PDO::PARAM_INT);

        $statement->execute();
        return $statement->fetchAll();
    }

    public function getNumberOfPages(array $filters): int
    {
        $sql = self::SELECT_COUNT;
        $queryItems = $this->buildUsuariosQuery($filters);
        $sql .=  $queryItems['sql'];

        if ($queryItems['params'] === []) {
            $statement = $this->pdo->query($sql);
        } else {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($queryItems['params']);
        }

        $numUsuarios = intval($statement->fetchColumn());
        return intval(ceil($numUsuarios / 25));
    }

    public function getOrderInt(array $filters): int
    {
        if (
            empty($filters['ordenar']) || filter_var($filters['ordenar'], FILTER_VALIDATE_INT) === false ||
            $filters['ordenar'] < 1 || $filters['ordenar'] > count(self::ORDER_BY)
        ) {
            return 1;
        } else {
            return (int)$filters['ordenar'];
        }
    }

    public function getPage(array $filters): int
    {
        if (
            empty($filters['page']) || filter_var($filters['page'], FILTER_VALIDATE_INT) === false ||
            $filters['page'] < 1
        ) {
            return 1;
        } else {
            return (int)$filters['page'];
        }
    }

    private function buildUsuariosQuery(array $filters): array
    {
        $results = [];
        $params = [];
        $conditions = [];
        $sql = "";

        if (!empty($filters['input_nombre'])) {
            $conditions[] = " u.username LIKE :username";
            $params['username'] = '%' . $filters['input_nombre'] . '%';
        }

        if (!empty($filters['input_rol'])) {
            $conditions[] = " u.id_rol = :id_rol";
            $params['id_rol'] = $filters['input_rol'];
        }

        if (!empty($filters['min_salario']) || !empty($filters['max_salario'])) {
            if (!empty($filters['min_salario'])) {
                $conditions[] = " u.salarioBruto >= :min";
                $params['min'] = $filters['min_salario'];
            }
            if (!empty($filters['max_salario'])) {
                $conditions[] = " u.salarioBruto <= :max";
                $params['max'] = $filters['max_salario'];
            }
        }

        if (!empty($filters['min_irpf']) || !empty($filters['max_irpf'])) {
            if (!empty($filters['min_irpf'])) {
                $conditions[] = " u.retencionIRPF >= :minirpf";
                $params['minirpf'] = $filters['min_irpf'];
            }
            if (!empty($filters['max_irpf'][1])) {
                $conditions[] = " u.retencionIRPF <= :maxirpf";
                $params['maxirpf'] = $filters['max_irpf'];
            }
        }

        if (!empty($filters['input_pais'])) {
            $sentence = " u.id_country IN (";
            for ($i = 0; $i < count($filters['input_pais']); $i++) {
                $sentence .= " :pais" . $i . ",";
                $params['pais' . $i] = $filters['input_pais'][$i];
            }
            $conditions[] = rtrim($sentence, ",") . ") ";
        }

        if (!empty($conditions)) {
            $stringConditions = implode(' AND ', $conditions);
            $sql .= " WHERE " . $stringConditions;
        }

        $results['params'] = $params;
        $results['sql'] = $sql;
        return $results;
    }

    public function insertUsuario(array $input): bool
    {
        $this->pdo->beginTransaction();
        $sql = "INSERT INTO trabajadores (username, salarioBruto, retencionIRPF, activo, id_rol, id_country) 
            VALUES (:username, :salario, :retencion, :activo, :rol, :pais)";

        $params = [
            'username' => $input['username'],
            'salario' => $input['salarioBruto'],
            'retencion' => $input['retencionIRPF'],
            'rol' => $input['id_rol'],
            'pais' => $input['id_country'],
            'activo' => $input['activo']
        ];

        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        if ($statement->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['insert', 'trabajadores', "Añadido el usuario " . $params['username']]);
            $this->pdo->commit();
            return true;
        } else {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function find(string $username): array|false
    {
        $sql = "SELECT * FROM trabajadores WHERE username = :username";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['username' => $username]);
        return $statement->fetch();
    }

    public function updateUsuario(array $input): bool
    {
        $this->pdo->beginTransaction();
        $sql = "UPDATE trabajadores SET salarioBruto = :salario, retencionIRPF = :retencion, id_rol = :rol,
                        id_country = :pais, activo = :activo, username = :username WHERE username = :username";

        $params = [
            'username' => $input['username'],
            'salario' => $input['salarioBruto'],
            'retencion' => $input['retencionIRPF'],
            'rol' => $input['id_rol'],
            'pais' => $input['id_country'],
            'activo' => $input['activo']
        ];

        $statement = $this->pdo->prepare($sql);
        $statement->execute($params);
        if ($statement->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['update', 'trabajadores', "Actualizado " . $params['username'] . " con los datos: " .
                json_encode($params)]);
            $this->pdo->commit();
            return true;
        } else {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function deleteUsuario(string $username): bool
    {
        $this->pdo->beginTransaction();
        $statement = $this->pdo->prepare("DELETE FROM trabajadores WHERE username = :username");
        $statement->execute(['username' => $username]);
        if ($statement->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['delete', 'trabajadores', "Borrado el usuario $username"]);
            $this->pdo->commit();
            return true;
        } else {
            $this->pdo->rollBack();
            return false;
        }
    }
}
