<?php

include('DB/conexion.php');

$marca=$_POST['marca'];
	$sql2="SELECT *
	   from modelo
		where marca_m ='$marca'";
	
	$resultados=mysqli_query($con,$sql2);
	$cadena=" 
    <label for='modelo'>Modelo:</label>
	<select name='modelo' id='controlBuscador3' style='width: 100%' >";
	while ($vermodelo=mysqli_fetch_row($resultados)) {
		$cadena=$cadena.'<option value='.$vermodelo[0].'>'.($vermodelo[1]).'</option>';
	}
	echo  $cadena."</select>
    </div>";
    
?>