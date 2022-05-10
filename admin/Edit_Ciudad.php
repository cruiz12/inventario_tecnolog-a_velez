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
<!-- CONTENEDOR CUERPO "EDITAR CIUDAD" -->
<div class="content-wrapper">
<?php

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS */
$idCiudad = $_REQUEST['idCiudad'];

$query="SELECT * FROM ciudades 
INNER JOIN departamento ON ciudades.departamento = departamento.idDepartamento
WHERE idCiudad='$idCiudad'";

$resultado= $con->query($query);
$row2=$resultado->fetch_assoc();

if(isset($_POST['updateciudad'])){

/* AQUI SE RECIBEN LOS DATOS DEL FORMULARIO */
  $idCiudad = $_REQUEST['idCiudad'];
  $departamento = $_POST['departamento'];
  $nombre_ciudad = $_POST['nombreCiudad'];
  
/* AQUI REALIZAMOS EL UPDATE DEL REGISTRO QUE SE SELECCIONÓ */
  $query="UPDATE ciudades SET nombre_ciudad='$nombre_ciudad',departamento='$departamento' WHERE idCiudad='$idCiudad'";
  $ResultadoEditCiudad = $con->query($query);

  if($ResultadoEditCiudad){
  echo "<script>alert('Los datos de la ciudad se han actualizado correctamente');window.location='Ciudades.php'</script>";
  }else{
    echo "<script>alert('los datos no se han podido actualizar correctamente');</script>";
  }

}
?>
  <?php  
      // CONSULTA PARA SELECT DE FORMULARIO(DEPARTAMENTO)
      $sql="SELECT * from departamento";
      $result=mysqli_query($con,$sql);
    ?>
 <div class="container p-4">
   <div class="row">
     <div class="col-md-5 mx-auto">
       <div class="card card-body" style="background-color: #55565a; color: #fff ">
        <!-- AQUI ESTA EL MODAL QUE CONTIENE EL FORMULARIO QUE REALIZA LA ACCIÓN DE LA PÁGINA -->
        <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Editando a: "<?php echo $row2['nombre_ciudad']; ?>"</h3>   
        <hr style="background-color: #fff; ">
        <form action="" method="POST">
            <div class="form-group">
              <label for="nombreCiudad">Nombre:</label>
              <input type="text" name="nombreCiudad" class="form-control" value="<?php echo $row2['nombre_ciudad']; ?>" placeholder="Actualizar Nit">
            </div>
            <div class="form-group">
            <label for="departamento">Departamento:</label>
              <select name="departamento" id="controlBuscador" style="width: 100%">
              <option value="<?php echo $row2['idDepartamento']; ?>"><?php echo $row2['nombre_departamento']; ?>(ACTUAL)</option>
                <?php while ($ver=mysqli_fetch_row($result)) {?>
                    <option value="<?php echo $ver[0] ?>">
                      <?php echo $ver[1] ?>
                    </option>
                  <?php  }?>
              </select>
            </div>
            <hr style="background-color: #fff; ">
            <h4 style=" text-align: center;">¡Revisa la información antes de realizar algún cambio!</h4>
            <div class="botones">
              <button name="updateciudad" class="btn btn-success">Actualizar</button>
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
<script src="select2/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador').select2({ dropdownParent: "" });
	});
</script>
</body>
<?php
}else{
 echo "<script>alert('¡NO TIENES PERMISO PARA INGRESAR A ESTE MÓDULO');window.location='Inicio.php'</script>";
}
?>