<?php
declare(strict_types=1);

// El repositorio reúne las cuatro operaciones CRUD usando PDO
final class ClienteRepositorio
{
    public function __construct(private PDO $pdo) {}

    /** CREATE: agrega un cliente y devuelve el ID generado. */
    public function registrar(Cliente $cliente): int
    {
        $sql = 'INSERT INTO clientes (nombre, apellido, correo, telefono, activo)
                VALUES (:nombre, :apellido, :correo, :telefono, :activo)';
        $consulta = $this->pdo->prepare($sql);
        $consulta->execute([
            'nombre' => $cliente->nombre,
            'apellido' => $cliente->apellido,
            'correo' => $cliente->correo,
            'telefono' => $cliente->telefono,
            'activo' => (int) $cliente->activo,
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    /** READ: obtiene un cliente por su ID. */
    public function consultar(int $id): ?Cliente
    {
        $consulta = $this->pdo->prepare('SELECT * FROM clientes WHERE id = :id');
        $consulta->execute(['id' => $id]);
        $fila = $consulta->fetch();
        return $fila ? Cliente::desdeFila($fila) : null;
    }

    /** READ: devuelve el listado de clientes, más recientes primero. */
    public function listar(): array
    {
        $filas = $this->pdo->query('SELECT * FROM clientes ORDER BY id DESC')->fetchAll();
        return array_map([Cliente::class, 'desdeFila'], $filas);
    }

    /** UPDATE: actualiza los datos del cliente existente */
    public function actualizar(Cliente $cliente): void
    {
        if ($cliente->id === null) {
            throw new InvalidArgumentException('Es necesario el ID para actualizar.');
        }
        $sql = 'UPDATE clientes
                SET nombre = :nombre, apellido = :apellido,
                    correo = :correo, telefono = :telefono, activo = :activo
                WHERE id = :id';
        $consulta = $this->pdo->prepare($sql);
        $consulta->execute([
            'id' => $cliente->id,
            'nombre' => $cliente->nombre,
            'apellido' => $cliente->apellido,
            'correo' => $cliente->correo,
            'telefono' => $cliente->telefono,
            'activo' => (int) $cliente->activo,
        ]);
    }

    /** DELETE: elimina un cliente por su ID */
    public function eliminar(int $id): void
    {
        $consulta = $this->pdo->prepare('DELETE FROM clientes WHERE id = :id');
        $consulta->execute(['id' => $id]);
    }
}
