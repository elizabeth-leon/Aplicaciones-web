-- Ejecutar en Workbench 
CREATE DATABASE IF NOT EXISTS GestionCursos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'cursosia_app'@'localhost' IDENTIFIED BY 'CAMBIAR_ESTA_CLAVE';
GRANT ALL PRIVILEGES ON GestionCursos.* TO 'cursosia_app'@'localhost';

