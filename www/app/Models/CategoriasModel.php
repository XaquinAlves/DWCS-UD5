<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class CategoriasModel extends BaseDbModel
{
    private const ORDER_BY = ['id_cat', 'id_cat DESC', 'cat_name', 'cat_name DESC', 'padre_name', 'padre_name DESC'];
    public function getCategorias(): array
    {
        $sql = "SELECT id_categoria as id_cat, nombre_categoria as cat_name FROM categoria ORDER BY nombre_categoria";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getCategoriasByFilters(array $filters): array|false
    {
        $sql = "SELECT cat.id_categoria as id_cat, cat.nombre_categoria as cat_name, 
       padre.nombre_categoria as padre_name, cat.id_padre FROM categoria as cat 
           LEFT JOIN categoria as padre ON cat.id_padre = padre.id_categoria";
        $params = [];
        $conditions = [];

        if (!empty($filters['id_cat'])) {
            $conditions[] = " cat.id_categoria = :id_cat";
            $params['id_cat'] = $filters['id_cat'];
        }

        if (!empty($filters['cat_name'])) {
            $conditions[] = " cat.nombre_categoria LIKE :cat_name";
            $params['cat_name'] = '%' . $filters['cat_name'] . '%';
        }

        if (!empty($filters['padre_name'])) {
            $conditions[] = " padre.nombre_categoria LIKE :padre_name";
            $params['padre_name'] = '%' . $filters['padre_name'] . '%';
        }

        if (!empty($filters['id_padre'])) {
            $conditions[] = " cat.id_padre = :id_padre";
            $params['id_padre'] = $filters['id_padre'];
        }

        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
        $sql .= " ORDER BY " . self::ORDER_BY[$this->getOrder($filters) - 1];

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getOrder(array $filters): int
    {
        if (
            empty($filters['ordenar']) || filter_var($filters['ordenar'], FILTER_VALIDATE_INT) === false ||
            $filters['ordenar'] < 1 || $filters['ordenar'] > count(self::ORDER_BY)
        ) {
            return 1;
        }
        return (int)$filters['ordenar'];
    }

    public function addCategoria(array $data): bool
    {
        $this->pdo->beginTransaction();
        if ($data['padre'] === 'null') {
            $data['padre'] = null;
        }

        $sql = "INSERT INTO categoria (nombre_categoria, id_padre) VALUES (:nombre, :padre)";
        $stmt = $this->pdo->prepare($sql);
        $params = [
            'nombre' => $data['nombre'],
            'padre' => $data['padre']
        ];
        $stmt->execute($params);
        if ($stmt->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['insert', 'categoria', "Añadida la categoría " . $params['nombre']]);
            $this->pdo->commit();
            return true;
        } else {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function findCategoria(int $id): array|false
    {
        $sql = "SELECT * FROM categoria WHERE id_categoria = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
