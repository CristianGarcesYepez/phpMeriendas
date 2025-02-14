<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - Gestión de Clientes</title>
    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .menu-container {
            max-width: 800px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .btn-menu {
            padding: 20px;
            margin: 10px;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }
        .btn-menu:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Sistema de Gestión</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="interfaces/logoutInterface.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="d-grid gap-2 mt-3 text-center">
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
        </div>
        <div class="container flex-grow-1 d-flex align-items-center justify-content-center">
            <div class="menu-container p-5">
                <h2 class="text-center mb-4">Menú Principal</h2>
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <a href="dashboard.php" class="btn btn-primary btn-menu w-100">
                            <i class="fas fa-users mb-2"></i><br>
                            Gestión de Clientes
                        </a>
                    </div>
                    <div class="col-md-6 text-center">
                        <a href="dashboardpedidos.php" class="btn btn-success btn-menu w-100">
                            <i class="fas fa-shopping-cart mb-2"></i><br>
                            Gestión de Pedidos
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once 'pie.php'; ?>
    </div>

    <!-- BOOTSTRAP 5 SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html> 