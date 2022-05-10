<?php

include('DB/conexion.php');

$idDepartamento=$_POST['idDepartamento'];
	$sql3="SELECT *
		from ciudades
		where departamento = '$idDepartamento'"; 
	$result=mysqli_query($con,$sql3);
	$cadena=" 
    <label for='idCiudad'>Ciudad:</label>
	<select name='idCiudad' id='controlBuscador3' style='width: 100%'>";
	while ($row=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$row[0].'>'.($row[1]).'</option>';
	}
	echo  $cadena."</select>";
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador3').select2({ dropdownParent: "#staticBackdrop" });
	});
</script>
