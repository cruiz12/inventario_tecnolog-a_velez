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
$nit = $_REQUEST['nit'];

 /* AQUI REALIZAMOS UNA CONSULTA EN LA TABLA PROVEEDOR QUE DEACUERDO AL NUMERO DEL
     REGISTRO SELECCIONADO PARA AUTOCOMPLEMENTAR LOS DATOS DEL
     FORMULARIO QUE ESTA DENTRO DEL MODAL staticBackdropLabel
      */
$query="SELECT * FROM proveedor WHERE nit='$nit'";
$resultado= $con->query($query);
$row2=$resultado->fetch_assoc();

if(isset($_POST['updateproveedor'])){

   /* AQUI SE RECIBEN LOS DATOS DEL FORMULARIO */
  $nit2 = $_POST['nit2'];
  $razon_social = $_POST['razon_social'];
  $comercial = $_POST['comercial'];
  $Telefono = $_POST['Telefono'];
  $correo = $_POST['correo'];
  
  /* AQUI REALIZAMOS EL UPDATE DEL REGISTRO QUE SE SELECCIONÓ */
  $query="UPDATE proveedor SET nit='$nit2', razon_social='$razon_social', comercial='$comercial',Telefono='$Telefono', correo='$correo' WHERE nit='$nit'";
  $ResultadoEditProveedor = $con->query($query);

  if($ResultadoEditProveedor){
  echo "<script>alert('Los datos del proveedor se han actualizado correctamente');window.location='Proveedor.php'</script>";
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
        <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Editando a: "<?php echo $row2['razon_social']; ?>"</h3>   
        <hr style="background-color: #fff; ">
        <form action="" method="POST">
            <div class="form-group">
              <label for="nit2">Nit:</label>
              <input type="text" name="nit2" class="form-control" value="<?php echo $row2['nit']; ?>" placeholder="Actualizar Nit">
            </div>
            <div class="form-group">
              <label for="razon_social">Razón Social:</label>
              <input type="text" name="razon_social" class="form-control" value="<?php echo $row2['razon_social']; ?>" placeholder="Actualizar Razon Social">
            </div>
            <div class="form-group">
              <label for="comercial">Comercial:</label>
              <input type="text" name="comercial" class="form-control" value="<?php echo $row2['comercial']; ?>" placeholder="Actualizar Comercial">
            </div>
            <div class="form-group">
              <label for="Telefono">Télefono:</label>
            <input type="text" name="Telefono" class="form-control" value="<?php echo $row2['Telefono']; ?>" placeholder="Actualizar telefono de contacto">
            </div>
            <div class="form-group">
              <label for="correo">Correo:</label>
            <input type="text" name="correo" class="form-control" value="<?php echo $row2['correo']; ?>" placeholder="Actualizar correo electronico">
            </div>
            <hr style="background-color: #fff; ">
            <h4 style=" text-align: center;">¡Revisa la información antes de realizar algún cambio!</h4>
            <div class="botones">
              <button name="updateproveedor" class="btn btn-success">Actualizar</button>
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