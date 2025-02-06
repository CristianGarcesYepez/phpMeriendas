<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
    <div class="d-flex flex-column min-vh-100 justify-content-between">

        <?php include_once 'cabecera.php'; ?>
        
        <div class="container my-8">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">Nuevo Cliente</h4>
                        </div>
                        <div class="card-body">
                            <form action="interfaces/insertarClienteInterface.php" method="POST" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" name="Nombre" class="form-control" required>
                                    <div class="invalid-feedback">
                                        El nombre es obligatorio
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="correo" class="form-label">Correo:</label>
                                    <input type="email" name="Correo" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Ingrese un correo válido
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono:</label>
                                    <input type="tel" name="Telefono" class="form-control" required>
                                    <div class="invalid-feedback">
                                        El teléfono es obligatorio
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Dirección:</label>
                                    <textarea name="Direccion" class="form-control" rows="3" required></textarea>
                                    <div class="invalid-feedback">
                                        La dirección es obligatoria
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Guardar
                                    </button>
                                    <a href="dashboard.php" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Volver
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include_once('pie.php'); ?>
    </div>

    <!-- BOOTSTRAP 5 SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
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