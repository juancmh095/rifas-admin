<?php

    require('../models/config.php');
    include_once('../models/sorteos.model.php');

    $sorteoModel = new sorteos();

    header("Content-Type: application/json");

    $data = json_decode(file_get_contents('php://input'), true);
    

    if($data['id'] != ''){

    }else{
        echo $sorteoModel->add_pre_sorteos($data['name'],$data['sorteo'],$data['desp'],$data['final'],$data['hora']);
    }

?>