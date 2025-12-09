<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class CategoriasModel extends BaseDbModel
{
    public function getCategorias(): array
    {
        $sql = "SELECT id_categoria as id_cat, nombre_categoria as cat_name FROM categoria ORDER BY nombre_categoria";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getCategoriasByFilters(array $filters): array|false
    {
        $sql = "SELECT cat.id_categoria as id_cat, cat.nombre_categoria as cat_name, 
       padre.nombre_categoria as padre_name FROM categoria as cat 
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

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}