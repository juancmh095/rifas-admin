<?php

    require('../models/config.php');
    include_once('../models/usuarios.model.php');

    $usuariosModel = new usuarios();

    header("Content-Type: application/json");

    $data = json_decode(file_get_contents('php://input'), true);

    if($data['id'] != ''){

    }else{
        echo $usuariosModel->add_users($data['name'],$data['email'],$data['password'],$data['rol']);

    }



?>