<?php
// Solo se permite el ingreso con el inicio de sesion.
session_start();
require_once("ConectarBD_Mysql.php");

// --- VALIDACIÓN SESSION-----
include("Session.php");

if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
  // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE...

 //  ----HEAD HTML---------
include("docs/_includes/head.html");
?>
 
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Preloader --><?php
    include("docs/_includes/preloader.html");
    ?>
 <!-- Navbar -->
 <?php 
    include("docs/_includes/navbar.php");
  ?>
<div class="content-wrapper">
<?php

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS QUE SE ENVIAN COMO PARAMETRO */
$Nro_de_contrato = $_REQUEST['Nro_de_contrato'];

 /* AQUI REALIZAMOS UNA CONSULTA EN LA TABLA BODEGA QUE DEACUERDO AL ID DE LA BODEGA SELECCIONADA 
    PARA AUTOCOMPLEMENTAR LOS DATOS DEL FORMULARIO QUE ESTA DENTRO DEL MODAL staticBackdropLabel
      */
$query="SELECT * FROM contrato WHERE Nro_de_contrato='$Nro_de_contrato'";
$resultado= $con->query($query);
$row2=$resultado->fetch_assoc();

if(isset($_POST['update'])){

   /* AQUI SE RECIBEN LOS DATOS DEL FORMULARIO */

  $Nro_de_contrato2 = $_POST['Nro_de_contrato'];
  $proveedor = $_POST['Proveedor'];
  $Fecha_de_inicio = $_POST['Fecha_de_inicio'];
  $Fecha_fin = $_POST['Fecha_fin'];

 
  /* AQUI REALIZAMOS EL UPDATE DEL REGISTRO QUE SE SELECCIONÓ */
  $query="UPDATE contrato SET Nro_de_contrato='$Nro_de_contrato2', Proveedor='$proveedor', Fecha_de_inicio='$Fecha_de_inicio', Fecha_fin='$Fecha_fin' WHERE Nro_de_contrato='$Nro_de_contrato'";
  $ResultadoEditContrato = $con->query($query);

  if($ResultadoEditContrato){
  echo "<script>alert('Los datos del contrato se han actualizado correctamente');window.location='Vista_Contrato.php?Nro_de_contrato=$Nro_de_contrato'</script>";
  }else{
    echo "<script>alert('los datos no se han podido actualizar correctamente');</script>";
  }

}
?>
<?php 
//CONSULTA TABLA (PROVEEDOR):
$sql="SELECT * from proveedor";
$result=mysqli_query($con,$sql);
?>
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

 <div class="container p-4">
   <div class="row">
     <div class="col-md-5 mx-auto">
       <div class="card card-body" style="background-color: #55565a; color: #fff ">
        <!-- AQUI ESTA EL MODAL QUE CONTIENE EL FORMULARIO QUE REALIZA LA ACCIÓN DE LA PÁGINA -->
        <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Editando a Contrato: "<?php echo $row2['Nro_de_contrato']; ?>"</h3>   
        <hr style="background-color: #fff; ">
        <form action="multipart/form-data" id="formpdf" method="POST">
            <div class="form-group" style="display:none;">
              <input type="text" name="First_Nro_de_contrato" class="form-control" value="<?php echo $row2['Nro_de_contrato']; ?>" placeholder="Actualizar Número de contrato">
            </div>
            <div class="form-group" style="display:none;">
              <input type="text" name="ruta_pdf" class="form-control" value="<?php echo $row2['ruta_pdf']; ?>" placeholder="Actualizar Número de contrato">
            </div>
            <div class="form-group">
              <label for="Nro_de_contrato">Número de contrato:</label>
              <input type="text" name="Nro_de_contrato" class="form-control" value="<?php echo $row2['Nro_de_contrato']; ?>" placeholder="Actualizar Número de contrato">
            </div>
            <div class="form-group">
              <label for="Proveedor">Proveedor:</label>
              <select name="Proveedor" id="controlBuscador" style="width: 100%">
                <option value="<?php echo $row2['Proveedor']; ?>"><?php echo $row2['Proveedor']; ?>(ACTUAL)</option>
                <?php while ($ver=mysqli_fetch_row($result)) {?>
                <option value="<?php echo $ver[0] ?>">
                  <?php echo $ver[1] ?> - <?php echo $ver[0] ?>
                </option>
                <?php  }?>
              </select>
            </div>
            <div class="form-group">
              <label for="Fecha_de_inicio">Fecha de inicio: <?php echo $row2['Fecha_de_inicio']; ?>(ACTUAL)</label>
              <input id="fechai" type="date" name="Fecha_de_inicio" value="<?php echo $row2['Fecha_de_inicio']; ?>" class="form-control" placeholder="Fecha de Inicio"
                autofocus>
            </div>
            <div class="form-group">
              <label for="Fecha_fin">Fecha de finalización: <?php echo $row2['Fecha_fin']; ?>(ACTUAL)</label>
              <input id="fechaf" type="date" name="Fecha_fin" value="<?php echo $row2['Fecha_fin']; ?>" class="form-control" placeholder="Fecha de Finalización"
                autofocus>
            </div>
            <hr style="background-color: #fff; ">
            <div class="container_2">
            <div class="form-group col-md-4">
               <label for="actual_pdf">Pdf Actual:</label>
            <button onclick="openModelPDF('<?php echo $row2['ruta_pdf'] ?>')" class="btn btn-dark" type="button"><i class="icofont-file-pdf"></i></button>
              </div>
              <hr style="background-color: #fff; ">
            <div class="form-group col-md-12">
              <label for="description">Si desea cambiar el pdf seleccione el nuevo:</label>
              <input type="file" class="form-control" id="file" name="file" placeholder="Pdf del contrato (Archivo)">
            </div> 
            </div>
             <hr style="background-color: #fff; ">
            <h4 style=" text-align: center;">¡Revisa la información antes de realizar algún cambio!</h4>
            <div class="botones">
            <input type="button"  class="btn btn-success"  onclick="onSubmitForm()" value="Agregar">
              <a href="javascript: history.go(-1)" role="button" class="btn btn-danger">Cancelar</a>
            </div>             
        </form>
       </div>
     </div>
   </div>
 </div>
</div>

<!-- PIE DE PÁGINA -->
<?php 
    include("docs/_includes/footer.php");
?>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#controlBuscador').select2();
    });
  </script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
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
                                var frm1 = new FormData(frm);
                                var data = frm1;
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
                                            window.history.go(-1);
                                        }

                                    }
                                };
                                xhttp.open("POST", "Aplicar_edit_contrato.php", true);
                                xhttp.send(data);
                                $('#formpdf').trigger('reset');
                               
                                
                            }
                            function openModelPDF(url) {
                                $('#modalPdf').modal('show');
                                $('#iframePDF').attr('src','<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/inventario_tecnolog-a_velez/admin/'; ?>'+url);
                            }
        </script>
    
</body>
<?php
}else{
 echo "<script>alert('¡NO TIENES PERMISO PARA INGRESAR A ESTE MÓDULO');window.location='Inicio.php'</script>";
}
?>