<?php 

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS */
if(isset($_POST['agregar_tipo'])){

/* AQUI ATRAPAMOS LOS DATOS */  
$Nombre_tipo = $_POST['nombre_tipo'];

  /* AQUI CREAMOS Y EJECUTAMOS EL QUERY PARA INSERTAR EL NUEVO TIPO DE DISPOSITIVO */
  $query = "INSERT INTO tipo_dispositivo (nombre_tipo_dispositivo)
  VALUES ('$Nombre_tipo')";
  $ResultadoAgregarTipo = $con->query($query);

if($ResultadoAgregarTipo){
  echo "<script>alert('El tipo de dispositivo ($Nombre_tipo) se ha agregado satisfactoriamente');window.location='Tipo_Dispositivos.php'</script>";
}else{
  echo "<script>alert('Los datos no se han podido guardar correctamente');window.location='Tipo_Dispositivos.php'</script>";
}
}

?>