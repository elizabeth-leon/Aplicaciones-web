<?php
declare(strict_types=1);

// Pruebas locales con PHP CLI: php tests/run.php
// No modifica la base de datos del proyecto.
require_once __DIR__ . '/../Models/Cliente.php';
require_once __DIR__ . '/../Models/ClienteRepositorio.php';
require_once __DIR__ . '/../Controllers/ClienteController.php';

function verificar(bool $condicion, string $mensaje): void
{
    if (!$condicion) {
        throw new RuntimeException('FALLÓ: ' . $mensaje);
    }
    echo '[OK] ' . $mensaje . PHP_EOL;
}

$cliente = new Cliente(null, 'Ana', 'Pérez', 'ana@ejemplo.com', '0991234567', true);
verificar($cliente->id === null && $cliente->nombre === 'Ana', 'Se construye el objeto Cliente');
verificar($cliente->activo === true, 'El estado activo es booleano');
$clienteFila = Cliente::desdeFila([
    'id' => 5, 'nombre' => 'Luis', 'apellido' => 'Mora',
    'correo' => 'luis@ejemplo.com', 'telefono' => '', 'activo' => 0,
]);
verificar($clienteFila->id === 5 && !$clienteFila->activo, 'Se recupera un Cliente desde una fila');

if (!in_array('sqlite', PDO::getAvailableDrivers(), true)) {
    echo '[INFO] CRUD SQL omitido: pdo_sqlite no está disponible; usa el formulario web con MySQL.' . PHP_EOL;
    exit(0);
}

$pdo = new PDO('sqlite::memory:', null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
$pdo->exec('CREATE TABLE clientes (id INTEGER PRIMARY KEY AUTOINCREMENT, nombre TEXT NOT NULL, apellido TEXT NOT NULL, correo TEXT UNIQUE NOT NULL, telefono TEXT NOT NULL, activo INTEGER NOT NULL DEFAULT 1)');
$repo = new ClienteRepositorio($pdo);
$id = $repo->registrar($cliente);
verificar($id > 0, 'CREATE: se registra un Cliente');
verificar($repo->consultar($id)?->correo === 'ana@ejemplo.com', 'READ: se consulta por ID');
verificar(count($repo->listar()) === 1, 'READ: se listan los clientes');
$cliente->id = $id;
$cliente->nombre = 'Ana María';
$repo->actualizar($cliente);
verificar($repo->consultar($id)?->nombre === 'Ana María', 'UPDATE: se actualiza el cliente');
$repo->eliminar($id);
verificar(count($repo->listar()) === 0, 'DELETE: se elimina el cliente');
echo 'Pruebas completadas.' . PHP_EOL;
