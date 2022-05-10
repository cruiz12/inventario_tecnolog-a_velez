<?php

include('DB/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nro_de_contrato = $con->real_escape_string(htmlentities($_POST['Nro_de_contrato']));
    $Nro_factura = $con->real_escape_string(htmlentities($_POST['Nro_factura']));

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
    
    $ins = $con->query("INSERT INTO factura_pdf(Nro_factura,Nro_contrato_f,ruta_fac_contrato) VALUES ('$Nro_factura','$Nro_de_contrato','$new_name_file')");
    if ($ins) {
    
    echo 'Factura agregada exitosamente';
         
      } else {
    echo 'Error al agregar factura';
    }

}