<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../Models/Cliente.php';
require_once __DIR__ . '/../Models/ClienteRepositorio.php';
require_once __DIR__ . '/../Controllers/ClienteController.php';

if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

function e(mixed $valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

try {
    $pdo = Database::conectar();
    $controlador = new ClienteController(new ClienteRepositorio($pdo));
    $vista = $controlador->ejecutar();
} catch (PDOException $ex) {
    http_response_code(500);
    exit('No se pudo conectar a la base de datos. Revisa config/database.php e importa database.sql.');
}

$clientes = $vista['clientes'];
$clienteFormulario = $vista['clienteFormulario'];
$errores = $vista['errores'];
$editando = $clienteFormulario !== null && $clienteFormulario->id !== null;
$mensaje = $_SESSION['mensaje'] ?? null;
unset($_SESSION['mensaje']);

require __DIR__ . '/../views/clientes.php';
