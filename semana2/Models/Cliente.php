<?php
declare(strict_types=1);

// Clase que representa un cliente. Usa tipos y constructor (POO).
final class Cliente
{
    public function __construct(
        public ?int $id,
        public string $nombre,
        public string $apellido,
        public string $correo,
        public string $telefono,
        public bool $activo = true
    ) {}

    public static function desdeFila(array $fila): self
    {
        return new self(
            (int) $fila['id'],
            (string) $fila['nombre'],
            (string) $fila['apellido'],
            (string) $fila['correo'],
            (string) $fila['telefono'],
            (bool) $fila['activo']
        );
    }
}
