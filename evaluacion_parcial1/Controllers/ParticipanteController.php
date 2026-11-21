<?php
require_once __DIR__ . '/../Models/ParticipanteRepositorio.php';
class ParticipanteController {
    private ParticipanteRepositorio $repo;
    public function __construct() { $this->repo = new ParticipanteRepositorio(); }
    public function index(): void {
        $q = trim((string)($_GET['q'] ?? ''));
        $rows = $this->repo->listar($q);
        require __DIR__ . '/../views/participantes.php';
    }
    public function formulario(): void {
        $id = idValido($_GET['id'] ?? null);
        $r = $id ? $this->repo->buscar($id) : null;
        if ($id && !$r) { http_response_code(404); echo 'Participante no encontrado.'; return; }
        $r ??= ['nombre'=>'','apellido'=>'','email'=>'','telefono'=>''];
        require __DIR__ . '/../views/participante_form.php';
    }
    public function guardar(): void {
        $id = idValido($_POST['id'] ?? null);
        if ($id && !$this->repo->buscar($id)) throw new InvalidArgumentException('El participante no existe.');
        $d = [
            'nombre' => trim((string)($_POST['nombre'] ?? '')),
            'apellido' => trim((string)($_POST['apellido'] ?? '')),
            'email' => trim((string)($_POST['email'] ?? '')),
            'telefono' => trim((string)($_POST['telefono'] ?? '')),
        ];
        if ($d['nombre'] === '' || mb_strlen($d['nombre']) > 80 || $d['apellido'] === '' || mb_strlen($d['apellido']) > 80 || !filter_var($d['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($d['email']) > 160 || mb_strlen($d['telefono']) > 25) {
            throw new InvalidArgumentException('Revisa el nombre, apellido, correo y teléfono.');
        }
        $this->repo->guardar($id, $d);
        aviso('Participante guardado correctamente.');
    }
    public function eliminar(): void {
        $id = idValido($_POST['id'] ?? null);
        if (!$id || !$this->repo->buscar($id)) throw new InvalidArgumentException('El participante no existe.');
        $this->repo->eliminar($id);
        aviso('Participante eliminado.');
    }
}
