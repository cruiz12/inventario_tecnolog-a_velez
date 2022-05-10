<?php
// Solo se permite el ingreso con el inicio de sesion.
session_start();
require_once("ConectarBD_Mysql.php");

// --- VALIDACIÓN SESSION-----
include("Session.php");
if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
  
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

if(isset($_POST['asignar'])&& !empty($_POST['bodega'])){

  /* AQUI SE RECIBEN LOS DATOS DEL FORMULARIO */
  
  $bodega = $_POST['bodega'];

  /* AQUI SE TOMA LA FECHA ACTUAL*/
  $fecha = getdate();
  $fecha_actual= $fecha['year'].-$fecha['mon'].-$fecha['mday'];

 
  /* AQUI REALIZAMOS EL UPDATE DEL REGISTRO QUE SE SELECCIONÓ E IGUAL EL INSERT AL CAMPO (FECHA_ENTREGA) DEL HISTORIAL*/
  $query="UPDATE dispositivos SET bodega_disp_id = $bodega, responsable = NULL WHERE codigo_serial = '$codigo_serial'";
  $ResultadoEditDispo = $con->query($query);

  $query2="UPDATE historial_dispositivo SET fecha_entrega = '$fecha_actual', responsable_devuelta = '$NombreSesion_User' WHERE (codigo_serial_h = '$codigo_serial' AND responsable_devuelta IS NULL AND fecha_entrega IS NULL )";
  $ResultadoHistorial = $con->query($query2);

  if($ResultadoHistorial && $ResultadoEditDispo){
  echo "<script>alert('Los datos del DISPOSITIVO se han actualizado correctamente');window.location='Vista_Dispositivo.php?codigo_serial=$codigo_serial'</script>";
  }else{
    echo "<script>alert('los datos no se han podido actualizar correctamente');</script>";
  }

}
?>
<!-- CONSULTA BODEGAS -->
<?php  
      $sql="SELECT * from bodega";
      $result=mysqli_query($con,$sql);
 ?>
 <div class="container p-4">
   <div class="row">
     <div class="col-md-5 mx-auto">
       <div class="card card-body" style="background-color: #55565a; color: #fff ">
        <!-- AQUI ESTA EL MODAL QUE CONTIENE EL FORMULARIO QUE REALIZA LA ACCIÓN DE LA PÁGINA -->
        <!--FORMULARIO ASIGNAR BODEGA-->
        <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Asignando "<?php echo $codigo_serial ?>" a Bodega:</h3> 
        <hr style="background-color: #fff; ">  
        <form action="#" method="POST">
        <div class="form-group">
              <select name="bodega" id="controlBuscador" style="width: 100%">
                <option disabled selected>Seleccione Bodega:</option>
                  <?php while ($ver=mysqli_fetch_row($result)) {?>
                    <option value="<?php echo $ver[0] ?>">
                      <?php echo "$ver[0]-$ver[1]" ?>
                    </option>
                  <?php  }?>
              </select>
            </div>
            <div class="botones2">
              <button name="asignar" class="btn btn-success">Enviar a Bodega</button>
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
      function preguntar(Num_Registro_Mascota)
      {
        if(confirm('¿Está seguro que desea eliminar esta mascota?'))
        {
          window.location.href = "Delete_Mascota.php?Num_Registro_Mascota="+Num_Registro_Mascota;
        }
      }
</script>
<script src="select2/select2.min.js"></script>
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