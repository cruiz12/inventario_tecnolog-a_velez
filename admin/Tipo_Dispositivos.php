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
    <!-- CONTENEDOR CUERPO "PROVEEDOR" -->
<div class="content-wrapper">
  <div class="text-center">
    <h1>TIPOS DE DISPOSITIVO:</h1>
    <?php
    if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
// SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
  <button class="btn-add-dueño" id="ModalEnsayo" data-toggle="modal" data-target="#staticBackdrop">Añadir Tipo Dispositivo</button>
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
      // CONSULTA PARA SELECT DE FORMULARIO(DEPARTAMENTO)
      $sql="SELECT * from paises";
      $result=mysqli_query($conn,$sql);
    ?>
 <!-- MODAL FORMULARIO AÑADIR TIPO DISPOSITIVO -->
   <?php 
   if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
    // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Añadir Tipo Dispositivo:</h3>           
        </div>
           <form action="Añadir_Tipo_Dispositivo.php" method="POST">
            <div class="form-group">
              <label for="nombre_tipo">Nombre:</label>
              <input type="text" name="nombre_tipo" class="form-control" placeholder="Nombre Tipo Dispositivo" required>
            </div>
            <div class="modal-footer">
              <input type="submit" name="agregar_tipo" class="btn btn-success" value="Agregar">
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
            <th>ID</th>
            <th>Nombre Tipo Dispositivo</th>
            <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
        <?php  
          include("DB/conexion.php");
          $query="SELECT * FROM tipo_dispositivo";
          $resultado= $con->query($query);
          while($mostrar=$resultado->fetch_assoc()){
        ?>   
          <tr>            
            <td><?php echo $mostrar['id_tipo_dispositivo'] ?></td>
            <td><?php echo $mostrar['Nombre_tipo_dispositivo'] ?></td>
            <td>
   <?php 
    if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
      // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE...?>
     <a href="Edit_Tipo_Dispositivo.php?id_tipo_dispositivo=<?php echo $mostrar['id_tipo_dispositivo']?>" title="Editar Tipo Dispositivo" class="btn btn-secondary">
                <i class="icofont-ui-edit"></i>
              </a>
              <a href="#" onclick="preguntar(<?php echo $mostrar['id_tipo_dispositivo']?>)" title="Eliminar Tipo Dispositivo" class="btn btn-danger">
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
        if(confirm('¿Está seguro que desea eliminar este Tipo de Dispositivo?'))
        {
          window.location.href = "Delete_Tipo_Dispositivo.php?id_tipo_dispositivo="+id;
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
<?php
}else{
 echo "<script>alert('¡NO TIENES PERMISO PARA INGRESAR A ESTE MÓDULO');window.location='Inicio.php'</script>";
}
?>