<?php
// Solo se permite el ingreso con el inicio de sesion.
session_start();
require_once("ConectarBD_Mysql.php");
include("DB/conexion.php");
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
<!-- CONTENEDOR CUERPO "BODEGA" -->
<div class="content-wrapper">
  <div class="text-center">
    <h1>BODEGAS:</h1>
    <?php
    if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
      // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
   <button class="btn-add-mascota" id="ModalEnsayo" data-toggle="modal" data-target="#staticBackdrop">Añadir Bodega</button>
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
    
  <!-- FORMULARIO AÑADIR BODEGA -->
  <?php 
   if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
    // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE...?>
      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Añadir Bodega:</h3>
        </div>
        
          <form name="f1" action="Añadir_Bodega.php" method="POST">
           <div class="form-group">
              <label for="Nombre_Bodega">Número:</label>
              <input type="number" name="id_bodega" class="form-control" placeholder="Número de Bodega:" required >
            </div>
            <div class="form-group">
              <label for="Nombre_Bodega">Nombre:</label>
              <input type="text" name="Nombre_Bodega" class="form-control" placeholder="Nombre de Bodega:" required >
            </div>
            <?php  
   // CONSULTA PARA SELECT DE FORMULARIO(PAIS-CIUDAD)
             $sql="SELECT * from paises";
             $result=mysqli_query($con,$sql);
             ?>
            <div class="form-group">
              <label for="idPais">Pais:</label>
            <select name="idPais" id="controlBuscador" style="width: 100%">
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
              <label for="Direccion_Bodega">Dirección:</label>
              <input type="text" name="Direccion_Bodega" class="form-control" placeholder="CR 00 #00-00 (COMPLEMENTO):" required>
            </div>
            <div class="modal-footer">
              <input type="submit" name="Agregar_Bodega" class="btn btn-success" value="Agregar">
              <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>          
            </div>   
          </form>
        </div>
      </div>
    </div>
    <?php
    }else{
      //SI NO TIIENE ROL ADMI NO MUESTRE NADA...
    }
    ?>
  
  <!-- DATATABLE BODEGAS -->
  <div class="datatable-responsive datatable-box">
    <table id="dueño" class="table table-responsive table-sm non-top-border" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Pais</th>
          <th>Departamento</th>   
          <th>Ciudad</th>    
          <th>Dirección</th>
          <th>Acciones</th>             
        </tr>
      </thead>
      <tbody>
        <?php  
          $query="SELECT * FROM bodega
          INNER JOIN paises ON bodega.pais_b = paises.idPais
          INNER JOIN departamento ON bodega.departamento_b = departamento.idDepartamento
          INNER JOIN ciudades ON bodega.ciudad_b = ciudades.idCiudad
          ";
          $resultado= $con->query($query);
          while($mostrar=$resultado->fetch_assoc()){
        ?>
          <tr>
          <td><a id="hrefvista" href="Vista_Bodega.php?id_bodega=<?php echo $mostrar['id_bodega']?>"><?php echo $mostrar['id_bodega'] ?></a></td>
            <td><?php echo $mostrar['nombre_bodega']?></td>
            <td><?php echo $mostrar['nombre_pais'] ?></td>
            <td><?php echo $mostrar['nombre_departamento']?></td>
            <td><?php echo $mostrar['nombre_ciudad']?></td>
            <td><?php echo $mostrar['direccion']?></td>
            <td>
  <?php 
    if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
      // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
              <a href="Edit_Bodega.php?id_bodega=<?php echo $mostrar['id_bodega']?>" title="Editar Bodega" class="btn btn-secondary">
                <i class="icofont-ui-edit"></i>
              </a>
              <a href="#" onclick="preguntar(<?php echo $mostrar['id_bodega']?>)" title="Eliminar Bodega" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
    <?php
    }else{
    //SI NO TIENE ROL ADMI NO MUESTRE NADA...
    }
    ?>
              <a href="Vista_Bodega.php?id_bodega=<?php echo $mostrar['id_bodega']?>" title="Ver detalles de Bodega" class="btn btn-primary">
                <i class="icofont-eye-alt"></i>
              </a>
            </td>
          </tr>
        <?php
          } //end while
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
      function preguntar(id_bodega)
      {
        if(confirm('¿Está seguro que desea eliminar esta Bodega?'))
        {
          window.location.href = "Delete_Bodega.php?id_bodega="+id_bodega;
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
		$('#controlBuscador').val();
		recargarLista();

		$('#controlBuscador').change(function(){
			recargarLista();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"Añadir_Select_Departamento.php",
			data:"idPais=" + $('#controlBuscador').val(),
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
