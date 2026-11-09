-- Base de datos para el ejercicio de POO y CRUD de clientes.
-- Ejecutar en phpMyAdmin o en MySQL/MariaDB antes de abrir la web.
CREATE DATABASE IF NOT EXISTS crud_clientes_poo
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE crud_clientes_poo;

CREATE TABLE IF NOT EXISTS clientes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(80) NOT NULL,
    apellido VARCHAR(80) NOT NULL,
    correo VARCHAR(120) NOT NULL UNIQUE,
    telefono VARCHAR(20) NOT NULL DEFAULT '',
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
