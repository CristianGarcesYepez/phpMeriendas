<?php
    session_start();
    include_once 'bd/clienteModel.php';
    $clientes = mostrarClientes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
    <div class="d-flex flex-column min-vh-100 justify-content-between">
        <?php include 'cabecera.php'; ?>
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
        
        <div class="container my-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Lista de Clientes</h4>
                            <a href="insertar.php" class="btn btn-primary">
                                <i class="fa fa-plus-circle"></i> Nuevo Cliente
                            </a>
                        </div>
                        <div class="card-body table-responsive-sm mb-3">
                            <table class="table table-bordered table-hover" id="datosClientes" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Teléfono</th>
                                        <th>Etapa</th>
                                        <th>Dirección</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($clientes as $cliente): ?>
                                        <tr>
                                            <td><?php echo $cliente['id']; ?></td>
                                            <td><?php echo $cliente['nombre']; ?></td>
                                            <td><?php echo $cliente['telefono']; ?></td>
                                            <td><?php echo $cliente['etapa']; ?></td>
                                            <td><?php echo $cliente['direccion']; ?></td>
                                            <td>
                                                <a href="editar.php?id=<?php echo $cliente['id']; ?>" class="btn btn-warning">
                                                    <i class="fas fa-marker"></i>
                                                </a>
                                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-cliente-id="<?php echo $cliente['id']; ?>" data-cliente-nombre="<?php echo $cliente['nombre']; ?>">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <a href="menu.php" class="btn btn-danger btn-lg">
                    <i class="fa fa-arrow-circle-left"></i> Salir
                </a>
            </div>

        </div>
        <?php include_once 'pie.php'; ?>


    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro que desea eliminar el cliente "<span id="modal-cliente-nombre"></span>"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" action="interfaces/eliminarClienteInterface.php" method="POST">
                        <input type="hidden" name="id" id="modal-cliente-id">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP 5 SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget;
      var clienteId = button.getAttribute('data-cliente-id');
      var clienteNombre = button.getAttribute('data-cliente-nombre');

      var modalClienteNombre = deleteModal.querySelector('#modal-cliente-nombre');
      var modalClienteId = deleteModal.querySelector('#modal-cliente-id');


      modalClienteNombre.textContent = clienteNombre;
      modalClienteId.value = clienteId;

    });

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
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
    })();
  </script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
  <script>
    $(document).ready(function() {
      $('#datosClientes').DataTable();
    });
  </script>
</body>
</html>