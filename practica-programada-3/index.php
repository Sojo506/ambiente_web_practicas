<?php
session_start();

// Inicializar sesión
if (!isset($_SESSION['transacciones'])) {
    $_SESSION['transacciones'] = [];
}

// Registrar transacción
if (isset($_POST['registrar'])) {

    $id = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $monto = (float)$_POST['monto'];

    $_SESSION['transacciones'][] = [
        'id' => $id,
        'descripcion' => $descripcion,
        'monto' => $monto
    ];
}

// Limpiar transacciones
if (isset($_POST['limpiar'])) {
    $_SESSION['transacciones'] = [];
}

// Descargar estado de cuenta
if (isset($_POST['descargar'])) {

    $transacciones = $_SESSION['transacciones'];

    if (empty($transacciones)) {
        echo "No hay transacciones registradas.";
        exit;
    }

    $montoTotal = 0;
    $detalles = "";

    foreach ($transacciones as $t) {

        $montoTotal += $t['monto'];

        $detalles .= "ID: {$t['id']} | ";
        $detalles .= "Descripcion: {$t['descripcion']} | ";
        $detalles .= "Monto: $" . number_format($t['monto'], 2) . "\n";
    }

    $interes = $montoTotal * 0.026;
    $cashback = $montoTotal * 0.001;
    $montoFinal = ($montoTotal + $interes) - $cashback;

    $contenido  = "===== ESTADO DE CUENTA =====\n\n";
    $contenido .= "TRANSACCIONES\n";
    $contenido .= $detalles . "\n";

    $contenido .= "Monto Total: $" . number_format($montoTotal, 2) . "\n";
    $contenido .= "Interes (2.6%): $" . number_format($interes, 2) . "\n";
    $contenido .= "Cashback (0.1%): $" . number_format($cashback, 2) . "\n";
    $contenido .= "Monto Final a Pagar: $" . number_format($montoFinal, 2) . "\n";

    // Crear archivo en directorio temporal
    $filePath = sys_get_temp_dir() . '/estado_cuenta.txt';
    file_put_contents($filePath, $contenido);

    // Forzar descarga
    header("Content-Type: text/plain");
    header("Content-Disposition: attachment; filename=estado_cuenta.txt");
    header("Content-Length: " . filesize($filePath));

    readfile($filePath);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Transacciones</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">

        <h1 class="text-center mb-4">
            Sistema de Transacciones
        </h1>

        <div class="card mb-4">

            <div class="card-header">
                Registrar Transacción
            </div>

            <div class="card-body">

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">ID</label>
                        <input type="text" name="id" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Monto</label>
                        <input type="number" step="0.01" id="monto" name="monto" class="form-control" required>
                    </div>

                    <button type="submit" name="registrar" class="btn btn-primary">
                        Registrar Transacción
                    </button>

                </form>

            </div>
        </div>

        <?php if (!empty($_SESSION['transacciones'])): ?>

            <div class="card mb-4">

                <div class="card-header">
                    Transacciones Registradas
                </div>

                <div class="card-body">

                    <ul class="list-group">

                        <?php foreach ($_SESSION['transacciones'] as $t): ?>

                            <li class="list-group-item">

                                <strong>ID:</strong> <?= htmlspecialchars($t['id']) ?> |
                                <strong>Descripción:</strong> <?= htmlspecialchars($t['descripcion']) ?> |
                                <strong>Monto:</strong> $<?= number_format($t['monto'], 2) ?>

                            </li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            </div>

            <form method="POST">

                <button name="descargar" class="btn btn-success">
                    Descargar Estado de Cuenta (.txt)
                </button>

                <button name="limpiar" class="btn btn-danger">
                    Limpiar Transacciones
                </button>

            </form>

        <?php endif; ?>

    </div>

    <script src="./script.js"> </script>

</body>

</html>