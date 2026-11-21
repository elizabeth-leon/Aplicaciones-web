<?php
require_once __DIR__ . '/../src/Database.php';
class EventoRepositorio {
    private PDO $db;
    public function __construct() { $this->db = Database::conectar(); }
    public function contar(): int { return (int)$this->db->query('SELECT COUNT(*) FROM eventos')->fetchColumn(); }
    public function buscar(int $id): ?array {
        $st = $this->db->prepare('SELECT * FROM eventos WHERE evento_id = ?');
        $st->execute([$id]); return $st->fetch() ?: null;
    }
    public function listar(string $filtro = ''): array {
        $st = $this->db->prepare('SELECT e.*, COUNT(i.inscripcion_id) AS inscritos FROM eventos e LEFT JOIN inscripciones i ON i.evento_id = e.evento_id WHERE e.nombre LIKE ? OR e.ubicacion LIKE ? GROUP BY e.evento_id ORDER BY e.fecha DESC, e.evento_id DESC');
        $st->execute(['%'.$filtro.'%', '%'.$filtro.'%']); return $st->fetchAll();
    }
    public function proximos(): array {
        return $this->db->query('SELECT e.*, COUNT(i.inscripcion_id) AS cantidad FROM eventos e LEFT JOIN inscripciones i ON i.evento_id=e.evento_id WHERE e.fecha >= CURRENT_DATE() GROUP BY e.evento_id ORDER BY e.fecha ASC LIMIT 6')->fetchAll();
    }
    public function opciones(): array { return $this->db->query('SELECT evento_id, nombre, fecha FROM eventos ORDER BY fecha DESC, nombre')->fetchAll(); }
    public function guardar(int $id, array $d): void {
        if ($id) {
            $st = $this->db->prepare('UPDATE eventos SET nombre=?, fecha=?, ubicacion=?, descripcion=? WHERE evento_id=?');
            $st->execute([$d['nombre'], $d['fecha'], $d['ubicacion'], $d['descripcion'], $id]);
        } else {
            $st = $this->db->prepare('INSERT INTO eventos (nombre,fecha,ubicacion,descripcion) VALUES (?,?,?,?)');
            $st->execute([$d['nombre'], $d['fecha'], $d['ubicacion'], $d['descripcion']]);
        }
    }
    public function eliminar(int $id): void { $st = $this->db->prepare('DELETE FROM eventos WHERE evento_id=?'); $st->execute([$id]); }
}
