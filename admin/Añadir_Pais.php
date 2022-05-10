<?php 

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS */
if(isset($_POST['agregar_pais'])){

/* AQUI ATRAPAMOS LOS DATOS */  
$Nombre_pais = $_POST['nombre_pais'];

  /* AQUI CREAMOS Y EJECUTAMOS EL QUERY PARA INSERTAR EL NUEVO PAÍS */
  $query = "INSERT INTO paises (nombre_pais)
  VALUES ('$Nombre_pais')";
  $ResultadoAgregarPais = $con->query($query);


if($ResultadoAgregarPais){
  echo "<script>alert('El país $Nombre_pais se ha agregado satisfactoriamente');window.location='Paises.php'</script>";
}else{
  echo "<script>alert('Los datos no se han podido guardar correctamente');window.location='Paises.php'</script>";
}
}

?>