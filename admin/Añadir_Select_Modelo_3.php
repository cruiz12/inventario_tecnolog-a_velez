<?php

include('DB/conexion.php');
$codigo_serial=$_POST['codigo_serial'];
$query="SELECT * FROM dispositivos
INNER JOIN marca ON dispositivos.marca = marca.id_marca
INNER JOIN modelo ON dispositivos.modelo = modelo.id_modelo
INNER JOIN tipo_dispositivo ON dispositivos.tipo_dispositivo = tipo_dispositivo.id_tipo_dispositivo WHERE codigo_serial='$codigo_serial'";
$resultadomode= $con->query($query);
$modeid=$resultadomode->fetch_assoc();
$id_modelo = $modeid['id_modelo'];
$id_marca=$_POST['id_marca'];
	$sql2="SELECT *
		from modelo
		where marca_m ='$id_marca'";
	
	$resultados=mysqli_query($con,$sql2);
	$cadena='
    <label for="codigo_modelo">Modelo:</label>
	<select name="modelo" id="controlBuscador2" style="width: 100%" >
    <option value="'.$id_modelo.'">'.$modeid['codigo_modelo'].'(ACTUAL)</option>';
	while ($vermode=mysqli_fetch_row($resultados)) {
		$cadena=$cadena.'<option value='.$vermode[0].'>'.($vermode[1]).'</option>';
	}
	echo  $cadena."</select>";
    
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador2').select2();
	});
</script>

