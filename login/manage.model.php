<?php
  require_once("conn.model.php");

  class Manage{
    function consult($ICNUM){
      $pdo= DataBase::connect();
      $consultalog="SELECT * FROM Usuario WHERE ICNUM = ?";
      $querylog= $pdo->prepare($consultalog);
      $querylog->execute(array($ICNUM));
      $resultlog=$querylog->fetch(PDO::FETCH_BOTH);
      DataBase::disconnect();
      return $resultlog;
    }
    function consultInv($ICNUM){
      $pdo= DataBase::connect();
      $consultalog="SELECT * FROM InventarioT WHERE Cedula = ?";
      $querylog= $pdo->prepare($consultalog);
      $querylog->execute(array($ICNUM));
      $resultlog=$querylog->fetchAll(PDO::FETCH_BOTH);
      DataBase::disconnect();
      return $resultlog;
    }
    function consultmod($DISPOSITIVO, $MARCA){
      $pdo= DataBase::connect();
      $consultalog="SELECT Modelo FROM Modelo WHERE Dispositivo = ? AND Marca = ?";
      $querylog= $pdo->prepare($consultalog);
      $querylog->execute(array($DISPOSITIVO, $MARCA));
      $resultlog=$querylog->fetchALL(PDO::FETCH_BOTH);
      DataBase::disconnect();
      return $resultlog;
    }
    function save($Activo, $Dispositivo, $Serial, $Responsable, $Cedula, $Ceco, $Marca, $Modelo, $Mouse, $Teclado, $Base, $Cargo, $Fecha, $Estado, $Tecnico){
			$pdo= DataBase::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$consulta = "INSERT INTO InventarioT (Activo, Dispositivo, Seriall, Responsable, Cedula, Ceco, Marca, Modelo, Mouse, Teclado, Base, Cargo, Fecha, Estado, Tecnico)
                   VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$query= $pdo->prepare($consulta);
			$query->execute(array($Activo, $Dispositivo, $Serial, $Responsable, $Cedula, $Ceco, $Marca, $Modelo, $Mouse, $Teclado, $Base, $Cargo, $Fecha, $Estado, $Tecnico));
      DataBase::disconnect();
		}
    function validaract($ACTIVO){
      $pdo= DataBase::connect();
      $consultalog="SELECT Count(Activo) FROM InventarioT WHERE Activo = ?";
      $querylog= $pdo->prepare($consultalog);
      $querylog->execute(array($ACTIVO));
      $resultlog=$querylog->fetch(PDO::FETCH_BOTH);
      DataBase::disconnect();
      return $resultlog;
    }
    function validarusuact($ACTIVO){
      $pdo= DataBase::connect();
      $consultalog="SELECT Responsable FROM InventarioT WHERE Activo = ?";
      $querylog= $pdo->prepare($consultalog);
      $querylog->execute(array($ACTIVO));
      $resultlog=$querylog->fetch(PDO::FETCH_BOTH);
      DataBase::disconnect();
      return $resultlog;
    }
    function validarsrl($SERIAL){
      $pdo= DataBase::connect();
      $consultalog="SELECT Count(Seriall) FROM InventarioT WHERE Seriall = ?";
      $querylog= $pdo->prepare($consultalog);
      $querylog->execute(array($SERIAL));
      $resultlog=$querylog->fetch(PDO::FETCH_BOTH);
      DataBase::disconnect();
      return $resultlog;
    }
    function validarususrl($SERIAL){
      $pdo= DataBase::connect();
      $consultalog="SELECT Responsable FROM InventarioT WHERE Seriall = ?";
      $querylog= $pdo->prepare($consultalog);
      $querylog->execute(array($SERIAL));
      $resultlog=$querylog->fetch(PDO::FETCH_BOTH);
      DataBase::disconnect();
      return $resultlog;
    }
    function update($Activo1, $Dispositivo, $Serial1, $Responsable, $Cedula, $Ceco, $Marca, $Modelo, $Mouse, $Teclado, $Base, $Cargo, $Fecha, $Estado, $Tecnico, $Activo, $Serial){
			$pdo= DataBase::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$consulta = "UPDATE InventarioT SET Activo = ?, Dispositivo = ?, Seriall = ?, Responsable = ?, Cedula = ?,
                   Ceco = ?, Marca = ?, Modelo = ?, Mouse = ?, Teclado = ?, Base = ?, Cargo = ?, Fecha = ?, Estado = ?, Tecnico = ? WHERE Activo = ? OR Seriall = ?";
			$query= $pdo->prepare($consulta);
			$query->execute(array($Activo1, $Dispositivo, $Serial1, $Responsable, $Cedula, $Ceco, $Marca, $Modelo, $Mouse, $Teclado, $Base, $Cargo, $Fecha, $Estado, $Tecnico, $Activo, $Serial));
      DataBase::disconnect();
		}
    function validartec($ICNUM){
      $pdo= DataBase::connect();
      $consultalog="SELECT * FROM Tecnico WHERE ICNUM = ?";
      $querylog= $pdo->prepare($consultalog);
      $querylog->execute(array($ICNUM));
      $resultlog=$querylog->fetch(PDO::FETCH_BOTH);
      DataBase::disconnect();
      return $resultlog;
    }
    function saveN($Activo, $Dispositivo, $Serial, $Responsable, $Cedula, $Ceco, $Marca, $Modelo, $Cargo, $Fecha, $Estado, $Tecnico, $Observaciones){
			$pdo= DataBase::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$consulta = "INSERT INTO InventarioT (Activo, Dispositivo, Seriall, Responsable, Cedula, Ceco, Marca, Modelo, Cargo, Fecha, Estado, Tecnico)
                   VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$query= $pdo->prepare($consulta);
			$query->execute(array($Activo, $Dispositivo, $Serial, $Responsable, $Cedula, $Ceco, $Marca, $Modelo, $Cargo, $Fecha, $Estado, $Tecnico));
      DataBase::disconnect();
		}
  }




?>
