<?php
// error_reporting(0);
date_default_timezone_set('America/Bogota');
require_once ('conn.model.php');
require_once ('manage.model.php');

$accion = $_REQUEST["action"];
if ($accion == null) {
      header("Location:../login.php");
    };
echo $accion;
switch ($accion) {
  case 'LOG':
  session_start();
    $hora = date('h:i:s A');
    $fecha = date('d/m/Y');
    $username = $_REQUEST['usuario'];
    try {

      $_SESSION['loggedin'] = TRUE;
	    $_SESSION['name'] = $username;
      echo "<script>location.href='../admin/Inicio.php'</script>";
      
		} catch (Exception $e) {
			echo $e;
		}

    break;
}
 ?>
