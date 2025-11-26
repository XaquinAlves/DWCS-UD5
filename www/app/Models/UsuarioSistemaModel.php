<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class UsuarioSistemaModel extends BaseDbModel
{

    public function findUsuario(string $username): array|false
    {
        $sql = "SELECT * FROM usuario_sistema WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $username]);
        return $stmt->fetch();
    }

    public function changeName(string $oldName, string $newName): bool
    {
        $sql = "UPDATE usuario_sistema SET nombre = :newName WHERE nombre = :oldName";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['oldName' => $oldName, 'newName' => $newName]);
    }
}