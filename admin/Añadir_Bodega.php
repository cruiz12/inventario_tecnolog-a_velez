<?php

include('DB/conexion.php');
/* CONDICIÓN: SI LE DAN AL BOTÓN AGREGAR BODEGA...Y SI NO HAY CAMPOS VACIOS*/
if (isset($_POST['Agregar_Bodega']) && !empty($_POST['id_bodega']) && !empty($_POST['Nombre_Bodega']) && !empty($_POST['idPais']) && !empty($_POST['idCiudad'])&& !empty($_POST['idDepartamento']) && !empty($_POST['Direccion_Bodega'])) {

  /* AQUI SE ATRAPAN LOS DATOS DEL FORMULARIO */

  $id_bodega = $_POST['id_bodega'];
  $Nombre_Bodega = $_POST['Nombre_Bodega'];
  $pais = $_POST['idPais'];
  $ciudad = $_POST['idCiudad'];
  $departamento = $_POST['idDepartamento'];
  $Direccion_Bodega = $_POST['Direccion_Bodega'];

  /* AQUI CREAMOS Y EJECUTAMOS EL QUERY PARA INSERTAR A LA NUEVA BODEGA */
  $query = "INSERT INTO bodega(id_bodega,nombre_bodega, pais_b, departamento_b, ciudad_b, direccion) 
  VALUES ('$id_bodega','$Nombre_Bodega','$pais','$departamento','$ciudad','$Direccion_Bodega')";
  $ResultadoInsertBodega = mysqli_query($con, $query);
  

  if($ResultadoInsertBodega){
    echo "<script>alert('La bodega $Nombre_Bodega se ha agregado satisfactoriamente');window.location='bodega.php'</script>";
    }else{
      echo "<script>alert('los datos no se han podido guardar correctamente');</script>";
    }  
}else{
  echo "<script>alert('Completa todos los campos del formulario');window.location='bodega.php'</script>";
exit;}

?>
