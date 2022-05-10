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
  <div class="preloader flex-column justify-content-center align-items-center" style="background:white;">
  <img class="animation__shake" src="../assets/img/LogoCuerosVélez.jpg" alt="Casme Logo" height="650px" width="1050px">
  </div>
    <!-- Navbar -->
    <?php 
    include("docs/_includes/navbar.php");
    ?>
  <div class="content-wrapper">
    <div class="text-center">
      <h1>CONTRATOS:</h1>
      <?php
    if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
      // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
      <button class="btn-add-mascota" id="ModalEnsayo" data-toggle="modal" data-target="#staticBackdrop">Añadir
        Contrato</button>
    <?php
    }else{
         //SI NO TIENE ROL ADMI NO MUESTRE NADA...
    }
    ?>
    </div>
    <!-- MESSAGES -->
    <?php if (isset($_SESSION['message'])) { ?>
    <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
      <?= $_SESSION['message']?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php session_unset(); } ?>
    <!-- FORMULARIO AÑADIR CONTRATO -->
    <?php  
      include("DB/conexion.php");
      $tmp = array();
$res = array();

$sel = $con->query("SELECT * FROM contrato");
while ($row2 = $sel->fetch_assoc()) {
    $tmp = $row2;
    array_push($res, $tmp);
}
      $sql="SELECT nit,razon_social,comercial,Telefono from proveedor";
      $result=mysqli_query($con,$sql);
    ?>
     <?php
    if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
      // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
    <!-- MODAL FORMULARIO AÑADIR CONTRATO -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Añadir Contrato</h3>
          </div>
          <form action="multipart/form-data" id="formpdf" method="POST">
            
            <div class="form-group">
              <label for="Nro_de_contrato">Número de contrato:</label>
              <input type="text" name="Nro_de_contrato" class="form-control" placeholder="Número de Contrato" autofocus>
            </div>
            <div class="form-group">
              <label for="Proveedor">Proveedor:</label>
              <select name="Proveedor" id="controlBuscador" style="width: 100%">
                <option disabled selected>Seleccione un Proveedor</option>
                <?php while ($ver=mysqli_fetch_row($result)) {?>
                <option value="<?php echo $ver[0] ?>">
                  <?php echo $ver[1] ?> - <?php echo $ver[0] ?>
                </option>
                <?php  }?>
              </select>
            </div>
            <div class="form-group">
              <label for="fecha_de_inicio">Fecha de inicio:</label>
              <input id="fechai" type="date" name="Fecha_de_inicio" class="form-control" placeholder="Fecha de Inicio"
                autofocus>
            </div>
            <div class="form-group">
              <label for="Fecha_fin">Fecha fin:</label>
              <input id="fechaf" type="date" name="Fecha_fin" class="form-control" placeholder="Fecha de Finalización"
                autofocus>
            </div>
            <div class="form-group">
              <label for="description">PDF del contrato:</label>
              <input type="file" class="form-control" id="file" name="file" placeholder="Pdf del contrato (Archivo)">
            </div>
            <div class="modal-footer">
              <input type="button"  class="btn btn-success"  onclick="onSubmitForm()" value="Agregar">
              <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalPdf" tabindex="-1" aria-labelledby="modalPdf" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ver archivo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe id="iframePDF" frameborder="0" scrolling="no" width="100%" height="500px"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
     </div>
     <?php
      }else{
           //SI NO TIENE ROL ADMI NO MUESTRE NADA...
      }
      ?>
    <!-- DATATABLE CONTRATO -->
    <div id="show_contrato" class="datatable-responsive datatable-box">
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
                    url: "Mostra_Contratos.php",
                    type: "POST",
                    success: function (data) {
                      $("#show_contrato").html(data);
                    }
                  });
                }

                loadTasks();

          });
                            function onSubmitForm() {
                                var frm = document.getElementById('formpdf');
                                var data = new FormData(frm);
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function () {
                                    if (this.readyState == 4) {
                                        var msg = xhttp.responseText;
                                        if (msg == 'success') {
                                            alert(msg);
                                            location.reload();
                                         
                                        } else {
                                            alert(msg);
                                            //$('#staticBackdrop').modal('hide');
                                            location.reload();
                                        }

                                    }
                                };
                                xhttp.open("POST", "Añadir_Contrato.php", true);
                                xhttp.send(data);
                                $('#formpdf').trigger('reset');
                               
                                
                            }
                          
       
      </script>
  <script>
    $(document).ready(function () {
      $('#dueño').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        }
      });
    });
  </script>
  <script type="text/javascript">
    function preguntar(Num_Registro_Mascota) {
      if (confirm('¿Está seguro que desea eliminar esta mascota?')) {
        window.location.href = "Delete_Contrato.php?Num_Registro_Mascota=" + Num_Registro_Mascota;
      }
    }
  </script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#controlBuscador').select2({
        dropdownParent: "#staticBackdrop"
      });
    });
  </script>
  <script>
    window.addEventListener('load', function () {
      document.getElementById('fechai').type = 'text';
      document.getElementById('fechai').addEventListener('blur', function () {
        document.getElementById('fechai').type = 'text';
      });
      document.getElementById('fechai').addEventListener('focus', function () {
        document.getElementById('fechai').type = 'date';
      });
    });

    window.addEventListener('load', function () {
      document.getElementById('fechaf').type = 'text';
      document.getElementById('fechaf').addEventListener('blur', function () {
        document.getElementById('fechaf').type = 'text';
      });
      document.getElementById('fechaf').addEventListener('focus', function () {
        document.getElementById('fechaf').type = 'date';
      });
    });
  </script>
    <script type="text/javascript">
      function preguntar(Nro_de_contrato)
      {
        if(confirm('¿Está seguro que desea eliminar este Contrato?'))
        {
          window.location.href = "Delete_Contrato.php?Nro_de_contrato="+Nro_de_contrato;
        }
      }
</script>

</body>