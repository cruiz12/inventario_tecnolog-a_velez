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
   <div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="../assets/img/LogoCuerosVélez.jpg" alt="Casme Logo" height="120px" width="160px">
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
      $Nro_de_contrato = $_REQUEST['Nro_de_contrato'];
      //CONSULTA TABLA DISPOSITIVOS
      $query="SELECT * FROM contrato 
      INNER JOIN proveedor ON contrato.Proveedor = proveedor.nit
      WHERE Nro_de_contrato='$Nro_de_contrato'";
      $resultado= $con->query($query);
      $row2=$resultado->fetch_assoc();
    ?>
    <div class="text-center">
      <h1>Detalles del contrato número: "<?php echo $row2['Nro_de_contrato']; ?>"</h1>
    </div>
  <div class="row" id="Vista">
    <div class="col-md">
      <div class="section-box">
        <div class="table-responsive col-sm">
          <table class="table table-sm  non-top-border">
            <tbody>
              <tr>
                <th>Número de Contrato:</th>
                <td> <?php echo $row2['Nro_de_contrato']; ?></td>
              </tr>
              <tr>
                <th>Proveedor:</th>    
                <td><a id="hrefvistaProveedor" href="Vista_Proveedor.php?nit=<?php echo $row2['nit']?>"><?php echo $row2['razon_social']?></a></td>
              </tr>
              <tr>
                <th>Fecha de Inicio:</th>
                <td><?php echo $row2['Fecha_de_inicio']; ?></td>
              </tr>
              <tr>
                <th>Fecha de finalización:</th>
                <td><?php echo $row2['Fecha_fin']; ?></td>
              </tr>
              <tr>
                <th>Pdf</th>
                <td>  <a class="btn btn-dark" target="_black" href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/inventario_tecnolog-a_velez/admin/' . $row2['ruta_pdf']; ?>" ><i class="icofont-file-pdf"></i></a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>             
    </div>
  </div>
  <div class="modal fade" id="modalPdf" tabindex="-1" aria-labelledby="modalPdf" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ver Factura</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe id="iframePDF" frameborder="0" scrolling="no" width="100%" height="500px"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
     </div>
    <div class="botones">
    <?php
    if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
      // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
      <a href="Edit_Contrato.php?Nro_de_contrato=<?php echo $row2['Nro_de_contrato']?>" class="btn btn-success">Editar</a>
      <a href="#" onclick="preguntar(<?php echo $row2['Nro_de_contrato']?>)" class="btn btn-danger">Eliminar</a>
      <button class="btn-add-mascota" style="background:#55565a;" id="ModalEnsayo" data-toggle="modal" data-target="#staticBackdrop">Añadir
        Factura</button>
      <?php
      }else{
         //SI NO TIENE ROL ADMI NO MUESTRE NADA...
      }
      ?>
      <a href="javascript: history.go(-1)" role="button" class="btn btn-primary">Volver</a>
    </div>

    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">Añadir Contrato</h3>
          </div>
          <form action="multipart/form-data" id="formpdf" method="POST">
           <div class="form-group" style="display:none;">
              <input type="text" name="Nro_de_contrato" value="<?php echo $row2['Nro_de_contrato']; ?>" class="form-control" placeholder="Número de Factura" autofocus>
            </div>
            <div class="form-group">
              <label for="Nro_de_factura">Número de Factura:</label>
              <input type="text" name="Nro_factura" class="form-control" placeholder="Número de Factura" autofocus>
            </div>
            <div class="form-group">
              <label for="description">PDF del contrato:</label>
              <input type="file" class="form-control" id="file" name="file" placeholder="Pdf del contrato (Archivo)">
            </div>
            <div class="modal-footer">
              <input type="button"  class="btn btn-success"  onclick="onSubmitForm()" value="Agregar">
              <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
   
    <hr> 
    <div class="text-center">
      <h1> Dispositivos del Contrato:</h1>
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
                <th>Responsable</th>     
                <?php
    if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
      // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>     
                <th>ASIGNAR</th>      
                <?php
      }else{
        //SI NO TIENE ROL ADMI NO MUESTRE NADA...
       echo "<th></th>";
      }
    ?> 
              </tr>
            </thead>
            <tbody>
              <?php  
                //INNER JOIN contrato ON dispositivos.contrato_d = contrato.Nro_de_contrato
                $query2="SELECT * FROM dispositivos
                INNER JOIN marca ON dispositivos.marca = marca.id_marca
                INNER JOIN modelo ON dispositivos.modelo = modelo.id_modelo
                INNER JOIN tipo_dispositivo ON dispositivos.tipo_dispositivo = tipo_dispositivo.id_tipo_dispositivo 
                WHERE contrato_d = '$Nro_de_contrato'";
                $resultado2= $con->query($query2);
                while($mostrar=$resultado2->fetch_assoc()){
              ?>   
                <tr>
                <td><a id="hrefvistaDispo" href="Vista_Dispositivo.php?codigo_serial=<?php echo $mostrar['codigo_serial']?>"><?php echo $mostrar['codigo_serial'] ?></a></td>     
                  <td><?php echo $mostrar['activo'];?></td>
                  <td><?php echo $mostrar['Nombre_tipo_dispositivo'];?></td>  
                  <td><?php echo $mostrar['nombre_marca'];?></td>
                  <td><?php echo $mostrar['codigo_modelo'];?></td>
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
  <hr>
    <div class="text-center">
      <h1> Facturas del Contrato:</h1>
    </div>
    <div class="row" id="Vista2">
    <div class="col-md">
      <div class="section-box">
        <div class="table-responsive col-sm">
            <table id="dueño" class="table table-responsive table-sm non-top-border" width="100%" cellspacing="0">
            <thead>
              <tr>                  
                <th>Número de Factura</th>
                <th>Pdf</th>
                <th>Eliminar</th>                     
              </tr>
            </thead>
            <tbody>
              <?php  
                $query3="SELECT * FROM factura_pdf
                WHERE Nro_contrato_f  = '$Nro_de_contrato'";
                $resultado3= $con->query($query3);
                while($mostrar3=$resultado3->fetch_assoc()){
              ?>   
                <tr>
                  <td><?php echo $mostrar3['Nro_factura'] ?></td>     
                  <td><button onclick="openModelPDF('<?php echo $mostrar3['ruta_fac_contrato'] ?>')" class="btn btn-dark" type="button"><i class="icofont-file-pdf"></i></button></td>
               <td><a href="#" onclick="preguntar2(<?php echo $mostrar3['Nro_factura']?>)" title="Eliminar Factura del contrato" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a></td>
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
<script type="text/javascript">
      function preguntar2(Nro_factura)
      {
        if(confirm('¿Está seguro que desea eliminar la Factura del contrato?'))
        {
          window.location.href = "Delete_Factura.php?Nro_factura="+Nro_factura;
        }
      }
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador').select2({ dropdownParent: "#staticBackdrop" });
	});
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script>
                            function onSubmitForm() {
                                var frm = document.getElementById('formpdf');
                                var data = new FormData(frm);
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function () {
                                    if (this.readyState == 4) {
                                        var msg = xhttp.responseText;
                                        if (msg == 'success') {
                                            alert(msg);
                                            location.reload();
                                         
                                        } else {
                                            alert(msg);
                                            //$('#staticBackdrop').modal('hide');
                                            location.reload();
                                        }

                                    }
                                };
                                xhttp.open("POST", "Añadir_Factura.php", true);
                                xhttp.send(data);
                                $('#formpdf').trigger('reset');
                               
                                
                            }
                            function openModelPDF(url) {
                                $('#modalPdf').modal('show');
                                $('#iframePDF').attr('src','<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/inventario_tecnolog-a_velez/admin/'; ?>'+url);
                            }
        </script>


</body>