<?php

include('DB/conexion.php');

$idPais=$_POST['idPais'];
	$sql2="SELECT *
		from departamento
		where pais ='$idPais'";
	
	$resultados=mysqli_query($con,$sql2);
	$cadena=" 
    <label for='idDepartamento'>Departamento:</label>
	<select name='idDepartamento' id='controlBuscador2' style='width: 100%' >";
	while ($verdepa=mysqli_fetch_row($resultados)) {
		$cadena=$cadena.'<option value='.$verdepa[0].'>'.($verdepa[1]).'</option>';
	}
	echo  $cadena."</select>
    <div  id='select3lista' class='form-group'>
    </div>";
    
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador2').select2({ dropdownParent: "#staticBackdrop" });
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador2').val(1);
		recargarLista2();

		$('#controlBuscador2').change(function(){
			recargarLista2();
		});
	})
</script>
<script type="text/javascript">
	function recargarLista2(){
		$.ajax({
			type:"POST",
			url:"Añadir_Select_Ciudad.php",
			data:"idDepartamento=" + $('#controlBuscador2').val(),
			success:function(r){
				$('#select3lista').html(r);
			}
		});
	}
</script>


