<?php
// Prueba temporal del sistema. Eliminar después de verificar.
declare(strict_types=1);
header('Content-Type: text/html; charset=utf-8');
echo '<h2>Prueba de conexión - Gestión Deportiva</h2>';
echo '<p>Versión PHP: ' . htmlspecialchars(PHP_VERSION) . '</p>';
echo '<p>PDO disponible: ' . (class_exists('PDO') ? 'Sí' : 'No') . '</p>';
echo '<p>Controlador pdo_mysql: ' . (extension_loaded('pdo_mysql') ? 'Sí' : 'NO - actívalo en MAMP') . '</p>';
echo '<p>Extensión mbstring: ' . (extension_loaded('mbstring') ? 'Sí' : 'NO - actívala en MAMP') . '</p>';
try {
    require_once __DIR__ . '/../src/Database.php';
    $pdo = Database::conectar();
    echo '<p style="color:green">Conexión PDO a MySQL: CORRECTA</p>';
    foreach (['eventos', 'participantes', 'inscripciones'] as $tabla) {
        $cantidad = $pdo->query('SELECT COUNT(*) FROM ' . $tabla)->fetchColumn();
        echo '<p>Tabla ' . $tabla . ': OK (' . (int)$cantidad . ' registros)</p>';
    }
} catch (Throwable $e) {
    echo '<p style="color:red">Error: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
    echo '<p>Si aparece Access denied, revisa usuario/contraseña. Si aparece could not find driver, activa pdo_mysql. Si aparece Connection refused, revisa el servicio y puerto 3306.</p>';
}
