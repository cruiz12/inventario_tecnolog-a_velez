<?php

include('DB/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Actual_Contrato = $_POST['First_Nro_de_contrato'];
    $ruta_pdf = $_POST['ruta_pdf'];
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
    if ($new_name_file != '' || $new_name_file != null) {
    $ins = $con->query("UPDATE contrato SET Nro_de_contrato='$Nro_de_contrato', Proveedor='$Proveedor', Fecha_de_inicio='$Fecha_de_inicio', Fecha_fin='$Fecha_fin', ruta_pdf='$new_name_file' WHERE Nro_de_contrato='$Actual_Contrato'");
    if ($ins) {
        If (unlink($ruta_pdf)) {
            // file was successfully deleted
          } else {
            echo "No se pudo eliminar el archivo de la ruta";
          }
    echo 'Se han realizado correctamente los cambios';
  
      } else {
    echo 'Error al agregar contrato';
    }
    } else{
        $ins = $con->query("UPDATE contrato SET Nro_de_contrato='$Nro_de_contrato', Proveedor='$Proveedor', Fecha_de_inicio='$Fecha_de_inicio', Fecha_fin='$Fecha_fin' WHERE Nro_de_contrato='$Actual_Contrato'");
    if ($ins) {
    
    echo 'Se han realizado correctamente los cambios';
  
      } else {
    echo 'Error al agregar contrato';
    }
    }

}