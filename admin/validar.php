<?php 
	session_start();
	include("DB/conexion.php");


	$username = $_POST['usuario'];
	$password = sha1($_POST['clave']);

	$res = $con->query("SELECT * FROM tecnicos WHERE usuario='".$username."' AND clave='".$password."'")or die($con->error);
	session_regenerate_id();
	$_SESSION['loggedin'] = TRUE;
	$_SESSION['name'] = $username;
	if(mysqli_num_rows($res) > 0 ){
		echo "<script>location.href='Inicio.php'</script>";
	}else{
		echo "<script>alert('Usuario o contraseña incorrecto');window.location='../Login.php'</script>";
	}

?>