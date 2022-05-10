<?php

include('DB/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nro_de_contrato = $con->real_escape_string(htmlentities($_POST['Nro_de_contrato']));
    $Proveedor = $_POST['Proveedor'];
    $Fecha_de_inicio = $con->real_escape_string(htmlentities($_POST['Fecha_de_inicio']));
    $Fecha_fin = $con->real_escape_string(htmlentities($_POST['Fecha_fin']));

    $file_name = $_FILES['file']['name'];

    $new_name_file = null;

    if ($file_name != '' || $file_name != null) {
        $file_type = $_FILES['file']['type'];
        list($type, $extension) = explode('/', $file_type);
        if ($extension == 'pdf') {
            $dir = 'files/';
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $file_tmp_name = $_FILES['file']['tmp_name'];
            //$new_name_file = 'files/' . date('Ymdhis') . '.' . $extension;
            $new_name_file = $dir . file_name($file_name) . '.' . $extension;
            if (copy($file_tmp_name, $new_name_file)) {
                
            }
        }
    }
    
    $ins = $con->query("INSERT INTO contrato(Nro_de_contrato,Proveedor,Fecha_de_inicio,Fecha_fin,ruta_pdf) VALUES ($Nro_de_contrato,'$Proveedor','$Fecha_de_inicio','$Fecha_fin','$new_name_file')");
    if ($ins) {
    
    echo 'Contrato agregado exitosamente';
  
      } else {
    echo 'Error al agregar contrato';
    }

}