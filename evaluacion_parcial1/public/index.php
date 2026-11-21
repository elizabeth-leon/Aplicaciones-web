<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/../src/Funciones.php';
require_once __DIR__ . '/../Controllers/EventoController.php';
require_once __DIR__ . '/../Controllers/ParticipanteController.php';
require_once __DIR__ . '/../Controllers/InscripcionController.php';
require_once __DIR__ . '/../views/plantilla.php';

$paginas = ['inicio','eventos','evento_form','participantes','participante_form','inscripciones','inscripcion_form'];
$page = $_GET['page'] ?? 'inicio';
if (!is_string($page) || !in_array($page, $paginas, true)) $page = 'inicio';

// Las operaciones que modifican datos solo aceptan POST y un token válido.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    revisarToken();
    $accion = (string)($_POST['action'] ?? '');
    $destino = 'inicio';
    try {
        switch ($accion) {
            case 'save_evento': (new EventoController())->guardar(); $destino='eventos'; break;
            case 'delete_evento': (new EventoController())->eliminar(); $destino='eventos'; break;
            case 'save_participante': (new ParticipanteController())->guardar(); $destino='participantes'; break;
            case 'delete_participante': (new ParticipanteController())->eliminar(); $destino='participantes'; break;
            case 'save_inscripcion': (new InscripcionController())->guardar(); $destino='inscripciones'; break;
            case 'delete_inscripcion': (new InscripcionController())->eliminar(); $destino='inscripciones'; break;
            default: throw new InvalidArgumentException('La operación solicitada no existe.');
        }
    } catch (InvalidArgumentException $e) {
        aviso($e->getMessage(),'error');
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $codigo = (int)($e->errorInfo[1] ?? 0);
        if ($codigo === 1062) aviso('El correo o la inscripción ya están registrados.', 'error');
        elseif ($codigo === 1451) aviso('Antes de eliminar este registro, elimina sus inscripciones.', 'error');
        else aviso('No se pudo guardar la información. Revisa los datos y la conexión.', 'error');
    }
    if ($destino === 'inicio') {
        if (str_contains($accion, 'evento')) $destino = 'eventos';
        elseif (str_contains($accion, 'participante')) $destino = 'participantes';
        elseif (str_contains($accion, 'inscripcion')) $destino = 'inscripciones';
    }
    ir($destino);
}

render_header($page);
try {
    switch ($page) {
        case 'inicio':
            $totalEventos = (new EventoRepositorio())->contar();
            $totalParticipantes = (new ParticipanteRepositorio())->contar();
            $totalInscripciones = (new InscripcionRepositorio())->contar();
            $proximos = (new EventoRepositorio())->proximos();
            require __DIR__ . '/../views/inicio.php';
            break;
        case 'eventos': (new EventoController())->index(); break;
        case 'evento_form': (new EventoController())->formulario(); break;
        case 'participantes': (new ParticipanteController())->index(); break;
        case 'participante_form': (new ParticipanteController())->formulario(); break;
        case 'inscripciones': (new InscripcionController())->index(); break;
        case 'inscripcion_form': (new InscripcionController())->formulario(); break;
    }
} catch (Throwable $e) {
    error_log((string)$e);
    http_response_code(500);
    echo '<section class="panel"><h2>No se pudo cargar el sistema</h2><p>Comprueba que MySQL esté activo y que importaste database.sql. Verifica también el archivo config/database.php.</p></section>';
}
render_footer();
