<?php
 class DataBase{
   private static  $server = 'VENUS\SQL04';
   private static  $database = '';
   private static  $username = '';
   private static  $password = '';
   private static  $db = null;

    public static function connect(){
      if(self::$db == null){
        try {
            self::$db = new PDO('sqlsrv:Server=' . self::$server . ';Database='. self::$database,self::$username,self::$password);
            // self::$db = new PDO("dblib:host=VENUS\SQL04;dbname=InventarioT", "appsvelezinv", '@pp$Velez.2018');
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch (PDOException $e) {
            echo $e->getMessage();
          }
      }return self::$db;
    }
    public static function disconnect(){
         self::$db = null;
      }
  }
?>
