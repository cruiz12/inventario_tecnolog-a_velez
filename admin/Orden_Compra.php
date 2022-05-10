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
<div class="content-wrapper">
  <div class="text-center">
    <h1>ORDENES DE COMPRA</h1>
    <?php
    
    if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
      // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE...?>
    <button class="btn-add-dueño" id="ModalEnsayo" data-toggle="modal" data-target="#staticBackdrop">Añadir Orden de Compra</button>
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
        include("DB/conexion.php");
        $sql="SELECT nit,razon_social,comercial,Telefono from proveedor";
        $result=mysqli_query($con,$sql)
    ?>
 
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Añadir Orden de compra</h3>           
        </div>
           <!-- FORMULARIO AÑADIR PROVEEDOR -->
           <form action="Añadir_Orden_Compra.php" method="POST">
            <div class="form-group">
              <label for="Id orden de compra">Id orden de compra:</label>
              <input type="text" name="id_orden" class="form-control" placeholder="Id de la Orden" required>
            </div>
            <div class="form-group">
            <label for="Proveedor">Proveedor:</label>
              <select name="Proveedor" id="controlBuscador" style="width: 100%">
                <option disabled selected>Seleccione un Proveedor</option>
                <?php while ($ver=mysqli_fetch_row($result)) {?>
                <option value="<?php echo $ver[0] ?>">
                  <?php echo $ver[1] ?> - <?php echo $ver[0] ?>
                </option>
                <?php  }?>
              </select>
            </div>
            <div class="form-group">
              <label for="Fecha-de_emisión_del_pedido">Fecha de emisión del pedido:</label>
              <input id="fechae" type="date" name="fecha_emision_pedido" class="form-control" placeholder="Fecha de emisión del pedido" required>
            </div>
            <div class="form-group">
              <label for="Fecha_de_recepción_del_pedido">Fecha de recepción del pedido:</label>
              <input id="fechar" type="date" name="fecha_recepcion_pedido" class="form-control" placeholder="Fecha de recepción del pedido" required>
            </div>
            <div class="modal-footer">
              <input type="submit" name="agregar_orden_compra" class="btn btn-success" value="Agregar">
              <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>
          </form>
      </div>
    </div>
  </div>
<!-- DATATABLE ORDEN DE COMPRA -->
  <div class="datatable-responsive datatable-box">
    <table id="dueño" class="table table-responsive table-sm non-top-border" width="100%" cellspacing="0">
      <thead>
          <tr>       
            <th>ID de Orden</th> 
            <th>Proveedor</th> 
            <th>Fecha de Emisión</th>  
            <th>Fecha de recepción pedido</th>  
            <th>Acciones</th>                
          </tr>
      </thead>
      <tbody>
        <?php  
   
          $query="SELECT * FROM orden_compra
           INNER JOIN proveedor ON orden_compra.id_proveedor_pedido = proveedor.nit";
          $resultado= $con->query($query);
          while($mostrar=$resultado->fetch_assoc()){
        ?>   
          <tr>            
            <td><?php echo $mostrar['id_orden'] ?></td>
            <td><a id="hrefvista" href="Vista_Proveedor.php?nit=<?php echo $mostrar['nit']?>"><?php echo $mostrar['razon_social'] ?></a></td>
            <td><?php echo $mostrar['fecha_emision_pedido'] ?></td>
            <td><?php echo $mostrar['fecha_recepcion_pedido'] ?></td>
            <td>
            <?php
             if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
              // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
              <a href="Edit_Orden_Compra.php?id_orden=<?php echo $mostrar['id_orden']?>" title="Editar Orden de Compra" class="btn btn-secondary">
                <i class="icofont-ui-edit"></i>
              </a>
              <a href="#" onclick="preguntar(<?php echo $mostrar['id_orden']?>)" title="Eliminar Orden de Compra" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
              <?php
            }else{
               //SI NO TIENE ROL ADMI NO MUESTRE NADA...
            }
            ?>
              <a href="Vista_Orden_Compra.php?id_orden=<?php echo $mostrar['id_orden']?>" title="Ver detalles de la Orden de Compra" class="btn btn-primary">
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
      function preguntar(id_orden)
      {
        if(confirm('¿Está seguro que desea eliminar la Orden de compra?'))
        {
          window.location.href = "Delete_Orden_Compra.php?id_orden="+id_orden;
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