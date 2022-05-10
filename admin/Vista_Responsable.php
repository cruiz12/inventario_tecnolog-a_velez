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
      $cedula = $_REQUEST['cedula'];
      //CONSULTA TABLA BODEGA
      $query="SELECT * FROM responsables_dispositivos
      INNER JOIN areas ON responsables_dispositivos.area = areas.id_area WHERE cedula='$cedula'";
      $resultado= $con->query($query);
      $row2=$resultado->fetch_assoc();
    ?>
    <div class="text-center">
      <h1>Detalles De Responsable:  "<?php echo $row2['nombre_responsable']; ?>"</h1>
    </div>
  <div class="row" id="Vista">
    <div class="col-md">
      <div class="section-box">
        <div class="table-responsive col-sm">
          <table class="table table-sm  non-top-border">
            <tbody>
              <tr>
                <th>Cédula :</th>
                <td> <?php echo $row2['cedula']; ?></td>
              </tr>
              <tr>
                <th>Nombre:</th>    
                <td><?php echo $row2['nombre_responsable']; ?></td> 
              </tr>
              <tr>
                <th>Area :</th>
                <td><?php echo $row2['nombre_area']; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>             
    </div>
  </div>
    <div class="botones">
      <a href="javascript: history.go(-1)" role="button" class="btn btn-primary">Volver</a>
    </div>
    <hr>
    <div class="text-center">
      <h2>Dispositivos De Responsable: "<?php echo $row2['nombre_responsable']; ?>" </h2>
    </div>
  <div class="row" id="Vista2">
    <div class="col-md">
      <div class="section-box">
        <div class="table-responsive col-sm">
            <!-- DATATABLE DISPOSITIVOS EN BODEGA -->
            <table id="dueño" class="table table-responsive table-sm non-top-border" width="100%" cellspacing="0">
            <thead>
              <tr>                  
                <th>Codigo_serial</th>
                <th>Activo</th>  
                <th>Marca</th>    
                <th>Tipo_De_Dispositivo</th>             
                <th>Orden_De_Compra</th>  
                <th>Contrato</th>
                <?php   
                if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
                // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE...?>
                <th>ACCIONES</th>
              <?php
              }else{
              // SI NO TIENE ROL ADMIN NO MUESTRE NADA
              }
              ?>                 
              </tr>
            </thead>
            <tbody>
              <?php  
               
                $query2="SELECT * FROM dispositivos
                INNER JOIN marca ON dispositivos.marca = marca.id_marca
                INNER JOIN tipo_dispositivo ON dispositivos.tipo_dispositivo = tipo_dispositivo.id_tipo_dispositivo
                WHERE responsable = $cedula";
                $resultado2= $con->query($query2);
                while($mostrar=$resultado2->fetch_assoc()){
              ?>   
                <tr>
                <td><a id="hrefvistaDispo" href="Vista_Dispositivo.php?codigo_serial=<?php echo $mostrar['codigo_serial']?>"><?php echo $mostrar['codigo_serial'] ?></a></td>     
                  <td><?php echo $mostrar['activo'];?></td>
                  <td><?php echo $mostrar['nombre_marca'];?></td>   
                  <td><?php echo $mostrar['Nombre_tipo_dispositivo'];?></td>       
                  <td><a id="hrefvistaOrden" href="Vista_Orden_Compra.php?id_orden=<?php echo $mostrar['orden_compra']?>"><?php echo $mostrar['orden_compra']?></a></td>
                  <td><a id="hrefvistaContrato" href="Vista_Contrato.php?Nro_de_contrato=<?php echo $mostrar['contrato_d']?>"><?php echo $mostrar['contrato_d']; ?></td>
                 <?php
                  if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
                  // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE...?>
                  <td>
                    <a href="asignar_bodega.php?codigo_serial=<?php echo $mostrar['codigo_serial']?>" name="asignar" class="btn btn-success">Enviar a bodega</a>
                  </td>
                 <?php
                    }else{
                    // SI NO TIENE ROL ADMIN NO MUESTRE NADA
                    }
                    ?>
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
	$(document).ready(function(){
		$('#controlBuscador').select2({ dropdownParent: "#staticBackdrop" });
	});
</script>


</body>