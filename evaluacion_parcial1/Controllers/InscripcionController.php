<?php
require_once __DIR__ . '/../Models/InscripcionRepositorio.php';
require_once __DIR__ . '/../Models/EventoRepositorio.php';
require_once __DIR__ . '/../Models/ParticipanteRepositorio.php';
class InscripcionController {
    private InscripcionRepositorio $repo;
    public function __construct() { $this->repo = new InscripcionRepositorio(); }
    public function index(): void {
        $rows = $this->repo->listar();
        require __DIR__ . '/../views/inscripciones.php';
    }
    public function formulario(): void {
        $id = idValido($_GET['id'] ?? null);
        $r = $id ? $this->repo->buscar($id) : null;
        if ($id && !$r) { http_response_code(404); echo 'Inscripción no encontrada.'; return; }
        $r ??= ['evento_id'=>0,'participante_id'=>0];
        $eventos = (new EventoRepositorio())->opciones();
        $participantes = (new ParticipanteRepositorio())->opciones();
        require __DIR__ . '/../views/inscripcion_form.php';
    }
    public function guardar(): void {
        $id = idValido($_POST['id'] ?? null);
        $evento = idValido($_POST['evento_id'] ?? null);
        $participante = idValido($_POST['participante_id'] ?? null);
        if (($id && !$this->repo->buscar($id)) || !$evento || !$participante || !(new EventoRepositorio())->buscar($evento) || !(new ParticipanteRepositorio())->buscar($participante)) {
            throw new InvalidArgumentException('Selecciona un evento y un participante válidos.');
        }
        $this->repo->guardar($id, $evento, $participante);
        aviso('Inscripción guardada correctamente.');
    }
    public function eliminar(): void {
        $id = idValido($_POST['id'] ?? null);
        if (!$id || !$this->repo->buscar($id)) throw new InvalidArgumentException('La inscripción no existe.');
        $this->repo->eliminar($id);
        aviso('Inscripción eliminada.');
    }
}
