
    <?php 
    $con = mysqli_connect("localhost","root","","database_inventario_cv");
     
    if(!$con){
        die("Connection error: " . mysqli_connect_error());	
    }

    function file_name($string) {

        // Tranformamos todo a minusculas
    
        $string = strtolower($string);
    
        //Rememplazamos caracteres especiales latinos
    
        $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
    
        $repl = array('a', 'e', 'i', 'o', 'u', 'n');
    
        $string = str_replace($find, $repl, $string);
    
        // Añadimos los guiones
    
        $find = array(' ', '&', '\r\n', '\n', '+');
        $string = str_replace($find, '-', $string);
    
        // Eliminamos y Reemplazamos otros carácteres especiales
    
        $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
    
        $repl = array('', '-', '');
    
        $string = preg_replace($find, $repl, $string);
    
        return $string;
    }
    ?>
  