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
<!-- CONTENEDOR CUERPO "EDITAR BODEGA" -->
<div class="content-wrapper">
<?php

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS QUE SE ENVIAN COMO PARAMETRO */
$id_bodega = $_REQUEST['id_bodega'];

 /* AQUI REALIZAMOS UNA CONSULTA EN LA TABLA BODEGA QUE DEACUERDO AL ID DE LA BODEGA SELECCIONADA 
    PARA AUTOCOMPLEMENTAR LOS DATOS DEL FORMULARIO QUE ESTA DENTRO DEL MODAL staticBackdropLabel
      */
$query="SELECT * FROM bodega
INNER JOIN paises ON bodega.pais_b = paises.idPais
INNER JOIN departamento ON bodega.departamento_b = departamento.idDepartamento
INNER JOIN ciudades ON bodega.ciudad_b = ciudades.idCiudad
WHERE id_bodega='$id_bodega'";
$resultado= $con->query($query);
$row2=$resultado->fetch_assoc();

if(isset($_POST['update'])){

   /* AQUI SE RECIBEN LOS DATOS DEL FORMULARIO */
  $id_bodega2 = $_POST['id_bodega2'];
  $Nombre_bodega = $_POST['nombre_bodega'];
  $pais = $_POST['idPais'];
  $departamento = $_POST['idDepartamento'];
  $ciudad = $_POST['idCiudad'];
  $direccion = $_POST['direccion'];

  /* AQUI REALIZAMOS EL UPDATE DEL REGISTRO QUE SE SELECCIONÓ */
  $query="UPDATE bodega SET id_bodega='$id_bodega2', nombre_bodega='$Nombre_bodega', pais_b='$pais', departamento_b='$departamento', ciudad_b='$ciudad' , direccion='$direccion' WHERE id_bodega='$id_bodega'";
  $ResultadoEditBodega = $con->query($query);

  if($ResultadoEditBodega){
  echo "<script>alert('Los datos de la bodega se han actualizado correctamente');window.location='Vista_Bodega.php?id_bodega=$id_bodega'</script>";
  }else{
    echo "<script>alert('los datos no se han podido actualizar correctamente');</script>";
  }

}
?>
 <div class="container p-4">
   <div class="row">
     <div class="col-md-5 mx-auto">
       <div class="card card-body"style="background-color: #55565a; color: #fff ">
        <!-- AQUI ESTA EL MODAL QUE CONTIENE EL FORMULARIO QUE REALIZA LA ACCIÓN DE LA PÁGINA -->
        <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Editando a Bodega: "<?php echo $row2['id_bodega']; ?>"</h3>   
        <hr style="background-color: #fff; ">
        <form action="" name="f1" method="POST">
            <div class="form-group">
              <label for="id_bodega2">Número(ID):</label>
              <input type="text" name="id_bodega2" class="form-control" value="<?php echo $row2['id_bodega']; ?>" placeholder="Actualizar Referencia Bodega">
            </div>
            <div class="form-group">
              <label for="nombre_bodega">Nombre:</label>
              <input type="text" name="nombre_bodega" class="form-control" value="<?php echo $row2['nombre_bodega']; ?>" placeholder="Actualizar Nombre Bodega">
            </div>
            <?php  
   // CONSULTA PARA SELECT DE FORMULARIO(PAIS-CIUDAD)
             $sql="SELECT * from paises";
             $result=mysqli_query($con,$sql);
             ?>
            <div class="form-group">
              <label for="idPais">Pais:</label>
            <select name="idPais" id="controlBuscador" style="width: 100%">
            <option value="<?php echo $row2['pais_b']; ?>"><?php echo $row2['nombre_pais']; ?>(ACTUAL)</option>
                  <?php while ($ver=mysqli_fetch_row($result)) {?>
                    <option value="<?php echo $ver[0] ?>">
                      <?php echo $ver[1] ?>
                    </option>
                  <?php  }?>
            </select>
            </div>
            <div  id="select2lista" class="form-group">
            </div>
            <div class="form-group">
              <label for="direccion">Dirección:</label> 
              <input type="text" name="direccion" class="form-control" value="<?php echo $row2['direccion']; ?>" placeholder="Actualizar direccion" autofocus>
            </div>
            <hr style="background-color: #fff; ">
            <h4 style=" text-align: center;">¡Revisa la información antes de realizar algún cambio!</h4>
            <div class="botones">
              <button name="update" class="btn btn-success">Actualizar</button>
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
		$('#controlBuscador').select2();
    $('daruown').select2();
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador').val();
    $('#daruown').val();
		recargarLista();

		$('#controlBuscador').change(function(){
			recargarLista();
		});
    $('#daruown').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
    var datos = "id_bodega=" + "<?php echo $id_bodega ?>"+"&idPais=" + $('#controlBuscador').val();
		$.ajax({
			type:"POST",
			url:"Añadir_Select2_Departamento.php",
			data: datos,
			success:function(r){
				$('#select2lista').html(r);
			}
		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador2').val(1);
		recargarLista();

		$('#controlBuscador2').change(function(){
			recargarLista();
		});
	})
</script>
</body>
<?php
}else{
 echo "<script>alert('¡NO TIENES PERMISO PARA INGRESAR A ESTE MÓDULO');window.location='Inicio.php'</script>";
}
?>