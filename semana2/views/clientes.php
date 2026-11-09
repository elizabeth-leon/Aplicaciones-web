<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <title>Gestión de clientes | PHP + POO</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="layout">
    <header class="header">
        <div>
            <p class="overline">APLICACIONES WEB · PROGRAMACIÓN ORIENTADA A OBJETOS</p>
            <h1>Gestión de clientes</h1>
            <p class="intro">Registro y administración de clientes mediante PHP, POO y PDO.</p>
        </div>
        <div class="header-mark" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="4" />
                <path d="M4 21v-2a8 8 0 0 1 16 0v2" />
            </svg>
        </div>
    </header>

    <?php if ($mensaje): ?>
        <div class="notice success" role="status"><?= e($mensaje) ?></div>
    <?php endif; ?>
    <?php if (isset($errores['general'])): ?>
        <div class="notice error" role="alert"><?= e($errores['general']) ?></div>
    <?php endif; ?>

    <main class="columns">
        <section class="panel form-panel">
            <div class="panel-top">
                <span class="eyebrow"><?= $editando ? 'ACTUALIZAR' : 'NUEVO REGISTRO' ?></span>
                <h2><?= $editando ? 'Editar cliente' : 'Registrar cliente' ?></h2>
                <p>Completa los campos para <?= $editando ? 'guardar los cambios.' : 'agregar un nuevo registro.' ?></p>
            </div>
            <form action="index.php" method="post">
                <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
                <input type="hidden" name="accion" value="<?= $editando ? 'actualizar' : 'crear' ?>">
                <?php if ($editando): ?>
                    <input type="hidden" name="id" value="<?= (int) $clienteFormulario->id ?>">
                <?php endif; ?>
                <div class="two-fields">
                    <label>Nombre <span>*</span>
                        <input name="nombre" maxlength="80" required placeholder="Ej.: María" value="<?= e($clienteFormulario?->nombre ?? '') ?>">
                        <?php if (isset($errores['nombre'])): ?><small class="field-error"><?= e($errores['nombre']) ?></small><?php endif; ?>
                    </label>
                    <label>Apellido <span>*</span>
                        <input name="apellido" maxlength="80" required placeholder="Ej.: Pérez" value="<?= e($clienteFormulario?->apellido ?? '') ?>">
                        <?php if (isset($errores['apellido'])): ?><small class="field-error"><?= e($errores['apellido']) ?></small><?php endif; ?>
                    </label>
                </div>
                <label>Correo electrónico <span>*</span>
                    <input type="email" name="correo" maxlength="120" required placeholder="nombre@correo.com" value="<?= e($clienteFormulario?->correo ?? '') ?>">
                    <?php if (isset($errores['correo'])): ?><small class="field-error"><?= e($errores['correo']) ?></small><?php endif; ?>
                </label>
                <label>Teléfono
                    <input type="tel" name="telefono" maxlength="20" placeholder="0991234567" value="<?= e($clienteFormulario?->telefono ?? '') ?>">
                    <?php if (isset($errores['telefono'])): ?><small class="field-error"><?= e($errores['telefono']) ?></small><?php endif; ?>
                </label>
                <label class="switch-label">
                    <input type="checkbox" name="activo" value="1" <?= ($clienteFormulario?->activo ?? true) ? 'checked' : '' ?>>
                    Cliente activo
                </label>
                <div class="form-actions">
                    <button type="submit" class="primary"><?= $editando ? 'Guardar cambios' : 'Registrar cliente' ?></button>
                    <?php if ($editando): ?><a class="secondary" href="index.php">Cancelar</a><?php endif; ?>
                </div>
            </form>
        </section>

        <section class="panel table-panel">
            <div class="panel-top table-header">
                <div>
                    <span class="eyebrow">CLIENTES REGISTRADOS</span>
                    <h2>Listado de clientes</h2>
                </div>
                <span class="count"><?= count($clientes) ?> registros</span>
            </div>
            <div class="table-scroll">
                <table>
                    <thead><tr><th>Cliente</th><th>Contacto</th><th>Estado</th><th>Acciones</th></tr></thead>
                    <tbody>
                    <?php if (!$clientes): ?>
                        <tr><td colspan="4" class="empty">Aún no existen clientes registrados.</td></tr>
                    <?php endif; ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><span class="client-name"><?= e($cliente->nombre . ' ' . $cliente->apellido) ?></span><span class="muted">ID #<?= $cliente->id ?></span></td>
                            <td><span><?= e($cliente->correo) ?></span><span class="muted"><?= e($cliente->telefono ?: 'Sin teléfono') ?></span></td>
                            <td><span class="status <?= $cliente->activo ? 'active' : 'inactive' ?>"><?= $cliente->activo ? 'Activo' : 'Inactivo' ?></span></td>
                            <td>
                                <div class="row-actions">
                                    <a href="index.php?editar=<?= $cliente->id ?>" class="edit">Editar</a>
                                    <form method="post" action="index.php" onsubmit="return confirm('¿Eliminar este cliente? Esta acción no se puede deshacer.');">
                                        <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
                                        <input type="hidden" name="accion" value="eliminar">
                                        <input type="hidden" name="id" value="<?= $cliente->id ?>">
                                        <button type="submit" class="delete">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <footer>Ejercicio académico de CRUD · PHP 8 · PDO · MySQL/MariaDB</footer>
</div>
</body>
</html>
