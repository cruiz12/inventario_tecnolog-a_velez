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
<div class="content-wrapper">
<?php

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS */
$id_orden = $_REQUEST['id_orden'];

 /* AQUI REALIZAMOS UNA CONSULTA EN LA TABLA ORDEN DE COMPRA QUE DEACUERDO AL NUMERO DEL
     REGISTRO SELECCIONADO PARA AUTOCOMPLEMENTAR LOS DATOS DEL
     FORMULARIO QUE ESTA DENTRO DEL MODAL staticBackdropLabel
      */
$query="SELECT * FROM orden_compra WHERE id_orden='$id_orden'";
$resultado= $con->query($query);
$row2=$resultado->fetch_assoc();

if(isset($_POST['updateordendecompra'])){

   /* AQUI SE RECIBEN LOS DATOS DEL FORMULARIO */
 
  $id_orden2 = $_POST['id_orden2'];
  $id_proveedor_pedido = $_POST['id_proveedor_pedido'];
  $fecha_emision_pedido = $_POST['fecha_emision_pedido'];
  $fecha_recepcion_pedido = $_POST['fecha_recepcion_pedido'];
  
  /* AQUI REALIZAMOS EL UPDATE DEL REGISTRO QUE SE SELECCIONÓ */
  $query="UPDATE orden_compra SET id_orden='$id_orden2', id_proveedor_pedido='$id_proveedor_pedido', fecha_emision_pedido='$fecha_emision_pedido' , fecha_recepcion_pedido='$fecha_recepcion_pedido' WHERE id_orden='$id_orden'";
  $ResultadoEditOrden = $con->query($query);

  if($ResultadoEditOrden){
  echo "<script>alert('Los datos de la orden de compra se han actualizado correctamente');window.location='Orden_Compra.php'</script>";
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

 <div class="container p-4">
   <div class="row">
     <div class="col-md-5 mx-auto">
       <div class="card card-body" style="background-color: #55565a; color: #fff ">
        <!-- AQUI ESTA EL MODAL QUE CONTIENE EL FORMULARIO QUE REALIZA LA ACCIÓN DE LA PÁGINA -->
        <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Editando Orden de Compra número : "<?php echo $row2['id_orden']; ?>"</h3>   
        <hr style="background-color: #fff; ">
        <form action="" method="POST">
            <div class="form-group">
              <label for="id_orden2">Número(ID) de Orden:</label>
              <input type="text" name="id_orden2" class="form-control" value="<?php echo $row2['id_orden']; ?>" placeholder="Actualizar número de la Orden">
            </div>
            <div class="form-group">
              <label for="Proveedor">Proveedor:</label>
              <select name="id_proveedor_pedido" id="controlBuscador" style="width: 100%">
                <option value="<?php echo $row2['id_proveedor_pedido']; ?>"><?php echo $row2['id_proveedor_pedido']; ?>(ACTUAL)</option>
                <?php while ($ver=mysqli_fetch_row($result)) {?>
                <option value="<?php echo $ver[0] ?>">
                  <?php echo $ver[1] ?> - <?php echo $ver[0] ?>
                </option>
                <?php  }?>
              </select>
            </div>
            <div class="form-group">
              <label for="fechaemision">Fecha de Emisión:</label>
            <input type="date" name="fecha_emision_pedido" class="form-control" value="<?php echo $row2['fecha_emision_pedido']; ?>" placeholder="Actualizar fecha de emisión del Pedido">
            </div>
            <div class="form-group">
              <label for="fecharecepcion">Fecha de Recepción:</label>
            <input type="date" name="fecha_recepcion_pedido" class="form-control" value="<?php echo $row2['fecha_recepcion_pedido']; ?>" placeholder="Actualizar fecha de recepción del Pedido">
            </div>
            <hr style="background-color: #fff; ">
            <h4 style=" text-align: center;">¡Revisa la información antes de realizar algún cambio!</h4>
            <div class="botones2">
              <button name="updateordendecompra" class="btn btn-success">Actualizar</button>
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