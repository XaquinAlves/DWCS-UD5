<?php

declare(strict_types=1);
namespace Com\Daw2\Libraries;

class Mensaje {
    public const INFO = 'info';
    public const ERROR = 'danger';
    public const SUCCESS = 'success';
    public const WARNING = 'warning';
    public const ALLOWED_TYPES = [self::INFO, self::ERROR, self::SUCCESS, self::WARNING];
    public function __construct(
        private string $texto,
        private string $tipoMensaje,
        private string $titulo = ''
    ) {
        if (!in_array($tipoMensaje, self::ALLOWED_TYPES)) {
            throw new  \InvalidArgumentException("El tipo de mensaje $tipoMensaje no es válido");
        }
    }

    public function getTexto(): string
    {
        return $this->texto;
    }

    public function getTipoMensaje(): string
    {
        return $this->tipoMensaje;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getIcon()
    {
        return match ($this->tipoMensaje) {
            self::INFO => 'fa fa-info',
            self::ERROR => 'fa fa-ban',
            self::SUCCESS => 'fa fa-check',
            self::WARNING => 'fa fa-warning',
            default => ''
        };
    }
}