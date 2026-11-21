<?php
require_once __DIR__ . '/../src/Database.php';
class InscripcionRepositorio {
    private PDO $db;
    public function __construct() { $this->db = Database::conectar(); }
    public function contar(): int { return (int)$this->db->query('SELECT COUNT(*) FROM inscripciones')->fetchColumn(); }
    public function buscar(int $id): ?array {
        $st = $this->db->prepare('SELECT * FROM inscripciones WHERE inscripcion_id = ?');
        $st->execute([$id]); return $st->fetch() ?: null;
    }
    public function listar(): array {
        return $this->db->query('SELECT i.inscripcion_id, i.fecha_inscripcion, e.nombre AS evento, e.fecha AS evento_fecha, CONCAT(p.nombre, " ", p.apellido) AS participante, p.email FROM inscripciones i INNER JOIN eventos e ON e.evento_id=i.evento_id INNER JOIN participantes p ON p.participante_id=i.participante_id ORDER BY i.fecha_inscripcion DESC, i.inscripcion_id DESC')->fetchAll();
    }
    public function guardar(int $id, int $evento, int $participante): void {
        if ($id) {
            $st = $this->db->prepare('UPDATE inscripciones SET evento_id=?, participante_id=? WHERE inscripcion_id=?');
            $st->execute([$evento, $participante, $id]);
        } else {
            $st = $this->db->prepare('INSERT INTO inscripciones (evento_id, participante_id) VALUES (?, ?)');
            $st->execute([$evento, $participante]);
        }
    }
    public function eliminar(int $id): void { $st = $this->db->prepare('DELETE FROM inscripciones WHERE inscripcion_id=?'); $st->execute([$id]); }
}
