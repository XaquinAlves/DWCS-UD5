<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;
use PDO;

class ProductosModel extends BaseDbModel
{
    private const SELECT_FROM = 'SELECT producto.codigo, producto.nombre as pro_name, cat.nombre_categoria as categoria,
                            prv.nombre as prv_name, producto.stock, producto.coste, 
                            producto.margen, (producto.coste * producto.margen * ((100 + producto.iva) / 100)) AS pvp
                            FROM producto 
                            LEFT JOIN categoria AS cat ON cat.id_categoria = producto.id_categoria
                            LEFT JOIN proveedor AS prv ON prv.cif = producto.proveedor';
    private const SELECT_FROM2 = 'SELECT pro.codigo, pro.nombre as pro_name, pro.stock, pro.coste, pro.margen,
       (pro.coste * pro.margen * ((100 + pro.iva) / 100)) AS pvp, pro.id_categoria as categoria,
       pro.proveedor as prv_name  FROM producto pro LEFT JOIN categoria cat ON cat.id_categoria = pro.id_categoria';
    private const SELECT_COUNT = 'SELECT COUNT(codigo) FROM producto';
    private const ORDER_BY = ['producto.codigo', 'producto.codigo DESC', 'pro_name', 'pro_name DESC', 'categoria',
        'categoria DESC','prv_name', 'prv_name DESC','producto.coste','producto.coste DESC','producto.margen',
        'producto.margen DESC', 'pvp', 'pvp DESC'];

    public function getProductosByFilter(array $filters): array
    {
        $sql = self::SELECT_FROM;
        $queryItems = $this->buildProductosQuery($filters);

        $pageSize = $this->getPageSize($filters);
        $offset = ($this->getPage($filters) - 1) * $pageSize;

        $sql .= $queryItems['sql'] . " ORDER BY " . self::ORDER_BY[$this->getOrderInt($filters) - 1] .
            " LIMIT :offset, :pageSize";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':pageSize', $pageSize, PDO::PARAM_INT);
        foreach ($queryItems['params'] as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getNumberOfPages(array $filters): int
    {
        $sql = self::SELECT_COUNT;
        $queryItems = $this->buildProductosQuery($filters);
        $sql .= $queryItems['sql'];

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($queryItems['params']);

        return intval(ceil($stmt->fetchColumn() / $this->getPageSize($filters)));
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

    public function getOrderInt(array $filters): int
    {
        if (
            empty($filters['order']) || filter_var($filters['order'], FILTER_VALIDATE_INT) === false ||
            $filters['order'] < 1 || $filters['order'] > count(self::ORDER_BY)
        ) {
            return 1;
        } else {
            return (int)$filters['order'];
        }
    }

    private function buildProductosQuery(array $filters): array
    {
        $sql = '';
        $query = [];
        $params = [];
        $conditions = [];

        if (!empty($filters['input_codigo'])) {
            $conditions[] = ' producto.codigo = :codigo';
            $params['codigo'] = $filters['input_codigo'];
        }

        if (!empty($filters['input_nombre'])) {
            $conditions[] = ' producto.nombre LIKE :nombre';
            $params['nombre'] = '%' . $filters['input_nombre'] . '%';
        }

        if (!empty($filters['input_cat'])) {
            $conditions[] = ' producto.id_categoria = :cat';
            $params['cat'] = $filters['input_cat'];
        }

        if (!empty($filters['input_prov'])) {
            $sentence = ' (';
            for ($i = 0; $i < count($filters['input_prov']); $i++) {
                $sentence .= " producto.proveedor = :prov" . $i . " OR";
                $params['prov' . $i] = $filters['input_prov'][$i];
            }
            $conditions[] = rtrim($sentence, 'OR') . ')';
        }

        if (!empty($filters['min_stock']) || !empty($filters['max_stock'])) {
            if (!empty($filters['min_stock'])) {
                $conditions[] = ' producto.stock >= :min_stock';
                $params['min_stock'] = $filters['min_stock'];
            }
            if (!empty($filters['max_stock'])) {
                $conditions[] = ' producto.stock <= :max_stock';
                $params['max_stock'] = $filters['max_stock'];
            }
        }

        if (!empty($filters['min_coste']) || !empty($filters['max_coste'])) {
            if (!empty($filters['min_coste'])) {
                $conditions[] = ' producto.coste >= :min_coste';
                $params['min_coste'] = $filters['min_coste'];
            }
            if (!empty($filters['max_coste'])) {
                $conditions[] = ' producto.coste <= :max_coste';
                $params['max_coste'] = $filters['max_coste'];
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

    public function findProductoCodigo(string $codigo): array|false
    {
        $sql = "SELECT * FROM producto WHERE codigo = :codigo";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['codigo' => $codigo]);
        return $statement->fetch();
    }

    public function altaProducto(array $input): bool
    {
        $sql = "INSERT INTO producto (codigo, nombre, descripcion, proveedor, coste, margen, stock, iva, id_categoria)
            VALUES (:codigo, :nombre, :desc, :prov, :coste, :margen, :stock, :iva,  :cat)";
        $params = [
            'codigo' => $input['codigo'],
            'nombre' => $input['nombre'],
            'desc' => $input['descripcion'] ?? 'Inserte una descripcion',
            'prov' => $input['proveedor'],
            'coste' => $input['coste'],
            'margen' => $input['margen'],
            'stock' => $input['stock'],
            'iva' => $input['iva'],
            'cat' => $input['categoria']
        ];
        $statement = $this->pdo->prepare($sql);
        return $statement->execute($params);
    }

    public function updateProducto(string $codigo, array $input): bool
    {
        $sql = "UPDATE producto SET nombre = :nombre, descripcion = :desc, proveedor = :prov, coste = :coste,
                    margen = :margen, stock = :stock, iva = :iva, id_categoria = :cat WHERE codigo = :codigo";
        $params = [
            'codigo' => $codigo,
            'nombre' => $input['nombre'],
            'desc' => $input['descripcion'],
            'prov' => $input['proveedor'],
            'coste' => $input['coste'],
            'margen' => $input['margen'],
            'stock' => $input['stock'],
        ];
        $statement = $this->pdo->prepare($sql);
        return $statement->execute($params);
    }
}
