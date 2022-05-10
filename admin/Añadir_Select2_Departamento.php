<?php

include('DB/conexion.php');
$id_bodega=$_POST['id_bodega'];
$query="SELECT * FROM bodega
INNER JOIN departamento ON bodega.departamento_b = departamento.idDepartamento
WHERE id_bodega='$id_bodega'";
$resultadodepid= $con->query($query);
$depid=$resultadodepid->fetch_assoc();
$id_departamento = $depid['departamento_b'];
$idPais=$_POST['idPais'];
	$sql2="SELECT *
		from departamento
		where pais ='$idPais'";
	
	$resultados=mysqli_query($con,$sql2);
	$cadena='
    <label for="idDepartamento">Departamento:</label>
	<select name="idDepartamento" id="controlBuscador2" style="width: 100%" >
    <option value="'.$id_departamento.'">'.$depid['nombre_departamento'].'(ACTUAL)</option>';
	while ($verdepa=mysqli_fetch_row($resultados)) {
		$cadena=$cadena.'<option value='.$verdepa[0].'>'.($verdepa[1]).'</option>';
	}
	echo  $cadena."</select>
    <div  id='select3lista' class='form-group'>
    </div>";
    
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#controlBuscador2').select2();
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
		var datos = "id_bodega=" + "<?php echo $id_bodega ?>"+"&idDepartamento=" + $('#controlBuscador2').val();
		$.ajax({
			type:"POST",
			url:"Añadir_Select2_Ciudad.php",
			data: datos,
			success:function(r){
				$('#select3lista').html(r);
			}
		});
	}
</script>


