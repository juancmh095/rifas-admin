<?php 

    try {
        //code...
        require('../models/config.php');
        require('../models/usuarios.model.php');

        $query = new usuarios();


        header("Content-Type: application/json");
        $data = json_decode(file_get_contents('php://input'), true);

        $response = $query->login($data['email'],$data['password']);

        /* $response = json_encode($response); */

        if(count($response)>0){
            session_start();
            if(isset($_SESSION['id_user'])){
                /* respuesta token:text */
                echo json_encode('{"response":"login","token":"x"}');
            }else{
                foreach($response as $item){
                    $_SESSION['id_user'] = $item['id'];
                    $_SESSION['name'] = $item['name'];
                    $_SESSION['role'] = $item['rol'];
                    
                    echo json_encode('{"response":"login","token":"x"}');
                }
            }
            
        }else{
            echo json_encode('{"msg":"Error de usuario y/o contraseña"}');
        }


    } catch (\Throwable $th) {
        //throw $th;
    }
?>