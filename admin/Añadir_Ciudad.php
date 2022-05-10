<?php 

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS */
if(isset($_POST['agregar_ciudad'])){

/* AQUI ATRAPAMOS LOS DATOS */  
$Nombre_ciudad = $_POST['nombre_ciudad'];
$Departamento= $_POST['departamento'];

  /* AQUI CREAMOS Y EJECUTAMOS EL QUERY PARA INSERTAR LA NUEVA CIUDAD */
  $query = "INSERT INTO ciudades (nombre_ciudad,departamento)
  VALUES ('$Nombre_ciudad','$Departamento')";
  $ResultadoAgregarCiudad = $con->query($query);


if($ResultadoAgregarCiudad){
  echo "<script>alert('La ciudad $Nombre_ciudad se ha agregado satisfactoriamente');window.location='Ciudades.php'</script>";
}else{
  echo "<script>alert('Los datos no se han podido guardar correctamente');window.location='Ciudades.php'</script>";
}
}

?>