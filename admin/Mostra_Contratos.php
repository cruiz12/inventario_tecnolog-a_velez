<?php
// Solo se permite el ingreso con el inicio de sesion.
session_start();
require_once("ConectarBD_Mysql.php");

// --- VALIDACIÓN SESSION-----
include("Session.php");
?>
<table id="dueño" class="table table-responsive table-sm non-top-border dt-responsive" cellspacing="0">
 <thead>
          <tr>
            <th>Número de Contrato</th>
            <th>Proveedor</th>
            <th>Fecha de inicio</th>
            <th>Fecha de finalización</th>
            <th>Número de dispositivos</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
<?php 

include('DB/conexion.php');


/* AQUI SE CREA Y SE EJECUTA EL QUERY QUE SELECIONA LA LISTA DE PENDIENTES PARA MOSTRAR ESOS DATOS*/
$sql = "SELECT * FROM contrato 
INNER JOIN proveedor ON contrato.Proveedor = proveedor.nit";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($mostrar = mysqli_fetch_assoc($result)) {

$Nro_de_contrato = $mostrar['Nro_de_contrato'];     

$sql2 = "SELECT * FROM dispositivos
WHERE contrato_d = '$Nro_de_contrato'";
$result2 = mysqli_query($con, $sql2);

?>
<tr>
            <td><a id="hrefvista"
                href="Vista_Contrato.php?Nro_de_contrato=<?php echo $mostrar['Nro_de_contrato']?>"><?php echo $mostrar['Nro_de_contrato'] ?></a>
            </td>
            <td><a id="hrefvista"
                href="Vista_Proveedor.php?nit=<?php echo $mostrar['nit']?>"><?php echo $mostrar['razon_social'] ?></a>
            </td>
            <td><?php echo $mostrar['Fecha_de_inicio']?></td>
            <td><?php echo $mostrar['Fecha_fin']?></td>
            <td><a id="hrefvista"
                href="Vista_Contrato.php?Nro_de_contrato=<?php echo $mostrar['Nro_de_contrato']?>"><?php echo mysqli_num_rows($result2); ?></a>
            </td>
            <td>
            <?php
    if($row['rol'] == 'SuperAdministrador' || $row['rol'] == 'Administrador'){
      // SI TIENE ROL ADMIN O SUPERADMIN MUESTRE... ?>
              <a href="Edit_Contrato.php?Nro_de_contrato=<?php echo $mostrar['Nro_de_contrato']?>"
                title="Editar contrato" class="btn btn-secondary">
                <i class="icofont-ui-edit"></i>
              </a>
              <a href="#" onclick="preguntar(<?php echo $mostrar['Nro_de_contrato']?>)" title="Eliminar contrato"
                class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
              <?php
              }else{
                 //SI NO TIENE ROL ADMI NO MUESTRE NADA...
              }
              ?>
              <a href="Vista_Contrato.php?Nro_de_contrato=<?php echo $mostrar['Nro_de_contrato']?>"
                title="Ver detalles del contrato" class="btn btn-info">
                <i class="icofont-eye-alt"></i>
              </a>
            </td>
          </tr>
          <?php
          } 
        }
        ?>
 </tbody>
 </table>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#dueño').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        }
      });
    });
  </script>
