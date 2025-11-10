<?php

declare(strict_types=1);
namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class AuxPaisModel extends BaseDbModel
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM aux_countries ORDER BY country_name DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}