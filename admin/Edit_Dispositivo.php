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
$codigo_serial  = $_REQUEST['codigo_serial'];

$query="SELECT * FROM dispositivos
INNER JOIN marca ON dispositivos.marca = marca.id_marca
INNER JOIN modelo ON dispositivos.modelo = modelo.id_modelo
INNER JOIN tipo_dispositivo ON dispositivos.tipo_dispositivo = tipo_dispositivo.id_tipo_dispositivo WHERE codigo_serial='$codigo_serial'";
$resultado= $con->query($query);
$row2=$resultado->fetch_assoc();

if(isset($_POST['update'])){

   /* AQUI SE RECIBEN LOS DATOS DEL FORMULARIO */

  $codigo_serial1  = $_POST['codigo_serial1'];
  $activo = $_POST['activo'];
  $id_marca = $_POST['id_marca'];
  $modelo = $_POST['modelo'];
  $id_tipo_dispositivo = $_POST['id_tipo_dispositivo'];
 
  /* AQUI REALIZAMOS EL UPDATE DEL REGISTRO QUE SE SELECCIONÓ */
  $query="UPDATE dispositivos SET codigo_serial='$codigo_serial1', activo='$activo', marca='$id_marca', modelo='$modelo' , tipo_dispositivo='$id_tipo_dispositivo' WHERE codigo_serial='$codigo_serial'";
  $ResultadoEditContrato = $con->query($query);

  if($ResultadoEditContrato){
  echo "<script>alert('Los datos del dispositivo se han actualizado correctamente');window.location='Vista_Dispositivo.php?codigo_serial=$codigo_serial1'</script>";
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
                            <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Editando
                                dispositivo con Código Serial: "<?php echo $row2['codigo_serial']; ?>"</h3>
                            <hr style="background-color: #fff; ">
                            <form  method="POST">
                                <div class="form-group" style="display:none;">
                                    <input type="text" name="codigo_serial1" class="form-control"
                                        value="<?php echo $row2['codigo_serial']; ?>" placeholder="Actualizar N">
                                </div>
                                <div class="form-group" style="display:none;">
                                    <input type="text" name="ruta_pdf" class="form-control"
                                        value="<?php echo $row2['ruta_pdf']; ?>"
                                        placeholder="Actualizar Número de contrato">
                                </div>
                                <div class="form-group">
                                    <label for="Nro_de_contrato">Código Serial:</label>
                                    <input type="text" name="codigo_serial" class="form-control"
                                        value="<?php echo $row2['codigo_serial']; ?>"
                                        placeholder="Actualizar Código Serial">
                                </div>
                                <div class="form-group">
                                    <label for="activo">Activo:</label>
                                    <input type="text" name="activo" class="form-control"
                                        value="<?php echo $row2['activo']; ?>"
                                        placeholder="Actualizar número de Activo">
                                </div>
                                <?php  
   // CONSULTA PARA SELECT DE FORMULARIO(MARCA_MODELO)
             $sql="SELECT * from marca";
             $result=mysqli_query($con,$sql);
             ?>
                                <div class="form-group">
                                    <label for="id_marca">Marca:</label>
                                    <select name="id_marca" id="controlBuscador" style="width: 100%">
                                        <option value="<?php echo $row2['id_marca']; ?>">
                                            <?php echo $row2['nombre_marca']; ?>(ACTUAL)</option>
                                        <?php while ($ver=mysqli_fetch_row($result)) {?>
                                        <option value="<?php echo $ver[0] ?>">
                                            <?php echo $ver[1] ?>
                                        </option>
                                        <?php  }?>
                                    </select>
                                </div>
                                <div class="form_group" id="select2lista">
                                </div>   
                                <?php  
   // CONSULTA PARA SELECT DE FORMULARIO(MARCA_MODELO)
             $sql2="SELECT * from tipo_dispositivo";
             $result2=mysqli_query($con,$sql2);
             ?>
                                <div class="form-group">
                                    <label for="id_tipo_dispositivo">tipo_dispostivo:</label>
                                    <select name="id_tipo_dispositivo" id="controlBuscador3" style="width: 100%">
                                        <option value="<?php echo $row2['id_tipo_dispositivo']; ?>">
                                            <?php echo $row2['Nombre_tipo_dispositivo']; ?>(ACTUAL)</option>
                                        <?php while ($ver2=mysqli_fetch_row($result2)) {?>
                                        <option value="<?php echo $ver2[0] ?>">
                                            <?php echo $ver2[1] ?>
                                        </option>
                                        <?php  }?>
                                    </select>
                                </div> 
                                    <div class="botones">
                                    <button name="update" class="btn btn-success">Actualizar</button>
                                        <a href="javascript: history.go(-1)" role="button"
                                            class="btn btn-danger">Cancelar</a>
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
 
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador3').select2();
 
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador').val();
 
		recargarLista();

		$('#controlBuscador').change(function(){
			recargarLista();
		});

	})
</script>
<script type="text/javascript">
	function recargarLista(){
    var datos = "codigo_serial=" + "<?php echo $codigo_serial ?>"+"&id_marca=" + $('#controlBuscador').val();
		$.ajax({
			type:"POST",
			url:"Añadir_Select_Modelo_3.php",
			data: datos,
			success:function(r){
				$('#select2lista').html(r);
			}
		});
	}
</script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
        </script>
</body>
<?php
}else{
 echo "<script>alert('¡NO TIENES PERMISO PARA INGRESAR A ESTE MÓDULO');window.location='Inicio.php'</script>";
}
?>