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
      //SE ATRAPA EL DATO ENVIADO COMO PARAMETRO
      $id_orden = $_REQUEST['id_orden'];
      //CONSULTA TABLA ORDEN DE COMPRA
      $query="SELECT * FROM orden_compra
      INNER JOIN proveedor ON orden_compra.id_proveedor_pedido = proveedor.nit
      WHERE id_orden='$id_orden'";
      $resultado= $con->query($query);
      $row2=$resultado->fetch_assoc();
    ?>
    <div class="text-center">
      <h1>Detalles de la Orden número: "<?php echo $row2['id_orden']; ?>"</h1>
    </div>
  <div class="row" id="Vista">
    <div class="col-md">
      <div class="section-box">
        <div class="table-responsive col-sm">
          <table class="table table-sm  non-top-border">
            <tbody>
              <tr>
                <th>Proveedor:</th>    
                <td><a id="hrefvistaProveedor" href="Vista_Proveedor.php?nit=<?php echo $row2['nit']?>"><?php echo $row2['razon_social']?></a></td>
              </tr>
              <tr>
                <th>Fecha de Emisión:</th>
                <td><?php echo $row2['fecha_emision_pedido']; ?></td>
              </tr>
              <tr>
                <th>Fecha de Recepción:</th>
                <td><?php echo $row2['fecha_recepcion_pedido']; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>             
    </div>
  </div>
    <div class="botones">
    <?php
   if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
    // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE...?>
      <a href="Edit_Orden_Compra.php?id_orden=<?php echo $row2['id_orden']?>" class="btn btn-success">Editar</a>
      <a href="#" onclick="preguntar(<?php echo $row2['id_orden']?>)" class="btn btn-danger">Eliminar</a>
      <?php
      }else{
           //SI NO TIENE ROL ADMI NO MUESTRE NADA...
        }
      ?>
      <a href="javascript: history.go(-1)" role="button" class="btn btn-primary">Volver</a>
    </div>
    <hr>
    <div class="text-center">
      <h1> Dispositivos de la Orden de Compra:</h1>
    </div>
  <div class="row" id="Vista2">
    <div class="col-md">
      <div class="section-box">
        <div class="table-responsive col-sm">
            <!-- DATATABLE DISPOSITIVOS EN BODEGA -->
            <table id="dueño" class="table table-responsive table-sm non-top-border" width="100%" cellspacing="0">
            <thead>
              <tr>                  
                <th>Codigo serial</th>
                <th>Activo</th>  
                <th>Marca</th>    
                <th>Tipo De Dispositivo</th>      
                <th>Bodega</th>  
                <th>Responsable</th>          
                <th>ASIGNAR</th>                   
              </tr>
            </thead>
            <tbody>
              <?php  
                //INNER JOIN contrato ON dispositivos.contrato_d = contrato.Nro_de_contrato
                //INNER JOIN orden_compra ON dispositivos.orden_compra = orden_compra.id_orden
                $query2="SELECT * FROM dispositivos
                INNER JOIN marca ON dispositivos.marca = marca.id_marca
                INNER JOIN tipo_dispositivo ON dispositivos.tipo_dispositivo = tipo_dispositivo.id_tipo_dispositivo 
                WHERE orden_compra  = '$id_orden'";
                $resultado2= $con->query($query2);
                while($mostrar=$resultado2->fetch_assoc()){
              ?>   
                <tr>
                <td><a id="hrefvistaDispo" href="Vista_Dispositivo.php?codigo_serial=<?php echo $mostrar['codigo_serial']?>"><?php echo $mostrar['codigo_serial'] ?></a></td>     
                  <td><?php echo $mostrar['activo'];?></td>
                  <td><?php echo $mostrar['nombre_marca'];?></td>
                  <td><?php echo $mostrar['Nombre_tipo_dispositivo'];?></td>   
                  <td><a id="hrefvistaBodega" href="Vista_Bodega.php?id_bodega=<?php echo $mostrar['bodega_disp_id']?>"><?php echo $mostrar['bodega_disp_id']?></a></td>  
                  <td><a id="hrefvistaResponsable" href="Vista_Responsable.php?cedula=<?php echo $mostrar['responsable']?>"><?php echo $mostrar['responsable']?></a></td>      
                  <td>
                  <?php 
                   
                   if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
                    // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE...

                    if ($mostrar['responsable'] === NULL){?>
                    <a href="asignar_dispositivo.php?codigo_serial=<?php echo $mostrar['codigo_serial']?>" name='asignar' class='btn btn-secondary'>Asignar Responsable</a>
                    <?php
                    }else{
                    ?>
                    <a href="asignar_bodega.php?codigo_serial=<?php echo $mostrar['codigo_serial']?>" name="asignar" class="btn btn-secondary">Enviar a Bodega</a>
                    <?php
                    }
                    
                  }else{
                       //SI NO TIENE ROL ADMI NO MUESTRE NADA...
                      }
                    ?>
                  </td>
                </tr>
              <?php
                }
              ?>   
            </tbody>
          </table>  
        </div>
      </div>
    </div>
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
      function preguntar(Nro_de_contrato)
      {
        if(confirm('¿Está seguro que desea eliminar el Contrato?'))
        {
          window.location.href = "Delete_Contrato.php?Nro_de_contrato="+Nro_de_contrato;
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