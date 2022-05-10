<?php 

include("DB/conexion.php");

/* AQUI SE ATRAPAN LOS DATOS */
if(isset($_POST['agregar_orden_compra'])){

/* AQUI ATRAPAMOS LOS DATOS */  
$id_orden  = $_POST['id_orden'];
$id_proveedor_pedido= $_POST['Proveedor'];
$fecha_emision_pedido = $_POST['fecha_emision_pedido'];
$fecha_recepcion_pedido = $_POST['fecha_recepcion_pedido'];

/* AQUI SE VERIFICA POR MEDIO DE UN SELECT SI El id_orden (DATO UNICO) NO SE ENCUENTRA YA ASIGNADO A OTRO CLIENTE REGISTRADO EN LA BASE DE DATOS */
$query="SELECT id_orden FROM orden_compra WHERE id_orden = $id_orden";
$resultado= $con->query($query);
$row=$resultado->fetch_assoc();

if($row>0){
  echo "<script>alert('La orden de compra con el id: $id_orden, ya se encuentra registrada');window.location='Orden_Compra.php'</script>";
}else{
  /* AQUI CREAMOS Y EJECUTAMOS EL QUERY PARA INSERTAR A LA NUEVA ORDEN DE COMPRA */
  $query = "INSERT INTO orden_compra (id_orden,id_proveedor_pedido,fecha_emision_pedido,fecha_recepcion_pedido)
  VALUES ($id_orden,$id_proveedor_pedido, '$fecha_emision_pedido' , '$fecha_recepcion_pedido')";
  $ResultadoAgregarOrdendeCompra = $con->query($query);
}

if($ResultadoAgregarOrdendeCompra){
  echo "<script>alert('La orden de compra número: $id_orden, se ha agregado satisfactoriamente');window.location='Orden_Compra.php'</script>";
}else{
  echo "<script>alert('Los datos no se han podido guardar correctamente');window.location='Proveedor.php'</script>";
}
}

?>