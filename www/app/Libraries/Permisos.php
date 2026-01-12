<?php

declare(strict_types=1);

namespace Com\Daw2\Libraries;

class Permisos
{
    private bool $read;

    private bool $write;

    private bool $delete;

    public function __construct(string $permisos)
    {
        $this->read = str_contains($permisos, 'r');
        $this->write = str_contains($permisos, 'w');
        $this->delete = str_contains($permisos, 'd');
    }

    public function canRead(): bool
    {
        return $this->read;
    }

    public function canWrite(): bool
    {
        return $this->write;
    }

    public function canDelete(): bool
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