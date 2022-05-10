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
  <div class="preloader flex-column justify-content-center align-items-center" style="background:white;">
  <img class="animation__shake" src="../assets/img/LogoCuerosVélez.jpg" alt="Casme Logo" height="650px" width="1050px">
  </div>
 <!-- Navbar -->
 <?php 
    include("docs/_includes/navbar.php");
  ?>
<!-- CONTENEDOR CUERPO "EDITAR PROVEEDOR" -->
<div class="content-wrapper">
<?php

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS */
$id_tipo_dispositivo = $_REQUEST['id_tipo_dispositivo'];

$query="SELECT * FROM tipo_dispositivo WHERE id_tipo_dispositivo='$id_tipo_dispositivo'";
$resultado= $con->query($query);
$row2=$resultado->fetch_assoc();

if(isset($_POST['updatetipo'])){

/* AQUI SE RECIBEN LOS DATOS DEL FORMULARIO */
  $id_tipo_dispositivo = $_REQUEST['id_tipo_dispositivo'];
  $nombre_tipo_dispositivo = $_POST['nombreTipoDispositivo'];

/* AQUI REALIZAMOS EL UPDATE DEL REGISTRO QUE SE SELECCIONÓ */
  $query="UPDATE tipo_dispositivo SET Nombre_tipo_dispositivo='$nombre_tipo_dispositivo' WHERE id_tipo_dispositivo='$id_tipo_dispositivo'";
  $ResultadoEditTipo = $con->query($query);

  if($ResultadoEditTipo){
  echo "<script>alert('Los datos del tipo de dispositivo se han actualizado correctamente');window.location='Tipo_Dispositivos.php'</script>";
  }else{
    echo "<script>alert('los datos no se han podido actualizar correctamente');</script>";
  }

}
?>
 <div class="container p-4">
   <div class="row">
     <div class="col-md-5 mx-auto">
       <div class="card card-body" style="background-color: #55565a; color: #fff ">
        <!-- AQUI ESTA EL MODAL QUE CONTIENE EL FORMULARIO QUE REALIZA LA ACCIÓN DE LA PÁGINA -->
        <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Editando a: "<?php echo $row2['Nombre_tipo_dispositivo']; ?>"</h3>   
        <hr style="background-color: #fff; ">
        <form action="" method="POST">
            <div class="form-group">
              <label for="nombreTipoDispositivo">Nombre:</label>
              <input type="text" name="nombreTipoDispositivo" class="form-control" value="<?php echo $row2['Nombre_tipo_dispositivo']; ?>" placeholder="Actualizar Nombre">
            </div>
            <hr style="background-color: #fff; ">
            <h4 style=" text-align: center;">¡Revisa la información antes de realizar algún cambio!</h4>
            <div class="botones">
              <button name="updatetipo" class="btn btn-success">Actualizar</button>
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

</body>
<?php
}else{
 echo "<script>alert('¡NO TIENES PERMISO PARA INGRESAR A ESTE MÓDULO');window.location='Inicio.php'</script>";
}
?>