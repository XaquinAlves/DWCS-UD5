<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class UsuarioSistemaModel extends BaseDbModel
{
    private const ORDER_BY = ['id_usuario','id_usuario DESC' ,'nombre', 'nombre DESC', 'email', 'email DESC', 'rol',
        'rol DESC' ,'last_date', 'last_date DESC', 'idioma', 'idioma DESC'];
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

    public function addUser(array $filters): bool
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
        $fecha = (new \DateTime())->format('d-m-Y H:i:s');
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

    public function getUserByFilters(array $filters): array
    {
        $sql = "SELECT usr.id_usuario, usr.nombre, usr.email, rol.rol,  usr.last_date, usr.idioma, usr.baja
            FROM usuario_sistema as usr LEFT JOIN rol as rol ON usr.id_rol = rol.id_rol";

        $queryItems = $this->userFilterBuildQuery($filters);
        if (!empty($queryItems['conditions'])) {
            $sql .= " WHERE " . implode(' AND ', $queryItems['conditions']);
        }

        $sql .= " ORDER BY " . self::ORDER_BY[$this->getOrderInt($filters) - 1];

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($queryItems['params']);

        return $stmt->fetchAll();
    }

    public function userFilterBuildQuery(array $filters): array
    {
        $params = [];
        $conditions = [];

        if (!empty($filters['id_usuario'])) {
            $conditions[] = " usr.id_usuario = :id_usuario";
            $params['id_usuario'] = $filters['id_usuario'];
        }

        if (!empty($filters['nombre'])) {
            $conditions[] = " usr.nombre LIKE :nombre";
            $params['nombre'] = '%' . $filters['nombre'] . '%';
        }

        if (!empty($filters['email'])) {
            $conditions[] = " usr.email LIKE :email";
            $params['email'] = '%' . $filters['email'] . '%';
        }

        if (!empty($filters['rol'])) {
            $conditions[] = " usr.id_rol = :rol";
            $params['rol'] = $filters['rol'];
        }

        if (!empty($filters['last_date_bf'])) {
            $conditions[] = " usr.last_date <= :last_date_bf";
            $params['last_date_bf'] = $filters['last_date_bf'];
        }

        if (!empty($filters['last_date_af'])) {
            $conditions[] = " usr.last_date >= :last_date_af";
            $params['last_date_af'] = $filters['last_date_af'];
        }

        if (!empty($filters['idioma'])) {
            $conditions[] = " usr.idioma = :idioma";
            $params['idioma'] = $filters['idioma'];
        }

        return ['conditions' => $conditions, 'params' => $params];
    }

    public function getOrderInt(array $filters): int
    {
        if (
            empty($filters['ordenar']) || filter_var($filters['ordenar'], FILTER_VALIDATE_INT) === false ||
            $filters['ordenar'] < 1 || $filters['ordenar'] > count(self::ORDER_BY)
        ) {
            return 1;
        } else {
            return (int)$filters['ordenar'];
        }
    }
}
