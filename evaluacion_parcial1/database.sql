CREATE DATABASE IF NOT EXISTS gestion_deportiva CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestion_deportiva;

CREATE TABLE IF NOT EXISTS eventos (
  evento_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  fecha DATE NOT NULL,
  ubicacion VARCHAR(160) NOT NULL,
  descripcion TEXT NULL,
  creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS participantes (
  participante_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(80) NOT NULL,
  apellido VARCHAR(80) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  telefono VARCHAR(25) NULL,
  creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS inscripciones (
  inscripcion_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  evento_id INT UNSIGNED NOT NULL,
  participante_id INT UNSIGNED NOT NULL,
  fecha_inscripcion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT uq_evento_participante UNIQUE (evento_id, participante_id),
  CONSTRAINT fk_inscripcion_evento FOREIGN KEY (evento_id) REFERENCES eventos(evento_id) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_inscripcion_participante FOREIGN KEY (participante_id) REFERENCES participantes(participante_id) ON DELETE RESTRICT ON UPDATE CASCADE,
  INDEX ix_inscripciones_participante (participante_id)
) ENGINE=InnoDB;
