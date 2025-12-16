<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;
use PDO;

class ProveedoresModel extends BaseDbModel
{
    private const SELECT_FROM = "SELECT p.cif, p.codigo, p.nombre, p.email, ac.country_name  FROM proveedor p
        LEFT JOIN aux_countries ac ON p.id_country = ac.id";

    private const ORDER_BY = ['cif', 'cif DESC', 'codigo', 'codigo DESC', 'nombre', 'nombre DESC',
        'email', 'email DESC', 'country_name', 'country_name DESC'];

    private const SELECT_COUNT = "SELECT COUNT(cif) FROM proveedor";

    public function getProveedores(): array
    {
        $sql = "SELECT cif, nombre  FROM proveedor";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getProveedoresComplete(): array
    {
        $sql =  self::SELECT_FROM;
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function findProveedorCif(string $cif): array|false
    {
        $sql = "SELECT cif FROM proveedor WHERE cif = :cif";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['cif' => $cif]);
        return $stmt->fetchColumn();
    }

    public function getProveedoresByFilters(array $filters): array
    {
        $sql = self::SELECT_FROM;
        $query = $this->buildQueryProveedores($filters);

        if (!empty($query['conditions'])) {
            $stringConditions = implode(' AND ', $query['conditions']);
            $sql .= " WHERE " . $stringConditions;
        }

        $sql .= " ORDER BY " . self::ORDER_BY[$this->getOrder($filters) - 1] . " LIMIT :offset,25";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':offset', ((intval($filters['pagina'] ?? 1) - 1) * 25), PDO::PARAM_INT);
        foreach ($query['params'] as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOrder(array $filters): int
    {
        if (
            empty($filters['ordenar']) || filter_var($filters['ordenar'], FILTER_VALIDATE_INT) === false ||
            $filters['ordenar'] < 1 || $filters['ordenar'] > 10
        ) {
            return 1;
        } else {
            return (int)$filters['ordenar'];
        }
    }

    public function getNumberOfPages(array $filters): int
    {
        $sql = self::SELECT_COUNT;
        $query = $this->buildQueryProveedores($filters);

        if (!empty($query['conditions'])) {
            $sql .= " WHERE " . implode(' AND ', $query['conditions']);
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($query['params']);
        return intval(ceil($stmt->fetchColumn() / 25));
    }

    public function getPage(array $filters): int
    {
        if (
            empty($filters['pagina']) || filter_var($filters['pagina'], FILTER_VALIDATE_INT) === false ||
            $filters['pagina'] < 1 || $filters['pagina'] > $this->getNumberOfPages($filters)
        ) {
            return 1;
        } else {
            return (int)$filters['pagina'];
        }
    }

    public function buildQueryProveedores(array $filters): array
    {
        $params = [];
        $conditions = [];

        if (!empty($filters['cif'])) {
            $params['cif'] = $filters['cif'];
            $conditions[] = "cif = :cif";
        }

        if (!empty($filters['codigo'])) {
            $params['codigo'] = $filters['codigo'];
            $conditions[] = "codigo = :codigo";
        }

        if (!empty($filters['nombre'])) {
            $params['nombre'] = "%{$filters['nombre']}%";
            $conditions[] = "nombre LIKE :nombre";
        }

        if (!empty($filters['email'])) {
            $params['email'] = "%{$filters['email']}%";
            $conditions[] = "email LIKE :email";
        }

        if (!empty($filters['id_country'])) {
            $params['id_country'] = $filters['id_country'];
            $conditions[] = "id_country = :id_country";
        }

        return [ 'conditions' => $conditions, 'params' => $params];
    }

    public function altaProveedor(array $input): bool
    {
        $this->pdo->beginTransaction();

        $sql = "INSERT INTO proveedor (cif, codigo, nombre, email, id_country, direccion, website, telefono)
            VALUES (:cif, :codigo, :nombre, :email, :id_country, :direccion, :website, :telefono)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($input);

        if ($stmt->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['insert', 'proveedor', "Añadido el proveedor " . $input['nombre']]);
            $this->pdo->commit();
            return true;
        } else {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function updateProveedor(array $input): bool
    {
        $this->pdo->beginTransaction();

        $sql = "UPDATE proveedor SET proveedor.codigo = :codigo, nombre = :nombre, email = :email,
                 direccion = :direccion, id_country = :id_country, website = :website, telefono = :telefono 
                 WHERE cif = :cif";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($input);

        if ($stmt->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['update', 'proveedor', "Actualizado el proveedor " . $input['nombre'] . "con los datos: "
            . json_encode($input)]);
            $this->pdo->commit();
            return true;
        } else {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function findProveedor(string $cif): array|false
    {
        $sql = "SELECT * FROM proveedor WHERE cif = :cif";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['cif' => $cif]);
        return $stmt->fetch();
    }

    public function deleteProveedor(string $cif): bool
    {
        $this->pdo->beginTransaction();
        $sql = "DELETE FROM proveedor WHERE cif = :cif";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['cif' => $cif]);

        if ($stmt->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['delete', 'proveedor', "Borrado el proveedor con cif $cif"]);
            $this->pdo->commit();
            return true;
        } else {
            $this->pdo->rollBack();
            return false;
        }
    }
}
