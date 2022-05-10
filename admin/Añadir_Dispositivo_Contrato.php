<?php

include('DB/conexion.php');
/* CONDICIÓN: SI LE DAN AL BOTÓN AGREGAR DISPOSITIVO(CONTRATO)...Y SI NO HAY CAMPOS VACIOS*/

if (isset($_POST['Agregar_Dispositivo_Contrato']) && !empty($_POST['codigo_serial']) && !empty($_POST['activo']) && !empty($_POST['marca']) && !empty($_POST['tipo_dispositivo']) && !empty($_POST['bodega'])&& !empty($_POST['contrato'])&& !empty($_POST['modelo2'])) {

  /* AQUI SE ATRAPAN LOS DATOS DEL FORMULARIO (DISPOSITIVO CON CONTRATO) */

  $Codigo_Serial = $_POST['codigo_serial'];
  $Activo = $_POST['activo'];
  $Marca = $_POST['marca'];
  $Tipo_Dispositivo = $_POST['tipo_dispositivo'];
  $Modelo = $_POST['modelo2'];
  $Bodega = $_POST['bodega'];
  $Contrato = $_POST['contrato'];

  /* AQUI CREAMOS Y EJECUTAMOS EL QUERY PARA INSERTAR EL NUEVO DISPOSITIVO */
  $query = "INSERT INTO dispositivos(codigo_serial, activo, marca, modelo, tipo_dispositivo, bodega_disp_id, contrato_d) 
  VALUES ('$Codigo_Serial','$Activo','$Marca','$Modelo','$Tipo_Dispositivo','$Bodega','$Contrato')";
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
