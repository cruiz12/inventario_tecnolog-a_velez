<?php
		require("ldap.controller.php");
		header("Content-Type: text/html; charset=utf-8");
		$usr = $_POST["usuario"];
		$usuario = mailboxpowerloginrd($usr,$_POST["clave"]);
		echo 'usuario'.$usuario['usuario'];
		if($usuario['usuario'] == "0" || $usuario['usuario'] == ''){
			$_SERVER = array();
			$_SESSION = array();
			// echo"<script>window.location.href='View/alert.login.php'; </script>";
			echo 'La contraseña es incorrecta';
		}else{
			session_start();
			$_SESSION["user"] = $usuario['usuario'];
			$_SESSION["autentica"] = "SIP";
			$_SESSION["icnum"] = $usuario['icnum'];

			// echo "<script>window.location.href='index1.php?usuario='</script>";
			echo "<script>window.location.href='login.controller.php?action=LOG&usuario=".$_SESSION["user"]."'</script>";
		}
?>
