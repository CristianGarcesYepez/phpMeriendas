<?php
    session_start();
    include "models/pedidoModel.php";
    include "bd/clienteModel.php";
    $clientes = mostrarClientes();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pedidos</title>
    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <style>
        .search-filters {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .btn-floating {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            font-size: 24px;
            box-shadow: 0 4px 8px rgba(247, 245, 245, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="menu.php">Sistema de Gestión</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php"><i class="fas fa-home"></i> Menú Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="interfaces/logoutInterface.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
            <?php
                if (isset($_SESSION['mensaje'])) {
                    echo '<div id="mensaje-alerta">' . $_SESSION['mensaje'] . '</div>';
                    unset($_SESSION['mensaje']);
                }
            ?>
            <script>
                        // Hacer que el mensaje desaparezca después de 3 segundos
                setTimeout(function() {
                    const mensaje = document.getElementById('mensaje-alerta');
                    if (mensaje) {
                        mensaje.style.transition = 'opacity 0.5s';
                        mensaje.style.opacity = '0';
                        setTimeout(() => mensaje.remove(), 300);
                    }
                }, 3000);
            </script>
        <h2 class="text-center mb-4">Gestión de Pedidos</h2>

        <!-- Filtros de búsqueda -->
        <div class="search-filters">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="clienteFilter" class="form-label">Buscar por Cliente:</label>
                        <select class="form-select" id="clienteFilter">
                            <option value="">Todos los clientes</option>
                            <?php
                                foreach ($clientes as $cliente): ?>
                                    <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nombre'] . " " . $cliente['etapa'] . " " . $cliente['direccion']; ?></option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="fechaInicio" class="form-label">Fecha Inicio:</label>
                        <input type="date" class="form-control" id="fechaInicio">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="fechaFin" class="form-label">Fecha Fin:</label>
                        <input type="date" class="form-control" id="fechaFin">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary" onclick="filtrarPedidos()">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
        </div>

        <!-- Tabla de Pedidos -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Cliente</th>
                        <th>Cant.Pedido</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaPedidos">
                    <?php
                        include_once "models/pedidoModel.php";
                        $pedidoModel = new PedidoModel();
                        $pedidos = $pedidoModel->obtenerTodos();
                        
                        foreach($pedidos as $row) {
                            echo "<tr>";
                            echo "<td>".$row['nombre']."-".$row['etapa']."-".$row['direccion']."</td>";
                            echo "<td>".$row['cantidad_pedido']."</td>";
                            echo "<td>".date('d/m/Y', strtotime($row['fecha_pedido']))."</td>";
                            echo "<td><span class='badge bg-".($row['estado_pedido'] == 'Pendiente' ? 'warning' : 'success')."'>".$row['estado_pedido']."</span></td>";
                            echo "<td>$".$row['total']."</td>";
                            echo "<td>
                                    <button class='btn btn-sm btn-info' onclick='verPedido(".$row['id_pedido'].")'><i class='fas fa-eye'></i></button>
                                    <button class='btn btn-sm btn-primary' onclick='editarPedido(".$row['id_pedido'].")'><i class='fas fa-edit'></i></button>
                                    <button class='btn btn-sm btn-danger' onclick='eliminarPedido(".$row['id_pedido'].")'><i class='fas fa-trash'></i></button>
                                  </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Botón flotante para nuevo pedido -->
        <a href="views/pedidos/insertarpedido.php" class="btn btn-success btn-floating">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <?php include_once 'pie.php'; ?>

    <!-- BOOTSTRAP 5 SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        function filtrarPedidos() {
            const cliente = document.getElementById('clienteFilter').value;
            const fechaInicio = document.getElementById('fechaInicio').value;
            const fechaFin = document.getElementById('fechaFin').value;

            // Aquí puedes implementar la lógica de filtrado con AJAX
            // Ejemplo básico de la estructura:
            fetch(filtrar(cliente=${cliente}&fechaInicio=${fechaInicio}&fechaFin=${fechaFin}))
                .then(response => response.json())
                .then(data => {
                    // Actualizar la tabla con los resultados
                    actualizarTablaPedidos(data);
                });
        }

        function verPedido(id) {
            window.location.href = `verpedido.php?id=${id}`;
        }

        function editarPedido(id) {
            window.location.href = `views/pedidos/editarPedido.php?id=${id}`;
        }

        function eliminarPedido(id) {
            if(confirm('¿Está seguro de que desea eliminar este pedido?')) {
                window.location.href = `eliminarpedido.php?id=${id}`;
            }
        }
    </script>
</body>
</html> 