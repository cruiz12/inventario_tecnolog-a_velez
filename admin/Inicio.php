<?php
// Solo se permite el ingreso con el inicio de sesion.
session_start();
require_once("ConectarBD_Mysql.php");

// --- VALIDACIÓN SESSION-----
include("Session.php");

 //  ----HEAD HTML---------
include("docs/_includes/head.html");

?>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Preloader -->
    <?php
    include("docs/_includes/preloader.html");
    ?>
    <!-- Navbar -->
   <?php 
    include("docs/_includes/navbar.php");
    ?>
  <!-- MODAL PARA CERRAR SESIÓN -->
  <div class="modal fade" id="exitModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">¿Desea salir?</h3>
        </div>
        <div class="modal-body">Presione "Cerrar Sesión" si desea salir.</div>
        <div class="modal-footer">
          <button class="btn btn-raised btn-secondary" type="button" data-dismiss="modal">Cancelar</button>&nbsp;
          <a class="btn btn-raised btn-danger" href="logout.php">Cerrar Sesión</a>
        </div>
      </div>
    </div>
  </div>
  <div class="content-wrapper">
    <div class="content-header admin-panel">
      <div class="text-center">
        <h1>INVENTARIO TECNOLOGICO VÉLEZ</h1>
      </div>
    </div>
    <div class="row row-admin">
      <div class="col-lg-3 col-6">
        <!-- small box RESPONSABLES-->
        <div class="small-box" style="background-color:#55565A">
          <div class="inner">
            <h4 style="color:white">Responsables</h4>
            <br>
            <br>
          </div>
          <div class="icon">
            <i class="fas fa-users"></i>
          </div>
          <a href="Responsables.php" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box PROVEEDORES-->
        <div class="small-box" style="background:#86D0CC">
          <div class="inner">
            <h4 style="color:white">Proveedores<sup style="font-size: 20px"></sup></h4>
            <br>
            <br>
          </div>
          <div class="icon">
            <i class="fas fa-people-arrows"></i>
          </div>
          <a href="Proveedor.php" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box DISPOSITIVOS-->
        <div class="small-box" style="background:#55565A">
          <div class="inner">
            <h4 style="color:white">Dispositivos</h4>
            <br>
            <br>
          </div>
          <div class="icon">
            <i class="fas fa-laptop"></i>
          </div>

          <a href="Dispositivos.php" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>

        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box CONFIGURACIÓN-->
        <div class="small-box" style="background:#86D0CC">
          <div class="inner">
            <h4 style="color:white">Configuración</h4>
            <br>
            <br>
          </div>
          <div class="icon">
            <i class="fas fa-cog"></i>
          </div>
          <a href="#" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="row row-admin">
      <div class="col-lg-3 col-6">
        <!-- small box CONTRATOS-->
        <div class="small-box" style="background-color:#86D0CC">
          <div class="inner">
            <h4 style="color:white">Contratos</h4>
            <br>
            <br>
          </div>
          <div class="icon">
            <i class="fas fa-paperclip"></i>
          </div>
          <a href="Contratos.php" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box BODEGAS-->
        <div class="small-box" style="background-color:#55565A">
          <div class="inner">
            <h4 style="color:white">Bodegas<sup style="font-size: 20px"></sup></h4>
            <br>
            <br>
          </div>
          <div class="icon">
            <i class="fas fa-warehouse"></i>
          </div>

          <a href="bodega.php" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>

        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box ORDEN_COMPRA-->
        <div class="small-box" style="background:#86D0CC">
          <div class="inner">
            <h4 style="color:white">Orden <br> de Compra<sup style="font-size: 20px"></sup></h4>
            <br>
          </div>
          <div class="icon">
            <i class="fas fa-shopping-bag"></i>
          </div>

          <a href="Orden_Compra.php" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>

        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box MANUAL USUARIO-->
        <div class="small-box" style="background-color:#55565A">
          <div class="inner">
            <h4 style="color:white">Manual<sup style="font-size: 20px"></sup></h4>
            <br>
            <br>
          </div>
          <div class="icon">
            <i class="fas fa-passport"></i>
          </div>

          <a href="Manual.php" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>

        </div>
      </div>
    </div>
    <!-- CONTENEDOR LISTA DE PENDIENTES -->
    <div class="wrapper2" style="background:#55565a">
      <h2 class="title" style="color:white">Lista de pendientes</h2>
      <div class="inputFields">
        <input type="text" id="taskValue" placeholder="Ingrese un pendiente">
        <button type="submit" id="addBtn" class="btn"><i class="fa fa-plus"></i></button>
      </div>
      <div class="content" style="color:white">
        <ul id="tasks"></ul>
      </div>
    </div>
  </div>
  <!-- PIE DE PÁGINA -->
<?php 
    include("docs/_includes/footer.php");
?>
  <script>
    $(document).ready(function () {
      // Show Tasks
      function loadTasks() {
        $.ajax({
          url: "show-tasks.php",
          type: "POST",
          success: function (data) {
            $("#tasks").html(data);
          }
        });
      }

      loadTasks();

      // Add Task
      $("#addBtn").on("click", function (e) {
        e.preventDefault();

        var task = $("#taskValue").val();

        $.ajax({
          url: "add-task.php",
          type: "POST",
          data: {
            task: task
          },
          success: function (data) {
            loadTasks();
            $("#taskValue").val('');
            if (data == 0) {
              alert("Algo salió mal. Inténtalo nuevamente");
            }
          }
        });
      });

      // Remove Task
      $(document).on("click", "#removeBtn", function (e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
          url: "remove-task.php",
          type: "POST",
          data: {
            id: id
          },
          success: function (data) {
            loadTasks();
            if (data == 0) {
              alert("Algo salió mal. Inténtalo nuevamente");
            }
          }
        });
      });
    });
  </script>

</body>

</html>