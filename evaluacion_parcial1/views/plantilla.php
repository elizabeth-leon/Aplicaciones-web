<?php
declare(strict_types=1);

// Encabezado y pie compartidos por todas las pantallas.

function render_header(string $page): void
{
    $labels = ['inicio' => 'Inicio', 'eventos' => 'Eventos', 'participantes' => 'Participantes', 'inscripciones' => 'Inscripciones'];
    $active = str_replace('_form', '', $page);
    ?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión Deportiva | <?= h($labels[$active] ?? 'Sistema') ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header class="header"><nav class="nav">
    <a class="brand" href="<?= h(url()) ?>">🏅 Gestión Deportiva</a>
    <div class="navlinks">
        <?php foreach ($labels as $key => $label): ?>
            <a class="<?= $active === $key ? 'active' : '' ?>" href="<?= h(url($key)) ?>"><?= h($label) ?></a>
        <?php endforeach; ?>
    </div>
</nav></header>
<main class="wrap">
<?php if (isset($_SESSION['aviso'])): $notice = $_SESSION['aviso']; unset($_SESSION['aviso']); ?>
<div class="alert <?= $notice['tipo'] === 'error' ? 'error' : '' ?>" role="status"><?= h($notice['mensaje']) ?></div>
<?php endif;
}

function render_footer(): void
{
    ?>
</main><footer class="footer">Sistema de Gestión de Eventos Deportivos · Proyecto académico de Aplicaciones Web · PHP + MySQL + PDO</footer>
<script src="app.js" defer></script>
</body></html>
<?php
}

