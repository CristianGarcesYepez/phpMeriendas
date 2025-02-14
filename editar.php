<?php
  $id = $_GET['id'];
  include_once 'bd/clienteModel.php';
  $cliente = mostrarCliente(id: $id);
  //print_r($cliente); Imprimir el array
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>
  <div class="d-flex flex-column min-vh-100 justify-content-between">
      <?php include_once 'cabecera.php'; ?>     
      <div class="row">
        <div class="col-md-4 mx-auto">
          <div class="card card-body">
            <h2 class="text-center mb-5">Editar Cliente { <?php print_r(value: $id)?> }</h2>
            <form action="interfaces/actualizarClienteInterface.php" method="POST" class="needs-validation" novalidate>
              <div class="mb-3">
                <input name="ID" type="hidden" class="form-control" value="<?php echo $cliente['id']; ?>"required readonly>
                <div class="form-group mb-2">
                  <input name="Nombre" type="text" class="form-control" value="<?php echo $cliente['nombre']; ?>" placeholder="Actualizar Nombre del Cliente" required>
                </div>
                
                <div class="form-group mb-2">
                  <input name="Telefono" type="text" class="form-control" value="<?php echo $cliente['telefono']; ?>" placeholder="Actualizar Telefono" required>
                </div>
                
                <div class="form-group mb-2">
                  <input name="Etapa" type="text" class="form-control" value="<?php echo $cliente['etapa']; ?>" placeholder="Actualizar Etapa" required>
                </div>

                <div class="form-group mb-2">
                  <input name="Direccion" type="text" class="form-control" value="<?php echo $cliente['direccion']; ?>" placeholder="Actualizar Direccion" required>
                </div>

                <div class="alert alert-danger mt-2 d-none" id="errorMessage">
                  Por favor, complete todos los campos requeridos correctamente.
                </div>
              </div>
              <div class="d-grid gap-2">
                <button class="btn btn-success w-100" type="submit" name="update">
                  <i class="fa fa-retweet"></i> Actualizar
                </button>
                <a href="dashboard.php" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Volver
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php include_once 'pie.php';?>
  </div>
 


  <!-- BOOTSTRAP 5 SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
          .forEach(function(form) {
            form.addEventListener('submit', function(event) {
              const errorMessage = document.getElementById('errorMessage');
              
              if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                errorMessage.classList.remove('d-none');
              } else {
                errorMessage.classList.add('d-none');
              }

              form.classList.add('was-validated');
            }, false)
          })
      })();
  </script>
</body>
</html>