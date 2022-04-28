

<?php

    require('../models/config.php');
    include_once('../models/sorteos.model.php');

    $sorteoModel = new sorteos();

    header("Content-Type: application/json");

    $data = json_decode(file_get_contents('php://input'), true);

    if($data['id'] != ''){
        echo $sorteoModel->update_sorteos($data['id'], $data['name'],$data['costo'],$data['desp'],$data['num'],$data['inicio'],$data['final'],$data['adi'],$data['sorteo'],$data['img']);

    }else{
        echo $sorteoModel->add_sorteos($data['name'],$data['costo'],$data['desp'],$data['num'],$data['inicio'],$data['final'],$data['adi'],$data['sorteo'],$data['img']);

    }



?>