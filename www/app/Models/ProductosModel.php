<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;
use PDO;

class ProductosModel extends BaseDbModel
{
    private const SELECT_FROM = 'SELECT pro.codigo, pro.nombre as pro_name, cat.nombre_categoria as cat,
                            prv.nombre as prv_name, pro.stock,pro.coste,
                            pro.margen, (pro.coste * pro.margen * ((100 + pro.iva) / 100)) AS pvp
                            FROM producto pro
                            LEFT JOIN categoria cat ON cat.id_categoria = pro.id_categoria
                            LEFT JOIN proveedor prv ON prv.cif = pro.proveedor';
    private const SELECT_COUNT = 'SELECT COUNT(codigo) FROM producto';

    public function getProductosByFilter(array $filters): array
    {
        $sql = self::SELECT_FROM;
        $queryItems = $this->buildProductosQuery($filters);
        $pageSize = $this->getPageSize($filters);
        $offset = ($this->getPage($filters) - 1) * $pageSize;
        $sql .= $queryItems['sql'] . " LIMIT $offset, $pageSize";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($queryItems['params']);

        return $stmt->fetchAll();
    }

    public function getNumberOfPages(array $filters): int
    {
        $sql = self::SELECT_COUNT;
        $queryItems = $this->buildProductosQuery($filters);
        $sql .= $queryItems['sql'];

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($queryItems['params']);

        return (int)$stmt->fetchColumn();
    }

    public function getPageSize(array $filters): int
    {
        if (
            empty($filters['page_size']) || filter_var($filters['page_size'], FILTER_VALIDATE_INT) === false ||
            $filters['page_size'] < 1
        ) {
            return 25;
        } else {
            return (int)$filters['page_size'];
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

    private function buildProductosQuery(array $filters): array
    {
        $sql = '';
        $query = [];
        $params = [];
        $conditions = [];

        if (!empty($filters['input_codigo'])) {
            $conditions[] = 'pro.codigo LIKE :codigo';
            $params['codigo'] = '%' . $filters['input_codigo'] . '%';
        }

        if (!empty($filters['input_nombre'])) {
            $conditions[] = 'pro.nombre LIKE :nombre';
            $params['nombre'] = '%' . $filters['input_nombre'] . '%';
        }

        if (!empty($filters['input_cat'])) {
            $sentence = ' (';
            for ($i = 0; $i < count($filters['input_cat']); $i++) {
                $sentence .= "cat.id_categoria = :cat" . $i . " OR";
                $params['cat' . $i] = $filters['input_cat'][$i];
            }
            $conditions[] = rtrim($sentence, 'OR') . ')';
        }

        if (!empty($filters['input_prov'])) {
            $conditions[] = 'prv.cif = :prov';
            $params['prov'] = $filters['input_prov'];
        }

        if (!empty($filters['min_stock']) || !empty($filters['max_stock'])) {
            if (!empty($filters['min_stock'])) {
                $conditions[] = 'pro.stock >= :min_stock';
                $params['min_stock'] = $filters['min_stock'];
            }
            if (!empty($filters['max_stock'])) {
                $conditions[] = 'pro.stock <= :max_stock';
                $params['max_stock'] = $filters['max_stock'];
            }
        }

        if (!empty($filters['min_pvp']) || !empty($filters['max_pvp'])) {
            if (!empty($filters['min_pvp'])) {
                $conditions[] = 'pro.pvp >= :min_pvp';
                $params['min_pvp'] = $filters['min_pvp'];
            }
            if (!empty($filters['max_pvp'])) {
                $conditions[] = 'pro.pvp <= :max_pvp';
                $params['max_pvp'] = $filters['max_pvp'];
            }
        }

        if (!empty($conditions)) {
            $stringConditions = implode(' AND ', $conditions);
            $sql = ' WHERE ' . $stringConditions;
        }

        $query['sql'] = $sql;
        $query['params'] = $params;
        return $query;
    }
}
