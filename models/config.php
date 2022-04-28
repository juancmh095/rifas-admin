<?php
class conectar{
      public function conection(){
        try{
            
             $user = "root";
             $password = "";
             $db = "rifas";
             $host = "localhost";
            /*  $user = "dbu2182891";
             $password = "ststechnology95";
             $host = "db5007387023.hosting-data.io";
             $db = "dbs6087158"; */
             $conexion = new PDO("mysql:host=$host;dbname=$db;",$user,$password);
             return $conexion;
           }catch(PDOException $e){
             echo "¡Error!: " . $e->getMessage() . "<br/>";
             die();
           }
            echo "conecto";
  }

}
?>