<?php
// Solo se permite el ingreso con el inicio de sesion.
session_start();
require_once("ConectarBD_Mysql.php");

// --- VALIDACIÓN SESSION-----
include("Session.php");
if($row['rol'] != 'SuperAdministrador'){
  echo "<script>alert('¡NO TIENES PERMISO PARA INGRESAR A ESTE MÓDULO');window.location='Inicio.php'</script>";
}else{
 //SI NO TIIENE ROL ADMI NO MUESTRE NADA...
}
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
    <!-- CONTENEDOR CUERPO "ADMINS" -->
<div class="content-wrapper">
  <div class="text-center">
    <h1>ADMINISTRADORES:</h1>
    <?php
    if($row['rol'] == 'SuperAdministrador'){ ?>
  <button class="btn-add-dueño" id="ModalEnsayo" data-toggle="modal" data-target="#staticBackdrop">Añadir Admin</button>
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

 <!-- MODAL FORMULARIO AÑADIR ADMIN -->
   <?php 
   if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
    // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Añadir Admin:</h3>           
        </div>
           
           <form action="Añadir_Admin.php" method="POST">
            <div class="form-group">
              <label for="nombres">Nombres:</label>
              <input type="text" name="nombre" class="form-control" placeholder="Nombre..." required>
            </div>
            <div class="form-group">
              <label for="apellidos">Apellidos:</label>
              <input type="text" name="apellidos" class="form-control" placeholder="Apellidos..." required>
            </div>
            <div class="form-group">
              <label for="nombre_usuario">Usuario:</label>
              <input type="text" name="nombre_usuario" class="form-control" placeholder="Usuario..." required>
            </div>
            <div class="form-group">
              <label for="clave">Clave:</label>
              <input type="password" id="clave" name="clave" class="form-control" placeholder="Clave..." required>
            </div>
            <div class="modal-footer">
              <input type="submit" name="agregar_admin" class="btn btn-success" value="Agregar">
              <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>
          </form>
      </div>
    </div>
<script src="ContraseñaSegura/js/jquery.min.js"></script>
<script src="ContraseñaSegura/js/strength.min.js"></script>
<script id="rendered-js">
  $(document).ready(function ($) {
  $('#clave').strength({
    strengthClass: 'strength',
    strengthMeterClass: 'strength_meter',
    strengthButtonClass: 'button_strength',
    strengthButtonText: 'Mostrar Clave',
    strengthButtonTextToggle: 'Ocultar Clave' });
});
</script>
  </div>
  <?php
    }else{
      //SI NO TIENE ROL ADMI NO MUESTRE NADA...
    }
   
    ?>
  
<!-- DATATABLE ADMIIN -->
  <div class="datatable-responsive datatable-box">
    <table id="dueño" class="table table-responsive table-sm non-top-border" width="100%" cellspacing="0" style='text-align: justify;'>
      <thead>
          <tr>      
            <th>Nº usuario</th>
            <th>Usuario</th> 
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Rol</th>
            <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
        <?php  
          include("DB/conexion.php");
          $query="SELECT * FROM tecnicos WHERE rol = 'Administrador'";
          $resultado= $con->query($query);
          while($mostrar=$resultado->fetch_assoc()){
        ?>   
          <tr>            
            <td><?php echo $mostrar['id_user'] ?></td> 
            <td><?php echo $mostrar['usuario'] ?></td>
            <td><?php echo $mostrar['Nombre_Usuario'] ?></td>
            <td><?php echo $mostrar['Apellidos_Usuario'] ?></td>
            <td><?php echo $mostrar['rol'] ?></td>
            <td>
   <?php 
    if($row['rol'] == 'Administrador' || $row['rol'] == 'SuperAdministrador'){ ?>
     <!-- <a href="Edit_Admin.php?id_user=<?php// echo $mostrar['id_user']?>" title="Editar Admin" class="btn btn-secondary">
                <i class="icofont-ui-edit"></i> 
              </a>-->
              <a href="#" onclick="preguntar(<?php echo $mostrar['id_user']?>)" title="Eliminar Admin" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
     <?php
    }else{
    //SI NO TIENE ROL ADMI NO MUESTRE NADA...
    }
    ?>
            </td>
          </tr>
          <?php
            } //end while
          ?>   
      </tbody>
    </table>
  </div>  
</div> 
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
      function preguntar(id)
      {
        if(confirm('¿Está seguro que desea eliminar este Administrador?'))
        {
          window.location.href = "Delete_Admin.php?id_user="+id;
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