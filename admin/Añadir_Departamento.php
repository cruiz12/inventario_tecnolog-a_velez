<?php 

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS */
if(isset($_POST['agregar_departamento'])){

/* AQUI ATRAPAMOS LOS DATOS */  
$Nombre_departamento = $_POST['nombre_departamento'];
$Pais= $_POST['pais'];

  /* AQUI CREAMOS Y EJECUTAMOS EL QUERY PARA INSERTAR LA NUEVA CIUDAD */
  $query = "INSERT INTO departamento (nombre_departamento,pais)
  VALUES ('$Nombre_departamento','$Pais')";
  $ResultadoAgregarDepartamento = $con->query($query);

if($ResultadoAgregarDepartamento){
  echo "<script>alert('El departamento ($Nombre_departamento) se ha agregado satisfactoriamente');window.location='Departamentos.php'</script>";
}else{
  echo "<script>alert('Los datos no se han podido guardar correctamente');window.location='Departamentos.php'</script>";
}
}

?>