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
      $id_bodega = $_REQUEST['id_bodega'];
      //CONSULTA TABLA BODEGA
      $query="SELECT * FROM bodega
      INNER JOIN paises ON bodega.pais_b = paises.idPais
      INNER JOIN departamento ON bodega.departamento_b = departamento.idDepartamento
      INNER JOIN ciudades ON bodega.ciudad_b = ciudades.idCiudad WHERE id_bodega='$id_bodega'";
      $resultado= $con->query($query);
      $row2=$resultado->fetch_assoc();
    ?>
    <div class="text-center">
      <h1>Detalles De Bodega:  "<?php echo $row2['nombre_bodega']; ?>"</h1>
    </div>
  <div class="row" id="Vista">
    <div class="col-md">
      <div class="section-box">
        <div class="table-responsive col-sm">
          <table class="table table-sm  non-top-border">
            <tbody>
              <tr>
                <th>ID :</th>
                <td> <?php echo $row2['id_bodega']; ?></td>
              </tr>
              <tr>
                <th>Nombre :</th>    
                <td><?php echo $row2['nombre_bodega']; ?></td> 
              </tr>
              <tr>
                <th>Pais :</th>
                <td><?php echo $row2['nombre_pais']; ?></td>
              </tr>
              <tr>
                <th>Departamento :</th>
                <td><?php echo $row2['nombre_departamento']; ?></td>
              </tr>
              <tr>
                <th>Ciudad :</th>
                <td><?php echo $row2['nombre_ciudad']; ?></td>
              </tr>
              <tr>
                <th>Dirección :</th>
                <td><?php echo $row2['direccion']; ?></td>
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
      <a href="Edit_Bodega.php?id_bodega=<?php echo $row2['id_bodega']?>" class="btn btn-success">Editar</a>
      <a href="#" onclick="preguntar(<?php echo $row2['id_bodega']?>)" class="btn btn-danger">Eliminar</a>
      <?php
    }else{
      //SI NO TIENE ROL ADMI NO MUESTRE NADA...
    }
    ?>
      <a href="javascript: history.go(-1)" role="button" class="btn btn-primary">Volver</a>
    </div>
    <hr>
    <div class="text-center">
      <h1> Dispositivos En Bodega:</h1>
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
                <th>Tipo_De_Dispositivo</th>     
                <th>Marca</th>   
                <th>Modelo</th>    
                <th>Bodega</th>           
                <th>Orden_De_Compra</th>   
                <th>Numero_De_Contrato</th>  
         <?php
            if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
              // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
                <th>ASIGNAR</th>
         <?php
          }else{
          //SI NO TIENE ROL ADMI NO MUESTRE NADA...
         }
          ?>                   
              </tr>
            </thead>
            <tbody>
              <?php  
                //INNER JOIN contrato ON dispositivos.contrato_d = contrato.Nro_de_contrato
                //INNER JOIN orden_compra ON dispositivos.orden_compra = orden_compra.id_orden
                $query2="SELECT * FROM dispositivos
                INNER JOIN marca ON dispositivos.marca = marca.id_marca
                INNER JOIN modelo ON dispositivos.modelo = modelo.id_modelo
                INNER JOIN tipo_dispositivo ON dispositivos.tipo_dispositivo = tipo_dispositivo.id_tipo_dispositivo
                INNER JOIN bodega ON dispositivos.bodega_disp_id = bodega.id_bodega
                WHERE bodega_disp_id = '$id_bodega'";
                $resultado2= $con->query($query2);
                while($mostrar=$resultado2->fetch_assoc()){
              ?>   
                <tr>
                <td><a id="hrefvistaDispo" href="Vista_Dispositivo.php?codigo_serial=<?php echo $mostrar['codigo_serial']?>"><?php echo $mostrar['codigo_serial'] ?></a></td>     
                  <td><?php echo $mostrar['activo'];?></td>
                  <td><?php echo $mostrar['Nombre_tipo_dispositivo'];?></td>  
                  <td><?php echo $mostrar['nombre_marca'];?></td>
                  <td><?php echo $mostrar['codigo_modelo']; ?></td> 
                  <td><?php echo $mostrar['nombre_bodega'];?></td>   
                  <td><a id="hrefvistaOrden" href="Vista_Orden_Compra.php?id_orden=<?php echo $mostrar['orden_compra']?>"><?php echo $mostrar['orden_compra']?></a></td>
                  <td><a id="hrefvistaOrden" href="Vista_Contrato.php?Nro_de_contrato=<?php echo $mostrar['contrato_d']?>"><?php echo $mostrar['contrato_d']?></a></td>                 
            <?php
              if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
                // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
                  <td>
                    <a href="asignar_dispositivo.php?codigo_serial=<?php echo $mostrar['codigo_serial']?>" name="asignar" class="btn btn-success">Asignar Responsable</a>
                  </td>
            <?php
               }else{
               //SI NO TIENE ROL ADMI NO MUESTRE NADA...
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
        if(confirm('¿Está seguro que desea eliminar la Bodega?'))
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