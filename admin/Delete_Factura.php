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

/* AQUI SE ATRAPAN LOS DATOS */
$Nro_factura = $_REQUEST['Nro_factura'];

 $query="SELECT * FROM factura_pdf WHERE Nro_factura = $Nro_factura";
$resultado= $con->query($query);
$row2=$resultado->fetch_assoc();

if(isset($_POST['delete'])){

  /* AQUI SE RECIBEN LOS DATOS DEL FORMULARIO */
  $Nro_factura = $_REQUEST['Nro_factura'];
 
  
  /* AQUI REALIZAMOS EL DELETE DEL REGISTRO QUE SE SELECCIONÓ */
 
  $linkcompleto = $row['ruta_fac_contrato'];
  If (unlink($linkcompleto)) {
    // file was successfully deleted
  } else {
    echo "No se pudo eliminar el archivo de la ruta";
  }

  $query3="DELETE FROM factura_pdf WHERE Nro_factura = $Nro_factura";
  $ResultadoDeleteFactura = $con->query($query3);

  if($ResultadoDeleteFactura){
  echo "<script>alert('La factura del contrato se han eliminado correctamente');window.location='javascript: history.go(-2)'</script>";
  }else{
    echo "<script>alert('Los datos no se han eliminado correctamente');</script>";
  }
 
}

?>
 <div class="container p-4">
   <div class="row">
     <div class="col-md-5 mx-auto">
       <div class="card card-body" style="background-color: #55565a; color: #fff">
        <!-- AQUI ESTA EL MODAL QUE CONTIENE EL FORMULARIO QUE REALIZA LA ACCIÓN DE LA PÁGINA -->
        <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Eliminando la factura: "<?php echo $row2['Nro_factura'];?>" del Contrato: "<?php echo $row['Nro_contrato_f'];?>"</h3>   
        <form action="" method="POST">
        <hr style="background-color: #fff; ">
            <h4 style=" text-align: center;">¡Esta acción no se puede revertir!</h4>
            <div class="botones">
              <button name="delete" class="btn btn-success">Eliminar</button>
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