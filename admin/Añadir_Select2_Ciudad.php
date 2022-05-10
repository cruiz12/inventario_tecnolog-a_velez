<?php

include('DB/conexion.php');
$id_bodega = $_POST['id_bodega'];
$query3="SELECT * FROM bodega
INNER JOIN ciudades ON bodega.ciudad_b = ciudades.idCiudad
WHERE id_bodega='$id_bodega'";
$resultadociuid= $con->query($query3);
$ciuid=$resultadociuid->fetch_assoc();
$id_ciudad = $ciuid['departamento_b'];
$idDepartamento=$_POST['idDepartamento'];
	$sql3="SELECT *
		from ciudades
		where departamento = '$idDepartamento'"; 
	$result=mysqli_query($con,$sql3);
	$cadena='
    <label for="idCiudad">Ciudad:</label>
	<select name="idCiudad" id="controlBuscador3" style="width: 100%">
	<option value="'.$id_ciudad.'">'.$ciuid['nombre_ciudad'].'(ACTUAL)</option>';
	while ($row=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$row[0].'>'.($row[1]).'</option>';
	}
	echo  $cadena."</select>";
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador3').select2();
	});
</script>
