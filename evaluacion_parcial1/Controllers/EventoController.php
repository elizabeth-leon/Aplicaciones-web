<?php
require_once __DIR__ . '/../Models/EventoRepositorio.php';
class EventoController {
    private EventoRepositorio $repo;
    public function __construct() { $this->repo = new EventoRepositorio(); }
    public function index(): void {
        $q = trim((string)($_GET['q'] ?? ''));
        $rows = $this->repo->listar($q);
        require __DIR__ . '/../views/eventos.php';
    }
    public function formulario(): void {
        $id = idValido($_GET['id'] ?? null);
        $r = $id ? $this->repo->buscar($id) : null;
        if ($id && !$r) { http_response_code(404); echo 'Evento no encontrado.'; return; }
        $r ??= ['nombre'=>'', 'fecha'=>'', 'ubicacion'=>'', 'descripcion'=>''];
        require __DIR__ . '/../views/evento_form.php';
    }
    public function guardar(): void {
        $id = idValido($_POST['id'] ?? null);
        if ($id && !$this->repo->buscar($id)) throw new InvalidArgumentException('El evento no existe.');
        $d = [
            'nombre' => trim((string)($_POST['nombre'] ?? '')),
            'fecha' => (string)($_POST['fecha'] ?? ''),
            'ubicacion' => trim((string)($_POST['ubicacion'] ?? '')),
            'descripcion' => trim((string)($_POST['descripcion'] ?? '')),
        ];
        $fecha = DateTimeImmutable::createFromFormat('!Y-m-d', $d['fecha']);
        if ($d['nombre'] === '' || mb_strlen($d['nombre']) > 120 || $d['ubicacion'] === '' || mb_strlen($d['ubicacion']) > 160 || mb_strlen($d['descripcion']) > 5000 || !$fecha || $fecha->format('Y-m-d') !== $d['fecha']) {
            throw new InvalidArgumentException('Revisa el nombre, la fecha y la ubicación del evento.');
        }
        $this->repo->guardar($id, $d);
        aviso('Evento guardado correctamente.');
    }
    public function eliminar(): void {
        $id = idValido($_POST['id'] ?? null);
        if (!$id || !$this->repo->buscar($id)) throw new InvalidArgumentException('El evento no existe.');
        $this->repo->eliminar($id);
        aviso('Evento eliminado.');
    }
}
