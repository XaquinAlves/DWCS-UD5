<?php

declare(strict_types=1);

namespace Com\Daw2\Core;

abstract class BaseDbModel
{
    protected \PDO $pdo;
    protected \MYSQLi $mysqli;

    public function __construct()
    {
        $this->pdo = DBManager::getInstance()->getConnection();
        $this->mysqli = DBManager::getInstance()->getMysqliConnection();
    }
}
