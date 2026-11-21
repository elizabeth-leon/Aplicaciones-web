<?php
declare(strict_types=1);

function h(mixed $valor): string {
    return htmlspecialchars((string)$valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function url(string $pagina = 'inicio', array $datos = []): string {
    return 'index.php?' . http_build_query(['page' => $pagina] + $datos);
}
function ir(string $pagina): never {
    header('Location: ' . url($pagina), true, 303);
    exit;
}
function aviso(string $mensaje, string $tipo = 'success'): void {
    $_SESSION['aviso'] = ['mensaje' => $mensaje, 'tipo' => $tipo];
}
function token(): string {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(24));
    return $_SESSION['csrf'];
}
function csrf_field(): string {
    return '<input type="hidden" name="csrf" value="' . h(token()) . '">';
}
function revisarToken(): void {
    if (!is_string($_POST['csrf'] ?? null) || !hash_equals(token(), $_POST['csrf'])) {
        http_response_code(419);
        exit('El formulario caducó. Actualiza la página y vuelve a intentarlo.');
    }
}
function idValido(mixed $dato): int {
    $id = filter_var($dato, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    return $id === false ? 0 : (int)$id;
}
