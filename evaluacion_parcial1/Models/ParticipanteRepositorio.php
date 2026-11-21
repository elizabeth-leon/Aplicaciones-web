<?php
require_once __DIR__ . '/../src/Database.php';
class ParticipanteRepositorio {
    private PDO $db;
    public function __construct() { $this->db = Database::conectar(); }
    public function contar(): int { return (int)$this->db->query('SELECT COUNT(*) FROM participantes')->fetchColumn(); }
    public function buscar(int $id): ?array {
        $st = $this->db->prepare('SELECT * FROM participantes WHERE participante_id = ?');
        $st->execute([$id]); return $st->fetch() ?: null;
    }
    public function listar(string $filtro = ''): array {
        $st = $this->db->prepare("SELECT p.*, COUNT(i.inscripcion_id) AS inscritos FROM participantes p LEFT JOIN inscripciones i ON i.participante_id=p.participante_id WHERE CONCAT(p.nombre, ' ', p.apellido) LIKE ? OR p.email LIKE ? GROUP BY p.participante_id ORDER BY p.apellido, p.nombre");
        $st->execute(['%'.$filtro.'%', '%'.$filtro.'%']); return $st->fetchAll();
    }
    public function opciones(): array { return $this->db->query('SELECT participante_id, nombre, apellido, email FROM participantes ORDER BY apellido, nombre')->fetchAll(); }
    public function guardar(int $id, array $d): void {
        if ($id) {
            $st = $this->db->prepare('UPDATE participantes SET nombre=?, apellido=?, email=?, telefono=? WHERE participante_id=?');
            $st->execute([$d['nombre'], $d['apellido'], $d['email'], $d['telefono'], $id]);
        } else {
            $st = $this->db->prepare('INSERT INTO participantes (nombre,apellido,email,telefono) VALUES (?,?,?,?)');
            $st->execute([$d['nombre'], $d['apellido'], $d['email'], $d['telefono']]);
        }
    }
    public function eliminar(int $id): void { $st = $this->db->prepare('DELETE FROM participantes WHERE participante_id=?'); $st->execute([$id]); }
}
