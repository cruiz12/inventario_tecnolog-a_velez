<?php

include('DB/conexion.php');
/* CONDICIÓN: SI LE DAN AL BOTÓN AGREGAR DISPOSITIVO(ORDEN DE COMPRA)...Y SI NO HAY CAMPOS VACIOS*/
if (isset($_POST['Agregar_Dispositivo_Orden']) && !empty($_POST['codigo_serial']) && !empty($_POST['activo']) && !empty($_POST['marca']) && !empty($_POST['tipo_dispositivo']) && !empty($_POST['bodega'])&& !empty($_POST['orden_compra'])&& !empty($_POST['modelo'])) {

  /* AQUI SE ATRAPAN LOS DATOS DEL FORMULARIO (DISPOSITIVO CON ORDEN DE COMPRA) */

  $Codigo_Serial = $_POST['codigo_serial'];
  $Activo = $_POST['activo'];
  $Marca = $_POST['marca'];
  $Tipo_Dispositivo = $_POST['tipo_dispositivo'];
  $Modelo = $_POST['modelo'];
  $Bodega = $_POST['bodega'];
  $Orden_Compra = $_POST['orden_compra'];

  /* AQUI CREAMOS Y EJECUTAMOS EL QUERY PARA INSERTAR EL NUEVO DISPOSITIVO */
  $query = "INSERT INTO dispositivos(codigo_serial, activo, marca, modelo, tipo_dispositivo, bodega_disp_id, orden_compra) 
  VALUES ('$Codigo_Serial','$Activo','$Marca','$Modelo','$Tipo_Dispositivo','$Bodega','$Orden_Compra')";
  $ResultadoInsertDispositivo = mysqli_query($con, $query);
  

  if($ResultadoInsertDispositivo){
    echo "<script>alert('El dispositivo $Codigo_Serial se ha agregado satisfactoriamente');window.location='Dispositivos.php'</script>";
    }else{
      echo "<script>alert('los datos no se han podido guardar correctamente');window.location='Dispositivos.php'</script>";
    }  
}else{
  echo "<script>alert('Completa todos los campos del formulario');window.location='Dispositivos.php'</script>";
exit;}


?>
