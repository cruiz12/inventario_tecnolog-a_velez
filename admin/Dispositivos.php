<?php
// Solo se permite el ingreso con el inicio de sesion.
session_start();
require_once("ConectarBD_Mysql.php");

// --- VALIDACIÓN SESSION-----
include("Session.php");

 //  ----HEAD HTML---------
include("docs/_includes/head.html");
   
?>

<body class="hold-transition sidebar-mini layout-fixed" >
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center" style="background:white;">
  <img class="animation__shake" src="../assets/img/LogoCuerosVélez.jpg" alt="Casme Logo" height="650px" width="1050px">
  </div>
  <!-- Navbar -->
  <?php 
    include("docs/_includes/navbar.php");
  ?>
<!-- CONTENEDOR CUERPO "DISPOSITIVOS" -->
<div class="content-wrapper">
  <div class="text-center">
    <h1>DISPOSITIVOS:</h1>
    <?php
    if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
      // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
    <button class="btn-add-mascota" id="ModalEnsayo" data-toggle="modal" data-target="#staticBackdrop">Añadir Dispositivo (ORDEN DE COMPRA)</button>
    <button class="btn-add-mascota" id="ModalEnsayo2" data-toggle="modal" data-target="#staticBackdrop2">Añadir Dispositivo (CONTRATO)</button>
    <?php
    }else{
  //SI NO TIENE ROL ADMI NO MUESTRE NADA...
    }
    ?>
  </div>
  <!-- MESSAGES -->
    <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php session_unset(); } ?>
  
    <?php  
    //CONSULTA TABLA (MARCA):
      include("DB/conexion.php");
      $sql="SELECT * from marca";
      $result=mysqli_query($con,$sql);
      $resultado=mysqli_query($con,$sql);
      //CONSULTA TABLA (TIPO_DISPOSITIVO):
      $sql2="SELECT * FROM tipo_dispositivo";
      $result2=mysqli_query($con,$sql2);
      $resultado2=mysqli_query($con,$sql2);
      //CONSULTA TABLA (BODEGA):
      $sql3="SELECT * FROM bodega";
      $result3=mysqli_query($con,$sql3);
      $resultado3=mysqli_query($con,$sql3);
      //CONSULTA TABLA (ORDEN_COMPRA):
      $sql4="SELECT * FROM orden_compra";
      $result4=mysqli_query($con,$sql4);
      //CONSULTA TABLA (CONTRATO):
      $sql5="SELECT * FROM contrato INNER JOIN proveedor ON contrato.proveedor = proveedor.nit";
      $result5=mysqli_query($con,$sql5);
      //CONSULTA TABLA (MODELO):
    ?>

    <?php
   if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
    // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
    <!-- MODAL FORMULARIO AÑADIR DISPOSITIVO CON (ORDEN DE COMPRA) -->
    
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Añadir Dispositivo: (ORDEN DE COMPRA)</h3>
        </div>
          <form action="Añadir_Dispositivo_Orden.php" method="POST">
            <div class="form-group">
              <label for="codigo_serial">Codigo Serial:</label>
              <input type="text" name="codigo_serial" class="form-control" placeholder="Codigo Serial:" required>
            </div>
            <div class="form-group">
              <label for="activo">Activo:</label>
              <input type="text" name="activo" class="form-control" placeholder="Activo:" required>
            </div>
            <div class="form-group">
              <label for="tipo_dispositivo">Tipo Dispositivo:</label>
            <select name="tipo_dispositivo" id="controlBuscador" style="width: 100%">
                <option disabled selected>Seleccione Tipo Dispositivo...</option>
                  <?php while ($ver=mysqli_fetch_row($result2)) {?>
                    <option value="<?php echo $ver[0] ?>">
                      <?php echo $ver[1] ?>
                    </option>
                  <?php  }?>
              </select>
            </div>
            <div class="form-group">
              <label for="marca">Marca:</label>
            <select name="marca" id="controlBuscador2" style="width: 100%">
                <option disabled selected>Seleccione Marca...</option>
                  <?php while ($ver=mysqli_fetch_row($result)) {?>
                    <option value="<?php echo $ver[0] ?>">
                      <?php echo $ver[1] ?>
                    </option>
                  <?php  }?>
              </select>
            </div>
            <div class="form-group" id="select2lista">
            <label>vkvrkvemv</label>
            </div>
            
           
            <div class="form-group">
              <label for="bodega">Bodega:</label>
            <select name="bodega" id="controlBuscador4" style="width: 100%">
                <option disabled selected>Seleccione Bodega...</option>
                  <?php while ($ver=mysqli_fetch_row($result3)) {?>
                    <option value="<?php echo $ver[0] ?>">
                      <?php echo "$ver[0]-$ver[1]" ?>
                    </option>
                  <?php  }?>
              </select>
            </div>
            <div class="form-group">
              <label for="orden_compra">Orden De Compra:</label>
            <select name="orden_compra" id="controlBuscador5" style="width: 100%">
                <option disabled selected>Seleccione Orden De Compra...</option>
                  <?php while ($ver=mysqli_fetch_row($result4)) {?>
                    <option value="<?php echo $ver[0] ?>">
                      <?php echo "$ver[0]---$ver[1]" ?>
                    </option>
                  <?php  }?>
              </select>
            </div>
            <div class="modal-footer">
              <input type="submit" name="Agregar_Dispositivo_Orden" class="btn btn-success" value="Agregar">
              <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>          
            </div>   
          </form>
        </div>
      </div>
    </div>

    <!--MODAL FORMULARIO AÑADIR DISPOSITIVO CON (CONTRATO) -->
    
  <div class="modal fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Añadir Dispositivo: (CONTRATO)</h3>
        </div>
          <form action="Añadir_Dispositivo_Contrato.php" method="POST">
            <div class="form-group">
              <label for="codigo_serial">Codigo Serial:</label>
              <input type="text" name="codigo_serial" class="form-control" placeholder="Codigo Serial:" required>
            </div>
            <div class="form-group">
              <label for="activo">Activo:</label>
              <input type="text" name="activo" class="form-control" placeholder="Activo:" required>
            </div>
            <div class="form-group">
              <label for="tipo_dispositivo">Tipo Dispositivo:</label>
            <select name="tipo_dispositivo" id="controlBuscador6" style="width: 100%">
                <option disabled selected>Seleccione Tipo Dispositivo...</option>
                  <?php while ($ver=mysqli_fetch_row($resultado2)) {?>
                    <option value="<?php echo $ver[0] ?>">
                      <?php echo $ver[1] ?>
                    </option>
                  <?php  }?>
              </select>
            </div>
            <div class="form-group">
              <label for="marca">Marca:</label>
            <select name="marca" id="controlBuscador7" style="width: 100%">
                <option disabled selected>Seleccione Marca...</option>
                  <?php while ($ver=mysqli_fetch_row($resultado)) {?>
                    <option value="<?php echo $ver[0] ?>">
                      <?php echo $ver[1] ?>
                    </option>
                  <?php  }?>
              </select>
            </div>
            <div class="form-group" id="select3lista">
            </div>
            <div class="form-group">
              <label for="bodega">Bodega:</label>
            <select name="bodega" id="controlBuscador9" style="width: 100%">
                <option disabled selected>Seleccione Bodega...</option>
                  <?php while ($ver=mysqli_fetch_row($resultado3)) {?>
                    <option value="<?php echo $ver[0] ?>">
                      <?php echo "$ver[0]-$ver[1]" ?>
                    </option>
                  <?php  }?>
              </select>
            </div>
            <div class="form-group">
              <label for="contrato">Contrato:</label>
            <select name="contrato" id="controlBuscador10" style="width: 100%">
                <option disabled selected>Seleccione Contrato...</option>
                  <?php while ($ver=mysqli_fetch_row($result5)) {?>
                    <option value="<?php echo $ver[0] ?>">
                      <?php echo "$ver[0]---$ver[6]" ?>
                    </option>
                  <?php  }?>
              </select>
            </div>
            <div class="modal-footer">
              <input type="submit" name="Agregar_Dispositivo_Contrato" class="btn btn-success" value="Agregar">
              <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>          
            </div>   
          </form>
        </div>
      </div>
    </div>
    <?php
    }else{
     //SI NO TIENE ROL ADMI NO MUESTRE NADA...
    }
    ?>
  <!-- DATATABLE DISPOSITIVOS -->
  <div class="datatable-responsive datatable-box">
    <table id="dueño" class="table table-responsive table-sm non-top-border dt-responsive" cellspacing="0">
      <thead>
        <tr>
          <th>Código Serial</th>
          <th>Activo</th>
          <th>Tipo Dispositivo</th> 
          <th>Marca</th>
          <th>Modelo</th>                 
          <th>Bodega</th>
          <th>Responsable</th>    
          <th>Orden Compra</th>  
          <th>Número Contrato</th>
          <th>Acciones</th>                   
        </tr>
      </thead>
      <tbody>
        <?php 
        // INNER JOIN bodega ON dispositivos.bodega_disp_id = bodega.id_bodega
        // INNER JOIN responsables_dispositivos ON dispositivos.responsable = responsables_dispositivos.cedula
         $query="SELECT * FROM dispositivos
         INNER JOIN marca ON dispositivos.marca = marca.id_marca
         INNER JOIN modelo ON dispositivos.modelo = modelo.id_modelo
         INNER JOIN tipo_dispositivo ON dispositivos.tipo_dispositivo = tipo_dispositivo.id_tipo_dispositivo ";
         $resultado= $con->query($query);
          while($mostrar=$resultado->fetch_assoc()){
        ?>
          <tr>
          <td><a id="hrefvistaDispo" href="Vista_Dispositivo.php?codigo_serial=<?php echo $mostrar['codigo_serial']?>"><?php echo $mostrar['codigo_serial'] ?></a></td>
                  <td><?php echo $mostrar['activo'];?></td>
                  <td><?php echo $mostrar['Nombre_tipo_dispositivo'];?></td> 
                  <td><?php echo $mostrar['nombre_marca'];?></td>
                  <td><?php echo $mostrar['codigo_modelo'];?></td>  
                  <td><a id="hrefvistaBodega" href="Vista_Bodega.php?id_bodega=<?php echo $mostrar['bodega_disp_id']?>"><?php echo $mostrar['bodega_disp_id']?></a></td>  
                  <td><a id="hrefvistaResponsable" href="Vista_Responsable.php?cedula=<?php echo $mostrar['responsable']?>"><?php echo $mostrar['responsable']?></a></td>
                  <td><a id="hrefvistaOrden" href="Vista_Orden_Compra.php?id_orden=<?php echo $mostrar['orden_compra']?>"><?php echo $mostrar['orden_compra']?></a></td>
                  <td><a id="hrefvistaContrato" href="Vista_Contrato.php?Nro_de_contrato=<?php echo $mostrar['contrato_d']?>"><?php echo $mostrar['contrato_d']?></a></td>
          <td>
          <?php
   if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
    // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
              <a href="Edit_Dispositivo.php?codigo_serial=<?php echo $mostrar['codigo_serial']?>" title="Editar Dispositivo" class="btn btn-secondary">
                <i class="icofont-ui-edit"></i>
              </a>
              <a href="#" onclick="preguntar(<?php echo $mostrar['codigo_serial']?>)" title="Eliminar Dispositivo" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
          <?php
      }else{
       //SI NO TIENE ROL ADMI NO MUESTRE NADA...
      }
          ?>
              <a href="Vista_Dispositivo.php?codigo_serial=<?php echo $mostrar['codigo_serial']?>" title="Ver detalles de Dispositivo" class="btn btn-primary">
                <i class="icofont-eye-alt"></i>
              </a>
            </td>
          </tr>
        <?php
          } 
        ?>   
      </tbody>
    </table>
  </div>
</div>
<!-- PIE DE PÁGINA -->
<?php 
    include("docs/_includes/footer.php");
?>
<script> $(document).ready(function() {
    $('#dueño').DataTable( {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        }
    } );
} );
</script>

<script type="text/javascript">
      function preguntar(codigo_serial)
      {
        if(confirm('¿Está seguro que desea eliminar este Dispositivo?'))
        {
          window.location.href = "Delete_Dispositivo.php?codigo_serial="+codigo_serial;
        }
      }
</script>
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
	<script src="select2/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador').select2({ dropdownParent: "#staticBackdrop" });
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador2').select2({ dropdownParent: "#staticBackdrop" });
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador2').val();
		recargarLista();

		$('#controlBuscador2').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"Añadir_Select_Modelo.php",
			data:"marca=" + $('#controlBuscador2').val(),
			success:function(r){
				$('#select2lista').html(r);
			}
		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador4').select2({ dropdownParent: "#staticBackdrop" });
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador5').select2({ dropdownParent: "#staticBackdrop" });
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador6').select2({ dropdownParent: "#staticBackdrop2" });
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador7').select2({ dropdownParent: "#staticBackdrop2" });
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador7').val();
		recargarLista2();

		$('#controlBuscador7').change(function(){
			recargarLista2();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista2(){
		$.ajax({
			type:"POST",
			url:"Añadir_Select_Modelo2.php",
			data:"marca2=" + $('#controlBuscador7').val(),
			success:function(r){
				$('#select3lista').html(r);
			}
		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador9').select2({ dropdownParent: "#staticBackdrop2" });
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador10').select2({ dropdownParent: "#staticBackdrop2" });
	});
</script>


</body>