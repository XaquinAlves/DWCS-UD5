<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class UsuarioSistemaModel extends BaseDbModel
{
    private const ORDER_BY = ['id_usuario','id_usuario DESC' ,'nombre', 'nombre DESC', 'email', 'email DESC', 'rol',
        'rol DESC' ,'last_date', 'last_date DESC', 'idioma', 'idioma DESC'];
    private bool $isTransaction = false;
    public function findUsuario(string $username): array|false
    {
        $sql = "SELECT * FROM usuario_sistema WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $username]);
        return $stmt->fetch();
    }

    public function findUsuarioById(int $id_usuario): array|false
    {
        $sql = "SELECT id_usuario, nombre, email, id_rol as rol, idioma, baja
                    FROM usuario_sistema WHERE id_usuario = :id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id_usuario' => $id_usuario]);
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

    public function addUser(array $input): bool
    {
        $this->pdo->beginTransaction();
        $password = password_hash($input['pass'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario_sistema (id_rol, nombre, email, pass, idioma, baja)
                    VALUES (:rol, :nombre, :email, :pass , :idioma , :baja)";

        $params = [
            'rol' => $input['rol'],
            'nombre' => $input['nombre'],
            'email' => $input['email'],
            'pass' => $password,
            'idioma' => $input['idioma'],
        ];

        if (isset($input['baja'])) {
            $params['baja'] = 1;
        } else {
            $params['baja'] = 0;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        if ($stmt->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['insert', 'usuario_sistema', "Añadido el usuario  de sistema " . $input['nombre']]);
            $this->pdo->commit();
            return true;
        } else {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function updateLastLogin(int $id_usuario): bool
    {
        $this->pdo->beginTransaction();
        $sql = "UPDATE usuario_sistema SET last_date = NOW() WHERE id_usuario = :id";
        $fecha = (new \DateTime())->format('d-m-Y H:i:s');
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id_usuario]);

        if ($stmt->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['update', 'usuario_sistema', "El usuario $id_usuario se ha conectado el $fecha" ]);
            $this->pdo->commit();
            return true;
        } else {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function updatePassword(int $id_usuario, string $password): bool
    {
        if (!$this->isTransaction) {
            $this->pdo->beginTransaction();
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE usuario_sistema SET pass = :pass WHERE id_usuario = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id_usuario, 'pass' => $password]);

        if ($stmt->rowCount() == 1) {
            $stmtLog = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
            $stmtLog->execute(['update', 'usuario_sistema', "Actualizada la contraseña del usuario $id_usuario"]);

            if (!$this->isTransaction) {
                $this->pdo->commit();
            }

            return true;
        } else {
            if (!$this->isTransaction) {
                $this->pdo->rollBack();
            }

            return false;
        }
    }

    public function updateUsuario(int $id_usuario, array $input): bool
    {
        $this->pdo->beginTransaction();
        $this->isTransaction = true;
        $sql = "UPDATE usuario_sistema SET ";
        $params = [ 'id' => $id_usuario ];

        if (isset($input['nombre'])) {
            $sql .= "nombre = :nombre, ";
            $params['nombre'] = $input['nombre'];
        }
        if (isset($input['email'])) {
            $sql .= "email = :email, ";
            $params['email'] = $input['email'];
        }
        if (isset($input['rol'])) {
            $sql .= "id_rol = :rol, ";
            $params['rol'] = $input['rol'];
        } if (isset($input['idioma'])) {
            $sql .= "idioma = :idioma, ";
            $params['idioma'] = $input['idioma'];
        }

        if (isset($input['baja'])) {
            $params['baja'] = 1;
        } else {
            $params['baja'] = 0;
        }
        $sql .= "baja = :baja WHERE id_usuario = :id";

        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute($params)) {
            if ($input['pass'] !== '') {
                $result = $this->updatePassword($id_usuario, $input['pass']);
                if ($result) {
                    $this->pdo->commit();
                    $this->isTransaction = false;

                    $logStmt = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
                    $logStmt->execute(['update', 'usuario_sistema', "Actualizado el usuario $id_usuario"]);
                } else {
                    $this->pdo->rollBack();
                }
            } else {
                $this->pdo->commit();
                $this->isTransaction = false;

                $logStmt = $this->pdo->prepare('INSERT INTO log (operacion,tabla,detalle) VALUES (?,?,?)');
                $logStmt->execute(['update', 'usuario_sistema', "Actualizado el usuario $id_usuario"]);
            }
        } else {
            $this->pdo->rollBack();
            $this->isTransaction = false;
        }


        return true;
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
