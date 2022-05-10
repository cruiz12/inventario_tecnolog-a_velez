<?php 

include('DB/conexion.php');
session_start();
/* AQUI ATRAPAMOS LOS DATOS */
$task = $_POST['task'];
$NombreSesion_User = $_SESSION['name'];
//echo $user;
/* AQUI SE CREA Y SE EJECUTA EL QUERY PARA INSERTAR LA NUEVA TAREA/PENDIENTE */
$sql = "INSERT INTO tabla_pendientes ('titulo','usuario_pendiente') VALUES ('$task','$NombreSesion_User')";
$result = mysqli_query($con, $sql);

if ($result) {
    echo 1;
} else {
    echo 0;
}

?>