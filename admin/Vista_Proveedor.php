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
   <?php
    include("docs/_includes/preloader.html");
    ?>
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
      $nit = $_REQUEST['nit'];
      $query="SELECT * FROM proveedor WHERE nit = $nit";
        $resultado= $con->query($query);
        $row2=$resultado->fetch_assoc();
      ?>
    <div class="text-center">
      <h1>Detalles de Proveedor: "<?php echo $row2['razon_social']; ?>"</h1>
    </div>
    <div class="row" id="Vista">
      <div class="col-md">
        <div class="section-box">
          <div class="table-responsive col-sm">
            <table class="table table-sm  non-top-border">
              <tbody>
                <tr>
                  <th>Nit</th>
                  <td>
                    <?php echo $row2['nit']; ?>
                  </td>
                </tr>
                <tr>
                  <th>Razón Social</th>
                  <td>
                    <?php echo $row2['razon_social']; ?>
                  </td>
                </tr>
                <tr>
                  <th>Comercial</th>
                  <td>
                    <?php echo $row2['comercial']; ?>
                  </td>
                </tr>
                <tr>
                  <th>Telefono</th>
                  <td>
                    <a href="tel:<?php echo $row2['Telefono']; ?>"><?php echo $row2['Telefono']; ?></a>
                  </td>
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
      <a href="Edit_Proveedor.php?nit=<?php echo $row2['nit']?>" class="btn btn-success">Editar</a>
      <a href="#" onclick="preguntar(<?php echo $row2['nit']?>)" class="btn btn-danger">Eliminar</a>
      <?php
    }else{
      //SI NO TIENE ROL ADMI NO MUESTRE NADA...
    }
    ?>
      <a href="javascript: history.go(-1)" role="button" class="btn btn-primary">Volver</a>
    </div>
    <hr>
    <div class="text-center">
      <h1> Contratos del proveedor:</h1>
    </div>
    <div class="row" id="Vista2">
      <div class="col-md">
        <div class="section-box">
          <div class="table-responsive col-sm">
            <!-- DATATABLE CONTRATOS DE PROVEEDOR -->
            <table id="dueño" class="table table-responsive table-sm non-top-border" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Numero_de_contrato</th>
                  <th>Proveedor</th>
                  <th>Fecha_de_inicio</th>
                  <th>Fecha_fin</th>
                  <th>DETALLES</th>
                </tr>
              </thead>
              <tbody>
                <?php  
                $query2="SELECT * FROM contrato
                WHERE Proveedor = '$nit'";
                $resultado2= $con->query($query2);
                while($mostrar=$resultado2->fetch_assoc()){
              ?>
                <tr>
                  <td><a id="hrefvistaContrato"
                      href="Vista_Contrato.php?Nro_de_contrato=<?php echo $mostrar['Nro_de_contrato']?>"><?php echo $mostrar['Nro_de_contrato'] ?></a>
                  </td>
                  <td><?php echo $mostrar['Proveedor'];?></td>
                  <td><?php echo $mostrar['Fecha_de_inicio'];?></td>
                  <td><?php echo $mostrar['Fecha_fin'];?></td>
                  <td>
                    <a href="Vista_Contrato.php?Nro_de_contrato=<?php echo $mostrar['Nro_de_contrato']?>" title="Ver detalles de Contrato" class="btn btn-primary">
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
      </div>
    </div>
  </div>
  <!-- PIE DE PÁGINA -->
<?php 
    include("docs/_includes/footer.php");
?>
  <script>
    $(document).ready(function () {
      $('#dueño').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        }
      });
    });
  </script>
  <script type="text/javascript">
    function preguntar(nit) {
      if (confirm('¿Estás seguro que quieres eliminar este Proveedor?')) {
        window.location.href = "Delete_Proveedor.php?nit=" + nit;
      }
    }
  </script>
  <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
</body>