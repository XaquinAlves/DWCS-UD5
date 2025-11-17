<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class ProductosModel extends BaseDbModel
{
    private const SELECT_FROM = 'SELECT pro.codigo, pro.nombre as pro_name, cat.nombre_categoria as cat,
                            prv.nombre as prv_name, pro.stock,pro.coste,
                            pro.margen, (pro.coste * pro.margen * ((100 + pro.iva) / 100)) AS pvp
                            FROM producto pro
                            LEFT JOIN categoria cat ON cat.id_categoria = pro.id_categoria
                            LEFT JOIN proveedor prv ON prv.cif = pro.proveedor';

    public function getProductosByFilter(array $filters): array
    {
        $sql = self::SELECT_FROM;
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

}
