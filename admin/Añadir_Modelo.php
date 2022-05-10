<?php 

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS */
if(isset($_POST['agregar_modelo'])){

/* AQUI ATRAPAMOS LOS DATOS */  
$codigo_modelo = $_POST['codigo_modelo'];
$id_marca = $_POST['marca'];
  /* AQUI CREAMOS Y EJECUTAMOS EL QUERY PARA INSERTAR LA NUEVA CIUDAD */
  $query = "INSERT INTO modelo (codigo_modelo,marca_m)
  VALUES ('$codigo_modelo','$id_marca')";
  $ResultadoAgregarModelo = $con->query($query);

if($ResultadoAgregarModelo){
  echo "<script>alert('El modelo ($codigo_modelo) se ha agregado satisfactoriamente');window.location='Modelos.php'</script>";
}else{
  echo "<script>alert('Los datos no se han podido guardar correctamente');window.location='Modelos.php'</script>";
}
}

?>