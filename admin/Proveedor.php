<?php
// Solo se permite el ingreso con el inicio de sesion.
session_start();
require_once("ConectarBD_Mysql.php");

// --- VALIDACIÓN SESSION-----
include("Session.php");

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
    <!-- CONTENEDOR CUERPO "PROVEEDOR" -->
<div class="content-wrapper">
  <div class="text-center">
    <h1>PROVEEDORES</h1>
    <?php
    if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
      // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
  <button class="btn-add-dueño" id="ModalEnsayo" data-toggle="modal" data-target="#staticBackdrop">Añadir Proveedor</button>
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

 <!-- MODAL FORMULARIO AÑADIR PROVEEDOR -->
   <?php 
   if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
    // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Añadir Proveedor</h3>           
        </div>
           
           <form action="Añadir_Proveedor.php" method="POST">
            <div class="form-group">
              <label for="nit">Nit:</label>
              <input type="text" name="nit" class="form-control" placeholder="NIT" required>
            </div>
            <div class="form-group">
              <label for="razon_social">Razón Social:</label>
              <input type="text" name="razon_social" class="form-control" placeholder="RAZÓN SOCIAL" required>
            </div>
            <div class="form-group">
              <label for="comercial">Comercial:</label>
              <input type="text" name="comercial" class="form-control" placeholder="COMERCIAL" required>
            </div>
            <div class="form-group">
              <label for="Telefono">Teléfono:</label>
              <input type="text" name="Telefono" class="form-control" placeholder="TELEFONO" required>
            </div>
            <div class="form-group">
              <label for="correo">Correo:</label>
              <input type="email" name="correo" class="form-control" placeholder="CORREO" required>
            </div>
            <div class="modal-footer">
              <input type="submit" name="agregar_proveedor" class="btn btn-success" value="Agregar">
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
  
<!-- DATATABLE PROVEEDOR -->
  <div class="datatable-responsive datatable-box">
    <table id="dueño" class="table table-responsive table-sm non-top-border" width="100%" cellspacing="0" style='text-align: justify;'>
      <thead>
          <tr>       
            <th>Nit</th>
            <th>Razón Social</th>
            <th>Comercial</th>
            <th>Télefono</th> 
            <th>Correo electronico</th>
            <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
        <?php  
          include("DB/conexion.php");
          $query="SELECT * FROM proveedor";
          $resultado= $con->query($query);
          while($mostrar=$resultado->fetch_assoc()){
        ?>   
          <tr>            
            <td><?php echo $mostrar['nit'] ?></td>
            <td><a id="hrefvista" href="Vista_Proveedor.php?nit=<?php echo $mostrar['nit']?>"><?php echo $mostrar['razon_social'] ?></a></td>
            <td><?php echo $mostrar['comercial'] ?></td>
            <td><?php echo $mostrar['Telefono'] ?></td>
            <td><?php echo $mostrar['correo'] ?></td>
            <td>
   <?php 
    if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
      // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
     <a href="Edit_Proveedor.php?nit=<?php echo $mostrar['nit']?>" title="Editar Proveedor" class="btn btn-secondary">
                <i class="icofont-ui-edit"></i>
              </a>
              <a href="#" onclick="preguntar(<?php echo $mostrar['nit']?>)" title="Eliminar Proveedor" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
     <?php
    }else{
    //SI NO TIENE ROL ADMI NO MUESTRE NADA...
    }
    ?>
              <a href="Vista_Proveedor.php?nit=<?php echo $mostrar['nit']?>" title="Ver detalles del Proveedor" class="btn btn-primary">
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
      function preguntar(nit)
      {
        if(confirm('¿Está seguro que desea eliminar este Proveedor?'))
        {
          window.location.href = "Delete_Proveedor.php?nit="+nit;
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