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
      $codigo_serial = $_REQUEST['codigo_serial'];
      //CONSULTA TABLA DISPOSITIVOS
      $query="SELECT * FROM dispositivos
      INNER JOIN marca ON dispositivos.marca = marca.id_marca
      INNER JOIN modelo ON dispositivos.modelo = modelo.id_modelo
      INNER JOIN tipo_dispositivo ON dispositivos.tipo_dispositivo = tipo_dispositivo.id_tipo_dispositivo
      WHERE codigo_serial='$codigo_serial'";
      $resultado= $con->query($query);
      $row2=$resultado->fetch_assoc();
      $hoy = getdate();
    ?>
    <div class="text-center">
      <h1>Detalles Del Dispositivo: "<?php echo $row2['codigo_serial']; ?>"</h1>
    </div>
  <div class="row" id="Vista">
    <div class="col-md">
      <div class="section-box">
        <div class="table-responsive col-sm">
          <table class="table table-sm  non-top-border">
            <tbody>
              <tr>
                <th>Codigo Serial:</th>
                <td> <?php echo $row2['codigo_serial']; ?></td>
              </tr>
              <tr>
                <th>Activo:</th>    
                <td><?php echo $row2['activo']; ?></td> 
              </tr>
              <tr>
                <th>Tipo Dispositivo:</th>
                <td><?php echo $row2['Nombre_tipo_dispositivo']; ?></td>
              </tr>
              <tr>
                <th>Marca:</th>
                <td><?php echo $row2['nombre_marca']; ?></td>
              </tr>
              <tr>
                <th>Modelo:</th>
                <td><?php echo $row2['codigo_modelo']; ?></td>
              </tr>
              <tr>
                <th>Bodega:</th>
                <td><a id="hrefvistaBodega" href="Vista_Bodega.php?id_bodega=<?php echo $row2['bodega_disp_id']?>"><?php echo $row2['bodega_disp_id']?></a></td>
              </tr>
              <tr>
                <th>Responsable:</th>
                <td><a id="hrefvistaResponsable" href="Vista_Responsable.php?cedula=<?php echo $row2['responsable']?>"><?php echo $row2['responsable']?></a></td>
              </tr>
              <tr>
                <th>Orden De Compra:</th>
                <td><a id="hrefvistaOrden" href="Vista_Orden_Compra.php?id_orden=<?php echo $row2['orden_compra']?>"><?php echo $row2['orden_compra']; ?></td>
              </tr>
              <tr>
                <th>Contrato:</th>
                <td><a id="hrefvistaContrato" href="Vista_Contrato.php?Nro_de_contrato=<?php echo $row2['contrato_d']?>"><?php echo $row2['contrato_d']; ?></td>
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
      // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
      <a href="Edit_Dispositivo.php?codigo_serial=<?php echo $row2['codigo_serial']?>" name="update" class="btn btn-success">Editar</a>
      <a href="#" onclick="preguntar(<?php echo $row2['codigo_serial']?>)" class="btn btn-danger">Eliminar</a>
    <?php 
      if ($row2['responsable'] === NULL){?>
     <a href="asignar_dispositivo.php?codigo_serial=<?php echo $row2['codigo_serial']?>" name='asignar' class='btn btn-secondary'>Asignar Responsable</a>
     <?php
      }else{
    ?>
      <a href="asignar_bodega.php?codigo_serial=<?php echo $row2['codigo_serial']?>" name="asignar" class="btn btn-secondary">Enviar a Bodega</a>
     <?php
      }
      ?>
    <?php
    }else{
      //SI NO TIENE ROL ADMI NO MUESTRE NADA...
    }
    ?>
    <a href="javascript: history.go(-1)" role="button" class="btn btn-primary">Volver</a>
    </div>  
    <hr>
    <div class="text-center">
      <h1>Historial Responsables Del Dispositivo:</h1>
    </div>
  <div class="row" id="Vista2">
    <div class="col-md">
      <div class="section-box">
        <div class="table-responsive col-sm">
            <!-- DATATABLE DISPOSITIVOS EN BODEGA -->
            <table id="dueño" class="table table-responsive table-sm non-top-border" width="100%" cellspacing="0">
            <thead>
              <tr>                  
                <th>Responsable Dispositivo</th>          
                <th>Fecha de asignación</th>
                <th>Fecha de devolución</th> 
                <th>Responsable Entrega</th>
                <th>Responsable devolución</th>             
              </tr>
            </thead>
            <tbody>
              <?php  
                //INNER JOIN contrato ON dispositivos.contrato_d = contrato.Nro_de_contrato
                //INNER JOIN orden_compra ON dispositivos.orden_compra = orden_compra.id_orden
                $query2="SELECT * FROM historial_dispositivo
                WHERE codigo_serial_h = '$codigo_serial'";
                $resultado2= $con->query($query2);
                while($mostrar=$resultado2->fetch_assoc()){
              ?>   
                <tr>
                  <td><a id="hrefvistaResponsable" href="Vista_Responsable.php?cedula=<?php echo $mostrar['responsable_h']?>"><?php echo $mostrar['responsable_h']?></a></td>      
                  <td><?php echo $mostrar['fecha_toma'];?></td>
                  <td><?php echo $mostrar['fecha_entrega'];?></td>
                  <td><?php echo $mostrar['responsable_entrega'];?></td>
                  <td><?php echo $mostrar['responsable_devuelta'];?></td>
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


<script type="text/javascript">
      function preguntar(codigo_serial)
      {
        if(confirm('¿Está seguro que desea eliminar el dispositivo?'))
        {
          window.location.href = "Delete_Dispositivo.php?codigo_serial="+codigo_serial;
        }
      }
</script>

<script type="text/javascript">
      function preguntar2(responsable_h)
      {
        if(confirm('¿Está seguro que desea eliminar el Responsable del Historial?'))
        {
          window.location.href = "Delete_Historial.php?responsable="+responsable_h;
        }
      }
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador').select2({ dropdownParent: "#staticBackdrop" });
	});
</script>

<script> $(document).ready(function() {
    $('#dueño').DataTable( {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        }
    } );
} );
</script>

</body>