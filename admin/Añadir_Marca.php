<?php 

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS */
if(isset($_POST['agregar_marca'])){

/* AQUI ATRAPAMOS LOS DATOS */  
$Nombre_marca = $_POST['nombre_marca'];

  /* AQUI CREAMOS Y EJECUTAMOS EL QUERY PARA INSERTAR LA NUEVA CIUDAD */
  $query = "INSERT INTO marca (nombre_marca)
  VALUES ('$Nombre_marca')";
  $ResultadoAgregarMarca = $con->query($query);

if($ResultadoAgregarMarca){
  echo "<script>alert('La marca ($Nombre_marca) se ha agregado satisfactoriamente');window.location='Marcas.php'</script>";
}else{
  echo "<script>alert('Los datos no se han podido guardar correctamente');window.location='Marcas.php'</script>";
}
}

?>