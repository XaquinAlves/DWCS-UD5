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
        $this->pdo->beginTransaction();
        $sql = "UPDATE usuario_sistema SET nombre = :newName WHERE nombre = :oldName";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['oldName' => $oldName, 'newName' => $newName]);

        if ($stmt->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['update', 'usuario_sistema', "Cambiado el nombre de $oldName a $newName"]);
            $this->pdo->commit();
            return true;
        } else {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function addUser(): bool
    {
        $this->pdo->beginTransaction();
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

        if ($stmt->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['insert', 'usuario_sistema', "Actualizado el usuario  de sistema " . $params['nombre']]);
            $this->pdo->commit();
            return true;
        } else {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function updateLastLogin(string $username): bool
    {
        $this->pdo->beginTransaction();
        $sql = "UPDATE usuario_sistema SET last_date = NOW() WHERE email = :email";
        $fecha = (new \DateTime())->format( 'd-m-Y H:i:s');
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $username]);

        if ($stmt->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['update', 'usuario_sistema', "El usuario $username se ha conectado el $fecha" ]);
            $this->pdo->commit();
            return true;
        } else {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function updatePassword(string $username, string $password): bool
    {
        $this->pdo->beginTransaction();
        $sql = "UPDATE usuario_sistema SET pass = :pass WHERE email = :email";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $username, 'pass' => $password]);

        if ($stmt->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['update', 'usuario_sistema', "Actualizada la contraseña de $username"]);
            $this->pdo->commit();
            return true;
        } else {
            $this->pdo->rollBack();
            return false;
        }
    }
}