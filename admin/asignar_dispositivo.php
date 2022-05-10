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
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="../assets/img/LogoCuerosVélez.jpg" alt="Casme Logo" height="650px" width="1050px">
  </div>
  <!-- Navbar -->
  <?php 
    include("docs/_includes/navbar.php");
  ?>
<div class="content-wrapper">
<?php

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS */
$codigo_serial = $_REQUEST['codigo_serial'];

$query="SELECT * FROM dispositivos WHERE codigo_serial='$codigo_serial'";
$resultado= $con->query($query);
$row2=$resultado->fetch_assoc();

if(isset($_POST['asignar'])&& !empty($_POST['responsable'])){

  /* AQUI SE RECIBEN LOS DATOS DEL FORMULARIO */
 
  $responsable = $_POST['responsable'];

  /* AQUI SE TOMA LA FECHA ACTUAL*/
  $fecha = getdate();
  $fecha_actual= $fecha['year'].-$fecha['mon'].-$fecha['mday'];

 
  /* AQUI REALIZAMOS EL UPDATE DEL REGISTRO QUE SE SELECCIONÓ */
  $query="UPDATE dispositivos SET bodega_disp_id = NULL, responsable = $responsable WHERE codigo_serial = $codigo_serial";
  $ResultadoEditDispo = $con->query($query);
  /* INSER INTO (FECHA_TOMA) DE DISPOSITIVO TABLA (HISTORIAL_DISPOSITIVO)*/
  $query2="INSERT INTO historial_dispositivo SET codigo_serial_h = '$codigo_serial', responsable_h = '$responsable', fecha_toma = '$fecha_actual', fecha_entrega = NULL, responsable_entrega = '$NombreSesion_User'";

  $ResultadoHistorial = $con->query($query2);
  
  if($ResultadoEditDispo && $ResultadoHistorial){
    echo "<script>alert('Los datos del DISPOSITIVO se han actualizado correctamente');window.location='Vista_Dispositivo.php?codigo_serial=$codigo_serial'</script>";
  }else{
    echo "<script>alert('los datos no se han podido actualizar correctamente');</script>";
  }

}
?>
<!-- CONSULTA RESPONSABLES DISPOSITIVOS(EMPLEADOS CV)-->
<?php  
      $sql="SELECT * from responsables_dispositivos";
      $result=mysqli_query($con,$sql);
    ?>
 <div class="container p-4">
   <div class="row">
     <div class="col-md-5 mx-auto">
       <div class="card card-body" style="background-color: #55565a; color: #fff">
        <!-- AQUI ESTA EL MODAL QUE CONTIENE EL FORMULARIO QUE REALIZA LA ACCIÓN DE LA PÁGINA -->
        <!--FORMULARIO ASIGNAR DISPOSITIVO-->
        <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Asignando "<?php echo $codigo_serial ?>" a Responsable:</h3>   
        <hr style="background-color: #fff; ">
        <form action="#" method="POST">
        <div class="form-group">
              <select name="responsable" id="controlBuscador" style="width: 100%">
                <option disabled selected>Seleccione Responsable:</option>
                  <?php while ($ver=mysqli_fetch_row($result)) {?>
                    <option value="<?php echo $ver[0] ?>">
                      <?php echo "$ver[0]-$ver[1]" ?>
                    </option>
                  <?php  }?>
              </select>
            </div>
            <div class="botones2">
              <button name="asignar" class="btn btn-success">Asignar Responsable</button>
              <a href="javascript: history.go(-1)" role="button" class="btn btn-danger">Cancelar</a>
            </div>             
        </form>
       </div>
     </div>
   </div>
 </div>
</div>

<?php 
    include("docs/_includes/footer.php");
?>

<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador').select2({});
	});
</script>

</body>
<?php
}else{
 echo "<script>alert('¡NO TIENES PERMISO PARA INGRESAR A ESTE MÓDULO');window.location='Inicio.php'</script>";
}
?>