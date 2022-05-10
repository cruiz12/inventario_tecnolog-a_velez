<?php 
include('DB/conexion.php');
session_start();
$NombreSesion_User = $_SESSION['name'];
//echo $NombreSesion_User;
/* AQUI SE CREA Y SE EJECUTA EL QUERY QUE SELECIONA LA LISTA DE PENDIENTES PARA MOSTRAR ESOS DATOS*/
$sql = "SELECT * FROM tabla_pendientes WHERE usuario_pendiente='$NombreSesion_User'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

?>

<li>
    <span class="text"><?php echo $row['titulo']; ?></span>
    <i id="removeBtn" class="icon fa fa-trash" data-id="<?php echo $row['id']; ?>"></i>
</li>

<?php 

    }
    echo '<div class="pending-text">Hay ' . mysqli_num_rows($result) . ' tareas pendientes.</div>';
 } else {
    echo "<li><span class='text'>Ninguna tarea pendiente.</span></li>";
 }

?>