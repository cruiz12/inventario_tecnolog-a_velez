<?php 

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS */
if(isset($_POST['agregar_admin'])){

/* AQUI ATRAPAMOS LOS DATOS */  
$Nombres = $_POST['nombre'];
$Apellidos= $_POST['apellidos'];
$Usuario= $_POST['nombre_usuario'];
$Clave = sha1($_POST['clave']);
$Rol = "Administrador";

  /* AQUI CREAMOS Y EJECUTAMOS EL QUERY PARA INSERTAR AL NUEVO USUARIO */
  $query = "INSERT INTO tecnicos (usuario, clave, Apellidos_Usuario, Nombre_Usuario, rol)
  VALUES ('$Usuario','$Clave', '$Apellidos', '$Nombres', '$Rol')";
  $ResultadoAgregarAdmin = $con->query($query);

if($ResultadoAgregarAdmin){
  echo "<script>alert('El Administrador $Usuario, se ha agregado satisfactoriamente');window.location='Administradores.php'</script>";
}else{
  echo "<script>alert('Los datos no se han podido guardar correctamente');window.location='Administradores.php'</script>";
}
}

?>