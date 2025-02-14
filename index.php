<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestión</title>
    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .btn-custom {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }
        .btn-custom:hover {
            background-color: #5a6268;
            border-color: #545b62;
            color: white;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column min-vh-100 justify-content-between">
        <div class="container my-8">
            <div class="d-flex justify-content-center align-items-center mt-3">
                <?php
                    if (isset($_SESSION['mensajeLogout'])) {
                        echo '<div id="mensaje-alerta">' . $_SESSION['mensajeLogout'] . '</div>';
                        unset($_SESSION['mensajeLogout']);
                    }
                ?>
            </div>
            <div class="container min-vh-100 d-flex justify-content-center align-items-center">
                <div class="login-container p-5">
                    <h2 class="text-center mb-4">Sistema de Gestión</h2>
                    <form action="interfaces/loginInterface.php" method="POST" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-custom">
                                <i class="fas fa-sign-in"></i> Acceder
                            </button>
                        </div>
                        <div class="d-grid gap-2 mt-3 text-center">
                            <?php
                                if (isset($_SESSION['mensaje'])) {
                                    echo $_SESSION['mensaje'];
                                    unset($_SESSION['mensaje']);
                                }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once 'pie.php'; ?>
    </div>

    <!-- BOOTSTRAP 5 SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Agregar este script antes del cierre del body -->
    <script>
        // Hacer que el mensaje desaparezca después de 3 segundos
        setTimeout(function() {
            const mensaje = document.getElementById('mensaje-alerta');
            if (mensaje) {
                mensaje.style.transition = 'opacity 0.5s';
                mensaje.style.opacity = '0';
                setTimeout(() => mensaje.remove(), 500);
            }
        }, 3000);
    </script>
</body>
</html>