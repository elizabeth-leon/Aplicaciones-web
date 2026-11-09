# Semana 2 — CRUD de clientes con PHP, POO y PDO

Versión reorganizada a partir de tu proyecto funcional. Se conserva el esquema de MySQL, el diseño, los formularios y los métodos CRUD. El monograma «C» se reemplazó por un ícono SVG de usuario (sin dependencias externas).

## Carpetas

```text
semana2/
├── Controllers/
│   └── ClienteController.php       # Controlador HTTP, formularios y validación
├── Models/
│   ├── Cliente.php                 # Clase Cliente (POO)
│   └── ClienteRepositorio.php      # CRUD con PDO y consultas preparadas
├── views/
│   └── clientes.php                # Vista HTML/PHP
├── test/
│   └── run.php                     # Pruebas de clase y CRUD (SQLite opcional)
├── src/
│   └── Database.php               # Conexión PDO a MySQL
├── config/
│   └── database.php                # Host, puerto y credenciales locales
├── public/
│   ├── index.php                   # Punto de entrada web
│   └── styles.css                  # Estilos
└── database.sql                    # Esquema original
```

## Cómo instalar en MAMP (Windows)

1. Haz una copia de seguridad de `C:\MAMP\htdocs\aplicaciones_web\semana2` por si quieres recuperar la versión anterior.
2. Reemplaza **los archivos del proyecto** por los de esta carpeta, manteniendo la misma ruta `C:\MAMP\htdocs\aplicaciones_web\semana2`.
3. No vuelvas a importar `database.sql`: la base `crud_clientes_poo` y sus clientes ya existentes se conservan.
4. Verifica `config/database.php`: host `127.0.0.1`, puerto `8889`, base `crud_clientes_poo`, usuario `root` y contraseña según tu MAMP.
5. Inicia Apache y MySQL en MAMP, y visita:

   `http://localhost:8888/aplicaciones_web/semana2/public/index.php`

6. Prueba Registrar, Listar, Editar y Eliminar.

## Pruebas

En la terminal, desde la carpeta `semana2`:

```bash
php test/run.php
```

La prueba valida la clase `Cliente`; si está disponible `pdo_sqlite`, también prueba las cuatro operaciones CRUD en una BD temporal en memoria, sin tocar MySQL. La aplicación web sigue utilizando MySQL con PDO.

## Cambios principales

- `src/Cliente.php` → `Models/Cliente.php`
- `src/ClienteRepositorio.php` → `Models/ClienteRepositorio.php`
- `src/ClienteControlador.php` → `Controllers/ClienteController.php` (también se renombra la clase a `ClienteController`)
- `views/clientes.php`: ícono SVG de usuario en lugar de «C».
- `public/index.php`: rutas `require_once` actualizadas.
- `test/run.php`: pruebas locales nuevas.
- Se retiró `public/test_conexion.php`, archivo temporal de diagnóstico, para evitar exponer errores de conexión en el sitio.

## POO y CRUD

| Acción | Método | SQL |
|---|---|---|
| Crear | `registrar(Cliente $cliente)` | `INSERT` |
| Consultar | `consultar(int $id)` / `listar()` | `SELECT` |
| Actualizar | `actualizar(Cliente $cliente)` | `UPDATE` |
| Eliminar | `eliminar(int $id)` | `DELETE` |

Uso académico local. Antes de ponerlo en producción se necesita autenticación, autorización y una gestión segura de credenciales.
