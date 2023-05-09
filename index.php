<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  <h1 class="font-weight-bold mb-4 text-center text-uppercase">Mis Tareas</h1>
  <div class="row">
    <div class="col-md-4">

      <!-- Mostrar mensaje -->
      <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show font-weight-bold" role="alert">
          <?= $_SESSION['message'] ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php session_unset();
      } ?>

      <!-- Guardar tarea -->
      <div class="card card-body shadow">
        <span class="mb-3 font-weight-bold text-uppercase text-center">Registrar una nueva tarea</span>
        <form action="save_task.php" method="POST">
          <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Título de la tarea" autofocus>
          </div>
          <div class="form-group">
            <textarea name="description" rows="2" class="form-control" placeholder="Descripción de la tarea" style="min-height: 70px; max-height: 120px;"></textarea>
          </div>
          <input type="submit" name="save_task" class="btn btn-primary btn-block text-uppercase font-weight-bold py-2" value="Guardar tarea">
        </form>
      </div>
    </div>


    <div class="col-md-8">
      <!-- Campo de búsqueda -->
      <div class="input-group col-md-6 mb-3 mx-auto">
        <input type="text" class="form-control" placeholder="Buscar tarea" id="search-input">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button" id="search-button">
            Buscar
          </button>
        </div>
      </div>

      <!-- Listar tareas -->
      <table class="table table-bordered table-dark">
        <thead>
          <tr>
            <th class="font-weight-bold text-center text-uppercase">N°</th>
            <th class="font-weight-bold text-center text-uppercase">Título</th>
            <th class="font-weight-bold text-center text-uppercase">Descripción</th>
            <th class="font-weight-bold text-center text-uppercase">Fecha de Creación</th>
            <th class="font-weight-bold text-center text-uppercase">Opciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM task";
          $result_tasks = mysqli_query($conn, $query);
          $count = 1;

          while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
            <tr>
              <td class="text-center"><?php echo $count++; ?></td>
              <td class="text-center"><?php echo $row['title']; ?></td>
              <td class="text-center"><?php echo $row['description']; ?></td>
              <td class="text-center"><?php echo $row['created_at']; ?></td>
              <td class="text-center">
                <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary">
                  <i class="fas fa-marker"></i>
                </a>
                <a href="delete_task.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">
                  <i class="far fa-trash-alt"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>

<script>
  document.getElementById('search-input').addEventListener('input', function() {
    var searchInput = this.value.toLowerCase();
    var tableRows = document.querySelectorAll('table tbody tr');

    tableRows.forEach(function(row) {
      var title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
      var description = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

      if (title.includes(searchInput) || description.includes(searchInput)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
</script>