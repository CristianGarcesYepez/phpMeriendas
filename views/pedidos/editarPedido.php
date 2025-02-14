<?php
    session_start();
    include "../../models/pedidoModel.php";
    include "../../bd/clienteModel.php";

    if (!isset($_GET['id'])) {
        header('Location: ../../dashboardpedidos.php');
        exit();
    }

    $pedidoModel = new PedidoModel();
    $pedido = $pedidoModel->obtenerPorId($_GET['id']);
    $clientes = mostrarClientes();  // Usando la función existente
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="../../menu.php">Sistema de Gestión</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../../dashboardpedidos.php"><i class="fas fa-arrow-left"></i> Volver</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Editar Pedido</h5>
                    </div>
                    <div class="card-body">
                        <form action="../../interfaces/pedido/actualizarPedidoInterface.php" method="POST" class="needs-validation" novalidate>
                            <input type="hidden" name="id_pedido" value="<?php echo $pedido['id_pedido']; ?>">
                            
                            <div class="mb-3">
                                <label for="cliente" class="form-label">Cliente:</label>
                                <select class="form-select" name="id_cliente" required>
                                    <option value="">Seleccione un cliente</option>
                                    <?php foreach($clientes as $cliente): ?>
                                        <option value="<?php echo $cliente['id']; ?>" 
                                            <?php echo ($cliente['id'] == $pedido['id_cliente']) ? 'selected' : ''; ?>>
                                            <?php echo $cliente['nombre'] . " - " . $cliente['etapa'] . " - " . $cliente['direccion']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor seleccione un cliente
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="fecha_pedido" class="form-label">Fecha:</label>
                                <input type="date" class="form-control" name="fecha_pedido" 
                                    value="<?php echo date('Y-m-d', strtotime($pedido['fecha_pedido'])); ?>" required>
                                <div class="invalid-feedback">
                                    La fecha es obligatoria
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="cantidad_pedido" class="form-label">Cantidad:</label>
                                <input type="number" class="form-control" name="cantidad_pedido" 
                                    value="<?php echo $pedido['cantidad_pedido']; ?>" required min="1">
                                <div class="invalid-feedback">
                                    Ingrese una cantidad válida
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="total" class="form-label">Total:</label>
                                <input type="number" step="0.01" min="0" class="form-control" name="total" 
                                    value="<?php echo $pedido['total']; ?>" required min="1">
                                <div class="invalid-feedback">
                                    Ingrese un total válido
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="estado_pedido" class="form-label">Estado:</label>
                                <select class="form-select" name="estado_pedido" required>
                                    <option value="Pendiente" <?php echo ($pedido['estado_pedido'] == 'Pendiente') ? 'selected' : ''; ?>>
                                        Pendiente
                                    </option>
                                    <option value="Completado" <?php echo ($pedido['estado_pedido'] == 'Completado') ? 'selected' : ''; ?>>
                                        Completado
                                    </option>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione un estado
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Guardar Cambios
                                </button>
                                <a href="../../dashboardpedidos.php" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validación de Bootstrap
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html> 