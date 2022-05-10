<?php 

include('DB/conexion.php');

$id = $_POST['id'];

$sql = "DELETE FROM tabla_pendientes WHERE id='$id'";
$result = mysqli_query($con, $sql);

if ($result) {
    echo 1;
} else {
    echo 0;
}

?>