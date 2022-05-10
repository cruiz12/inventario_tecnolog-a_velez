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
<!-- CONTENEDOR CUERPO "RESPONSABLES" -->
<div class="content-wrapper">
  <div class="text-center">
    <h1>RESPONSABLES:</h1>
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
 
  <!-- DATATABLE BODEGAS -->
  <div class="datatable-responsive datatable-box" >
    <table id="galeria" class="table table-responsive table-sm non-top-border" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Cédula</th>
          <th>Nombre</th>
          <th>Area</th>   
          <th>DETALLES</th>     
        </tr>
      </thead>
      <tbody>
        <?php  
          include("DB/conexion.php");
          $query="SELECT * FROM responsables_dispositivos
          INNER JOIN areas ON responsables_dispositivos.area = areas.id_area";
          $resultado= $con->query($query);
          while($mostrar=$resultado->fetch_assoc()){
        ?>
          <tr>
          <td><?php echo $mostrar['cedula'] ?></a></td>
            <td><a id="hrefvista" href="Vista_Responsable.php?cedula=<?php echo $mostrar['cedula']?>"><?php echo $mostrar['nombre_responsable'] ?></td>
            <td><?php echo $mostrar['nombre_area']?></td>
            <td>
              <a href="Vista_Responsable.php?cedula=<?php echo $mostrar['cedula']?>" title="Ver detalles de Responsable" class="btn btn-primary">
                <i class="icofont-eye-alt"></i>
              </a>
            </td>
          </tr>
        <?php
          } // END WHILE
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
    $('#galeria').DataTable( {
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


</body>
