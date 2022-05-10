<?php 

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS */
if(isset($_POST['agregar_proveedor'])){

/* AQUI ATRAPAMOS LOS DATOS */  
$nit = $_POST['nit'];
$razon_social= $_POST['razon_social'];
$comercial= $_POST['comercial'];
$Telefono = $_POST['Telefono'];
$correo = $_POST['correo'];

/* AQUI SE VERIFICA POR MEDIO DE UN SELECT SI EL CELULAR (DATO UNICO) NO SE ENCUENTRA YA ASIGNADO A OTRO CLIENTE REGISTRADO EN LA BASE DE DATOS */
$query="SELECT nit FROM proveedor WHERE nit = $nit";
$resultado= $con->query($query);
$row=$resultado->fetch_assoc();

if($row>0){
  echo "<script>alert('El Proveedor con el nit: '$nit' , ya se encuentra registrado');window.location='Proveedor.php'</script>";
}else{
  /* AQUI CREAMOS Y EJECUTAMOS EL QUERY PARA INSERTAR AL NUEVO CLIENTE/DUEÑO */
  $query = "INSERT INTO proveedor (nit,razon_social,comercial,Telefono,correo)
  VALUES ('$nit','$razon_social', '$comercial', '$Telefono', '$correo')";
  $ResultadoAgregarProveedor = $con->query($query);
}

if($ResultadoAgregarProveedor){
  echo "<script>alert('El Proveedor $razon_social se ha agregado satisfactoriamente');window.location='Proveedor.php'</script>";
}else{
  echo "<script>alert('Los datos no se han podido guardar correctamente');window.location='Proveedor.php'</script>";
}
}

?>