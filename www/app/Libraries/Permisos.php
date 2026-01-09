<?php

declare(strict_types=1);
namespace Com\Daw2\Libraries;

class Permisos {
    private $read;

    private $write;

    private $delete;

    public function __construct(string $permisos)
    {
        $this->read = str_contains($permisos, 'r');
        $this->write = str_contains($permisos, 'w');
        $this->delete = str_contains($permisos, 'd');
    }

    public function isRead(): bool
    {
        return $this->read;
    }

    public function isWrite(): bool
    {
        return $this->write;
    }

    public function isDelete(): bool
    {
        return $this->delete;
    }

    public function setPermisos(string $permisos): void
    {
        $this->read = str_contains($permisos, 'r');
        $this->write = str_contains($permisos, 'w');
        $this->delete = str_contains($permisos, 'd');
    }
}