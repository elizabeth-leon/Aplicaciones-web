CREATE USER IF NOT EXISTS 'cursosia_app'@'localhost'
IDENTIFIED BY 'CursosIA2026!';

ALTER USER 'cursosia_app'@'localhost'
IDENTIFIED BY 'CursosIA2026!';

CREATE DATABASE IF NOT EXISTS GestionCursos;

GRANT ALL PRIVILEGES ON GestionCursos.*
TO 'cursosia_app'@'localhost';


USE GestionCursos;
SHOW TABLES;