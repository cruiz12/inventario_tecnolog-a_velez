<?php

include('DB/conexion.php');

$marca2=$_POST['marca2'];
	$sql2mo="SELECT *
	   from modelo
		where marca_m ='$marca2'";
	
	$resultados2=mysqli_query($con,$sql2mo);
	$cadena2=" 
    <label for='modelo2'>Modelo:</label>
	<select name='modelo2' id='controlBuscador8' style='width: 100%' >";
	while ($vermodelo2=mysqli_fetch_row($resultados2)) {
		$cadena2=$cadena2.'<option value='.$vermodelo2[0].'>'.($vermodelo2[1]).'</option>';
	}
	echo  $cadena2."</select>
    </div>";
    
?>