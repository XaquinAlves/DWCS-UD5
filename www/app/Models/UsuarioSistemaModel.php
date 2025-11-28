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

    public function addUser(): void
    {
        $password = password_hash('TestTest1.', PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuario_sistema (id_rol, nombre, email, pass, idioma, baja)
                    VALUES (:idrol, :nombre, :email, :pass , :idioma , :baja)";

        $params = [
            'idrol' => 4,
            'nombre' => 'EncargadoProductos',
            'email' => 'encargadop@test.es',
            'pass' => $password,
            'idioma' => 'es',
            'baja' => 0
        ];
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
    }
}