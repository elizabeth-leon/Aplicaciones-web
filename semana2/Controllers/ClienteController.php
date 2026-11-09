<?php
declare(strict_types=1);

final class ClienteController
{
    public function __construct(private ClienteRepositorio $repositorio) {}

    /** @return array<string, string> */
    private function validar(Cliente $cliente): array
    {
        $errores = [];
        if ($cliente->nombre === '' || mb_strlen($cliente->nombre) > 80) {
            $errores['nombre'] = 'Ingresa un nombre de hasta 80 caracteres.';
        }
        if ($cliente->apellido === '' || mb_strlen($cliente->apellido) > 80) {
            $errores['apellido'] = 'Ingresa un apellido de hasta 80 caracteres.';
        }
        if (!filter_var($cliente->correo, FILTER_VALIDATE_EMAIL) || mb_strlen($cliente->correo) > 120) {
            $errores['correo'] = 'Ingresa un correo electrónico válido.';
        }
        if ($cliente->telefono !== '' && !preg_match('/^[0-9+() .-]{7,20}$/', $cliente->telefono)) {
            $errores['telefono'] = 'Ingresa un teléfono válido (7 a 20 caracteres).';
        }
        return $errores;
    }

    public function ejecutar(): array
    {
        $errores = [];
        $edicion = null;
        $datosFormulario = null;
        $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        if ($metodo === 'POST') {
            if (!hash_equals($_SESSION['csrf'], (string) ($_POST['csrf'] ?? ''))) {
                http_response_code(403);
                exit('Solicitud no autorizada (CSRF).');
            }
            $accion = (string) ($_POST['accion'] ?? '');
            $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

            if ($accion === 'eliminar') {
                if ($id === false || $id === null || $this->repositorio->consultar($id) === null) {
                    $errores['general'] = 'El cliente solicitado no existe.';
                } else {
                    $this->repositorio->eliminar($id);
                    $this->redirigir('Cliente eliminado correctamente.');
                }
            } elseif (in_array($accion, ['crear', 'actualizar'], true)) {
                $cliente = new Cliente(
                    $accion === 'actualizar' && is_int($id) ? $id : null,
                    trim((string) ($_POST['nombre'] ?? '')),
                    trim((string) ($_POST['apellido'] ?? '')),
                    trim((string) ($_POST['correo'] ?? '')),
                    trim((string) ($_POST['telefono'] ?? '')),
                    isset($_POST['activo'])
                );
                $datosFormulario = $cliente;
                $errores = $this->validar($cliente);

                if ($accion === 'actualizar' && ($cliente->id === null || $this->repositorio->consultar($cliente->id) === null)) {
                    $errores['general'] = 'El cliente que intentas editar no existe.';
                }
                if (!$errores) {
                    try {
                        if ($accion === 'crear') {
                            $this->repositorio->registrar($cliente);
                            $this->redirigir('Cliente registrado correctamente.');
                        }
                        $this->repositorio->actualizar($cliente);
                        $this->redirigir('Cliente actualizado correctamente.');
                    } catch (PDOException $e) {
                        if ($e->getCode() === '23000') {
                            $errores['correo'] = 'Este correo ya está registrado.';
                        } else {
                            throw $e;
                        }
                    }
                }
            } else {
                $errores['general'] = 'Operación no reconocida.';
            }
        } elseif (isset($_GET['editar'])) {
            $id = filter_var($_GET['editar'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            if ($id === false || $id === null) {
                $errores['general'] = 'Identificador de cliente no válido.';
            } else {
                $edicion = $this->repositorio->consultar($id);
                if ($edicion === null) {
                    $errores['general'] = 'El cliente solicitado no existe.';
                }
            }
        }

        return [
            'clientes' => $this->repositorio->listar(),
            'clienteFormulario' => $datosFormulario ?? $edicion,
            'errores' => $errores,
        ];
    }

    private function redirigir(string $mensaje): never
    {
        $_SESSION['mensaje'] = $mensaje;
        header('Location: index.php', true, 303);
        exit;
    }
}
