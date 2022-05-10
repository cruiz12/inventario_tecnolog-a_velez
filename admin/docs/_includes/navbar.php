<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light" style="background:#003D51">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color:#ffff"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block"></li>  
  </ul>
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->      
    <li class="nav-item">
      <a class="nav-link" style="color:#ffff" data-toggle="modal" data-target="#exitModal">
        <i class="icofont-exit" style="color:#ffff" aria-hidden="true"></i> Salir
      </a>
    </li>
  </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="color:white; background:#003D51">  
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../assets/img/mesadeayuda.jpg" rel="icon" class="brand-image img-circle elevation-3" style="opacity: .8">
      </div>
      <div class="info">
      <span class="brand-text font-weight-light" style="font-size:2.5vh"><?php echo $row['Apellidos_Usuario']?><br><?php echo $row['Nombre_Usuario']?></span>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">       
      <li class="nav-item ">
        <a href="Inicio.php" class="nav-link "  >
          <i class="nav-icon fa fa-sort"></i>
          <p>
            Inicio
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="Proveedor.php" class="nav-link">
          <i class="nav-icon fas fa-people-arrows"></i>
          <p>
            Proveedores       
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="bodega.php" class="nav-link " >
          <i class="nav-icon fas fa-warehouse"></i>
          <p>
            Bodegas         
          </p>
        </a>     
      </li>   
      <li class="nav-item">
      <!-- <a href="Dispositivos.php" class="nav-link active" onclick="alert('Actualmente te encuentras en la sección de Dispositivos')"> -->
        <a href="Dispositivos.php" class="nav-link">
          <i class="nav-icon fa fa-laptop"></i>
          <p>
            Dispositivos
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="Responsables.php" class="nav-link">
          <i class="nav-icon fa fa-users"></i>
          <p>
            Responsables
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="Contrato.php" class="nav-link">
          <i class="nav-icon fa fa-wpforms"></i>
          <p>
            Contratos
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="Orden_Compra.php" class="nav-link">
          <i class="nav-icon fa fa-shopping-bag"></i>
          <p>
            Orden de Compra
          </p>
        </a>
      </li>
<?php
      if($row['rol'] == 'Administrador' || $row['rol'] == 'SuperAdministrador'){
?>
      <li class="nav-item">
        <a href="Configuracion.php" class="nav-link">
          <i class="nav-icon fas fa-cogs"></i>
          <p>
            Configuración
          </p>
          <i class="fas fa-angle-left right"></i>
        </a>
        <hr>
        <ul class="nav nav-treeview">
        <?php
            if($row['rol'] != 'SuperAdministrador'){
            //SI NO TIIENE ROL SUPER ADMI NO MUESTRE NADA...
            }else{
           echo '
          <li class="nav-item">
            <a href="Administradores.php" class="nav-link">
              <i class="fas fa-user nav-icon"></i>
              <p>Cuentas admin</p>
            </a>
          </li>';
            }
          ?>
          <hr>
          <li class="nav-item">
            <a href="Marcas.php" class="nav-link">
              <i class="fas fa-unlock nav-icon"></i>
              <p>Marcas</p>
            </a>
          </li>
            <li class="nav-item">
            <a href="Tipo_dispositivos.php" class="nav-link">
              <i class="fas fa-unlock nav-icon"></i>
              <p>Tipos De Dispositivos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Modelos.php" class="nav-link">
              <i class="fas fa-unlock nav-icon"></i>
              <p>Modelos </p>
            </a>
          </li>
          <hr>
          <li class="nav-item">
            <a href="Paises.php" class="nav-link">
              <i class="fas fa-unlock nav-icon"></i>
              <p>Paises</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="Departamentos.php" class="nav-link">
              <i class="fas fa-unlock nav-icon"></i>
              <p>Departamentos</p>
            </a>
          </li>
           <li class="nav-item">
            <a href="Ciudades.php" class="nav-link">
              <i class="fas fa-unlock nav-icon"></i>
              <p>Ciudades</p>
            </a>
          </li>
        </ul>
        </ul>
         <?php
     }else{
     //SI NO TIIENE ROL ADMI NO MUESTRE NADA...
    }?>
      </li>
    </nav>
  </div>
</aside>
</div>
<!-- MODAL PARA CERRAR SESIÓN -->
<div class="modal fade" id="exitModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title" id="staticBackdropLabel" style="font-weight:bold">¿Desea salir?</h3>
    </div>
    <div class="modal-body">Presione "Cerrar Sesión" si desea salir.</div>
    <div class="modal-footer">
      <button class="btn btn-raised btn-secondary" type="button" data-dismiss="modal">Cancelar</button>&nbsp;
      <a class="btn btn-raised btn-danger" href="logout.php">Cerrar Sesión</a>
    </div>
  </div>
</div>
</div>